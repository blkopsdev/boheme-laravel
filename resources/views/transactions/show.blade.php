@extends('layouts.app', ['activePage' => 'transactions.show', 'titlePage' => __('Transaction Detail')])

@section('content')
  <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customers.show', $transaction->customer_id) }}">{{ __('Customer') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Transaction') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h2>
                {{ __('Transaction ID: ') . $transaction->id }} 
                </h2>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                @if (auth()->user()->user_type == 'admin')
                <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-primary btn-rounded ml-3"><i class="material-icons mr-2">edit</i>{{ __('Edit') }}</a>
                @endif
            </div>
        </div>
      <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card mt-5 pb-3">
                <div class="card-header card-header-warning">
                    <h4 class="card-title">{{ __('Transaction Information') }}</h4>
                </div>
                <div class="card-body table-responsive">
                    @php
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
                        $cash = $transaction->cash_in + $transaction->cash_out_for_trade + $transaction->cash_out_for_storecredit;
                        $cash = number_format($cash, 2, '.', '');

                        if (( $transaction->transaction_type == "Cash out for store credit") || ( $transaction->transaction_type == "Cash out for trade")){
                            $cash = "-$" . $cash;
                        }else{
                            $cash = "$" . $cash;
                        } 
                    @endphp
                    <table class="ml-2 table table-striped" style="width: 600px">
                        <tbody>
                            <tr>
                                <th style="border-top: none"><strong>{{ __('ID:') }}</strong></th>
                                <td>{{$transaction->id}}</td>
                            </tr>
                            <tr>
                                <th><strong>{{ __('Created On:') }}</strong></th>
                                <td>{{ date('m/d/Y',strtotime($transaction->created_at)) }}</td>
                            </tr>
                            @if ($transaction->transaction_type == "Add store credit")
                            <tr>
                                <th><strong>{{ __('Expires On:') }}</strong></th>
                                <td>
                                    {{ date('m/d/Y', get_store_credit($transaction->customer_id, $transaction->id)['expires_on']) }}
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <th><strong>{{ __('Type:') }}</strong></th>
                                <td>{{ $transaction->transaction_type }}</td>
                            </tr>
                            <tr>
                                <th><strong>{{ __('Purchase Subtotal:') }}</strong></th>
                                <td>${{ $transaction->purchased_items }}</td>
                            </tr>
                            <tr>
                                <th><strong>{{ __('Tax:') }}</strong></th>
                                <td>${{ $transaction->tax }}</td>
                            </tr>
                            <tr>
                                <th><strong>{{ __('Store Credit:') }}</strong></th>
                                <td>{{ $store_credit }}</td>
                            </tr>
                            <tr>
                                <th><strong>{{ __('Cash In/Out:') }}</strong></th>
                                <td>{{ $cash }}</td>
                            </tr>
                            <tr>
                                <th><strong>{{ __('Credit Balance:') }}</strong></th>
                                <td>${{ number_format(get_store_credit($transaction->customer_id, $transaction->id)['credit'], 2) }}</td>
                            </tr>
                            <tr>
                                <th><strong>{{ __('Employee:') }}</strong></th>
                                <td>
                                    @if ($transaction->employee != null)
                                        {{ $transaction->employee }}
                                    @elseif($transaction->user_id != null)
                                        {{ $transaction->user->name }}
                                    @endif
                                </td>
                            </tr>
                            @if ($transaction->comments)
                            <tr>
                                <th><strong>{{ __('Comments:') }}</strong></th>
                                <td>{{ $transaction->comments }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script>
  @if(session('success'))
      toastr.success('{{ session('success') }}', '{{ trans('app.success') }}', toastr_options);
  @endif
  @if(session('error'))
      toastr.error('{{ session('error') }}', '{{ trans('app.error') }}', toastr_options);
  @endif
</script>
@endpush