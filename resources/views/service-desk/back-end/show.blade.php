@extends('layouts.spaces.service_desk', ['activePanel' => 'service_desk', 'titlePage' => __('Ticket Details'), 'activePage' => $ticket->status == 0 ? 'open_tickets' : 'closed_tickets'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row mb-3">
        <div class="col-md-12">
          <h5 class="text-success">ID {{ $ticket->id }} | {{ $ticket->name }}</h5>
        </div>
      </div>
      <div class="panel">
        <div class="panel-item bg-white">
          <div class="row align-items-center">
            <div class="col-md-3">
              <span class="m-0">
                Priority: <span class="mr-3 ticket-priority ticket-priority-{{ $ticket->priority }}">{{ $ticket->priority }}</span> 
              </span>
            </div>
            <div class="col-md-3">
              <select class="selectpicker ticket-data" id="ticket_manager" name="ticket_manager" data-style="btn btn-success text-white" title="@lang('app.add_project_manager')">
                @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ $ticket->user_id == $user->id? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
              @if ($ticket->status == 0)
              <button type="button" class="btn btn-link p-0 mr-3">
                <i class="material-icons" style="font-size: 35px;">play_arrow</i>&nbsp; @lang('app.start_timer')
              </button>
              <button type="button" class="btn btn-success btn-sm m-0 mr-3" id="ticket_done">
                <i class="material-icons">check_circle</i>&nbsp; @lang('app.mark_as_done')
              </button>
              @else
              <button type="button" class="btn btn-info btn-sm m-0 mr-3" id="ticket_done">
                <i class="material-icons">check_circle</i>&nbsp; @lang('app.mark_as_undone')
              </button>
              @endif
              <form method="POST" id="delete-ticket" class="m-0 ml-2" action="{{ route('delete_ticket', $ticket->id) }}" onsubmit="return confirm('Do you really want to DELETE this ticket?');">
                {{csrf_field()}}
                <button type="submit" class="btn btn-link btn-danger p-2 m-0 btn-lg"><i class="fa fa-trash" style="font-size:20px"></i></button>
              </form>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6 my-3">
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
                    <th class="py-2">@lang('app.phone')</th>
                    <td class="due-date">{{ $ticket->phone }}</td>
                  </tr>
                  <tr>
                    <th class="py-2">@lang('app.email')</th>
                    <td class="description">{{ $ticket->email }}</td>
                  </tr>
                  <tr>
                    <th class="py-2">@lang('app.ticket_link'):</th>
                    <td class="assigned"><a href="{{ route('ticket', ['id' => $ticket->id, 'token' => $ticket->token]) }}" target="_blank">{{ route('ticket', ['id' => $ticket->id, 'token' => $ticket->token]) }}</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="panel-item bg-white mt-3">
              <h3 class="mt-2"><strong>Activity</strong></h3>
              <div class="row mb-5">
                <div class="col-md-12">
                  <ul class="nav nav-tabs text-dark p-0" id="activityTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="conversation-tab" data-toggle="tab" href="#conversation" role="tab" aria-controls="conversation" aria-selected="true"><i class="material-icons">laptop</i> {{ __('app.conversation') }}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="track-tab" data-toggle="tab" href="#track" role="tab" aria-controls="track" aria-selected="false"><i class="material-icons">timer</i> {{ __('app.tracked_time') }}</a>
                    </li>
                  </ul>
                  <div class="tab-content mt-5" id="activityTabContent">
                    <div class="tab-pane fade show active" id="conversation" role="tabpanel" aria-labelledby="conversation-tab">
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
                    <div class="tab-pane fade" id="track" role="tabpanel" aria-labelledby="track-tab">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus recusandae rerum necessitatibus consequuntur similique velit doloremque sequi veniam vel, perspiciatis quisquam ducimus quam dolore iure numquam quis iusto aut sapiente!</div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel">
            <div class="panel-item bg-white my-3">
              <h3 class="mt-2"><strong>@lang('app.to_do')</strong></h3>
              <div class="row">
                <div class="col-md-12 table-responsive">
                  <table class="table table-hover" id="todo_table">
                    <thead>
                      <tr>
                        <th><strong>@lang('app.name')</strong></th>
                        <th><strong>@lang('app.assigned')</strong></th>
                        <th><strong>@lang('app.deadline')</strong></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($ticket->todos as $todo)
                      <tr>
                        <td><div class="swatch-color mr-1" style="background-color: {{ $todo->calendar->bg_color }}; width: 14px; height: 14px; display:inline-block;"></div>{{ $todo->name }}</td>
                        <td>{{ $todo->manager()->name }}</td>
                        <td>{{ $todo->type == 1 ? $todo->deadline : $todo->end }}</td>
                        <td><a class="text-success" href="{{ route('show_todo', $todo->id) }}"><i class="fa fa-eye"></i></a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <button type="button" class="btn btn-success btn-round" data-toggle="modal" data-target="#create_todo">@lang('app.add_to_do')</button>
                </div>
              </div>
            </div>
            <div class="panel-item bg-white my-3">
              <h3 class="mt-2"><strong>@lang('app.comments')</strong></h3>
              <div class="comment-list">
                @if ($comments->count()>0)
                @foreach ($comments as $comment)
                <div class="comments-item">  
                  <div class="comment_image">
                    <i class="material-icons" style="font-size: 50px; color: {{ auth()->user()->company->main_color }}">account_circle</i>
                  </div>
                  <div class="comments-context">
                    <h4><strong>{{ $comment->user_name }}</strong> <span class="comment-time">{{ date('d-m-Y H:i',strtotime($comment->created_at)) }}</span></h4>
                    <p>
                      {!! $comment->message !!}
                      <button class="btn btn-danger comment_delete" data-id="{{ $comment->id }}"><span><i class="fa fa-trash"></i> </span></button>
                    </p>
                  </div>
                </div>
                @endforeach
                @endif
              </div>
              
              <div class="new-comment mt-3">
                <form id="commentform">
                  @csrf
                  <textarea name="comment" id="comment" rows="4" tabindex="4" placeholder="Type your comments..." required></textarea>
                  <button type="submit" class="add-comment btn btn-success">Submit comment</button>
                </form>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('components.modals.ticket-todo')
@endsection
@push('js')
<script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script>
  $(document).ready(function() {
    // CKEDITOR.inline('comment')
    $('#commentform').on('submit',function(event){
      event.preventDefault();
      var comment = $('#comment').val();
      $.ajax({
        url: "{{route('add_ticket_comment', $ticket->id)}}",
        type:"POST",
        data:{
            _token: "{{ csrf_token() }}",
            comment: comment,
        },
        success:function(data){
          if (data.success == 1){
            $( '#commentform').each(function(){
                this.reset();
            });
            var html = '<div class="comments-item"><div class="comment_image"><i class="material-icons" style="font-size: 50px; color: {{ auth()->user()->company->main_color }}">account_circle</i></div><div class="comments-context"><h4><strong>{{ auth()->user()->name }}</strong> <span class="comment-time">{{ date('d-m-Y  H:i') }}</span></h4><p>'+ comment +'<button class="btn btn-danger comment_delete" data-id="'+ data.id +'"><span><i class="fa fa-trash"></i> </span></button></p></div></div>';
            $('.comment-list').append(html);
            CKEDITOR.instances.comment.setData('')
          }
        }
      });
    });
    /* $('#reply-message').on('submit', function(event) {
      event.preventDefault();
      var form = $(this)
      var formData = new FormData(form[0]);
      $("#btnSubmit").prop("disabled", true);
      spinner.show()

      $.ajax({
        url: "{{ route('new_message' , $ticket->id) }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success:function(data){
          spinner.hide()
          debugger;
          // if (data.success == 1){
          //   if(data.media.ref == 'manual_logo') {
          //     html = '<tr><td><a href="/uploads/' + data.media.media_name + '" class="text-success" target="_blank">' + data.media.media_name + '</a></td><td>' + data.media.status_name + '</td><td>';
          //     if (data.media.no_delete != 1) {
          //       html += '<form class="mb-0 delete-file"><input type="hidden" name="file_id" value="' + data.media.id + '"><button type="submit" class="btn btn-link btn-sm text-danger p-1"><span class="material-icons">delete</span></button></form>';
          //     }
          //     html += '</td></tr>';
          //     $('table.feedback-files tbody').append(html)
          //   } else {
          //     location.reload();
          //   }
          //   $('form.logo-file').each(function() {
          //     $(this).find('input[name="file"]').val('');
          //   })
          //   $('form.logo-file #status_picker').val('');
          //   $('form.logo-file #status_picker').selectpicker("refresh");
          // }
        },
      });
    }) */
    $('select#ticket_manager').change(function (e, clickedIndex, isSelected, previousValue) {
      var type = $(this).attr('name');
      var value = $(this).val();
      $.ajax({
        url : '{{ route("update_ticket", $ticket->id) }}',
        type: "POST",
        data: { 
          type: type,
          value: value,
          _token : '{{ csrf_token() }}' 
        },
        success : function (data) {
          if (data.success != 1) {
            toastr.error(data.msg, toastr_options);
          } else{
            toastr.success(data.msg, toastr_options);
          }

          setTimeout(function() {
            location.reload();
          }, 1000)
        }
      });
    });
    $(document).on('click','#ticket_done', function() {
      $.ajax({
        url: "{{route('ticket_done')}}",
        type:"POST",
        data:{
            _token: "{{ csrf_token() }}",
            id: "{{ $ticket->id }}",
        },
        success:function(data){
          location.reload()
        },
      });
    });

    $('#reply-message').on('submit', function() {
      spinner.show();
    })
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