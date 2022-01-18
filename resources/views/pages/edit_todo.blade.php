@extends('layouts.spaces.dashboard', ['activePage' => 'agenda', 'activePanel' => 'dashboard'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row mb-3">
        <div class="col-md-12">
          <a href="{{ route('agenda') }}">@lang('app.agenda')</a> / <a href="{{ route('show_todo', $todo->id) }}">@lang('app.to_do')</a> / @lang('app.edit')
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h4 class="todo-title m-0">
            <span class="mr-3" style="background-color: {{ $todo->calendar->bg_color }}; color: {{ $todo->calendar->color }}">{{ $todo->name }}</span> 
          </h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 card py-5">
          <form action="{{ route('update_todo', $todo->id) }}" method="post" class="m-0" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <input type="text" name="name" id="name" placeholder="@lang('app.name')" class="form-control" value="{{ $todo->name }}" required>
                </div>
                <div class="form-group">
                  <textarea name="description" class="form-control" rows="4" placeholder="@lang('app.description')">{{ $todo->description }}</textarea>
                </div>
                <div class="todo-files">
                  <div class="form-group">
                    <label for="file">@lang('app.files')</label>
                    <input type="file" class="form-control no-bg input-file" name="files[]">
                  </div>
                </div>
                <div class="form-group">
                  <button type="button" class="btn-round btn-success no-border btn add-btn" id="more_file"><i class="fa fa-plus"></i></button><label for="more_file">&nbsp; @lang('app.add_file')</label> 
                </div>
                
                <h4 class="mt-3">@lang('app.deadline')</h4>
                <div class="form-group calendar-event-type">
                  <label class="switch mb-0 mr-3">
                    <input type="checkbox" class="success" id="calendar_event_type" name="event_type" value="1" {{ $todo->type == 1 ? 'checked' : '' }}>
                    <span class="slider"></span>
                  </label>
                  @lang('app.all_day_event')
                </div>
                <div class="all-day-event" style="display: {{ $todo->type != 1 ? 'none' : 'block' }};">
                  <div class="form-group">
                    <label for="deadline">@lang('app.date')</label>
                    <input type="text" id="deadline" name="deadline" class="datetimepicker" autocomplete="false" value="{{ $todo->deadline }}" {{ $todo->type != 0 ? 'required' : 'block' }}>
                  </div>
                </div>
                <div class="normal-event" style="display: {{ $todo->type == 1 ? 'none' : 'block' }};">
                  <div class="row mt-3">
                    <div class="col">
                      <div class="form-group">
                        <label for="startEvent">@lang('app.start')</label>
                        <input type="text" id="startEvent" name="start" class="form-control no-bg" autocomplete="false" value="{{ $todo->start }}" {{ $todo->type != 1 ? 'required' : 'block' }}>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col">
                      <div class="form-group">
                        <label for="endEvent">@lang('app.end')</label>
                        <input type="text" id="endEvent" name="end" class="form-control no-bg" autocomplete="false" value="{{ $todo->end }}" {{ $todo->type != 1 ? 'required' : 'block' }}>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <select class="selectpicker form-control no-bg" id="user" name="user" data-style="btn btn-success text-white" title="@lang('app.add_project_manager')" required>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $todo->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <select class="selectpicker form-control no-bg" id="todo_calendar" name="calendar" data-style="btn btn-success text-white" title="@lang('app.choose_calendar')" required>
                    @foreach ($calendars as $calendar)
                    @if ($calendar->status != 0 && $calendar->name != 'Deadline')
                    <option value="{{ $calendar->id }}" style="background-color: {{ $calendar->bg_color }}" {{ $todo->calendar_id == $calendar->id ? 'selected' : '' }}>{{ $calendar->name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <select class="selectpicker form-control no-bg" id="select_project" name="project" data-style="btn btn-success text-white" title="@lang('app.choose_project')">
                    @foreach ($projects as $project)
                    <option value="{{ $project->id }}" {{ $todo->project_id == $project->id ? 'selected' : '' }}>{{ $project->company_name }} : {{ $project->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-success save-calendar">@lang('app.update')</button>
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
    $(document).ready(function() {
      var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
    
      $('#deadline').datepicker({ 
        showOtherMonths: true,
        format: 'yyyy-mm-dd',
        minDate: today,
      });
      $('#startEvent').datetimepicker({ 
        datepicker: { 
          showOtherMonths: true,
          minDate: today,
        },
        format: 'yyyy-mm-dd HH:MM',
        footer: true, 
        modal: true 
      });

      $('#endEvent').datetimepicker({ 
        datepicker: { 
          showOtherMonths: true,
          minDate: today,
        },
        format: 'yyyy-mm-dd HH:MM',
        footer: true, 
        modal: true 
      });

      $("#calendar_event_type").change(function(){
          if($(this).prop("checked") == true){
            $('.all-day-event').show();
            $('.normal-event').hide();
            $('#deadline').attr('required', true);
            $('#startEvent, #endEvent').attr('required', false);
          }else{
            $('.all-day-event').hide();
            $('.normal-event').show();
            $('#deadline').attr('required', false);
            $('#startEvent, #endEvent').attr('required', true);
          }
      });
      
      $(document).on('click', '.calendar',function() {
        var id = $(this).data('id');
        var value = $(this).val();
        $.ajax({
          url: '{{ route("update_calendar") }}',
          type: 'POST',
          data: {
            _token: "{{ csrf_token() }}",
            id: id,
            value: value
          },
          success: function(data) {
            location.reload();
          }
        });
      });
      
      $('#more_file').click(function() {
        html = '<div class="form-group d-flex align-items-center"><input type="file" class="form-control no-bg input-file" name="files[]"><button type="button" class="btn btn-danger btn-link remove-file p-0 ml-3"><span class="fas fa-times text-danger"></span></button></div>';
        $('.todo-files').append(html);
      });

      $(document).on('click', '.remove-file', function() {
        $(this).parent('.form-group').remove();
      });
    });

    @if(session('success'))
      toastr.success('{{ session('success') }}', '{{ trans('app.success') }}', toastr_options);
    @endif
    @if(session('error'))
        toastr.error('{{ session('error') }}', '{{ trans('app.error') }}', toastr_options);
    @endif
  </script>
@endpush