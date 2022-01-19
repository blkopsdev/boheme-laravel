@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">people</i>
              </div>
              <p class="card-category">Customers</p>
              <h3 class="card-title">{{ $customers->count() }}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <a href="">View More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">access_time</i>
              </div>
              <p class="card-category">Today Transactions</p>
              <h3 class="card-title">{{ $today_transactions->count() }}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <a href="">View More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">payments</i>
              </div>
              <p class="card-category">Total Transactions</p>
              <h3 class="card-title">{{ $transactions->count() }}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <a href="">View More</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Last 10 Transactions</h4>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Created At</th>
                  <th>Customer</th>
                  <th>Type</th>
                  <th>Purchased Items</th>
                  <th>Tax</th>
                  <th>Purchase Total</th>
                  <th>Store Credit</th>
                  <th>Cash</th>
                  <th>Credit Balance</th>
                  <th>Comments</th>
                </thead>
                <tbody>
                  @foreach ($new_trans as $trans)
                  <tr>
                    <td>{{ $trans->id }}</td>
                    <td>{{ date('d-m-Y', strtotime($trans->created_at)) }}</td>
                    <td>{{ $trans->customer->first_name . ' ' . $trans->customer->last_name }}</td>
                    <td>{{ $trans->transaction_type }}</td>
                    <td>${{ $trans->purchased_items }}</td>
                    <td>${{ $trans->tax }}</td>
                    <td>${{ $trans->purchase_total }}</td>
                    <td></td>
                    <td></td>
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
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush