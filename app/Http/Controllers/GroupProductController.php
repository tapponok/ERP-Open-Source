<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group_product;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\XmlConfiguration\Group;

class GroupProductController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:indexgroupproduct', ['only' => ['show', 'index']]);
        $this->middleware('permission:creategroupproduct', ['only' => ['create','store', 'collectionadd']]);
        $this->middleware('permission:updategroupproduct', ['only' => ['edit', 'update']]);
        $this->middleware('permission:deletegroupproduct', ['only' => ['destory','collectiondestroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = Group_product::orderBy('created_at', 'DESC')
                                ->where('isarchive', '!=', '1')
                                ->get();
        return view('groupproduct.index', compact('group'));
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
            'name' => 'required | min:2',
        ];
        $this->validate($request, $rules);

        try {
            $group = new Group_product();
            $group->name = $request->input('name');
            $group->created_at = now();
            $group->save();
            return redirect()->route('groupproduct.index')->with('succes', 'Group product was created succesfully');
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
        $rules = [
            'name' => 'required | min:2',
        ];
        $this->validate($request, $rules);
        try {
            $group = Group_product::findOrFail($id);
            $group->name = $request->input('name');
            $group->updated_at = now();
            $group->save();
            return redirect()->route('groupproduct.index')->with('succes', 'Group product was updated succesfully');
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
        $listproduct = Product::all();
        $group = Group_product::all()->where('id', $id)->first();
        //dd($group);
        $product = Product::where('group_product_id', $id)->get();
        return view('groupproduct.details', compact('group', 'product', 'listproduct'));
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
            $collection = Product::where('group_product_id', $id)->get();
            foreach ($collection as $collections)
            {
                $product = Product::find($collections->id);
                $product->group_product_id = null;
                $product->save();
            }
            $group = Group_product::findOrFail($id);
            $group->isarchive = true;
            $group->save();
            return redirect()->route('groupproduct.index', 'Group product was deleted succesfully');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function collectiondestroy($id)
    {
        try {
            $collectiongroup = Product::findOrFail($id);
            $collectiongroup->group_product_id = null;
            $collectiongroup->save();
            return redirect()->back()->with('succes', 'Product deleted form group');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function collectionadd(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($request->idproduct);
            $product->group_product_id = $request->route('id');
            $product->save();
            return redirect()->back()->with('succes', 'Product added to group');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
