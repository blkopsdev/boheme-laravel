@extends('layouts.app', ['activePage' => 'transactions.month', 'titlePage' => __('Transactions of This Month')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
              <li class="breadcrumb-item"><a href="/">{{ __('Transactions') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('Transactions of This Month') }}</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <h2>{{ $title }}</h2>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">{{ __('Total Transactions:') }} <strong class="text-primary">{{ number_format($total) }}</strong></h4>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover" id="transactions">
                <thead class="text-warning">
                    <th>ID</th>
                    <th>Created On</th>
                    <th>Customer</th>
                    <th>Type</th>
                    <th>Purchase Subtotal</th>
                    <th>Tax</th>
                    <th>Purchase Total</th>
                    <th>Store Credit</th>
                    <th>Cash In/Out</th>
                    <th></th>
                </thead>
                <tbody>
                  
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
    $(document).ready(function() {
      $('#transactions').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('transactions_month_ajax') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'created_on', name: 'created_on'},
            {data: 'customer', name: 'customer'},
            {data: 'transaction_type', name: 'transaction_type'},
            {data: 'purchased_items', name: 'purchased_items'},
            {data: 'tax', name: 'tax'},
            {data: 'purchase_total', name: 'purchase_total'},
            {data: 'store_credit', name: 'store_credit'},
            {data: 'cash', name: 'cash'},
            {data: 'action', name: 'action', searchable: false, orderable: false},
        ],
        "order": [[ 0, "desc" ]],
        'pageLength': 10
      })
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