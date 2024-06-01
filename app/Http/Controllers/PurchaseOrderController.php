<?php

namespace App\Http\Controllers;

use App\Models\Child_category;
use Illuminate\Http\Request;
use App\Models\Purchase_order;
use App\Models\Purchase_order_item;
use App\Models\Garage;
use App\Models\Product;
use App\Models\Product_child;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Traits\HasRoles;
use Yajra\DataTables\Facades\DataTables;

class PurchaseOrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:indexpurchaseorder', ['only' => ['show', 'index']]);
        $this->middleware('permission:createpurchaseorder', ['only' => ['create', 'store']]);
        $this->middleware('permission:approvepurchaseorder', ['only' => ['approve']]);
        $this->middleware('permission:rejectpurchaseorder', ['only' => ['cancell']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->hasRole('superadmin')) {
                $data = Purchase_order::with('createdby', 'updatedby', 'approvedby', 'canceledby', 'supplierid', 'garageid')
                    ->orderBy('id', 'DESC')
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            } else {
                $data = Purchase_order::with('createdby', 'updatedby', 'approvedby', 'canceledby', 'supplierid', 'garageid')
                    ->whereRelation('garageid', 'garage_id', Auth::user()->garage_id)
                    ->orderBy('id', 'DESC')
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }
        }
        return view('purchaseorder/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::where('isarchive', '=', '0')->get();
        $garage = Garage::where('isarchive', '=', '0')->get();
        return view('purchaseorder/create', compact('supplier', 'garage'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'supplier_id' => 'required',
            'garage_id' => 'required',
            'idproduct' => 'required',
        ];
        $this->validate($request, $rules);
        try {
            $iduser = Auth::id();
            $purchase_last_id = Purchase_order::max("id");
            $po_number = 'PO-' . $iduser . '-' . $request->supplier_id . '-' . date("dmy") . '-' . ($purchase_last_id + 1);
            $purchaseorder = new Purchase_order();
            $purchaseorder->po_number = $po_number;
            $purchaseorder->status = 'submit';
            $purchaseorder->total = array_sum($request->subtotal);
            $purchaseorder->created_at = date("d-m-yyyy");
            $purchaseorder->updated_at = null;
            $purchaseorder->created_by = $iduser;
            $purchaseorder->supplier_id = $request->input('supplier_id');
            $purchaseorder->garage_id = $request->input('garage_id');
            $purchaseorder->note = $request->input('notes');
            $purchaseorder->save();

            $total_detail_items = count($request->idproduct);
            $last_insert_id = Purchase_order::where("po_number", $po_number)->pluck("id")->first();
            for ($i = 0; $i < $total_detail_items; $i++) {
                Purchase_order_item::insert([
                    'purchase_order_id' => $last_insert_id,
                    'product_id' => $request->idproduct[$i],
                    'product_name' => $request->productname[$i],
                    'product_code' => $request->codeproduct[$i],
                    'quantity' => $request->quantity[$i],
                    'price' => $request->price[$i],
                    'subtotal' => $request->subtotal[$i],
                    'created_at' => now(),
                    'created_by' => $iduser,
                ]);
            }
            return redirect()->route('purchaseorder.index')->with('succes', 'Purchase order was submited successfully');
        } catch (\Throwable $th) {
            return redirect()->route('purchaseorder.index')->with('fail', 'fail to crate'.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->hasRole('superadmin')) {
            $po_detail = Purchase_order::with('createdby', 'updatedby', 'approvedby', 'canceledby', 'supplierid', 'garageid')
                ->where("id", $id)
                ->first();
        } else {
            $po_detail = Purchase_order::with('createdby', 'updatedby', 'approvedby', 'canceledby', 'supplierid', 'garageid')
                ->where("id", $id)
                ->first();
            $id_garage = $po_detail->garageid->id;
            if ($id_garage != Auth()->user()->garage_id) {
                return view('error');
            }
        }
        $po_item = Purchase_order_item::where("purchase_order_id", $id)->get();
        return view('purchaseorder/details', compact('po_detail', 'po_item'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        try {
            $iduser = Auth::id();
            $purchase_order = Purchase_order::findOrFail($id);
            $purchase_order->approved_at = date("yy-m-d");
            $purchase_order->approved_by = $iduser;
            $purchase_order->status = 'approved';
            $purchase_order->save();
            return redirect()->route('purchaseorder.index')->with('succes', 'Puchase order was approved successfully');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancell($id)
    {
        try {
            $iduser = Auth::id();
            $purchase_order = Purchase_order::findOrFail($id);
            $purchase_order->canceled_at = date("yy-m-d");
            $purchase_order->canceled_by = $iduser;
            $purchase_order->status = 'cancelled';
            $purchase_order->save();
            return redirect()->route('purchaseorder.index')->with('succes', 'Puchase order was cancelled successfully');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
