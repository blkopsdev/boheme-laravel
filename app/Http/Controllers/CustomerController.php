<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;

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
        $this->middleware('only_admin_access')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = __('Customers');
        // $customers = Customer::select(['id', 'first_name', 'last_name', 'phone', 'email'])->orderBy('id','desc')->get();
        $customers = DB::table('customers')->select(['id', 'first_name', 'last_name', 'phone', 'email'])->get();
        return view('customer.index', compact('title', 'customers'));
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

        $rules = [
            'phone' => 'required',
            'email' => 'email|regex:/(.+)@(.+)\.(.+)/i'
        ];
        $messages = [
            'phone.digits' => 'Phone number must inlude only 10 digits numbers.'
        ];
        $this->validate($request, $rules, $messages);
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
        if(!$customer) {
            return redirect()->route("customers.index")->with('error', 'Customer doesn\'t exist!');
        }
        $transactions = Transaction::whereCustomerId($id)->orderBy('id', 'asc')->get();
        if ($transactions->count() > 0) {
            $store_credit = get_store_credit($id)['credit'];
        } else {
            $store_credit = 0.00;
        }

        return view('customer.show', compact('customer', 'transactions', 'store_credit'));
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
        $rules = [
            'phone' => 'digits:10',
            'email' => 'email|regex:/(.+)@(.+)\.(.+)/i'
        ];
        $messages = [
            'phone.digits' => 'Phone number must inlude only 10 digits numbers.'
        ];
        $this->validate($request, $rules, $messages);

        $customer = Customer::find($id);
        $customer->update($request->all());
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Show the form for merging the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function merge($id)
    {
        $title = __("Merge Customer");
        $customer = Customer::find($id);
        $transactions = Transaction::whereCustomerId($id)->orderBy('id', 'asc')->get();
        if ($transactions->count() > 0) {
            $store_credit = get_store_credit($id)['credit'];
        } else {
            $store_credit = 0.00;
        }
        return view('customer.merge', compact('title', 'customer', 'store_credit'));
    }

    public function mergeSubmit(Request $request, $id)
    {
        $target_id = $request->target_id;
        $target_customer = Customer::find($target_id);
        
        if(!$target_customer) {
            return redirect()->back()->with("error", "Target Customer doesn\'t exist.");
        } 

        $customer = Customer::find($id);
        $transactions = Transaction::whereCustomerId($id)->get();

        if($transactions->count() == 0) {
            return redirect()->route('customers.show', $id)->with("error", "This Customer doesn\'t have any transactions to merge.");
        }

        foreach ($transactions as $transaction) {
            $transaction->customer_id = $target_id;
            $transaction->update();
        }

        return redirect()->route('customers.show', $target_id)->with('success', "Customer Transaction Data has been merged successfully!");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        $transactions = Transaction::whereCustomerId($id)->get();
        if($transactions->count() > 0) {
            foreach ($transactions as $transaction) {
                $transaction->delete();
            }
        }

        return redirect()->back()->with('success', 'Customer has been deleted successfully!');
    }
}
