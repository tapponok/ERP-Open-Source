<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment = Payment::orderBy('created_at', 'DESC')
                            ->where('isarchive', '!=', '1')
                            ->get();
        return view('payment.index', compact('payment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [ 'name' => 'required' ];
        $this->validate($request, $rules);

        try {
            $payment = new Payment();
            $payment->name = $request->input('name');
            $payment->created_by = Auth::id();
            $payment->save();
            return redirect()->route('payment.index')->with('succes', 'Payment was created succesfully');
        } catch (\Throwable $th) {
            Log::error($th);
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
        //
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
        $rules = [ 'name' => 'required' ];
        $this->validate($request, $rules);

        try {
            $payment = Payment::find($id);
            $payment->name = $request->input('name');
            $payment->save();
            return redirect()->route('payment.index')->with('succes', 'Payment was updated succesfully');
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
            $payment = Payment::find($id);
            $payment->isarchive = true;
            $payment->save();
            return redirect()->route('payment.index')->with('succes', 'Payment was deleted succesfully');
        } catch (\Throwable $th) {
            Log::error($th);
            //throw $th;
        }
    }
}
