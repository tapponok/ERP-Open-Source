<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class UnitController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:indexunit', ['only' => ['show', 'index']]);
        $this->middleware('permission:createunit', ['only' => ['create','store']]);
        $this->middleware('permission:updateunit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:deleteunit', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unit = Unit::orderBy('created_at', 'DESC')
                    ->where('isarchive', '!=', '1')
                    ->get();
        return view('unit.index', compact('unit'));
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
            'unit_name' => 'required',
        ];
        $this->validate($request, $rules);
        try {
            $useractive = Auth::id();
            $unit = new Unit();
            $unit->unit_name = $request->input('unit_name');
            $unit->created_by = $useractive;
            $unit->created_at = now();
            $unit->save();
            return redirect()->route('unit.index')->with('succes', 'Unit was successfully created');
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
            'unit_name' => 'required',
        ];
        $this->validate($request, $rules);
        try {
            $useractive = Auth::id();
            $unit = Unit::findOrFail($id);
            $unit->unit_name = $request->input('unit_name');
            $unit->updated_by = $useractive;
            $unit->save();
            return redirect()->route('unit.index')->with('succes', 'Unit was successfully updated');
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
    public function destroy(Unit $unit)
    {
        try {
            $unit =  Unit::findOrFail($unit->id);
            $unit->isarchive = true;
            $unit->save();
            return redirect()->route('unit.index')->with('succes', 'Unit was successfully deleted');
        } catch (\Throwable $th) {
            return redirect()->route('unit.index')->with('fail', 'Fail to delete data'.$th->getMessage());
        }
    }
}
