<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class SupplierController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:indexsupplier', ['only' => ['show', 'index']]);
        $this->middleware('permission:createsupplier', ['only' => ['create','store']]);
        $this->middleware('permission:updatesupplier', ['only' => ['edit', 'update']]);
        $this->middleware('permission:deletesupplier', ['only' => ['destroy']]);
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
    public function index()
    {
        $supplier = Supplier::orderBy('created_at', 'desc')
                            ->where('isarchive', '!=', '1')
                            ->get();
        return view('supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('image')){
            $realpath = 'storage/supplier';
            if (!file_exists($realpath)){
                mkdir(public_path($realpath), 666, true);
            }
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $imagename = time().'_'.$filename;
            $image_resize = Image::make($image->getRealPath())->resize(300,300)->save(public_path('storage/supplier/'.$imagename));
        }
        $rules = [
            'supplier_name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'required',
        ];
        $this->validate($request, $rules);
        try {
            $useractive = Auth::id();
            $supplier = new Supplier();
            $supplier->supplier_name = $request->input('supplier_name');
            $supplier->email = $request->input('email');
            $supplier->phone = $request->input('phone');
            $supplier->address = $request->input('address');
            $supplier->city = $request->input('city');
            $supplier->province = $request->input('province');
            $supplier->postalcode = $request->input('postalcode');
            if ($request->image != NULL){
                $supplier->photo_path = $request->image = $imagename;
            } else {
                $supplier->photo_path = null;
            }
            $supplier->shop_name = $request->input('shop_name');
            $supplier->account_number = $request->input('account_number');
            $supplier->bank_name = $request->input('bank_name');
            $supplier->created_by = $useractive;
            $supplier->created_at = now();
            $supplier->save();
            return redirect()->route('supplier.index')->with('succes', 'Supplier was successfully created');
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
        $supplier = Supplier::orderBy('created_at', 'desc')
                    ->where('id', $id)
                    ->first();
        return view('supplier.details', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::where('id', $id)->first();
        return view('supplier.edit', compact('supplier'));
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
        if ($request->has('image')){
            $realpath = 'storage/supplier';
            if (!file_exists($realpath)){
                mkdir(public_path($realpath), 666, true);
            }
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $imagename = time().'_'.$filename;
            $image_resize = Image::make($image->getRealPath())->resize(300,300)->save(public_path('storage/supplier/'.$imagename));
        }
        $rules = [
            'supplier_name' => 'required',
            'email' => 'nullable|email',
            'account_number' => 'required',
            'bank_name' => 'required',

        ];
        $this->validate($request, $rules);
        try {
            $useractive = Auth::id();
            $supplier = Supplier::findOrFail($id);
            $supplier->supplier_name = $request->input('supplier_name');
            $supplier->email = $request->input('email');
            $supplier->phone = $request->input('phone');
            $supplier->address = $request->input('address');
            $supplier->city = $request->input('city');
            $supplier->province = $request->input('province');
            $supplier->postalcode = $request->input('postalcode');
            if ($request->image != null){
                $supplier->photo_path = $request->image = $imagename;
            }
            $supplier->shop_name = $request->input('shop_name');
            $supplier->account_number = $request->input('account_number');
            $supplier->bank_name = $request->input('bank_name');
            $supplier->updated_by = $useractive;
            $supplier->updated_at = now();
            $supplier->save();
            return redirect()->route('supplier.index')->with('succes', 'Supplier was successfully updated');
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
            $supplier = Supplier::findOrFail($id);
            $supplier->isarchive = true;
            $supplier->save();
            return redirect()->route('supplier.index')->with('succes', 'Supplier was successfully deleted');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
