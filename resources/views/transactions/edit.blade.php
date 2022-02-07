@extends('layouts.app', ['activePage' => 'transactions', 'titlePage' => "Transaction Edit"])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">{{ __('Customers') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('customers.show', $transaction->customer_id) }}">{{ __('Customer') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('transactions.show', $transaction->id) }}">{{ __('Transaction') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('Edit') }}</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h2>{{ $title }}</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <form class="form" method="POST" action="{{ route('transactions.update', $transaction->id) }}">
            @csrf
            @method('put')
            <div class="card p-5">
              <div class="bmd-form-group{{ $errors->has('transaction_type') ? ' has-danger' : '' }} mt-3">
                <div class="row">
                  <div class="col-md-4 d-flex align-items-center">
                    <label for="transaction_type" class="m-0">{{ __('Transaction Type:') }}</label>
                  </div>
                  <div class="input-group col-md-8">
                    <input type="text" name="transaction_type" id="transaction_type" class="form-control" placeholder="{{ __('Transaction Type') }}" value="{{ $transaction->transaction_type }}" readonly>
                  </div>
                </div>
              </div>
              @if ($transaction->transaction_type == 'Purchase')
              <div class="bmd-form-group{{ $errors->has('purchased_items') ? ' has-danger' : '' }} mt-3">
                <div class="row">
                  <div class="col-md-4 d-flex align-items-center">
                    <label for="purchased_items" class="m-0">{{ __('Purchase Subtotal ($)') }}</label>
                  </div>
                  <div class="input-group col-md-8">
                    <input type="number" class="form-control" step="0.01" name="purchased_items" id="purchased_items" min="0.01" value="{{ old('purchased_items', $transaction->purchased_items) }}" onblur="calcTax();" required>
                  </div>
                </div>
                @if ($errors->has('purchased_items'))
                  <div id="purchased-items-error" class="error text-danger pl-3" for="purchased_items" style="display: block;">
                    <strong>{{ $errors->first('purchased_items') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('tax') ? ' has-danger' : '' }} mt-3">
                <div class="row">
                  <div class="col-md-4 d-flex align-items-center">
                    <label for="tax" class="m-0">{{ __('Tax ($)') }}</label>
                  </div>
                  <div class="input-group col-md-8">
                    <input type="number" class="form-control" step="0.01" name="tax" id="tax" min="0" value="{{ old('tax', $transaction->tax) }}" required readonly>
                  </div>
                </div>
                @if ($errors->has('tax'))
                  <div id="tax-error" class="error text-danger pl-3" for="tax" style="display: block;">
                    <strong>{{ $errors->first('tax') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('purchase_total') ? ' has-danger' : '' }} mt-3">
                <div class="row">
                  <div class="col-md-4 d-flex align-items-center">
                    <label for="purchase_total" class="m-0">{{ __('Purchase Total ($)') }}</label>
                  </div>
                  <div class="input-group col-md-8">
                    <input type="number" class="form-control" step="0.01" name="purchase_total" id="purchase_total" min="0" value="{{ old('purchase_total', $transaction->purchase_total) }}" required readonly>
                  </div>
                </div>
                @if ($errors->has('purchase_total'))
                  <div id="purchase-total-error" class="error text-danger pl-3" for="purchase_total" style="display: block;">
                    <strong>{{ $errors->first('purchase_total') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('store_credit') ? ' has-danger' : '' }} mt-3">
                <div class="row">
                  <div class="col-md-4 d-flex align-items-center">
                    @php
                        $store_credit = number_format(get_store_credit($transaction->customer_id, $transaction->id)['credit'], 2);
                        $used_credit = number_format($transaction->store_credit, 2);
                        $available_credit = $store_credit + $used_credit;
                    @endphp
                    <label for="store_credit" class="m-0">{{ __('Store Credit ($)') }}</label> <button type="button" class="btn btn-primary btn-link btn-small p-0 ml-2" data-toggle="tooltip" data-placement="right" title="{{ __('Available store credit is $') . $available_credit }}">
                      <i class="material-icons">help</i>
                    </button>
                  </div>
                  <div class="input-group col-md-8">
                    <input type="number" class="form-control" step="0.01" name="store_credit" id="store_credit" min="0" value="{{ old('store_credit', $transaction->store_credit) }}" onblur="calcCashNeeded();" required>
                  </div>
                </div>
                @if ($errors->has('store_credit'))
                  <div id="store-credit-error" class="error text-danger pl-3" for="store_credit" style="display: block;">
                    <strong>{{ $errors->first('store_credit') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('cash_in') ? ' has-danger' : '' }} mt-3">
                <div class="row">
                  <div class="col-md-4 d-flex align-items-center">
                    <label for="cash_in" class="m-0">{{ __('Amount Due ($)') }}</label>
                  </div>
                  <div class="input-group col-md-8">
                    <input type="number" class="form-control" step="0.01" name="cash_in" id="cash_in" min="0" value="{{ old('cash_in', $transaction->cash_in) }}" required>
                  </div>
                </div>
                @if ($errors->has('cash_in'))
                  <div id="cash-in-error" class="error text-danger pl-3" for="cash_in" style="display: block;">
                    <strong>{{ $errors->first('cash_in') }}</strong>
                  </div>
                @endif
              </div>
              @elseif($transaction->transaction_type == "Add store credit")
              <div class="bmd-form-group{{ $errors->has('transaction_amount') ? ' has-danger' : '' }} mt-3">
                <div class="row">
                  <div class="col-md-4 d-flex align-items-center">
                    <label for="transaction_amount" class="m-0">{{ __('Amount ($)') }}</label>
                  </div>
                  <div class="input-group col-md-8">
                    <input type="number" class="form-control" step="0.01" name="transaction_amount" id="transaction_amount" min="0" value="{{ old('transaction_amount', $transaction->store_credit) }}" required>
                  </div>
                </div>
                @if ($errors->has('transaction_amount'))
                  <div id="transaction-amount-error" class="error text-danger pl-3" for="transaction_amount" style="display: block;">
                    <strong>{{ $errors->first('transaction_amount') }}</strong>
                  </div>
                @endif
              </div>
              @elseif($transaction->transaction_type == "Cash out for trade")
              <div class="bmd-form-group{{ $errors->has('transaction_amount') ? ' has-danger' : '' }} mt-3">
                <div class="row">
                  <div class="col-md-4 d-flex align-items-center">
                    <label for="transaction_amount" class="m-0">{{ __('Amount ($)') }}</label>
                  </div>
                  <div class="input-group col-md-8">
                    <input type="number" class="form-control" step="0.01" name="transaction_amount" id="transaction_amount" min="0" value="{{ old('transaction_amount', $transaction->cash_out_for_trade) }}" required>
                  </div>
                </div>
                @if ($errors->has('transaction_amount'))
                  <div id="transaction-amount-error" class="error text-danger pl-3" for="transaction_amount" style="display: block;">
                    <strong>{{ $errors->first('transaction_amount') }}</strong>
                  </div>
                @endif
              </div>
              @elseif($transaction->transaction_type == "Cash out for store credit")
              <div class="bmd-form-group{{ $errors->has('transaction_amount') ? ' has-danger' : '' }} mt-3">
                <div class="row">
                  <div class="col-md-4 d-flex align-items-center">
                    <label for="transaction_amount" class="m-0">{{ __('Amount ($)') }}</label>
                  </div>
                  <div class="input-group col-md-8">
                    <input type="number" class="form-control" step="0.01" name="transaction_amount" id="transaction_amount" min="0" value="{{ old('transaction_amount', $transaction->cash_out_for_storecredit) }}" required>
                  </div>
                </div>
                @if ($errors->has('transaction_amount'))
                  <div id="transaction-amount-error" class="error text-danger pl-3" for="transaction_amount" style="display: block;">
                    <strong>{{ $errors->first('transaction_amount') }}</strong>
                  </div>
                @endif
              </div>
              @endif
              
              <div class="bmd-form-group{{ $errors->has('comments') ? ' has-danger' : '' }} mt-3">
                <div class="row">
                  <div class="col-md-4 d-flex align-items-center">
                    <label for="comments" class="m-0">{{ __('Comments') }}</label>
                  </div>
                  <div class="input-group col-md-8">
                    <textarea class="form-control" name="comments" rows="6" placeholder="Comments...">{{ old('comments', $transaction->comments) }}</textarea>
                  </div>
                </div>
                @if ($errors->has('comments'))
                  <div id="comments-error" class="error text-danger pl-3" for="comments" style="display: block;">
                    <strong>{{ $errors->first('comments') }}</strong>
                  </div>
                @endif
              </div>
              
              <div class="bmd-form-group mt-5">
                <div class="row">
                  <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-rounded">{{ __('Update') }}</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script>
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

    var avail_credit_value = {{ number_format(get_store_credit($transaction->customer_id, $transaction->id)['credit'], 2) + number_format($transaction->store_credit, 2) }};
    if (document.getElementById('store_credit').value * 1 > avail_credit_value * 1){
      materialAlert("Error!", "Customer does NOT have this much store credit!! <br>Available store credit value is $" + avail_credit_value + ".");
      return false;
    }

    if (document.getElementById('transaction_type').value == 'Cash out for store credit' && document.getElementById('transaction_amount').value > avail_credit_value / 2){
      materialAlert("Error!", "Customer does NOT have this much store credit !! (Remember we can only give half the cash they have in store credit)");
      return false;
    }
  }

  $(document).on('submit', 'form', function() {
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