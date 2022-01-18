@extends('layouts.spaces.dashboard', ['activePage' => 'agenda', 'titlePage' => __('Agenda'), 'activePanel' => 'dashboard'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <h2><span class="text-success mr-3">{{ $title }}</span><button class="btn btn-success btn-round" data-toggle="modal" data-target="#create_todo"><i class="material-icons">add</i>@lang('app.add_to_do')</button></h2>
        </div>
        <div class="col-md-8 d-flex justify-content-end">
          <form action="{{ route('agenda') }}" method="GET" class="calendar-filter m-0">
            @csrf
            <select class="selectpicker no-bg mr-3" id="user" name="user" data-style="btn btn-default text-white" title="@lang('app.select_manager')">
              @foreach ($users as $user)
              <option value="{{ $user->id }}" 
                @if (isset($_GET['user']) && $_GET['user'] == $user->id)
                  selected
                @else
                  {{ auth()->user()->id == $user->id ? 'selected' : '' }}
                @endif
              >{{ $user->name }}</option>
              @endforeach
            </select>
            
            <button type="submit" class="btn btn-success">@lang('app.view')</button>
          </form>
        </div>
      </div>      
      <div class="row border-top">
        <div class="col-md-3">
          <div class="row">
            <div class="col-md-12">
              <h4 class="text-uppercase my-3">@lang('app.calendars')</h4>
              <div class="calendars">
                <ul class="list-unstyled">
                  <li><a href="" class="btn btn-success btn-link p-0 text-capitalize btn-lg" data-toggle="modal" data-target="#create_calendar"><i class="material-icons">add</i>@lang('app.new_calendar')</a></li>
                  @foreach ($calendars as $item)
                  <li>
                    <label class="disable-select">
                      <input type="checkbox" value="{{ $item->status }}" class="mr-2 calendar" {{ $item->status == 1 ? 'checked' : '' }} data-id={{ $item->id }}>
                      <div class="swatch-color mr-1" style="background-color: {{ $item->bg_color }}; width: 14px; height: 14px; display:inline-block;">
                      </div>
                      {{ $item->name }}
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                    </label>
                    @if ($item->type == 0)
                    <button type="button" class="delete-calendar btn btn-danger btn-link p-0 float-right" data-id="{{ $item->id }}"><i class="material-icons">delete</i></button>
                    @endif
                    <button type="button" class="update-calendar btn btn-primary btn-link p-0 float-right" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-bgcolor="{{ $item->bg_color }}" data-color="{{ $item->color }}" data-toggle="modal" data-target="#update_calendar"><i class="material-icons">edit</i></button>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-9 border-left">
          <div id='calendar' class="mt-3"></div>  
        </div>
      </div>
    </div>
  </div>
  @include('components.modals.calendar', ['page' => 'agenda'])
@endsection

@push('js')
<script>
  $(document).ready(function () {
    var siteurl = window.location.href;
    var url = siteurl.replace("{{ route('agenda') }}", "{{ route('fullcalendar') }}");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var calendar = $('#calendar').fullCalendar({
      editable: true,
      header: {
				left: 'title',
				center: 'agendaDay,agendaWeek,month',
				right: 'prev,next today'
			},
      events: url,
      displayEventTime: true,
      editable: true,
      eventRender: function (event, element, view) {
        if (event.allDay === 'true') {
          event.allDay = true;
        } else {
          event.allDay = false;
        }
      },
      selectable: true,
      selectHelper: true,
    });

    var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
    $('#startDate').datepicker({
      showOtherMonths: true,
      maxDate: function () {
        return $('#endDate').val();
      },
      format: 'yyyy-mm-dd'
    });
    $('#endDate').datepicker({
      showOtherMonths: true,
      minDate: function () {
        return $('#startDate').val();
      },
      format: 'yyyy-mm-dd'
    });
  });

  $(document).on('click', '.delete-calendar', function() {
    if (!confirm('{{ trans("app.are_you_sure_delete_calendar") }}')) {
      return '';
    }
    var id = $(this).data('id');
    $.ajax({
      url: "{{route('delete_calendar')}}",
        type:"POST",
        data:{
          _token: "{{ csrf_token() }}",
          id: id,
        },
        success:function(data){
          location.reload()
        },
    });
  });

  function displayMessage(message) {
    $(".response").html("<div class='success'>" + message + "</div>");
    setInterval(function () {
      $(".success").fadeOut();
    }, 1000);
  }

  @if(session('success'))
      toastr.success('{{ session('success') }}', '{{ trans('app.success') }}', toastr_options);
  @endif
  @if(session('error'))
      toastr.error('{{ session('error') }}', '{{ trans('app.error') }}', toastr_options);
  @endif
</script>
@endpush