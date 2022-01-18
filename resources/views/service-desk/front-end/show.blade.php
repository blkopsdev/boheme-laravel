@extends('layouts.spaces.frontpage')

@section('content')
<div class="content my-5">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="panel">
          <div class="panel-item bg-white">
            <div class="row align-items-center">
              <div class="col-md-6">
                <span class="m-0">
                  Priority: <span class="mr-3 ticket-priority ticket-priority-{{ $ticket->priority }}">{{ $ticket->priority }}</span> 
                </span>
              </div>
              <div class="col-md-6 d-flex justify-content-end align-items-center">
                @if ($ticket->status == 0)
                <button type="button" class="btn btn-success btn-sm m-0 mr-3" id="close_ticket">
                  <span class="material-icons">check_circle</span>&nbsp;@lang('app.close_ticket')
                </button>
                @else
                <h4 class="text-bold m-0">Closed</h4>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-6">
        <div class="panel">
          <div class="panel-item bg-white">
            <h3 class="mt-2"><strong>Klantgegevens</strong></h3>
            <table class="table table-borderless table-fixed">
              <tbody>
                <tr>
                  <th class="py-2">@lang('app.client_name')</th>
                  <td class="due-date">{{ $ticket->name }}</td>
                </tr>
                <tr>
                  <th class="py-2">@lang('app.company_name')</th>
                  <td class="due-date">{{ $ticket->company_name }}</td>
                </tr>
                <tr>
                  <th class="py-2">@lang('app.ticket_link'):</th>
                  <td class="assigned"><a href="{{ route('ticket', ['id' => $ticket->id, 'token' => $ticket->token]) }}" target="_blank">{{ route('ticket', ['id' => $ticket->id, 'token' => $ticket->token]) }}</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel">
          <div class="panel-item">
            <h3 class="my-2"><strong>Activity:</strong></h3>
            @foreach ($conversations as $conversation)
            <div class="conversation p-3 @if($conversation->user_id) even @endif">
              <div class="conversation-title">
                <p> <span class="h4"><strong>{{ $conversation->name() }}</strong> - {{ $conversation->subject }}</span> <small class="message-time">{{ $conversation->created_at }}</small></p>
              </div>
              <div class="conversation-note">
                {!! $conversation->note !!}
              </div>
              @if ($conversation->media_id)
              <div class="conversation-file">
                Attachments: <a href="{{ asset('uploads/ticket/' . $conversation->media->media_name) }}" target="_blank">{{ $conversation->media->media_name }}</a>
              </div>
              @endif
            </div>
            @endforeach
            <div class="reply-message mt-5 row">
              <div class="col-md-8">
                <p class="text-bold" style="font-size: 20px;">Reply:</p>
                <form action="{{ route('new_message' , $ticket->id) }}" method="post" id="reply-message" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject:" required>
                  </div>
                  <div class="form-group">
                    <label for="note">Message:</label>
                    <textarea name="note" id="note" class="ckeditor" rows="5" required></textarea>
                  </div>
                  <div class="form-group">
                    <label class="text-dark" for="file">@lang('app.file')</label>
                    <input type="file" name="file" id="file" class="upload-file">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success" id="btnSubmit">Send</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>    
@endsection

@push('js')
<script src="//cdn.ckeditor.com/4.15.1/basic/ckeditor.js"></script>
<script>
  $(document).ready(function() {
    $('#reply-message').on('submit', function() {
      spinner.show();
    })
    $('#close_ticket').on('click', function() {
      $.ajax({
        url: "{{route('close_ticket', $ticket->id)}}",
        type:"POST",
        data:{
          _token: "{{ csrf_token() }}",
        },
        success:function(data){
          location.reload()
        },
      });
    });
  })
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