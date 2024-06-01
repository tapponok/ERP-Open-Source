<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use App\Models\Partnership;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sales_order;
use App\Models\salesInvoice;
use App\Models\salesInvoiceItems;
use App\Models\Salesorder_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


class salesInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data = salesInvoiceItems::with('salesInvoice','salesorderid', 'salesorderid.partnershipid', 'salesorderid.garageid','paymentid', 'submitedby')->get();
        // return response()->json($data);

        if ($request->ajax()) {
            $data = salesInvoiceItems::with('salesinvoice', 'salesorderid', 'salesorderid.partnershipid', 'salesorderid.garageid', 'paymentid', 'submitedby')
                ->orderBy('id', 'DESC')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('salesinvoice.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSalesOrder(Request $request)
    {
        $search = $request->search;
        $arrayid = $request->arrayid;
        if ($search == '') {
            $salesOrder = Sales_order::select("id", "salesorder_code")
                ->limit(6)
                ->get();
        } elseif ($search != '' && $arrayid != null) {
            $salesOrder =  Sales_order::select("id", "salesorder_code")
                ->where('salesorder_code', 'LIKE', "%$search%")
                ->whereNotIn('id', $arrayid)
                ->limit(6)
                ->get();
        } else {
            $salesOrder =  Sales_order::select("id", "salesorder_code")
                ->where('salesorder_code', 'LIKE', "%$search%")
                ->limit(6)
                ->get();
        }
        $response = array();
        foreach ($salesOrder as $salesOrder) {
            $response[] = array(
                "id" => $salesOrder->id,
                "salesorder_code" => $salesOrder->salesorder_code
            );
        }
        return json_encode($response);
        exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function CreateSalesInvoice(Request $request)
    {
        $dataSalesOrder = Sales_order::with('invoice', 'salesorderid', 'partnershipid', 'garageid')
            ->where('id', $request->salesOrderID)
            ->first();
        $datasalesOrderItem = Salesorder_item::where('salesorder_id', $request->salesOrderID)->where('isarchive', 'false')->get();
        $totalSalesOrderItem = Salesorder_item::where('isarchive', false)->where('salesorder_id', $request->salesOrderID)->sum('total_after_discount');
        $payment = Payment::all();
        // dd($dataSalesOrder, $datasalesOrderItem);
        return view('salesinvoice.create', compact('dataSalesOrder', 'datasalesOrderItem', 'totalSalesOrderItem', 'payment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $SI_LastID = salesInvoiceItems::max("id");
        $SI_number = 'SI-' . Auth::id() . '-' . $request->IDsalesOrder . '-' . date("dmy") . '-' . ($SI_LastID + 1);

        $sales_invoice = salesInvoice::where('sales_order_id', $request->IDsalesOrder)->first();


        if ($sales_invoice == null) {
            $sales_invoice = new salesInvoice();
            $sales_invoice->sales_order_id = $request->IDsalesOrder;
            $sales_invoice->total_payment = $request->payment;
            $sales_invoice->total_down_payment = $request->downpaymentvalue;
            $sales_invoice->outstanding = $request->outstanding;
            $sales_invoice->save();
        } else {
            $sales_invoice->sales_order_id = $request->IDsalesOrder;
            $sales_invoice->total_payment = $sales_invoice->total_payment + $request->payment;
            $sales_invoice->total_down_payment = $sales_invoice->total_down_payment + $request->downpaymentvalue;
            $sales_invoice->outstanding = $request->downpaymenttype === "1" ? $sales_invoice->outstanding - $request->downpaymentvalue : $sales_invoice->outstanding - $request->payment;
            $sales_invoice->save();
        }

        $salesInvoiceItem = new salesInvoiceItems();
        $salesInvoiceItem->sales_invoice_id = $sales_invoice->id;
        $salesInvoiceItem->sales_order_id = $request->IDsalesOrder;
        $salesInvoiceItem->sales_invoice_code = $SI_number;
        $salesInvoiceItem->payment_id = $request->paymnetID;
        if ($request->downpaymenttype == "1") {
            $salesInvoiceItem->downpayment = true;
            $salesInvoiceItem->down_payment_total = $request->downpaymentvalue;
        } else {
            $salesInvoiceItem->downpayment = false;
            $salesInvoiceItem->payment = $request->payment;
        };
        $salesInvoiceItem->outstanding = $sales_invoice->outstanding;
        $salesInvoiceItem->reference = $request->reference;
        $salesInvoiceItem->payment_date = now();
        $salesInvoiceItem->submited_by = Auth::id();
        if ($request->isSubmit === "save") {
            $salesInvoiceItem->status = 'save';
        } else {
            $salesInvoiceItem->status = 'submit';
        }
        $salesInvoiceItem->save();
        return response()->json($salesInvoiceItem);
    }
    public function printpdf(){
        // return view('salesinvoice.detail');

        $pdf = PDF::loadView('salesinvoice.detail')->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);
        $pdf->setPaper('A4', 'portrait');

        // Aktifkan mode debug
        $pdf->setOptions(['debug' => true]);

        // Tampilkan PDF atau simpan ke file
        return $pdf->stream('invoice.pdf');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sales_invoice_items = salesInvoiceItems::findorfail($id);
        // $sales_order = Sales_order::where("id", $sales_invoice->sales_order_id)->get();
        dd($sales_invoice_items);

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
