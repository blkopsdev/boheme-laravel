@extends('layouts.spaces.dashboard', ['activePage' => 'agenda', 'titlePage' => __('To Do'), 'activePanel' => 'dashboard'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row mb-3">
        <div class="col-md-12">
          <a href="{{ route('agenda') }}">@lang('app.agenda')</a> / @lang('app.to_do')
        </div>
      </div>
      <div class="panel">
        <div class="panel-item bg-white">
          <div class="row">
            <div class="col-md-6">
              <h4 class="todo-title m-0">
                <span class="mr-3" style="background-color: {{ $todo->calendar->bg_color }}; color: {{ $todo->calendar->color }}">{{ $todo->name }}</span> 
              </h4>
            </div>
            @if (auth()->user()->id == $todo->manager_id)
            <div class="col-md-6 d-flex justify-content-end align-items-center">
              @if ($todo->status == 0)
              <button type="button" class="btn btn-link p-0 mr-3">
                <i class="material-icons" style="font-size: 35px;">play_arrow</i>&nbsp; @lang('app.start_timer')
              </button>
              <button type="button" class="btn btn-success btn-sm m-0 mr-3" id="todo_done">
                <i class="material-icons">check_circle</i>&nbsp; @lang('app.mark_as_done')
              </button>
              @else
              <button type="button" class="btn btn-info btn-sm m-0 mr-3" id="todo_done">
                <i class="material-icons">check_circle</i>&nbsp; @lang('app.mark_as_undone')
              </button>
              @endif
              @if (auth()->user()->id == $todo->user_id || auth()->user()->id == $todo->manager_id)
              <a href="{{ route('edit_todo', $todo->id) }}" class="btn btn-link btn-sm m-0 text-success p-0">
                <i class="material-icons" style="font-size: 35px">edit</i>
              </a>
              <form method="POST" id="delete-todo" class="m-0 ml-2" action="{{ route('delete_todo', $todo->id) }}" onsubmit="return confirm('Do you really want to DELETE this todo?');">
                {{csrf_field()}}
                <button type="submit" class="btn btn-link btn-danger p-2 m-0 btn-lg"><i class="fa fa-trash" style="font-size:20px"></i></button>
              </form>
              @endif
            </div>
            @endif
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 my-3">
          <div class="panel">
            <div class="panel-item bg-white">
              <h3 class="mt-2"><strong>@lang('app.details')</strong></h3>
              <table class="table table-borderless table-fixed">
                <tbody>
                  @if ($todo->type == 1)
                  <tr>
                    <th class="py-2">@lang('app.due_date')</th>
                    <td class="due-date">{{ $todo->deadline }}</td>
                  </tr>
                  @else
                  <tr>
                    <th class="py-2">@lang('app.start')</th>
                    <td class="due-date">{{ $todo->start }}</td>
                  </tr>
                  <tr>
                    <th class="py-2">@lang('app.end')</th>
                    <td class="due-date">{{ $todo->end }}</td>
                  </tr>
                  @endif
                  <tr>
                    <th class="py-2">@lang('app.description')</th>
                    <td class="description">{{ $todo->description }}</td>
                  </tr>
                  @if ($todo->files)
                  <tr>
                    <th class="py-2">@lang('app.attachments'):</th>
                    <td class="attachments">
                        <ul class="m-0">
                        @foreach (json_decode($todo->files) as $file)
                          <li><a href="{{ asset('uploads/todo/' . $file) }}" target="_blank">{{ $file }}</a></li>
                        @endforeach
                        </ul>
                    </td>
                  </tr>
                  @endif
                  <tr>
                    <th class="py-2">@lang('app.created_by'):</th>
                    <td class="assigned">{{ $todo->user->name }}</td>
                  </tr>
                  <tr>
                    <th class="py-2">@lang('app.assigned'):</th>
                    <td class="assigned">{{ $todo->manager()->name }}</td>
                  </tr>
                  @if ($todo->project)
                  <tr>
                    <th class="py-2">@lang('app.project'):</th>
                    <td class="project">
                      <a href="@if ($todo->project->space == 1) {{ route('website', $todo->project->id) }} @elseif ($todo->project->space == 2) {{ route('custom_website', $todo->project->id) }} @elseif ($todo->project->space == 3) {{ route('webshop.show', $todo->project->id) }} @elseif ($todo->project->space == 4) {{ route('custom_webshop.show', $todo->project->id) }} @endif">{{ $todo->project->project_name }}</a>
                    </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel">
            <div class="panel-item bg-white my-3">
              <h3 class="mt-2"><strong>@lang('app.comments')</strong></h3>
              <div class="comment-list">
                @if ($comments->count()>0)
                @foreach ($comments as $comment)
                <div class="comments-item">  
                  <div class="comment_image">
                    @if ($comment->user->image_name)
                    <img src="{{ asset('uploads/users/' . $comment->user->image_name ) }}" class="img-fluid">
                    @else
                    <i class="material-icons" style="font-size: 50px; color: {{ auth()->user()->company->main_color }}">account_circle</i>
                    @endif
                  </div>
                  <div class="comments-context">
                    <h4><strong>{{$comment->user->name}}</strong> <span class="comment-time">{{ date('d-m-Y H:i',strtotime($comment->created_at)) }}</span></h4>
                    <p>
                      {!! $comment->message !!}
                      <button class="btn btn-danger comment_delete" data-id="{{ $comment->id }}"><span><i class="fa fa-trash"></i> </span></button>
                    </p>
                  </div>
                </div>
                @endforeach
                @endif
              </div>
              @if (auth()->user()->id == $todo->user_id || auth()->user()->id == $todo->manager_id )
              <div class="new-comment mt-3">
                <form id="commentform">
                  @csrf
                  <textarea name="comment" id="comment" rows="4" tabindex="4" placeholder="Type your comments..."></textarea>
                  <input name="submit" type="submit" class="add-comment btn btn-success" value="Submit comment">
                </form>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script>
  $(document).ready(function() {
    CKEDITOR.inline('comment')
    $('#commentform').on('submit',function(event){
      event.preventDefault();
      var comment = $('#comment').val();

      $.ajax({
        url: "{{route('add_agenda_comment')}}",
        type:"POST",
        data:{
            _token: "{{ csrf_token() }}",
            id: "{{$todo->id}}",
            comment: comment,
        },
        success:function(data){
          if (data.success == 1){
            $( '#commentform').each(function(){
                this.reset();
            });
            var html = '<div class="comments-item"><div class="comment_image">@if (auth()->user()->image_name) <img src="{{ asset('uploads/users/' . auth()->user()->image_name) }}" class="img-fluid"> @else <i class="material-icons" style="font-size: 50px; color: {{ auth()->user()->company->main_color }}">account_circle</i> @endif</div><div class="comments-context"><h4><strong>{{Auth::user()->name}}</strong> <span class="comment-time">{{ date('d-m-Y  H:i') }}</span></h4><p>'+ comment +'<button class="btn btn-danger comment_delete" data-id="'+ data.id +'"><span><i class="fa fa-trash"></i> </span></button></p></div></div>';
            $('.comment-list').append(html);
            CKEDITOR.instances.comment.setData('')
          }
        }
      });
    });
    
    $(document).on('click','.comment_delete', function() {
      var id = $(this).data('id');
      $.ajax({
        url: "{{route('delete_agenda_comment')}}",
        type:"POST",
        data:{
            _token: "{{ csrf_token() }}",
            id: id,
        },
        success:function(data){
          if (data.success == 1){
            var elem = $('.comment_delete[data-id="'+ id +'"]');
            var item = elem.closest('.comments-item');
            item.remove()
          }
        },
      });
    });

    $(document).on('click','#todo_done', function() {
      $.ajax({
        url: "{{route('todo_done')}}",
        type:"POST",
        data:{
            _token: "{{ csrf_token() }}",
            id: "{{ $todo->id }}",
        },
        success:function(data){
          location.reload()
        },
      });
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