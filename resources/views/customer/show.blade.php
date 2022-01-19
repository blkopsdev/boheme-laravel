@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <span>ID {{ $project->id }} | <a href="{{ route('projects') }}">Websites</a> | {{ $project->email }}</span>
        </div>
      </div>
      
      <div class="row bg-white project-status-bar mt-3">
        <div class="col-lg-6 col-md-6">
          <label for="status" class="mb-0">@lang('app.status'): </label>
          <select class="selectpicker" id="status" name="status" data-style="btn btn-primary">
            <option value="">@lang('app.select_status')</option>
            @foreach ($statuses as $status)
            @if (in_array($status->id, $available_status))
              <option value="{{ $status->id }}" {{ $project->status_id == $status->id? 'selected' : '' }}>{{ $status->name }}</option>
            @endif
            @endforeach
          </select>
          <select class="selectpicker" id="error_message" name="error_message" data-style="btn btn-danger">
            <option value="">@lang('app.select_error_message')</option>
            @foreach ($error_messages as $error_message)
            <option value="{{ $error_message->id }}" {{ $project->error_id == $error_message->id? 'selected' : '' }}>{{ $error_message->message }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-lg-3 col-md-3">
          <select class="selectpicker" id="project_manager" name="project_manager" data-style="btn btn-success" title="Add Project Mnager">
            @foreach ($users as $user)
            <option value="{{ $user->id }}" {{ $project->user_id == $user->id? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-lg-3 col-md-3">
          <button class="btn btn-danger">@lang('app.delete')</button>
          <button class="btn btn-success">@lang('app.change_data')</button>
        </div>
      </div>
    </div>
    <div class="container-fluid mt-3">
      <div class="row panel">
        <div class="panel-item bg-white mb-3">
          <div class="col-md-12">
            <div class="client-info my-2">
              <h3><strong>@lang('app.client_details')</strong></h3>
              <table class="col-md-8 ml-2">
                <tbody>
                  <tr>
                    <td><strong>@lang('app.name')</strong></td>
                    <td>{{$project->name}}</td>
                  </tr>
                  <tr>
                    <td><strong>@lang('app.company_name')</strong></td>
                    <td>{{$project->company_name}}</td>
                  </tr>
                  <tr>
                    <td><strong>@lang('app.phone')</strong></td>
                    <td>{{$project->phone}}</td>
                  </tr>
                  <tr>
                    <td><strong>@lang('app.email')</strong></td>
                    <td>{{$project->email}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="project-timeline my-2">
              <h3><strong>@lang('app.project_timeline')</strong></h3>
              <hr>
              <div class="col-md-12">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="" name="welcome_email" id="welcome_email" {{ $project->sent_welcome == 1? 'checked disabled': ''}}>
                    @lang('app.send_welcome_email')
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="" name="upfront_payment" id="upfront_payment">
                    @lang('app.upfront_payment')
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
              <table class="col-md-12 ml-2 my-4">
                <thead>
                  <tr>
                    <th><strong>@lang('app.timeline')</strong></th>
                    <th><strong>@lang('app.created_at')</strong></th>
                    <th><strong>@lang('app.deadline')</strong></th>
                    <th><strong>@lang('app.download')</strong></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><strong>@lang('app.project_created')</strong></td>
                    <td>{{date('m-d-Y', strtotime($project->created_at))}}</td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
              <div class="col-md-12 mb-3">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="" name="website_completed" id="website_completed" {{ $project->is_completed == 1? 'checked': ''}}>
                    @lang('app.website_completed')
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
              <hr>
            </div>
          </div>
        </div>
        <div class="panel-item bg-white mb-3">
          <div class="col-md-12">
            <h3><strong>@lang('app.documents')</strong></h3>
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
      $('.selectpicker').selectpicker();
      $('select.selectpicker').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        if (!confirm('{{ trans('app.are_you_sure_status') }}')) {
          return '';
        }
        var type = $(this).attr('name');
        var value = $(this).val();

        $.ajax({
          url : '{{ route('update_project', $project->id) }}',
          type: "POST",
          data: { 
            type: type,
            value: value,
            _token : '{{ csrf_token() }}' 
          },
          success : function (data) {
            if (data.success == 1){
                toastr.success(data.msg, '@lang('app.success')', toastr_options);
            } else {
              if (data.msg) {
                toastr.error(data.msg, toastr_options);
              } else {
                  toastr.error('@lang("app.login_manager")', '@lang("app.error")', toastr_options);
              }
            }
          }
        });
      });

      $("#welcome_email").change(function() {
        if(this.checked) {
          
          var manager_id = $('#project_manager').val();
          if (manager_id == '') {
            toastr.error('@lang("app.select_manager")', '@lang("app.error")', toastr_options);
            $(this).prop('checked', false);
          }
          $.ajax({
            url : '{{ route('email_welcome') }}',
            type: "POST",
            data: { 
              project_id: {{$project->id}},
              user_id: manager_id,
              _token : '{{ csrf_token() }}' 
            },
            success : function (data) {
              if (data.success == 1){
                  toastr.success(data.msg, '@lang('app.success')', toastr_options);
                  $('#welcome_email').attr('disabled', true)
              } else {
                toastr.error(data.msg, toastr_options);
              }
            }
          });
        }
      });
      $("#website_completed").change(function() {
        if(this.checked) {
          var value = 1
        }else { 
          var value = 0
        }
        $.ajax({
          url : '{{ route('update_project', $project->id) }}',
          type: "POST",
          data: { 
            type: 'is_completed',
            value: value,
            _token : '{{ csrf_token() }}' 
          },
          success : function (data) {
            if (data.success == 1){
                toastr.success(data.msg, '@lang('app.success')', toastr_options);
            } else {
              if (data.msg) {
                toastr.error(data.msg, toastr_options);
              } else {
                  toastr.error('@lang("app.login_manager")', '@lang("app.error")', toastr_options);
              }
            }
          }
        });
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