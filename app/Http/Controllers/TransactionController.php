<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use DB;

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
        $this->middleware('only_admin_access')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = __('Complete History of Transactions');
        $total = Transaction::select('id')->get()->count();
        
        return view('transactions.index', compact('title', 'total'));
    }

    public function transactions(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('transactions')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_on', function($row){
                    $created_on = date('m/d/Y', strtotime($row->created_at));
                    return $created_on;
                })
                ->addColumn('customer', function($row){
                    $content = '';
                    try {
                        if($row->customer_id) {
                            $customer = Customer::whereId($row->customer_id)->select('first_name', 'last_name')->first();
                            if($customer) {
                                $first_name = $customer->first_name ? $customer->first_name : '';
                                $last_name = $customer->last_name ? $customer->last_name : '';
                                $content = '<a href="' . route('customers.show', $row->customer_id) . '" class="text-primary">' . $first_name . ' ' . $last_name . '</a>';
                            }
                        }
                    } catch (Exception $ex) {
                    }
                    return $content;
                })
                ->addColumn('store_credit', function($row){
                    $store_credit = 0.00;
                    if ($row->transaction_type == 'Purchase') {
                        if ($row->store_credit != 0) {
                          $store_credit = "-" . $row->store_credit;
                        } else {
                          $store_credit = "0.00";
                        }
                    } else if ($row->transaction_type == 'Cash out for store credit') {
                        $store_credit = "-" . $row->cash_out_for_storecredit;
                    } else {
                        $store_credit = $row->store_credit;
                    }
                    
                    return $store_credit;
                })
                ->addColumn('cash', function($row){
                    $cash = 0.00;
                    $cash = number_format($row->cash_in + $row->cash_out_for_trade + $row->cash_out_for_storecredit/2, 2, '.', '');
                    if (strpos($row->transaction_type, 'Cash out') !== false){
                        $cash = "-" .$cash;
                    } else {
                        $cash = "" .$cash;
                    }
                    
                    return $cash;
                })
                ->addColumn('action', function($row){
                    $actions = 
                        '<a href="' . route('transactions.show', $row->id) . '" class="btn btn-primary p-2" rel="tooltip" data-original-title="" title="View"><i class="material-icons">visibility</i></a>
                        ';

                    if(auth()->user()->user_type == 'admin') {
                        $actions = $actions . '<a href="' . route('transactions.edit', $row->id) . '" class="btn btn-warning p-2" rel="tooltip" data-original-title="" title="Edit"><i class="material-icons">edit</i></a>
                        <form action="' . route('transactions.destroy',$row->id) . '" method="POST">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-danger p-2" onclick="return confirm(Are you sure you want to permanently delete Transaction #' . $row->id . '?\')" rel="tooltip" data-original-title="" title="Delete"><i class="material-icons">delete</i></button>
                        </form>';
                    }
                    return $actions;
                })
                ->rawColumns([
                    'created_on', 
                    'customer', 
                    'store_credit', 
                    'cash', 
                    'action'
                ])
                ->make(true);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function month()
    {
        $title = __('Transactions of This Month');
        $total = Transaction::where('created_at', '>=', date('Y-m-d', strtotime(date('Y-m-1'))))->select('id')->get()->count();
        
        return view('transactions.list.this_month', compact('title', 'total'));
    }

    public function thisYear()
    {
        $title = __('Transactions of This Year');
        $total = Transaction::where('created_at', '>=', date('Y-m-d', strtotime(date('Y-1-1'))))->select('id')->get()->count();
        
        return view('transactions.list.this_year', compact('title', 'total'));
    }

    public function lastYear()
    {
        $last_year = date("Y",strtotime("-1 year"));

        $title = __('Transactions of Last Year');
        $total = Transaction::whereYear('created_at', Carbon::now()->subYear()->year)->select('id')->get()->count();
        
        return view('transactions.list.last_year', compact('title', 'total'));
    }

    public function transactionsMonth(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('transactions')->where('created_at', '>=', date('Y-m-d', strtotime(date('Y-m-1'))))->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_on', function($row){
                    $created_on = date('m/d/Y', strtotime($row->created_at));
                    return $created_on;
                })
                ->addColumn('customer', function($row){
                    $content = '';
                    try {
                        if($row->customer_id) {
                            $customer = Customer::whereId($row->customer_id)->select('first_name', 'last_name')->first();
                            if($customer) {
                                $first_name = $customer->first_name ? $customer->first_name : '';
                                $last_name = $customer->last_name ? $customer->last_name : '';
                                $content = '<a href="' . route('customers.show', $row->customer_id) . '" class="text-primary">' . $first_name . ' ' . $last_name . '</a>';
                            }
                        }
                    } catch (Exception $ex) {
                    }
                    return $content;
                })
                ->addColumn('store_credit', function($row){
                    $store_credit = 0.00;
                    if ($row->transaction_type == 'Purchase') {
                        if ($row->store_credit != 0) {
                          $store_credit = "-" . $row->store_credit;
                        } else {
                          $store_credit = "0.00";
                        }
                    } else if ($row->transaction_type == 'Cash out for store credit') {
                        $store_credit = "-" . $row->cash_out_for_storecredit;
                    } else {
                        $store_credit = $row->store_credit;
                    }
                    
                    return $store_credit;
                })
                ->addColumn('cash', function($row){
                    $cash = 0.00;
                    $cash = number_format($row->cash_in + $row->cash_out_for_trade + $row->cash_out_for_storecredit/2, 2, '.', '');
                    if (strpos($row->transaction_type, 'Cash out') !== false){
                        $cash = "-" .$cash;
                    } else {
                        $cash = "" .$cash;
                    }
                    
                    return $cash;
                })
                ->addColumn('action', function($row){
                    $actions = 
                        '<a href="' . route('transactions.show', $row->id) . '" class="btn btn-primary p-2" rel="tooltip" data-original-title="" title="View"><i class="material-icons">visibility</i></a>
                        ';

                    if(auth()->user()->user_type == 'admin') {
                        $actions = $actions . '<a href="' . route('transactions.edit', $row->id) . '" class="btn btn-warning p-2" rel="tooltip" data-original-title="" title="Edit"><i class="material-icons">edit</i></a>
                        <form action="' . route('transactions.destroy',$row->id) . '" method="POST">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-danger p-2" onclick="return confirm(Are you sure you want to permanently delete Transaction #' . $row->id . '?\')" rel="tooltip" data-original-title="" title="Delete"><i class="material-icons">delete</i></button>
                        </form>';
                    }
                    return $actions;
                })
                ->rawColumns([
                    'created_on', 
                    'customer', 
                    'store_credit', 
                    'cash', 
                    'action'
                ])
                ->make(true);
        }
    }

    public function transactionsThisYear(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('transactions')->where('created_at', '>=', date('Y-m-d', strtotime(date('Y-1-1'))))->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_on', function($row){
                    $created_on = date('m/d/Y', strtotime($row->created_at));
                    return $created_on;
                })
                ->addColumn('customer', function($row){
                    $content = '';
                    try {
                        if($row->customer_id) {
                            $customer = Customer::whereId($row->customer_id)->select('first_name', 'last_name')->first();
                            if($customer) {
                                $first_name = $customer->first_name ? $customer->first_name : '';
                                $last_name = $customer->last_name ? $customer->last_name : '';
                                $content = '<a href="' . route('customers.show', $row->customer_id) . '" class="text-primary">' . $first_name . ' ' . $last_name . '</a>';
                            }
                        }
                    } catch (Exception $ex) {
                    }
                    return $content;
                })
                ->addColumn('store_credit', function($row){
                    $store_credit = 0.00;
                    if ($row->transaction_type == 'Purchase') {
                        if ($row->store_credit != 0) {
                          $store_credit = "-" . $row->store_credit;
                        } else {
                          $store_credit = "0.00";
                        }
                    } else if ($row->transaction_type == 'Cash out for store credit') {
                        $store_credit = "-" . $row->cash_out_for_storecredit;
                    } else {
                        $store_credit = $row->store_credit;
                    }
                    
                    return $store_credit;
                })
                ->addColumn('cash', function($row){
                    $cash = 0.00;
                    $cash = number_format($row->cash_in + $row->cash_out_for_trade + $row->cash_out_for_storecredit/2, 2, '.', '');
                    if (strpos($row->transaction_type, 'Cash out') !== false){
                        $cash = "-" .$cash;
                    } else {
                        $cash = "" .$cash;
                    }
                    
                    return $cash;
                })
                ->addColumn('action', function($row){
                    $actions = 
                        '<a href="' . route('transactions.show', $row->id) . '" class="btn btn-primary p-2" rel="tooltip" data-original-title="" title="View"><i class="material-icons">visibility</i></a>
                        ';

                    if(auth()->user()->user_type == 'admin') {
                        $actions = $actions . '<a href="' . route('transactions.edit', $row->id) . '" class="btn btn-warning p-2" rel="tooltip" data-original-title="" title="Edit"><i class="material-icons">edit</i></a>
                        <form action="' . route('transactions.destroy',$row->id) . '" method="POST">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-danger p-2" onclick="return confirm(Are you sure you want to permanently delete Transaction #' . $row->id . '?\')" rel="tooltip" data-original-title="" title="Delete"><i class="material-icons">delete</i></button>
                        </form>';
                    }
                    return $actions;
                })
                ->rawColumns([
                    'created_on', 
                    'customer', 
                    'store_credit', 
                    'cash', 
                    'action'
                ])
                ->make(true);
        }
    }

    public function transactionsLastYear(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('transactions')->whereYear('created_at', Carbon::now()->subYear()->year)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_on', function($row){
                    $created_on = date('m/d/Y', strtotime($row->created_at));
                    return $created_on;
                })
                ->addColumn('customer', function($row){
                    $content = '';
                    try {
                        if($row->customer_id) {
                            $customer = Customer::whereId($row->customer_id)->select('first_name', 'last_name')->first();
                            if($customer) {
                                $first_name = $customer->first_name ? $customer->first_name : '';
                                $last_name = $customer->last_name ? $customer->last_name : '';
                                $content = '<a href="' . route('customers.show', $row->customer_id) . '" class="text-primary">' . $first_name . ' ' . $last_name . '</a>';
                            }
                        }
                    } catch (Exception $ex) {
                    }
                    return $content;
                })
                ->addColumn('store_credit', function($row){
                    $store_credit = 0.00;
                    if ($row->transaction_type == 'Purchase') {
                        if ($row->store_credit != 0) {
                          $store_credit = "-" . $row->store_credit;
                        } else {
                          $store_credit = "0.00";
                        }
                    } else if ($row->transaction_type == 'Cash out for store credit') {
                        $store_credit = "-" . $row->cash_out_for_storecredit;
                    } else {
                        $store_credit = $row->store_credit;
                    }
                    
                    return $store_credit;
                })
                ->addColumn('cash', function($row){
                    $cash = 0.00;
                    $cash = number_format($row->cash_in + $row->cash_out_for_trade + $row->cash_out_for_storecredit/2, 2, '.', '');
                    if (strpos($row->transaction_type, 'Cash out') !== false){
                        $cash = "-" .$cash;
                    } else {
                        $cash = "" .$cash;
                    }
                    
                    return $cash;
                })
                ->addColumn('action', function($row){
                    $actions = 
                        '<a href="' . route('transactions.show', $row->id) . '" class="btn btn-primary p-2" rel="tooltip" data-original-title="" title="View"><i class="material-icons">visibility</i></a>
                        ';

                    if(auth()->user()->user_type == 'admin') {
                        $actions = $actions . '<a href="' . route('transactions.edit', $row->id) . '" class="btn btn-warning p-2" rel="tooltip" data-original-title="" title="Edit"><i class="material-icons">edit</i></a>
                        <form action="' . route('transactions.destroy',$row->id) . '" method="POST">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-danger p-2" onclick="return confirm(Are you sure you want to permanently delete Transaction #' . $row->id . '?\')" rel="tooltip" data-original-title="" title="Delete"><i class="material-icons">delete</i></button>
                        </form>';
                    }
                    return $actions;
                })
                ->rawColumns([
                    'created_on', 
                    'customer', 
                    'store_credit', 
                    'cash', 
                    'action'
                ])
                ->make(true);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports(Request $request)
    {
        $title = __('Reports');
        $start = $request->from_date;
        $end = $request->to_date;
        if(!$start && !$end) {
            $start = date('Y-m-d', strtotime(date('Y-m-1')));
            $end = date('Y-m-d');
        }
        $store_credit_given = Transaction::where('created_at', '>=', $start)->where('created_at', '<=', $end)->whereTransactionType('Add store credit')->sum('store_credit');
        $store_credit_used = Transaction::where('created_at', '>=', $start)->where('created_at', '<=', $end)->whereTransactionType('Purchase')->sum('store_credit');
        $cash_out = Transaction::where('created_at', '>=', $start)->where('created_at', '<=', $end)->whereTransactionType('Cash out for trade')->sum('cash_out_for_trade');
        $cash_out_for_store_credit = Transaction::where('created_at', '>=', $start)->where('created_at', '<=', $end)->whereTransactionType('Cash out for store credit')->sum('cash_out_for_storecredit');
        return view('transactions.report', compact('title', 'start', 'end', 'store_credit_given', 'store_credit_used', 'cash_out', 'cash_out_for_store_credit'));
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
        if ($type == 'Purchase') {
            $rules = [
                'purchased_items' => 'required|numeric|min:0|not_in:0',
                'tax' => 'required|numeric|min:0|not_in:0',
                'purchase_total' => 'required|numeric|min:0|not_in:0',
            ];
        } else {
            $rules = [
                'transaction_amount' => 'required|numeric|min:0|not_in:0',
            ];
        }

        $this->validate($request, $rules);
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
        $data['employee'] = $request->employee;

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
        if(auth()->user()->user_type != 'admin') {
            return redirect()->back();
        }
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
        } else if ($type == 'Cash out for store_credit') {
            $data['cash_out_for_storecredit'] = $request->transaction_amount;
        } else {
            $data['transaction_type'] = 'Cash out for trade';
            $data['cash_out_for_trade'] = $request->transaction_amount;
        }
        $data['comments'] = $request->comments;
        $data['employee'] = $request->employee;
        $update = $transaction->update($data);
        if(!$update) {
            return redirect()->back()->withError('msg', "Something went wrong, please try again!");
        }

        return redirect()->route('customers.show', $transaction->customer_id)->with('success', "Transaction has been updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->user_type != 'admin') {
            return redirect()->back();
        }
        $transaction = Transaction::find($id);
        $transaction->delete();
        return redirect()->back()->with('success', 'Transaction #' . $id . ' has successfully been deleted.');
    }
}
