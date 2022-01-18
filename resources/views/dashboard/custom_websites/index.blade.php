@extends('layouts.spaces.dashboard', ['activePage' => 'custom_websites', 'titlePage' => __('Dashboard'), 'activePanel' => 'dashboard'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2><span class="mr-3">{{ $title }}</span> <a href="{{ route('create_custom_project') }}" class="btn btn-success btn-round"><i class="material-icons">add</i>@lang('app.add_project')</a></h2>
        </div>
      </div>
      
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-success">
              <h4 class="card-title">@lang('app.total_projects'): {{ $projects->count() }}  &nbsp;&nbsp;| &nbsp;&nbsp;
                <select class="selectpicker" id="project_manager" name="project_manager" data-style="btn btn-success text-white" title="@lang('app.project_manager')">
                <option class="text-dark" value="">All</option>
                @foreach ($users as $user)
                <option class="text-dark" value="{{ $user->name }}">{{ $user->name }}</option>
                @endforeach
              </select></h4>
              
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover project-list text-center">
                <thead class="text-black">
                  <th>@lang('app.id')</th>
                  <th>@lang('app.status')</th>
                  <th>@lang('app.client_name')</th>
                  <th>@lang('app.company_name')</th>
                  <th>@lang('app.project_manager')</th>
                  <th>@lang('app.milestone_deadline')</th>
                  <th>@lang('app.action')</th>
                  <th></th>
                </thead>
                <tbody>
                  @foreach ($projects as $project)
                  <tr>
                    <td>{{ $project->id }}</td>
                    <td><span class="project-status">{{ $project->status_id != 0? $project->status->name: ''}}</span></td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->company_name }}</td>
                    <td>{{ $project->user_id? $project->user->name: '' }}</td>
                    <td>
                      @if ($project->status_id != 0 && isset($project->cur_deadline()->deadline) )
                      {{ $project->cur_deadline()->deadline }}
                      @endif
                    </td>
                    <td>
                      <div class="dropdown project-action">
                        <button class="btn dropdown-toggle" data-action="{{ $project->action }}" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-id="{{ $project->id }}">
                          @if($project->action == 0) Bedrijf @elseif($project->action == 1) Klant @elseif ($project->action == 2) Partner @elseif ($project->action == 3) Completed @endif
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <span class="dropdown-item update-action" data-project-id="{{ $project->id }}" data-action="0">Bedrijf</span>
                          <span class="dropdown-item update-action" data-project-id="{{ $project->id }}" data-action="1">Klant</span>
                          <span class="dropdown-item update-action" data-project-id="{{ $project->id }}" data-action="2">Partner</span>
                          <span class="dropdown-item update-action" data-project-id="{{ $project->id }}" data-action="3">Completed</span>
                        </div>
                      </div>
                    </td>
                    <td><a href="{{ route('custom_website', $project->id) }}" class="btn bg-white text-dark btn-round view-btn"> View &nbsp;<span class="material-icons">visibility</span></a></td>
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
      
      $('#project_manager').selectpicker();
      var self;
      $('.project-list').DataTable({
        "order": [[0, "desc"]],
        "paging":   false,
        initComplete: function () {
          self = this;
          $('#project_manager').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            val = $(this).val()
            self.api().column('4').search(val).draw()
          });
        }
      });
      $('.update-action').click(function() {
        var project_id = $(this).data('project-id');
        var value = $(this).data('action');
        $.ajax({
          url: "{{ route('project_action_update') }}",
          type: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            project_id: project_id,
            value: value
          },
          success: function(data){
            if (data.success == 1) {
              if(data.project.action == 0) {
                var action = 'Bedrijf'
              }
              if(data.project.action == 1) {
                var action = 'Klant'
              }
              if(data.project.action == 2) {
                var action = 'Partner'
              }
              if(data.project.action == 3) {
                var action = 'Completed'
              }
              $('.project-action button[data-id="' + data.project.id + '"]').html(action);
              $('.project-action button[data-id="' + data.project.id + '"]').attr('data-action', data.project.action)
            }
          }
        })
      });
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