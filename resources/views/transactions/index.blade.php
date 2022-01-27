@extends('layouts.app', ['activePage' => 'transactions', 'titlePage' => __('Transactions')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2">
          <h2>{{ $title }}</h2>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">{{ __('Total Transactions:') }} <strong>{{ number_format($total) }}</strong></h4>
            </div>
            <div class="card-body table-responsive">
                <table class="col-md-12 ml-2 table table-hover">
                    <thead>
                      <tr>
                        <th><strong>{{ __('ID') }}</strong></th>
                        <th><strong>{{ __('Customer') }}</strong></th>
                        <th><strong>{{ __('Created On') }}</strong></th>
                        <th><strong>{{ __('Expires On') }}</strong></th>
                        <th><strong>{{ __('Type') }}</strong></th>
                        <th><strong>{{ __('Purchase Subtotal') }}</strong></th>
                        <th><strong>{{ __('Tax') }}</strong></th>
                        <th><strong>{{ __('Purchase Total') }}</strong></th>
                        <th><strong>{{ __('Store Credit') }}</strong></th>
                        <th><strong>{{ __('Cash In/Out') }}</strong></th>
                        <th><strong>{{ __('Detail') }}</strong></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($transactions as $trans)
                        @php
                          $createdAt = strtotime($trans->created_at);
      
                          if ($trans->transaction_type == 'Purchase') {
                            if ($trans->store_credit != 0) {
                              $store_credit = "-$" . $trans->store_credit;
                            }
                          } else if ($trans->transaction_type == 'Cash out for store credit') {
                            $store_credit = "-$" . $trans->cash_out_for_storecredit;
                          } else {
                            $store_credit = "$" . $trans->store_credit;
                          }
      
                          $cash = number_format($trans->cash_in + $trans->cash_out_for_trade + $trans->cash_out_for_storecredit/2, 2, '.', '');
                          if ($trans->transaction_type == "Cash out for store credit" || $trans->transaction_type == "Cash out for trade"){
                            $cash = "-$" .$cash;
                          } else {
                            $cash = "$" .$cash;
                          }
                          @endphp
                        <tr>
                          <td>{{ $trans->id }}</td>
                          <td>{{ $trans->customer->first_name ? $trans->customer->first_name : '' }} {{ $trans->customer->last_name ? $trans->customer->last_name : '' }}</td>
                          <td>{{ date('m/d/Y', strtotime($trans->created_at)) }}</td>
                          <td>
                            @if($trans->transaction_type == 'Add store credit')
                              {{ date('m/d/Y', strtotime('+12 month', strtotime($trans->created_at))) }}
                            @endif
                          </td>
                          <td>{{ $trans->transaction_type }}</td>
                          <td>${{ $trans->purchased_items }}</td>
                          <td>${{ $trans->tax }}</td>
                          <td>${{ $trans->purchase_total }}</td>
                          <td>{{ $store_credit }}</td>
                          <td>{{ $cash }}</td>
                          <td></td>
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
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      md.initDashboardPageCharts();
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