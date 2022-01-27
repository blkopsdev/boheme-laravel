<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
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
        $title = __('Customers');
        $total = Customer::count();
        $customers = Customer::orderBy('id','desc')->paginate(15);
        return view('customer.index', compact('title', 'customers', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = __('Add a Customer');
        return view('customer.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'contact_pref' => $request->contact_pref,
            'newsletter' => $request->newsletter,
            'customer_notes' => $request->customer_notes
        ];

        $customer = Customer::create($data);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        $transactions = Transaction::whereCustomerId($id)->orderBy('id', 'asc')->paginate(10);
        $last_transaction = Transaction::whereCustomerId($id)->orderBy('id', 'desc')->first();
        $expiration_date = Carbon::now()->subMonths(6);
        // $available_credit = Transaction::whereCustomerId($id)->where('created_at', '>=', date('Y-m-d', strtotime($expiration_date)))->sum('store_credit');
        return view('customer.show', compact('customer', 'transactions', 'last_transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = __("Edit Customer");
        $customer = Customer::find($id);
        return view('customer.edit', compact('title', 'customer'));
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
        $customer = Customer::find($id);
        $customer->update($request->all());
        return redirect()->route('customers.show', $id)->with('success', 'Customer updated successfully.');
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
