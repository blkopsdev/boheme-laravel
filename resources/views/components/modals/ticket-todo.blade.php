
<div class="modal fade" id="create_todo" tabindex="-1" role="dialog" aria-labelledby="todoCreateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-success" id="todoCreateLabel"><strong>@lang('app.add_to_do')</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('create_todo') }}" method="post" class="m-0" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" name="name" id="name" placeholder="@lang('app.name')" class="form-control" required>
              </div>
              <div class="form-group">
                <textarea name="description" class="form-control" rows="4" placeholder="@lang('app.description')"></textarea>
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
                  <input type="checkbox" class="success" id="calendar_event_type" name="event_type" value="1">
                  <span class="slider"></span>
                </label>
                @lang('app.all_day_event')
              </div>
              <div class="all-day-event" style="display: none;">
                <div class="form-group">
                  <label for="deadline">@lang('app.date')</label>
                  <input type="text" id="todo_deadline" name="deadline" class="datetimepicker" autocomplete="false">
                </div>
              </div>
              <div class="normal-event">
                <div class="row mt-3">
                  <div class="col">
                    <div class="form-group">
                      <label for="startEvent">@lang('app.start')</label>
                      <input type="text" id="startEvent" name="start" class="form-control no-bg" autocomplete="false" required>
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col">
                    <div class="form-group">
                      <label for="endEvent">@lang('app.end')</label>
                      <input type="text" id="endEvent" name="end" class="form-control no-bg" autocomplete="false" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <select class="selectpicker form-control no-bg" id="select_user" name="user" data-style="btn btn-success text-white" title="@lang('app.add_project_manager')" required>
                  @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <select class="selectpicker form-control no-bg" id="todo_calendar" name="calendar" data-style="btn btn-success text-white" title="@lang('app.choose_calendar')" required>
                  <option value="">@lang('app.choose_calendar')</option>
                  {{-- @foreach ($lUser->calendars as $calendar)
                  @if ($calendar->status != 0 && $calendar->name != 'Deadline')
                  <option value="{{ $calendar->id }}" style="background-color: {{ $calendar->bg_color }}">{{ $calendar->name }}</option>
                  @endif
                  @endforeach --}}
                </select>
              </div>
              <div class="form-group hide">
                <a href="{{ route('agenda') }}" target="_blank">@lang('app.add_calendar')</a>
                <input type="hidden" name="ticket" value="{{ $ticket->id }}">
              </div>
            </div>
          </div>
          <div class="row border-top mt-3">
            <div class="col-md-12 text-right pt-3">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success save-calendar">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('js')
<script>
  $(document).ready(function() {
    var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
    
    $('#todo_deadline').datepicker({ 
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

    $(document).on('show.bs.modal', '#update_calendar', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id')
      var name = button.data('name')
      var bg_color = button.data('bgcolor')
      var color = button.data('color')
      var modal = $(this)
      
      modal.find('.modal-body input[name="id"]').val(id)
      modal.find('.modal-body input[name="name"]').val(name)
      modal.find('.modal-body input[name="bg_color"]').val(bg_color)
      modal.find('.modal-body input[name="color"]').val(color)
      var bg_swatch = modal.find('.modal-body input[name="bg_color"]').closest('.form-group').find('.minicolors-swatch')
      var txt_swatch = modal.find('.modal-body input[name="color"]').closest('.form-group').find('.minicolors-swatch')
      bg_swatch.css('background', bg_color)
      txt_swatch.css('background', color)
    });

    $('.calendar').on('click', function() {
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

    $('#select_user').change(function (e, clickedIndex, isSelected, previousValue) {
      var user_id = $(this).val();
      $.ajax({
        url: "{{ route('get_calendars') }}",
        type: "GET",
        data: {
          _token: "{{ csrf_token() }}",
          user_id: user_id
        },
        success: function(data) {
          var option = '';
            if (data.length > 0) {
                for ( i in data){
                    option += '<option value="'+data[i].id+'" style="background-color: ' + data[i].bg_color + '"> '+data[i].name +' </option>';
                }
                $('#todo_calendar').html(option);
                $('#todo_calendar').selectpicker('refresh');
            }else {
                $('#todo_calendar').html('<option value="">@lang("app.choose_calendar")</option>');
                $('#todo_calendar').selectpicker('refresh');
            }
        }
      });
    });
  });
</script>
@endpush