<?php

namespace App\Http\Controllers;

use App\Models\ExpensesPlan;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpensesPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_rencana_pengeluaran = ExpensesPlan::where('user_id', Auth::id())->get();
        $list_kategori = Category::where('user_id', Auth::id())->orWhereNull('user_id')->get();

        return view('expenses-plans', compact('list_rencana_pengeluaran', 'list_kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:100',
            'category_id' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date|after:yesterday'
        ]);

        if (!is_numeric($request->category_id)) {
            $request->category_id = Category::create([
                'user_id' => Auth::id(),
                'name' => $request->category_id
            ])->id;
        }

        ExpensesPlan::create([
            'user_id' => Auth::id(),
            'description' => $request->description,
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'date' => $request->date
        ]);

        return redirect()->route('expenses-plans.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpensesPlan  $expensesPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expensesPlan = ExpensesPlan::find($id);

        $request->validate([
            'description' => 'required|string|max:100',
            'category_id' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date|after:yesterday'
        ]);

        if (!is_numeric($request->category_id)) {
            $request->category_id = Category::create([
                'user_id' => Auth::id(),
                'name' => $request->category_id
            ])->id;
        }

        $expensesPlan->update($request->all());

        return redirect()->route('expenses-plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpensesPlan  $expensesPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expensesPlan = ExpensesPlan::find($id);

        $expensesPlan->delete();

        return redirect()->route('expenses-plans.index');
    }
}
