<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase_order;
use App\Models\Purchase_invoice;
use PHPUnit\Framework\Constraint\Count;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_user = Count(User::all());
        $total_product= count(Product::all());
        $total_purchaseorder= count(Purchase_order::all());
        $total_purchaseinvoice= count(Purchase_invoice::all());
        return view('home', compact('total_user', 'total_product', 'total_purchaseorder', 'total_purchaseinvoice'));
    }
}
