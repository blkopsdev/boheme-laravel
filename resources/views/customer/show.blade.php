@extends('layouts.app', ['activePage' => 'customer.show', 'titlePage' => __('Customer Detail')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">{{ __('Customers') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('Customer Detail') }}</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h2>{{ __('ID: ') . $customer->id }} | {{ $customer->first_name }} {{ $customer->last_name }} 
          </h2>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-end">
          <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary btn-rounded ml-3" rel="tooltip" data-original-title="" title="{{ __('Edit') }}"><i class="material-icons mr-2">edit</i>{{ __('Edit') }}</a>
            @if (auth()->user()->user_type == "admin")
            <a href="{{ route('merge', $customer->id) }}" class="btn btn-success btn-rounded ml-3" rel="tooltip" data-original-title="" title="{{ __('Merge') }}"><i class="material-icons mr-2">merge</i>{{ __('Merge') }}</a>
            <form action="{{ route('customers.destroy',$customer->id) }}" method="POST" class="mb-1">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-rounded ml-3" onclick="return confirm('All transactions linked to this customer will be deleted. Are you sure you want to permanently DELETE Customer #{{ $customer->id }}?')" rel="tooltip" data-original-title="" title="{{ __('Delete') }}">
                <i class="material-icons mr-2">delete</i>
                Delete</button>
            </form>
            @endif
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="client-info">
            <div class="card mt-5 pb-3">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Customer Information') }}</h4>
              </div>
              <div class="card-body table-responsive">
                <table class="ml-2 table table-striped" style="width: 600px">
                  <tbody>
                    <tr>
                      <td><strong>{{ __('First Name:') }}</strong></td>
                      <td>{{$customer->first_name}}</td>
                    </tr>
                    <tr>
                      <td><strong>{{ __('Last Name:') }}</strong></td>
                      <td>{{$customer->last_name}}</td>
                    </tr>
                    <tr>
                      <td><strong>{{ __('Phone Number:') }}</strong></td>
                      <td>
                        @php
                          $phone = str_replace('-', '', str_replace('.', '',$customer->phone));
                          if(strlen($phone) == 7) {
                            $phone = '530' . $phone;
                          }
                        @endphp
                        {{ preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $phone) }}
                        {{-- {{$customer->phone}} --}}
                      </td>
                    </tr>
                    <tr>
                      <td><strong>{{ __('Email:') }}</strong></td>
                      <td>{{$customer->email}}</td>
                    </tr>
                    <tr>
                      <td><strong>{{ __('Trade-in Quality:') }}</strong></td>
                      <td>{{ucfirst($customer->contact_pref)}}</td>
                    </tr>
                    <tr>
                      <td><strong>{{ __('Newsletter:') }}</strong></td>
                      <td>{{ucfirst($customer->newsletter)}}</td>
                    </tr>
                    <tr>
                      <td><strong>{{ __('Customer Notes') }}</strong></td>
                      <td>{{ $customer->customer_notes }}</td>
                    </tr>
                    <tr>
                      <td><strong>{{ __('Available Credit') }}</strong></td>
                      <td>
                        $<span id="storeCredit">{{ number_format($store_credit, 2) }}</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="new-transaction my-3">
            <div class="card mt-5 pb-5">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Add Transaction') }}</h4>
              </div>
              <div class="card-body">
                <form class="form add-transaction" method="POST" action="{{ route('transactions.store') }}">
                  @csrf
                  <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="bmd-form-group{{ $errors->has('transaction_type') ? ' has-danger' : '' }} mt-3">
                        <div class="col-md-8">
                          <label for="transaction_type">{{ __('Transaction Type') }}</label>
                          <select class="selectpicker form-control transaction-type" id="transaction_type" name="transaction_type" data-style="btn btn-primary text-white" required>
                            <option value="">{{ __('- Select one -') }}</option>
                            <option value="Add store credit" {{ old('transaction_type') == 'Add store credit' ? 'selected' : '' }}>{{ __('Add store credit') }}</option>
                            <option value="Purchase" {{ old('transaction_type') == 'Purchase' ? 'selected' : '' }}>{{ __('Purchase') }}</option>
                            <option value="Cash out for trade" {{ old('transaction_type') == 'Cash out for trade' ? 'selected' : '' }}>{{ __('Cash out for TRADE-INS') }}</option>
                            <option value="Cash out for store credit" {{ old('transaction_type') == 'Cash out for store credit' ? 'selected' : '' }}>{{ __('Cash out for store credit (We give HALF their store cerdit in cash)') }}</option>
                          </select>
                        </div>
                        <div class="col-md-2"></div>
                        @if ($errors->has('transaction_type'))
                          <div id="transaction-type-error" class="error text-danger pl-3" for="transaction_type" style="display: block;">
                            <strong>{{ $errors->first('transaction_type') }}</strong>
                          </div>
                        @endif
                      </div>
                      <div class="amount-input transaction-purchase {{ old('transaction_type') == 'Purchase' ? '' : 'd-none' }}">
                        <div class="bmd-form-group{{ $errors->has('purchased_items') ? ' has-danger' : '' }} mt-3">
                          <div class="input-group col-md-8">
                            <label for="purchased_items" class="mb-0">{{ __('Amount of Sale ($): ') }}</label>
                            <input type="number" step="0.01" name="purchased_items" id="purchased_items" value="{{ old('purchased_items', 0) }}" onblur="calcTax();">
                          </div>
                          @if ($errors->has('purchased_items'))
                            <div id="purchased-error" class="error text-danger pl-3" for="purchased_items" style="display: block;">
                              <strong>{{ $errors->first('purchased_items') }}</strong>
                            </div>
                          @endif
                        </div>
                        <div class="bmd-form-group{{ $errors->has('tax') ? ' has-danger' : '' }} mt-3">
                          <div class="input-group col-md-8">
                            <label for="tax" class="mb-0">{{ __('Tax ($): ') }}</label>
                            <input type="number" step="0.01" name="tax" id="tax" min="0" value="{{ old('tax', 0) }}" readonly>
                          </div>
                          @if ($errors->has('tax'))
                            <div id="tax-error" class="error text-danger pl-3" for="tax" style="display: block;">
                              <strong>{{ $errors->first('tax') }}</strong>
                            </div>
                          @endif
                        </div>
                        <div class="bmd-form-group{{ $errors->has('purchase_total') ? ' has-danger' : '' }} mt-3">
                          <div class="input-group col-md-8">
                            <label for="purchase_total" class="mb-0">{{ __('Total ($)') }}</label>
                            <input type="number" step="0.01" name="purchase_total" id="purchase_total" min="0" value="{{ old('purchase_total', 0) }}" readonly>
                          </div>
                          @if ($errors->has('purchase_total'))
                            <div id="purchase-total-error" class="error text-danger pl-3" for="purchase_total" style="display: block;">
                              <strong>{{ $errors->first('purchase_total') }}</strong>
                            </div>
                          @endif
                        </div>
                        <div class="bmd-form-group{{ $errors->has('store_credit') ? ' has-danger' : '' }} mt-3">
                          <div class="input-group col-md-8">
                            <label for="store_credit" class="mb-0">{{ __('Store Credit Used ($):') }}</label>
                            <input type="number" step="0.01" name="store_credit" id="store_credit" min="0" value="{{ old('store_credit', 0) }}" onblur="calcCashNeeded()">
                          </div>
                          @if ($errors->has('store_credit'))
                            <div id="store-credit-error" class="error text-danger pl-3" for="store_credit" style="display: block;">
                              <strong>{{ $errors->first('store_credit') }}</strong>
                            </div>
                          @endif
                        </div>
                        <div class="bmd-form-group{{ $errors->has('cash_in') ? ' has-danger' : '' }} mt-3">
                          <div class="input-group col-md-8">
                            <label for="cash_in" class="mb-0">{{ __('Amount due ($):') }}</label>
                            <input type="number" step="0.01" name="cash_in" id="cash_in" min="0" value="{{ old('cash_in', 0) }}">
                          </div>
                          @if ($errors->has('cash_in'))
                            <div id="cash-in-error" class="error text-danger pl-3" for="cash_in" style="display: block;">
                              <strong>{{ $errors->first('cash_in') }}</strong>
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="amount-input transaction-no-purchase {{ old('transaction_type') != 'Purchase' ? '' : 'd-none' }}">
                        <div class="bmd-form-group{{ $errors->has('transaction_amount') ? ' has-danger' : '' }} mt-3">
                          <div class="input-group col-md-8">
                            <label for="transaction_amount" class="mb-0">{{ __('Amount ($):') }}</label>
                            <input type="number" step="0.01" name="transaction_amount" id="transaction_amount" value="{{ old('transaction_amount', 0) }}">
                          </div>
                          @if ($errors->has('transaction_amount'))
                            <div id="transaction-amount-error" class="error text-danger pl-3" for="transaction_amount" style="display: block;">
                              <strong>{{ $errors->first('transaction_amount') }}</strong>
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="bmd-form-group{{ $errors->has('employee') ? ' has-danger' : '' }} mt-3">
                        <div class="input-group col-md-8">
                          <label for="employee" class="mb-0">{{ __('Employee Name:') }}</label>
                          <input type="text" name="employee" id="employee" value="{{ old('employee') }}" required>
                        </div>
                        @if ($errors->has('employee'))
                          <div id="employee-error" class="error text-danger pl-3" for="employee" style="display: block;">
                            <strong>{{ $errors->first('employee') }}</strong>
                          </div>
                        @endif
                      </div>
                      <div class="bmd-form-group mt-5">
                        <div class="col-md-8">
                          <button type="submit" class="btn btn-success btn-rounded">{{ __('Submit') }}</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="bmd-form-group{{ $errors->has('comments') ? ' has-danger' : '' }} mt-3">
                        <div class="col-md-8">
                          <h5 ><strong>{{ __('Transaction Comment (optional)') }}</strong></h5>
                        </div>
                        <div class="input-group col-md-8">
                          <textarea name="comments" id="comments" class="form-control" placeholder="Comment..." rows="4"></textarea>
                        </div>
                        @if ($errors->has('comments'))
                            <div id="comments-error" class="error text-danger pl-3" for="comments" style="display: block;">
                              <strong>{{ $errors->first('comments') }}</strong>
                            </div>
                          @endif
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="transaction-history mt-5">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Transaction History') }}</h4>
              </div>
              <div class="card-body">
                <table class="col-md-12 ml-2 table table-hover" id="transaction_history">
                  <thead>
                    <tr>
                      <th><strong>{{ __('ID') }}</strong></th>
                      <th><strong>{{ __('Created On') }}</strong></th>
                      <th><strong>{{ __('Expires On') }}</strong></th>
                      <th><strong>{{ __('Type') }}</strong></th>
                      <th><strong>{{ __('Purchase Subtotal') }}</strong></th>
                      <th><strong>{{ __('Tax') }}</strong></th>
                      <th><strong>{{ __('Purchase Total') }}</strong></th>
                      <th><strong>{{ __('Store Credit') }}</strong></th>
                      <th><strong>{{ __('Cash In/Out') }}</strong></th>
                      <th><strong>{{ __('Credit Balance') }}</strong></th>
                      <th><strong>{{ __('Actions') }}</strong></th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $avail_credit = 0;
                        $avail_credit_unexpired_tally = 0;
                        $avail_credit_expired_tally = 0;
                        $purchases_over_one_year = 0;
                        $expirationDate = "";
                    @endphp
                    @foreach ($transactions as $transaction)
                      @php
                        $dateMinusYear = strtotime(date("Y-m-d").' -1 year');
                        $dateMinus6Months = strtotime(date("2015-10-01").' -6 months'); // New 6 month expiration
                        $transactionDate = strtotime($transaction->created_at);

                        $expiredFlag = 0;

                        if($transaction->transaction_type == "Add store credit") 
                        {
                          if ($transactionDate < strtotime(date("2021-01-01"))){
                            if ($transactionDate >= $dateMinus6Months) {
                              $avail_credit_unexpired_tally = $avail_credit_unexpired_tally + $transaction->store_credit;
                              $expiredFlag = 0;
                            } else {
                              $expiredFlag = 1;
                            }
                          } else {
                            if ($transactionDate >= $dateMinusYear) {
                              $avail_credit_unexpired_tally = $avail_credit_unexpired_tally + $transaction->store_credit;
                              $expiredFlag = 0;
                            } else {
                              $expiredFlag = 1;
                            }
                          }
                        }

                        if ($transaction->transaction_type == "Purchase" && $transactionDate >= $dateMinusYear){
                            $purchases_over_one_year = $purchases_over_one_year + $transaction->store_credit;
                        }
                            
                        if ($transaction->transaction_type == "Cash out for store credit"){
                            $avail_credit_unexpired_tally = $avail_credit_unexpired_tally - $transaction->cash_out_for_storecredit * 2;
                        }
                            
                        $avail_credit_unexpired  = $avail_credit_unexpired_tally - $purchases_over_one_year; // doing nothing it seems.. not used elsewhere...
                            
                        // NEXT we calc the EXPIRED store credit tally so we can subtract it in the ledger in each subsequent transaction:
                            
                        if ($transaction->transaction_type == "Add store credit" && $transactionDate < $dateMinusYear){
                            $avail_credit_expired_tally = $transaction->store_credit;
                            $avail_credit = $avail_credit - $avail_credit_expired_tally;
                        }

                        if ($transactionDate < strtotime(date("2015-05-05")) || $transactionDate >= strtotime(date("2021-01-01"))) {
                          $expirationDate = strtotime('12 months', $transactionDate); 
                        } else{
                          $expirationDate = strtotime('6 months', $transactionDate); 
                        } 
                        
                        $expiredFlag = 0;

                        if ($transaction->transaction_type == "Add store credit") {
                            $avail_credit = $avail_credit + $transaction->store_credit;
                        }
                            
                        if ( $transaction->transaction_type == "Purchase"){
                            $avail_credit = $avail_credit - $transaction->store_credit;
                        }
                            
                        if ( $transaction->transaction_type == "Cash out for store credit"){
                            $avail_credit = $avail_credit - (2 * $transaction->cash_out_for_storecredit);
                        }

                        $cash = $transaction->cash_in + $transaction->cash_out_for_trade + $transaction->cash_out_for_storecredit;
                        $cash = number_format($cash, 2, '.', '');

                        if (str_contains( $transaction->transaction_type, 'Cash out')){
                            $cash = "-$" . $cash;
                        }else{
                            $cash = "$" . $cash;
                        } 
                        
                        if ($avail_credit <= 0 ) {
                            $avail_credit = 0.00 * 1;  // this is because 0 wasn't acting like a number so i tried this multiply trick...?
                        }
                        $createdAt = strtotime($transaction->created_at);
    
                        if ($transaction->transaction_type == 'Purchase') {
                          if ($transaction->store_credit != 0) {
                            $store_credit = "-$" . number_format($transaction->store_credit, 2);
                          } else {
                            $store_credit = "$0.00";
                          }
                        } else if ($transaction->transaction_type == 'Cash out for store credit') {
                          $store_credit = "-$" . number_format($transaction->cash_out_for_storecredit*2, 2);
                        } else {
                          $store_credit = "$" . number_format($transaction->store_credit, 2);
                        } 
                        @endphp
                      <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ date('m/d/Y', strtotime($transaction->created_at)) }}</td>
                        <td>
                          @if($transaction->transaction_type == 'Add store credit')
                            {{ date('m/d/Y', $expirationDate) }}
                          @endif
                        </td>
                        <td>
                          @if ($transaction->transaction_type == "Cash out")
                          {{ __('Cash out for trade') }}
                          @else
                          {{ $transaction->transaction_type }}</td>
                          @endif
                        <td>${{ $transaction->purchased_items }}</td>
                        <td>${{ $transaction->tax }}</td>
                        <td>${{ $transaction->purchase_total }}</td>
                        <td>{{ $store_credit }}</td>
                        <td>{{ $cash }}</td>
                        <td>${{ number_format($avail_credit, 2) }}</td>
                        <td class="d-flex">
                          <a rel="tooltip" class="btn btn-primary btn-rounded p-2" href="{{ route('transactions.show', $transaction->id) }}" data-original-title="" title="{{ __('View') }}">
                            <i class="material-icons">visibility</i>
                            <div class="ripple-container"></div>
                          </a>
                          @if (auth()->user()->user_type == "admin")
                          <a rel="tooltip" class="btn btn-warning btn-rounded p-2" href="{{ route('transactions.edit', $transaction->id) }}" data-original-title="" title="{{ __('Edit') }}">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                          </a>
                          <form action="{{ route('transactions.destroy',$transaction->id) }}" method="POST" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger p-2" onclick="return confirm('Are you sure you want to permanently delete Transaction #{{ $transaction->id }}?')" rel="tooltip" data-original-title="" title="{{ __('Delete') }}"><i class="material-icons">delete</i></button>
                          </form>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')

<script>
  $(document).ready(function() {
    $('#transaction_history').DataTable({
      "order": [[ 0, 'desc' ]],
      "columnDefs": [
        { "targets": [0], "orderable": true },
        { "orderable": false, targets: '_all' }
      ]
    });
    $('.selectpicker').selectpicker();
    $('select.transaction-type').on("changed.bs.select", function(e, clickedIndex, newValue, oldValue) {
      var value = $(this).val();
      $('.add-transaction .amount-input input').each(function() {
        $(this).val(0)
      });
      if (value == 'Purchase') {
        $('.transaction-purchase').removeClass('d-none');
        $('.transaction-no-purchase').addClass('d-none');

      } else {
        $('.transaction-purchase').addClass('d-none');
        $('.transaction-no-purchase').removeClass('d-none');
      }
    });
  });


  var CASalesTaxRate = parseFloat({{ get_option('tax_rate')/100 }}, 2);
  function calcTax() {
    document.getElementById('tax').value = (document.getElementById('purchased_items').value * CASalesTaxRate).toFixed(2);
    document.getElementById('purchase_total').value = (eval(document.getElementById('purchased_items').value) + eval(document.getElementById('tax').value)).toFixed(2);
    calcCashNeeded();
  }
  function calcCashNeeded(){
    document.getElementById('cash_in').value = (document.getElementById('purchase_total').value - document.getElementById('store_credit').value).toFixed(2);
  }
  function validate() {
    calcTax(document.getElementById('purchased_items'));

    /* if(document.getElementById('transaction_type').value == 'Add store credit' || document.getElementById('transaction_type').value == 'Cash out for trade') {
      if (document.getElementById('employee').value == '') {
        materialAlert("Error!", "You must select your name in the Employee dropdown menu...");
        return false;
      }
    } */

    var avail_credit_value = document.getElementById('storeCredit').innerHTML;

    if (document.getElementById('store_credit').value * 1 > avail_credit_value * 1){
      materialAlert("Error!", "Customer does NOT have this much store credit !!");
      return false;
    }

    if (document.getElementById('transaction_type').value == 'Cash out for store credit' && document.getElementById('transaction_amount').value > avail_credit_value / 2){
      materialAlert("Error!", "Customer does NOT have this much store credit !! (Remember we can only give half the cash they have in store credit)");
      return false;
    }
  }

  $(document).on('submit','.add-transaction', function() {
    if(validate() == false) {
      return false
    } 
  });
</script>
<script>
  @if(session('success'))
      toastr.success('{{ session('success') }}', '{{ trans('app.success') }}', toastr_options);
  @endif
  @if(session('error'))
      toastr.error('{{ session('error') }}', '{{ trans('app.error') }}', toastr_options);
  @endif
</script>
@endpush