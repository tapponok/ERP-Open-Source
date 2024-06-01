<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use App\Models\Partnership;
use App\Models\Product;
use App\Models\Sales_order;
use App\Models\Salesorder_item;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class SalesorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sales_order::with('partnershipid', 'garageid')
                ->orderBy('id', 'DESC')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        $garage = Garage::all();
        $partnership = Partnership::all();
        return view('salesorder.index', compact('garage', 'partnership'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('salesorder.create', compact('garage', 'partnership'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'garage_id' => 'required',
            'partnership_id' => 'required',
            'estimate_date' => 'required',
        ];
        $this->validate($request, $rules);
        try {
            $sales_last_id = Sales_order::max("id");
            $iduser = Auth::id();
            $so_number = 'SO-' . $iduser . '-' . $request->supplier_id . '-' . date("dmy") . '-' . ($sales_last_id + 1);
            $salesorder = new Sales_order();
            $salesorder->salesorder_code = $so_number;
            $salesorder->garage_id = $request->input('garage_id');
            $salesorder->partnership_id = $request->input('partnership_id');
            $salesorder->estimate_date = $request->input('estimate_date');
            $salesorder->status = 'draft';
            $salesorder->save();
            $salesorder_find_id = Sales_order::where('salesorder_code', $so_number)->select('id')->first();
            return redirect()->route('salesorder.show', ['salesorder' => $salesorder_find_id])->with('succes', 'Sales order was created successfully');
        } catch (\Throwable $th) {
            throw $th;
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
        $salesorder = Sales_order::find($id);
        if ($salesorder->status == 'draft') {
            $product = Product::all();
            $garage = Garage::all();
            $partnership = Partnership::all();
            $salesorder = Sales_order::find($id);
            $salesOrderItem = Salesorder_item::where('salesorder_id', $id)->where('isarchive', 'false')->get();
            $totalSalesOrderItem = Salesorder_item::where('isarchive', false)->where('salesorder_id', $id)->sum('total_after_discount');
            return view('salesorder.update', compact('salesorder', 'garage', 'partnership', 'product', 'salesOrderItem', 'totalSalesOrderItem'));
        } else {
            $product = Product::all();
            $garage = Garage::all();
            $partnership = Partnership::all();
            $salesorder = Sales_order::find($id);
            $salesOrderItem = Salesorder_item::where('salesorder_id', $id)->where('isarchive', 'false')->get();
            $totalSalesOrderItem = Salesorder_item::where('isarchive', false)->where('salesorder_id', $id)->sum('total_after_discount');
            return view('salesorder.detail', compact('salesorder', 'garage', 'partnership', 'product', 'salesOrderItem', 'totalSalesOrderItem'));
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
    }
    public function submit(Request $request, $id)
    {
        try {
            $Auth = Auth::id();
            $salesOrder = Sales_order::where('id', $request->IDsalesOrder)->first();
            $salesOrder->estimate_date = Carbon::parse($request->estimate_date);
            $salesOrder->partnership_id = $request->partnershipID;
            $salesOrder->garage_id = $request->garageID;
            $salesOrder->address = $request->addressValue;
            $salesOrder->city = $request->city;
            $salesOrder->province = $request->province;
            $salesOrder->postal_code = $request->postalCode;
            $salesOrder->total = $request->totalAmount;
            $salesOrder->total_discount = $request->totalDiscount;
            $salesOrder->discount = $request->discount;
            $salesOrder->tax_percent = $request->taxPercent;
            $salesOrder->tax_total = $request->totalTax;
            $salesOrder->shipment_cost = $request->shipmentCostVal;
            $salesOrder->created_by = $Auth;
            $salesOrder->total_charge = $request->totalCharge;
            $salesOrder->date_order = now();
            $salesOrder->status = 'submit';
            $salesOrder->notes = $request->globalNotes;
            $salesOrder->save();
            $data = [
                "salesOrder" => $salesOrder,
                "message" => 'Data submited successfully',
            ];
            return response()->json($salesOrder, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
    public function approve($id)
    {
        try {
            $salesOrder = Sales_order::findOrFail($id);
            $salesOrder->status = 'approve';
            $salesOrder->approved_by = Auth::id();
            $salesOrder->approved_at = now();
            $salesOrder->save();
            $data = [
                "salesOrder" => $salesOrder,
            ];
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
    public function reject($id)
    {
        try {
            $salesOrder = Sales_order::findOrFail($id);
            $salesOrder->status = 'cancel';
            $salesOrder->cancelled_by = Auth::id();
            $salesOrder->canceled_at = now();
            $salesOrder->save();
            $data = [
                "salesOrder" => $salesOrder,
            ];
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
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
        $product = Product::findOrfail($request->productID);
        if ($request->ActionFor == 'create') {
            try {
                $salesOrderItems =  new Salesorder_item;
                $salesOrderItems->salesorder_id = $request->salesOrderID;
                $salesOrderItems->product_id = $request->productID;
                $salesOrderItems->product_code = $product->product_code;
                $salesOrderItems->product_name = $product->product_name;
                $salesOrderItems->price = $product->selling_price;
                $salesOrderItems->quantity = $request->inputQuantity;
                $salesOrderItems->discount_percentage = $request->inputDiscountPercentage;
                $salesOrderItems->discounttotal = $request->inputDiscountTotal;
                $salesOrderItems->subtotal = $request->inputSubtotal;
                $salesOrderItems->total_after_discount = $request->inputTotalAfterDiscount;
                $salesOrderItems->save();
                $Data = [
                    'data' => $salesOrderItems,
                    'Status' => 'Data saved successfully',
                ];
                return response()->json($Data, 200);
            } catch (\Throwable $th) {
                $Data = [
                    'data' => $$th->getMessage(),
                    'Status' => 'Fail to save data',
                    'action' => 'request->ActionFor'
                ];
                return response()->json($Data, 500);
            }
        } else {
            try {
                $salesOrderItem = Salesorder_item::where('salesorder_id', $request->salesOrderID)
                    ->where('product_id', $request->productID)->first();
                $salesOrderItem->salesorder_id = $request->salesOrderID;
                $salesOrderItem->product_id = $request->productID;
                $salesOrderItem->product_code = $product->product_code;
                $salesOrderItem->product_name = $product->product_name;
                $salesOrderItem->price = $product->selling_price;
                $salesOrderItem->quantity = $request->inputQuantity;
                $salesOrderItem->discount_percentage = $request->inputDiscountPercentage;
                $salesOrderItem->discounttotal = $request->inputDiscountTotal;
                $salesOrderItem->subtotal = $request->inputSubtotal;
                $salesOrderItem->total_after_discount = $request->inputTotalAfterDiscount;
                $salesOrderItem->save();
                $Data = [
                    'data' => $salesOrderItem,
                    'Status' => 'Data updated successfully',
                ];
                return response()->json($Data, 200);
            } catch (\Throwable $th) {
                $Data = [
                    'data' => $$th->getMessage(),
                    'Status' => 'Fail to save data',
                    'action' => 'request->ActionFor'
                ];
                return response()->json($Data, 500);
            }
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $salesOrderItem = Salesorder_item::findOrFail($id);
            $salesOrderItem->isarchive = true;
            $salesOrderItem->save();
            return redirect()->route('salesorder.show', ['salesorder' => $salesOrderItem->salesorder_id])->with('succes', 'Data deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->route('salesorder.show', ['salesorder' => $salesOrderItem->salesorder_id])->with('fail',  'Fail to delete data \n \n \n' . $th->getMessage());
        }
    }
}
