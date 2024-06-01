<?php

namespace App\Http\Controllers;

use App\Models\Child_category;
use Illuminate\Http\Request;
use App\Models\Purchase_order;
use App\Models\Purchase_order_item;
use App\Models\Garage;
use App\Models\Product;
use App\Models\Product_child;
use App\Models\Purchase_invoice;
use App\Models\Purchase_invoice_item;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use PDF;
use Yajra\DataTables\Facades\DataTables;

use function Ramsey\Uuid\v1;

class PurchaseInvoiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:indexpurchaseinvoice', ['only' => ['show', 'index']]);
        $this->middleware('permission:createpurchaseinvoice', ['only' => ['submit']]);
        $this->middleware('permission:approvepurchaseinvoice', ['only' => ['approve', 'cancell']]);
        $this->middleware('permission:rejectpurchaseinvoice', ['only' => ['approve', 'cancell']]);
    }
    public function createpdf($id)
    {
        try {
            $pi_detail = Purchase_invoice::with('createdby', 'updatedby', 'approvedby', 'canceledby', 'supplierid', 'garageid')
                ->where("id", $id)
                ->first();
            $pi_item = Purchase_invoice_item::where("purchase_invoice_id", $id)->get();
            return view('purchaseinvoice/pdfdownload', compact('pi_detail', 'pi_item'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function submit($id)
    {
        $purchase_invoice_find_id = Purchase_invoice::select("purchase_order_id")
            ->where("purchase_order_id", $id)->pluck("purchase_order_id")->first();
        try {
            if (empty($purchase_invoice_find_id)) {
                $puchase_order = Purchase_order::findOrFail($id);
                $puchase_order->status = 'finish';
                $puchase_order->save();

                $puchase_order_item = Purchase_order_item::where("purchase_order_id", $id)->get();
                $iduser = Auth::id();
                $purchase_last_id = Purchase_invoice::max("id");
                $pi_number = 'PI-' . $iduser . '-' . $puchase_order->supplier_id . '-' . date("dmy") . '-' . ($purchase_last_id + 1);
                $purchaseinvoice = new Purchase_invoice();
                $purchaseinvoice->pi_number = $pi_number;
                $purchaseinvoice->status = 'submit';
                $purchaseinvoice->total = $puchase_order->total;
                $purchaseinvoice->created_at = date("d-m-yyyy");
                $purchaseinvoice->updated_at = null;
                $purchaseinvoice->created_by = $iduser;
                $purchaseinvoice->supplier_id = $puchase_order->supplier_id;
                $purchaseinvoice->garage_id = $puchase_order->garage_id;
                $purchaseinvoice->purchase_order_id = $puchase_order->id;
                $purchaseinvoice->save();

                $total_detail_items = count($puchase_order_item);
                $last_insert_id = Purchase_invoice::where("pi_number", $pi_number)->pluck("id")->first();

                for ($i = 0; $i < $total_detail_items; $i++) {
                    Purchase_invoice_item::insert([
                        'purchase_invoice_id' => $last_insert_id,
                        'product_id' => $puchase_order_item[$i]->product_id,
                        'product_code' => $puchase_order_item[$i]->product_name,
                        'product_name' => $puchase_order_item[$i]->product_code,
                        'quantity' => $puchase_order_item[$i]->quantity,
                        'price' => $puchase_order_item[$i]->price,
                        'subtotal' => $puchase_order_item[$i]->subtotal,
                        'created_at' => now(),
                        'created_by' => $iduser,
                    ]);
                }
                return redirect()->route('purchaseorder.index')->with('succes', 'Purchase invoice was submited successfully');
            } else {
                return redirect()->route('purchaseorder.index')->with('fail', 'The purchase order already has a purchase invoice');
            }
        } catch (\Throwable $th) {
            dd ($th->getMessage());
        }
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->hasRole('superadmin')) {
                $data = Purchase_invoice::with('puchaseorderid', 'createdby', 'updatedby', 'approvedby', 'canceledby', 'supplierid', 'garageid')
                    ->orderBy('id', 'DESC')->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            } else {
                $data = Purchase_invoice::with('puchaseorderid', 'createdby', 'updatedby', 'approvedby', 'canceledby', 'supplierid', 'garageid')
                    ->whereRelation('garageid', 'garage_id', Auth::user()->garage_id)
                    ->orderBy('id', 'DESC')->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }
        }
        return view('purchaseinvoice/index');
    }
    public function show($id)
    {
        if (Auth::user()->hasRole('superadmin')) {
            $pi_detail = Purchase_invoice::with('createdby', 'updatedby', 'approvedby', 'canceledby', 'supplierid', 'garageid')
                ->where("id", $id)
                ->first();
        } else {
            $pi_detail = Purchase_invoice::with('createdby', 'updatedby', 'approvedby', 'canceledby', 'supplierid', 'garageid')
                ->where("id", $id)
                ->first();
            $id_garage = $pi_detail->garageid->id;
            if ($id_garage != Auth()->user()->garage_id) {
                return view('error');
            }
        }
        $pi_item = Purchase_invoice_item::where("purchase_invoice_id", $id)->get();
        return view('purchaseinvoice/details', compact('pi_detail', 'pi_item'));
    }
    public function approve($id)
    {
        try {
            $iduser = Auth::id();
            $Purchase_invoice = Purchase_invoice::findOrFail($id);
            $Purchase_invoice->approved_at = date("yy-m-d");
            $Purchase_invoice->approved_by = $iduser;
            $Purchase_invoice->status = 'approved';
            $Purchase_invoice->save();
            return redirect()->route('purchaseinvoice.index')->with('succes', 'Puchase invoice was approved successfully');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function cancell($id)
    {
        try {
            $this->middleware(['role:puchaserspv|superadmin', 'permission:rejectpurchaseinvoice']);
            $iduser = Auth::id();
            $Purchase_invoice = Purchase_invoice::findOrFail($id);
            $Purchase_invoice->canceled_at = date("yy-m-d");
            $Purchase_invoice->canceled_by = $iduser;
            $Purchase_invoice->status = 'cancelled';
            $Purchase_invoice->save();
            return redirect()->route('purchaseinvoice.index')->with('succes', 'Puchase invoice was canceled successfully');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
