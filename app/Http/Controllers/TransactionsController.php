<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $transaction = Transaction::where('user_id', $user->id)->get();

        return $transaction;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'user_id' => 'required',
            'is_income' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'description' => 'required'
        ]);

        $transaction = new Transaction;
        $transaction->user_id = $user->id;
        $transaction->is_income = $request->is_income == '1' ? True : False;
        $transaction->description = $request->description;
        $transaction->amount = $request->amount;
        $transaction->date = $request->date;
        $transaction->save();

        return $transaction;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);

        return $transaction;
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
        $request->validate([
            'user_id' => 'required',
            'is_income' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'description' => 'required'
        ]);

        $transaction = Transaction::find($id);
        $transaction->is_income = $request->is_income == '1' ? True : False;
        $transaction->description = $request->description;
        $transaction->amount = $request->amount;
        $transaction->date = $request->date;
        $transaction->save();

        return $transaction;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $transaction = Transaction::find($id);

        if ($transaction && $transaction->user_id == $user->id) {
            Transaction::destroy($id);
            return;
        }

        return;
    }
}
