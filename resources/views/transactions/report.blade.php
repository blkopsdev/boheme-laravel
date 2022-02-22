@extends('layouts.app', ['activePage' => 'reports', 'titlePage' => __('reports')])

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
                        <h4 class="card-title">Reports</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <form method="get" class="prettyform" action="{{ route('transactions.index') }}">
                          @csrf
                          <p>{{ __('NOTE: Earliest data we have is from 2012-02-20') }}</p>
                          <p><strong><i>{{ __('Important!') }}</i> {{ __('please form dates like: MM/DD/YY') }}</strong></p>
                          <label for="from_date">{{ __('Date range from:') }}</label>
                          <input type="date" name="from_date" id="from_date" value="{{ $start }}" required>
                          <label for="to_date"> {{ __('To:') }} </label>
                          <input type="date" name="to_date" id="to_date" value="{{ $end }}" required>
                          <input type="submit" class="btn btn-primary btn-sm ml-3">
                        </form>
                        <div class="data-table mt-5">
                          <p>Showing data from {{ date('m-d-Y', strtotime($start)) }} to {{ date('m-d-Y', strtotime($end)) }}:</p>
                          <table class="table table-bordered" style="width: 100%">
                            <thead>
                              <th><strong>Time Period:</strong></th>
                              <th><strong>Store credit given:</strong></th>
                              <th><strong>Store credit used:</strong></th>
                              <th><strong>Store credit NOT used:</strong></th>
                              <th><strong>Cash paid out for Trade-Ins:</strong></th>
                              <th><strong>Cash paid out for store credit:</strong></th>
                            </thead>
                            <tbody>
                              <td>
                                {{ date('m-d-Y', strtotime($start)) }} to {{ date('m-d-Y', strtotime($end)) }}
                              </td>
                              <td>${{ number_format($store_credit_given, 2) }}</td>
                              <td>${{ number_format($store_credit_used, 2) }}</td>
                              <td>${{ number_format(($store_credit_given - $store_credit_used), 2) }}</td>
                              <td>${{ number_format($cash_out, 2) }}</td>
                              <td>${{ number_format($cash_out_for_store_credit, 2) }}</td>
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
    $(document).ready(function () {
        $('#transactions').DataTable();
    });

</script>

<script>
    @if(session('success'))
      toastr.success('{{ session("success") }}', '{{ trans("app.success") }}', toastr_options);
    @endif
    @if(session('error'))
      toastr.error('{{ session("error") }}', '{{ trans("app.error") }}', toastr_options);
    @endif
</script>
@endpush
