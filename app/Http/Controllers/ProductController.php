<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_child;
use App\Models\Category;
use App\Models\Child_category;
use App\Models\Garage;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use app\Http\Controllers\storechild;
use App\Models\Products;
use Yajra\DataTables\Facades\DataTables;


class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:createproduct', ['only' => ['create', 'store']]);
        $this->middleware('permission:indexproduct', ['only' => ['show', 'index']]);
        $this->middleware('permission:updateproduct', ['only' => ['edit', 'update']]);
        $this->middleware('permission:deleteproduct', ['only' => ['destory', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Product::query()->join('categories', 'categories.id', '=', 'products.category_id')
                ->select('products.id','products.product_name', 'products.product_code', 'products.selling_price', 'categories.categ_name')
                ->where('products.isarchive', '!=', '1')
                ->orderBy('products.created_at', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('product.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $unit = Unit::all();
        $garage = Garage::all();
        return view('product.create', compact('category', 'unit', 'garage'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('image')) {
            $relPath = 'storage/product/'; //your path inside public directory

            if (!file_exists(public_path($relPath))) { //Verify if the directory exists
                mkdir(public_path($relPath), 666, true); //create it if do not exists
            }
            $image       = $request->file('image');
            $filename    = $image->getClientOriginalName();
            $imagesname = time() . '_' . $filename;
            $image_resize = Image::make($image->getRealPath())->resize(300, 300)->save(public_path('storage/product/' . $imagesname));
        }
        $rules = [
            'product_name' => 'required|min:2',
            'product_code' => 'required|unique:products,product_code',
            'category_id' => 'required',
            'unit_id' => 'required',
            'selling_price' => 'required|numeric',
            'minimum_stock' => 'nullable|numeric',
        ];
        $this->validate($request, $rules);
        try {
            $useractive = Auth::id();
            $product = new Product();
            $product->product_name = $request->input('product_name');
            $product->product_code = $request->input('product_code');
            $product->category_id = $request->input('category_id');
            $product->unit_id = $request->input('unit_id');
            $product->sku = $request->input('sku');
            $product->minimum_stock = $request->input('minimum_stock');
            $product->selling_price = $request->input('selling_price');
            $product->created_by = $useractive;
            if ($request->image != NULL) {
                $product->product_photo = $request->image = $imagesname;
            } else {
                $product->product_photo = null;
            }
            $product->created_at = now();
            $product->save();
            return redirect()->route('product.index')->with('succes', 'Product was successfully created');
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
        $product = Product::with('category', 'unit')->where('id', $id)->first();
        return view('product/details', compact('product'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $category = Category::all();
            $garage = Garage::all();
            $unit = Unit::all();
            $unitedit = Unit::all();
            $product = Product::with('category', 'unit')->where('id', $id)->first();
            return view('product.edit', compact('category', 'garage', 'unit', 'product'));
        } catch (\Throwable $th) {
            //throw $th;
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
        if ($request->has('image')) {
            $relPath = 'storage/product/'; //your path inside public directory

            if (!file_exists(public_path($relPath))) { //Verify if the directory exists
                mkdir(public_path($relPath), 666, true); //create it if do not exists
            }
            $image       = $request->file('image');
            $filename    = $image->getClientOriginalName();
            $imagesname = time() . '_' . $filename;
            $image_resize = Image::make($image->getRealPath())->resize(300, 300)->save(public_path('storage/product/' . $imagesname));
        }
        $rules = [
            'product_name' => 'required|min:2',
            'product_code' => 'unique:products,product_code,' . $id,
            'category_id' => 'required',
            'unit_id' => 'required',
            'selling_price' => 'required|numeric',
            'minimum_stock' => 'nullable|numeric',
        ];
        $this->validate($request, $rules);
        try {
            $useractive = Auth::id();
            $product = Product::findOrFail($id);
            $product->product_name = $request->input('product_name');
            $product->product_code = $request->input('product_code');
            $product->category_id = $request->input('category_id');
            $product->unit_id = $request->input('unit_id');
            $product->sku = $request->input('sku');
            $product->minimum_stock = $request->input('minimum_stock');
            $product->selling_price = $request->input('selling_price');
            if ($request->image != NULL) {
                $product->product_photo = $request->image = $imagesname;
            } else {
                $product->product_photo = null;
            }
            $product->updated_by = $useractive;
            $product->updated_at = now();
            $product->save();
            return redirect()->route('product.index')->with('succes', 'Product was successfully updated');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->isarchive = true;
            $product->save();
            return redirect()->route('product.index')->with('succes', 'Product was successfully deleted');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
