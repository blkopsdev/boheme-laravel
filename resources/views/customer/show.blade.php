@extends('layouts.app', ['activePage' => 'customer.show', 'titlePage' => __('Customer Detail')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2>{{ __('ID: ') . $customer->id }} | {{ $customer->first_name }} {{ $customer->last_name }} <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary btn-rounded ml-3"><i class="material-icons mr-2">edit</i>{{ __('Edit') }}</a></h2>
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
                <table class="ml-2" style="width: 600px" class="table">
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
                      <td>{{$customer->phone}}</td>
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
                      <td>$<span>{{ $available_credit }}</span></td>
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
                          <select class="selectpicker form-control transaction-type" id="transaction_type" name="transaction_type" data-style="btn btn-primary text-white">
                            <option value="Add store credit">{{ __('Add store credit') }}</option>
                            <option value="Purchase">{{ __('Purchase') }}</option>
                            <option value="Cash out for trade">{{ __('Cash out for TRADE-INS') }}</option>
                            <option value="Cash out for store credit">{{ __('Cash out for store credit (We give HALF their store cerdit in cash)') }}</option>
                          </select>
                        </div>
                        @if ($errors->has('contact_pref'))
                          <div id="contact-pref-error" class="error text-danger pl-3" for="contact_pref" style="display: block;">
                            <strong>{{ $errors->first('contact_pref') }}</strong>
                          </div>
                        @endif
                      </div>
                      <div class="transaction-purchase d-none">
                        <div class="bmd-form-group{{ $errors->has('purchased_items') ? ' has-danger' : '' }} mt-3">
                          <div class="input-group col-md-8">
                            <label for="purchased_items" class="mb-0">{{ __('Amount of Sale ($): ') }}</label>
                            <input type="number" step="0.01" name="purchased_items" id="purchased_items" min="0" value="{{ old('purchased_items', 0) }}" onblur="calcTax();">
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
                      <div class="transaction-no-purchase">
                        <div class="bmd-form-group{{ $errors->has('transaction_amount') ? ' has-danger' : '' }} mt-3">
                          <div class="input-group col-md-8">
                            <label for="transaction_amount" class="mb-0">{{ __('Amount ($):') }}</label>
                            <input type="number" step="0.01" name="transaction_amount" id="transaction_amount" min="0" value="{{ old('transaction_amount', 0) }}">
                          </div>
                          @if ($errors->has('transaction_amount'))
                              <div id="transaction-amount-error" class="error text-danger pl-3" for="transaction_amount" style="display: block;">
                                <strong>{{ $errors->first('transaction_amount') }}</strong>
                              </div>
                            @endif
                        </div>
                        <div class="show-employee">
                          <div class="bmd-form-group{{ $errors->has('employee') ? ' has-danger' : '' }} mt-3">
                            <div class="col-md-8">
                              <label for="employee">{{ __('Trade-in Processor') }}</label>
                              <select class="selectpicker form-control" id="employee" name="employee" data-style="btn btn-primary text-white">
                                <option value="">{{ __('Choose Employee') }}</option>
                                <option value="Yelena">{{ __('Yelena') }}</option>
                                <option value="Other">{{ __('Other') }}</option>
                              </select>
                            </div>
                            @if ($errors->has('employee'))
                              <div id="employee-error" class="error text-danger pl-3" for="employee" style="display: block;">
                                <strong>{{ $errors->first('employee') }}</strong>
                              </div>
                            @endif
                          </div>
                        </div>
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
              <div class="card-body table-responsive">
                <table class="col-md-12 ml-2 table table-hover">
                  <thead>
                    <tr>
                      <th><strong>{{ __('Transaction ID') }}</strong></th>
                      <th><strong>{{ __('Created At') }}</strong></th>
                      <th><strong>{{ __('Expires At') }}</strong></th>
                      <th><strong>{{ __('Type') }}</strong></th>
                      <th><strong>{{ __('Purchased Items') }}</strong></th>
                      <th><strong>{{ __('Tax') }}</strong></th>
                      <th><strong>{{ __('Purchase Total') }}</strong></th>
                      <th><strong>{{ __('Store Credit') }}</strong></th>
                      <th><strong>{{ __('Cash') }}</strong></th>
                      <th><strong>{{ __('Credit Balance') }}</strong></th>
                      <th><strong>{{ __('Comments') }}</strong></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($transactions as $trans)
                      @php
                        $createdAt = strtotime($trans->created_at);
    
                        // if ($trans->transaction_type == 'Add store credit') {
                        //   if($createdAt <= strtotime('2015-05-05')) {
    
                        //   } else {}
                        // } else if ($trans->transaction_type == 'Purchase') {
    
                        // } else if ($trans->transaction_type == 'Cash out for store credit') {
                        // }
                        if ($trans->transaction_type == 'Purchase') {
                          if ($trans->store_credit != 0) {
                            $store_credit = "-$" . $trans->store_credit;
                          }
                        } else {
                          $store_credit = "$" . $trans->store_credit;
                        }
    
                        $cash = number_format($trans->cash_in + $trans->cash_out_for_trade + $trans->cash_out_for_storecredit, 2, '.', '');
                        if ($trans->transaction_type == "Cash out for store credit" || $trans->transaction_type == "Cash out for trade"){
                          $cash = "-$" .$cash;
                        } else {
                          $cash = "$" .$cash;
                        }
                        @endphp
                      <tr>
                        <td>{{ $trans->id }}</td>
                        <td>{{ date('d-m-Y', strtotime($trans->created_at)) }}</td>
                        <td></td>
                        <td>{{ $trans->transaction_type }}</td>
                        <td>${{ $trans->purchased_items }}</td>
                        <td>${{ $trans->tax }}</td>
                        <td>${{ $trans->purchase_total }}</td>
                        <td>{{ $store_credit }}</td>
                        <td>{{ $cash }}</td>
                        <td></td>
                        <td>{{ $trans->comments }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $transactions->links() }}
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
    $('.selectpicker').selectpicker();
    $('select.transaction-type').on("changed.bs.select", function(e, clickedIndex, newValue, oldValue) {
      var value = $(this).val();
      $('.add-transaction input').each(function() {
        $(this).val(0)
      });
      if (value == 'Purchase') {
        $('.transaction-purchase').removeClass('d-none');
        $('.transaction-no-purchase').addClass('d-none');

      } else {
        $('.transaction-purchase').addClass('d-none');
        $('.transaction-no-purchase').removeClass('d-none');
        if(value == 'Cash out for store credit') {
          $('.show-employee').addClass('d-none');
        } else {
          $('.show-employee').removeClass('d-none');
        }
      }
    });
  });

  /* $(document).on('change', '#purchased_items', function(e) {
    e.preventDefault();
    debugger;
  }) */

  var CASalesTaxRate = 0.0825;
  function calcTax() {
    document.getElementById('tax').value = (document.getElementById('purchased_items').value * CASalesTaxRate).toFixed(2);
    document.getElementById('purchase_total').value = (eval(document.getElementById('purchased_items').value) + eval(document.getElementById('tax').value)).toFixed(2);
    calcCashNeeded();
  }
  function calcCashNeeded(){
    debugger;
    document.getElementById('cash_in').value = (document.getElementById('purchase_total').value - document.getElementById('store_credit').value).toFixed(2);
  }

  function validate() {
    if(document.getElementById('transaction_type').value == 'Purchase') {
      if (document.getElementById('purchased_items').value == 0) {
        changeAlert('You must enter an Amount of Sales...');
        return false;
      }
    } else {
      if (document.getElementById('transaction_amount').value == 0) {
        changeAlert('You must enter something in the Amount $ box...');
        return false;
      }
    }

    calcTax(document.getElementById('purchased_items'));

    if(document.getElementById('transaction_type').value == 'Add store credit' || document.getElementById('transaction_type').value == 'Cash out for trade') {
      if (document.getElementById('employee').value == '') {
        changeAlert('You must select your name in the Employee dropdown menu...');
        return false;
      }
    }

    /* var avail_credit_value = document.saveuser.avail_credit.value.replace("$","");    

    //var stringnumber = Math.round(avail_credit_value * 100) / 100;

    if ((document.saveuser.salesbox_store_credit.value * 1) > (avail_credit_value * 1)){
      changeAlert('Customer does NOT have this much store credit !!');
      //alert(document.saveuser.salesbox_store_credit.value + ' > '+ avail_credit_value);
        //alert(' 5' ); 
      return false;
    }

    if ((document.saveuser.transaction_type[3].checked) && (document.saveuser.transaction_amount.value > avail_credit_value / 2)){
      changeAlert('Customer does NOT have this much store credit !! (Remember we can only give half the cash they have in store credit)');
      return false;
    } */
  }
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