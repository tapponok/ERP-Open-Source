<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use Illuminate\Http\Request;
use App\Models\Receive_order;
use App\Models\Receive_order_item;
use App\Models\Product_garage_stock;
use App\Models\Purchase_order;
use App\Models\Purchase_invoice;
use App\Models\Purchase_order_item;
use App\Models\Supplier;
use App\Models\Stocklog;
use Illuminate\Support\Facades\Auth;
use DB;
use PHPUnit\Framework\Constraint\Count;
use Yajra\DataTables\Facades\DataTables;


class ReceiveOrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:indexreceiveorder', ['only' => ['show', 'index']]);
        $this->middleware('permission:createreceiveorder', ['only' => ['create', 'store']]);
        $this->middleware('permission:approvereceiveorder', ['only' => ['approve', 'cancell']]);
        $this->middleware('permission:rejectreceiveorder', ['only' => ['approve', 'cancell']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->hasRole('superadmin')) {
                $data = Receive_order::with('purchaseorderid', 'puchaseinvoiceid', 'garageid', 'supplierid', 'receivedby', 'updatedby', 'approvedby', 'cancelledby', 'receiveoderitem')
                    ->orderby('created_at', 'desc')
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            } else {
                $data = Receive_order::with('purchaseorderid', 'puchaseinvoiceid', 'garageid', 'supplierid', 'receivedby', 'updatedby', 'approvedby', 'cancelledby', 'receiveoderitem')
                    ->whereRelation('garageid', 'garage_id', Auth::user()->garage_id)
                    ->orderby('created_at', 'desc')
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }
        }
        return view('receiveorder.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchase_order = Purchase_order::all();
        $purchase_invoice = Purchase_invoice::all();
        $garage = Garage::all();
        $supplier  = Supplier::all();
        return view('receiveorder.create', compact('purchase_order', 'purchase_invoice', 'garage', 'supplier'));
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
            'idpurchaseorder' => 'required',
            'lisenseplate' => 'required'
        ];
        try {
            $lisense = preg_replace('/\s+/', '', $request->lisenseplate);
            $iduser = Auth::id();
            $receivedorder_last_id = Receive_order::max("id") + 1;
            $purchaseorder = Purchase_order::where('id', $request->idpurchaseorder)
                ->first();
            $purchase_invoice = Purchase_invoice::where('purchase_order_id', $purchaseorder->id)
                ->first();
            $codereceived = $lisense . '-' . date("dmy") . '-' . $purchaseorder->id . '-' . $receivedorder_last_id;
            $receivedorderstore = new Receive_order();
            $receivedorderstore->codereceived = $codereceived;
            $receivedorderstore->purchaseorder_id = $purchaseorder->id;
            $receivedorderstore->purchaseinvoice_id = $purchase_invoice->id;
            $receivedorderstore->garage_id = $purchaseorder->garage_id;
            $receivedorderstore->supplier_id = $purchaseorder->supplier_id;
            $receivedorderstore->received_by = $iduser;
            $receivedorderstore->receivedate = date("yy-m-d");
            $receivedorderstore->licenseplate = $request->input('lisenseplate');
            $receivedorderstore->status = 'submit';
            $receivedorderstore->save();

            $receivedorderstore_lastid = Receive_order::max("id");
            $arrayku = count($request->idproduct);
            for ($i = 0; $i < $arrayku; $i++) {
                Receive_order_item::insert([
                    'receive_order_id' => $receivedorderstore_lastid,
                    'product_id' => $request->idproduct[$i],
                    'product_name' => $request->productname[$i],
                    'product_code' => $request->codeproduct[$i],
                    'quantity' => $request->quantity[$i],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            return redirect()->route('receiveorder.index')->with('succes', 'Order received was submited successfully');
        } catch (\Throwable $th) {
            //throw $th;
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
            $receiveorder = Receive_order::with('purchaseorderid', 'puchaseinvoiceid', 'garageid', 'supplierid', 'receivedby', 'updatedby', 'approvedby', 'cancelledby', 'receiveoderitem')
                ->where('id', $id)
                ->first();
        } else {
            $receiveorder = Receive_order::with('purchaseorderid', 'puchaseinvoiceid', 'garageid', 'supplierid', 'receivedby', 'updatedby', 'approvedby', 'cancelledby', 'receiveoderitem')
                ->where('id', $id)
                ->first();
            $id_garage = $receiveorder->garageid->id;
            if ($id_garage != Auth()->user()->garage_id) {
                return view('error');
            }
        }
        $receiveorderfind = Receive_order::find($id);
        $receive_order_items = Receive_order_item::whereRelation('receiveorderid', 'status', '=', 'approved')
            ->whereRelation('receiveorderid', 'purchaseorder_id', $receiveorderfind->purchaseorder_id)
            ->select('product_id', 'product_code', 'product_name', DB::raw('SUM(quantity) as quantity'))
            ->groupBy('product_id', 'product_code', 'product_name');
        $purchase_order_items = Purchase_order_item::select('purchase_order_items.product_id', 'purchase_order_items.product_code', 'purchase_order_items.product_name', 'purchase_order_items.quantity', 'receive_order_items.quantity as received')
            ->joinSub($receive_order_items, 'receive_order_items', function ($join) {
                $join->on('purchase_order_items.product_id', '=', 'receive_order_items.product_id');
            })
            ->where('purchase_order_id', $receiveorderfind->purchaseorder_id)
            ->get();

        return view('receiveorder.details', compact('receiveorder', 'purchase_order_items'));
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
    public function approve($id)
    {
        try {
            $iduser = Auth::id();
            $receive_order = Receive_order::findOrFail($id);
            $receive_order->approved_at = date("yy-m-d");
            $receive_order->approved_by = $iduser;
            $receive_order->status = 'approved';
            $receive_order->save();
            $receive_order = Receive_order::where('id', $id)
                ->first();
            $ro_items = Receive_order_item::where('receive_order_id', $id)
                ->get();

            $arrayku = count($ro_items);
            for ($i = 0; $i < $arrayku; $i++) {
                $id_array = $ro_items[$i]->product_id;
                $stock = Product_garage_stock::where([
                    ['product_id', $id_array],
                    ['garage_id', $receive_order->garage_id]
                ])
                    ->first();
                if ($stock == null) {
                    $pgs = new Product_garage_stock();
                    $pgs->product_id = $ro_items[$i]->product_id;
                    $pgs->garage_id = $receive_order->garage_id;
                    $pgs->stock = $ro_items[$i]->quantity;
                    $pgs->save();

                    $stocklogs = new Stocklog();
                    $stocklogs->created_by = Auth::id();
                    $stocklogs->product_id = $ro_items[$i]->product_id;
                    $stocklogs->laststock = 0;
                    $stocklogs->tabel_name = 'receive_orders';
                    $stocklogs->table_data_id = $id;
                    $stocklogs->type = 'in';
                    $stocklogs->stock_in_process = $ro_items[$i]->quantity;
                    $stocklogs->newstock = $ro_items[$i]->quantity;
                    $stocklogs->garage_id = $receive_order->garage_id;
                    $stocklogs->trigger = 'approve receive order';
                    $stocklogs->save();
                } else {
                    $pgs = Product_garage_stock::findOrFail($stock->id);
                    $pgs->garage_id = $receive_order->garage_id;
                    $pgs->stock = $ro_items[$i]->quantity + $pgs->stock;
                    $pgs->save();

                    $stocklogs = new Stocklog();
                    $stocklogs->created_by = Auth::id();
                    $stocklogs->product_id = $ro_items[$i]->product_id;
                    $stocklogs->laststock = ($pgs->stock) - ($ro_items[$i]->quantity);
                    $stocklogs->tabel_name = 'receive_orders';
                    $stocklogs->table_data_id = $id;
                    $stocklogs->type = 'in';
                    $stocklogs->stock_in_process = $ro_items[$i]->quantity;
                    $stocklogs->newstock = $pgs->stock;
                    $stocklogs->garage_id = $receive_order->garage_id;
                    $stocklogs->trigger = 'approve receive order';
                    $stocklogs->save();
                }
            }
            $receive_order_items = Receive_order_item::whereRelation('receiveorderid', 'status', '=', 'approved')
                ->whereRelation('receiveorderid', 'purchaseorder_id', $receive_order->purchaseorder_id)
                ->select('product_id', 'product_code', 'product_name', DB::raw('SUM(quantity) as quantity'))
                ->groupBy('product_id', 'product_code', 'product_name');
            $purchase_order_items = Purchase_order_item::select('purchase_order_items.product_id', 'purchase_order_items.product_code', 'purchase_order_items.product_name', 'purchase_order_items.quantity', 'receive_order_items.quantity as received')
                ->joinSub($receive_order_items, 'receive_order_items', function ($join) {
                    $join->on('purchase_order_items.product_id', '=', 'receive_order_items.product_id');
                })
                ->where(DB::raw('receive_order_items.quantity - purchase_order_items.quantity'),  '<', '0')
                ->get()
                ->toArray();
            $finishpo = count($purchase_order_items) == 0;
            if ($finishpo == true) {
                $findpo = Purchase_order::find($receive_order->purchaseorder_id);
                $findpo->fulfilled = true;
                $findpo->save();
            }
            return redirect()->route('receiveorder.index')->with('succes', 'Receiveorder was approved successfully');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function cancel($id)
    {
        try {
            $iduser = Auth::id();
            $receive_order = Receive_order::findOrFail($id);
            $receive_order->cancelled_at = date("yy-m-d");
            $receive_order->cancelled_by = $iduser;
            $receive_order->status = 'cancelled';
            $receive_order->save();
            return redirect()->route('receiveorder.index')->with('succes', 'Receiveorder was cancelled successfully');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
