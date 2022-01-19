@extends('layouts.app', ['activePage' => 'customer.show', 'titlePage' => __('Customer')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2">
          <h2>{{ $customer->first_name }} {{ $customer->last_name }}</h2>
        </div>
        <div class="col-md-10">
          <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary btn-rounded"><i class="material-icons mr-2">edit</i>{{ __('Edit') }}</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="client-info my-3">
            <h3 class="text-primary"><strong>{{ __('Customer Info') }}</strong></h3>
            <table class="ml-2" style="width: 600px">
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
              </tbody>
            </table>
          </div>
          <div class="new-transaction my-3">
            <h3 class="text-primary"><strong>{{ __('Add Transaction') }}</strong></h3>
            <form class="form" method="POST" action="">
              @csrf
              
            </form>
          </div>
          <div class="transaction-history my-3">
            <h3 class="text-primary"><strong>{{ __('Transaction History') }}</strong></h3>
            <table class="col-md-12 ml-2 my-4 table table-hover">
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
                      $store_credit = "-$" . $trans->store_credit;
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