<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $type = $request->transaction_type;
        $data = [];
        if ($type == 'Add store credit') {
            $data['store_credit'] = $request->transaction_amount;
        } else if ($type == 'Purchase') {
            $data['purchased_items'] = $request->purchased_items;
            $data['tax'] = $request->tax;
            $data['purchase_total'] = $request->purchase_total;
            $data['store_credit'] = $request->store_credit;
            $data['cash_in'] = $request->cash_in;
        } else if ($type == 'Cash out for trade') {
            $data['cash_out_for_trade'] = $request->transaction_amount;
        } else {
            $data['cash_out_for_storecredit'] = $request->transaction_amount;
        }
        $data['transaction_type'] = $type;
        $data['customer_id'] = $request->customer_id;
        $data['comments'] = $request->comments;
        $data['user_id'] = auth()->user()->id;

        $transaction = Transaction::create($data);
        
        if(!$transaction) {
            return redirect()->back()->withErrors('msg', 'Something went wrong, please try again!');
        }
        return redirect()->back()->with('success', 'Transaction has been created successfully!');
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
        $customer_id = $transaction->customer_id;
        
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = __("Edit Transaction");
        $transaction = Transaction::find($id);
        return view('transactions.edit', compact('title', 'transaction'));
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
        $transaction = Transaction::find($id);
        $type = $request->transaction_type;
        $data = [];
        if ($type == 'Add store credit') {
            $data['store_credit'] = $request->transaction_amount;
        } else if ($type == 'Purchase') {
            $data['purchased_items'] = $request->purchased_items;
            $data['tax'] = $request->tax;
            $data['purchase_total'] = $request->purchase_total;
            $data['store_credit'] = $request->store_credit;
            $data['cash_in'] = $request->cash_in;
        } else if ($type == 'Cash out for trade') {
            $data['cash_out_for_trade'] = $request->transaction_amount;
        } else {
            $data['cash_out_for_storecredit'] = $request->transaction_amount;
        }
        $data['comments'] = $request->comments;
        $update = $transaction->update($data);
        if(!$update) {
            return redirect()->back()->withError('msg', "Something went wrong, please try again!");
        }

        return redirect()->back()->with('success', "Transaction has been updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}