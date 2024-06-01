<?php

namespace App\Http\Controllers;

use App\Models\Partnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PhpParser\Builder\Param;

class PartnershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partnership = Partnership::orderBy('created_at', 'DESC')
                                ->where('isarchive', '=', '0')
                                ->get();
        return view('partnership.index', compact('partnership'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partnership.create');
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
            $partnership = new Partnership();
            $partnership->name = $request->input('name');
            $partnership->email = $request->input('email');
            $partnership->phone = $request->input('phone');
            $partnership->address = $request->input('address');
            $partnership->city = $request->input('city');
            $partnership->province = $request->input('province');
            $partnership->bankname = $request->input('bankname');
            $partnership->bankaccount = $request->input('bankaccount');
            $partnership->postalcode = $request->input('postalcode');
            $partnership->created_by = Auth::id();
            $partnership->save();
            return redirect()->route('partnership.index')->with('succes', 'Partnership was created sucessfully');
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
        $partnership = Partnership::find($id);
        return view('partnership.details', compact('partnership'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partnership = Partnership::find($id);
        return view('partnership.edit', compact('partnership'));
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
        try {
            $partnership = Partnership::find($id);
            $partnership->name = $request->input('name');
            $partnership->email = $request->input('email');
            $partnership->phone = $request->input('phone');
            $partnership->address = $request->input('address');
            $partnership->city = $request->input('city');
            $partnership->province = $request->input('province');
            $partnership->postalcode = $request->input('postalcode');
            $partnership->bankname = $request->input('bankname');
            $partnership->bankaccount = $request->input('bankaccount');
            $partnership->save();
            return redirect()->route('partnership.index')->with('succes', 'Partnership was updated sucessfully');
        } catch (\Throwable $th) {
            Log::error($th);
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
            $partnership = Partnership::find($id);
            $partnership->isarchive = true;
            $partnership->save();
            return redirect()->route('partnership.index')->with('succes', 'Partnership was deleted sucessfully');
        } catch (\Throwable $th) {
            Log::error($th);
            //throw $th;
        }
    }
}
