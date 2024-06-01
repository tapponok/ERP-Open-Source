<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use App\Models\Product;
use App\Models\Product_garage_stock;
use App\Models\Stock_opname;
use App\Models\Stock_opname_item;
use App\Models\Stocklog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;


class StockOpnameController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:indexstockopname', ['only' => ['show', 'index']]);
        $this->middleware('permission:createstockopname', ['only' => ['create', 'store']]);
        $this->middleware('permission:approvestockopname', ['only' => ['approve', 'cancel']]);
        $this->middleware('permission:rejectstockopname', ['only' => ['approve', 'cancel']]);
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
                $data = Stock_opname::with('createdby')->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            } else {
                $data = Stock_opname::with('createdby', 'stokopnameitem')
                    ->whereRelation('stokopnameitem', 'garage_id', Auth::user()->garage_id)
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }
        }
        return view('stockopname.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $garage = Garage::where('isarchive', '=', '0')->get();
        return view('stockopname.create', compact('garage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $totalarray = count($request->idproduct);
            $iduser = Auth::id();
            $opnamelastid = Stock_opname::max("id");
            $code = 'OP-' . $iduser . '-' . date("dmy") . '-' . ($opnamelastid + 1);
            $stock_opname = new Stock_opname();
            $stock_opname->code = $code;
            $stock_opname->notes = $request->input('notesstockopname');
            $stock_opname->status = 'submit';
            $stock_opname->created_by = $iduser;
            $stock_opname->created_at =  now();
            $stock_opname->save();
            $lastid = $stock_opname->id;
            for ($i = 0; $i < $totalarray; $i++) {
                Stock_opname_item::insert([
                    'stockopname_id' => $lastid,
                    'garage_id' =>  $request->garageid[$i],
                    'product_id' =>  $request->idproduct[$i],
                    'laststock' =>  $request->stock[$i],
                    'newstock' =>  $request->newstock[$i],
                    'notes' =>  $request->message[$i],
                    'created_at' => now(),
                ]);
            }
            return redirect()->route('stockopname.index')->with('succes', 'Stock opname was submited successfully');
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
        try {
            $stockopname =  Stock_opname::with('stokopnameitem', 'createdby', 'updatedby', 'approvedby', 'canceledby')
                ->where('id', $id)
                ->first();
            if (Auth::user()->hasRole('superadmin')) {
                $stockopname_item = Stock_opname_item::with('productid', 'garageid')->where('stockopname_id', $stockopname->id)->get();
            } else {
                $check = Stock_opname_item::with('productid', 'garageid')
                    ->where('stockopname_id', $stockopname->id)
                    ->whereRelation('garageid', 'garage_id', Auth::user()->garage_id)
                    ->first();
                if ($check == null) {
                    return view('error');
                }
                $stockopname_item = Stock_opname_item::with('productid', 'garageid')->where('stockopname_id', $stockopname->id)->get();
            }
        } catch (\Throwable $th) {
        }
        return view('stockopname.details', compact('stockopname', 'stockopname_item'));
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
            $stock_opname = Stock_opname::findOrFail($id);
            $stock_opname->approved_at = date("yy-m-d");
            $stock_opname->approved_by = $iduser;
            $stock_opname->status = 'approved';
            $stock_opname->save();

            $stockopname_item = Stock_opname_item::where('stockopname_id', $id)->get();
            foreach ($stockopname_item as $soi) {
                $stocklogs = new Stocklog();
                $stocklogs->created_by = Auth::id();
                $stocklogs->product_id = $soi->product_id;
                $stocklogs->laststock = $soi->laststock;
                $stocklogs->tabel_name = 'stockopname';
                $stocklogs->table_data_id = $id;
                $stocklogs->type = 'opname';
                $stocklogs->stock_in_process =  ($soi->newstock) - ($soi->laststock);
                $stocklogs->newstock = $soi->newstock;
                $stocklogs->garage_id = $soi->garage_id;
                $stocklogs->trigger = 'approve stockopname';
                $stocklogs->save();

                $stock = Product_garage_stock::where([
                    ['product_id', $soi->product_id],
                    ['garage_id', $soi->garage_id]
                ])
                    ->first();
                if ($stock == null) {
                    $pgs = new Product_garage_stock();
                    $pgs->product_id = $soi->product_id;
                    $pgs->garage_id = $soi->garage_id;
                    $pgs->stock = $soi->newstock;
                    $pgs->save();
                } else {
                    $pgs = Product_garage_stock::findOrFail($stock->id);
                    $pgs->garage_id = $soi->garage_id;
                    $pgs->stock = $soi->newstock;
                    $pgs->save();
                }
            }
            return redirect()->route('stockopname.index')->with('succes', 'Stockopname was submited successfully');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function cancel($id)
    {
        try {
            $stock_opname = Stock_opname::findOrFail($id);
            $stock_opname->canceled_at = date("yy-m-d");
            $stock_opname->canceled_by = Auth::id();
            $stock_opname->status = 'cancelled';
            $stock_opname->save();
            return redirect()->route('stockopname.index')->with('succes', 'Stock opname was cancelled successfully');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
