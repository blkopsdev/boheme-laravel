@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2">
          <h2>{{ $title }}</h2>
        </div>
        <div class="col-md-10">
          <a href="{{ route('create_project') }}" class="btn btn-success btn-round"><i class="material-icons">add</i>@lang('app.add_project')</a>
        </div>
      </div>
      
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">@lang('app.total_projects'): {{ $projects->count() }}</h4>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>@lang('app.id')</th>
                  <th>@lang('app.status')</th>
                  <th>@lang('app.project_manager')</th>
                  <th>@lang('app.created_at')</th>
                  <th>@lang('app.timeline')</th>
                  <th>@lang('app.milestone_deadline')</th>
                  <th>@lang('app.action')</th>
                  <th></th>
                </thead>
                <tbody>
                  @foreach ($projects as $project)
                  <tr>
                    <td>{{$project->id}}</td>
                    <td>{{$project->status_id != 0? $project->status->name: ''}}</td>
                    <td>{{$project->name }}</td>
                    <td>{{date('m-d-Y h:i', strtotime($project->created_at))}}</td>
                    <td>{{$project->status_id != 0? $project->status->name: ''}}</td>
                    <td>26 Nov 2019 19:14</td>
                    <td>customer</td>
                    <td><a href="{{ route('project', $project->id) }}" class="btn btn-warning btn-round">View</a></td>
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