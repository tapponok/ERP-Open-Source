<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Garage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\EloquentUserProvider;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class GarageController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:indexgarage', ['only' => ['show', 'index']]);
        $this->middleware('permission:creategarage', ['only' => ['create','store']]);
        $this->middleware('permission:updategarage', ['only' => ['edit', 'update']]);
        $this->middleware('permission:deletegarage', ['only' => ['destory']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $garage = Garage::orderBy('created_at', 'DESC')
                        ->where('isarchive', '!=', '1')
                        ->get();
        return view('garage.index', compact('garage'));
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
            'garagename' => 'required',
        ];
        $this->validate($request, $rules);
        try {
            $useractive = Auth::id();
            $garage = new Garage();
            $garage->garagename = $request->input('garagename');
            $garage->address = $request->input('address');
            $garage->city = $request->input('city');
            $garage->province = $request->input('province');
            $garage->postalcode = $request->input('postalcode');
            $garage->created_at = now();
            $garage->save();
            return redirect()->route('garage.index')->with('success', 'Garage was successfully created');
        } catch (\Throwable $th) {
            throw $th;
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
            'garagename' => 'required',
        ];
        $this->validate($request, $rules);
        try {
            $garage = Garage::findOrFail($id);
            $useractive = Auth::id();
            $garage->garagename = $request->input('garagename');
            $garage->address = $request->input('address');
            $garage->city = $request->input('city');
            $garage->province = $request->input('province');
            $garage->postalcode = $request->input('postalcode');
            $garage->updated_at = now();
            $garage->save();
            return redirect()->route('garage.index')->with('succes', 'Garage was successfully updated');
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
    public function destroy(Garage $garage)
    {
        try {
            $garage =  Garage::findOrFail($garage->id);
            $garage->isarchive = true;
            $garage->save();
            return redirect()->route('garage.index')->with('succes', 'Garage was successfully deleted');
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
}
