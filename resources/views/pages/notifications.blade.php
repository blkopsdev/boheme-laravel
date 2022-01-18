@extends('layouts.spaces.dashboard', ['activePage' => 'notifications', 'titlePage' => __('Notifications'), 'activePanel' => 'dashboard'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-success">
        <h3 class="card-title">Notifications</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 notifications">
            @if ($data->count() > 0)
            @foreach ($data as $notification)
            <div class="alert alert-info alert-with-icon" data-notify="container">
              <button type="button" class="close close-notify" data-dismiss="alert" aria-label="Close" data-id="{{ $notification->id }}">
                <i class="material-icons">close</i>
              </button>
              <a href="{{ $notification->project->space == 0 ? route('website', $notification->project->id) : route('custom_website', $notification->project->id) }}" class="alert-notification {{ $notification->is_read == 0 ? 'font-weight-bold' : '' }}" data-notify="message" data-id="{{ $notification->id }}" target="_blank">{{ $notification->project->project_name }} ({{ $notification->status->name }}) need to be finished in 24 hours.</a>
              <span class="relative-time"></span>
            </div>
            @endforeach
            @else    
            <h4 style="padding: 30px 0;">@lang('app.no_notification')</h4>
            @endif
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
    $('.alert-notification').click(function() {
      var id = $(this).data('id');
      $.ajax({
        url: '{{ route("notification_read") }}',
        type: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            id: id
          },
          success: function(data){
            $('.alert-notification[data-id="'+id+'"]').removeClass('font-weight-bold');
            $('.dropdown-item[data-id="'+id+'"]').removeClass('font-weight-bold');
          }
      });
    });

    $('.close-notify').click(function() {
      var id = $(this).data('id');

      $.ajax({
        url: '{{ route("notification_delete") }}',
        type: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            id: id
          },
          success: function(data){
            var item = $('.dropdown-item[data-id="'+id+'"]');
            if(item) {
              item.remove();
            }
            if(data.notifies == 0) {
              $('.notifications').html('<h4 style="padding: 30px 0;">@lang("app.no_notification")</h4>')
            }
          }
      });
    });
  });
</script>
@endpush