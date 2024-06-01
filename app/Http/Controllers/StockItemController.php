<?php

namespace App\Http\Controllers;

use App\Models\Product_garage_stock;
use App\Models\Stocklog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class StockItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:stockproduct', ['only' => ['index']]);
        $this->middleware('permission:stocklogs', ['only' => ['stocklogs']]);
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
                $data =  Product_garage_stock::query()->with('productid', 'garageid')->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            } else {
                $data =  Product_garage_stock::query()->with('productid', 'garageid')
                    ->whereRelation('garageid', 'id', Auth()->user()->garage_id)
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }
        }
        return view('stockitem.index');
    }
    public function stocklogs(Request $request)
    {
        if ($request->ajax()) {
            $data = Stocklog::query()->with('productid', 'garageid', 'createdby')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('stockitem.stocklog');
    }
}
