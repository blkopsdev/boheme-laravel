@extends('layouts.spaces.dashboard', ['activePage' => 'webshops', 'titlePage' => __('Webshop'), 'activePanel' => 'dashboard'])
@section('page-css')
<style>
  .alert.alert-danger,
  .alert.alert-success {
    display:none !important;
  }
</style>
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      
      <div class="row bg-white project-status-bar">
        <div class="col-lg-6 col-md-6">
          <label for="status" class="mb-0">@lang('app.status'): </label>
          <select class="selectpicker project-data" id="status" name="status" data-style="btn btn-success text-white" >
            <option value="">@lang('app.select_status')</option>
            @foreach ($statuses as $status)
            @if (in_array($status->slug, $available_status))
            <option value="{{ $status->slug }}" {{ $project->status_id == $status->id? 'selected' : '' }}>{{ $status->name }}</option>
            @endif
            @endforeach
          </select>
          <select class="selectpicker project-data" id="error_message" name="error_message" data-style="btn btn-danger text-white">
            <option value="">@lang('app.select_error_message')</option>
            @foreach ($error_messages as $error_message)
            <option value="{{ $error_message->id }}">{{ $error_message->message }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-lg-2 col-md-2">
          <select class="selectpicker project-data" id="project_manager" name="project_manager" data-style="btn btn-success text-white" title="@lang('app.add_project_manager')">
            @foreach ($users as $user)
            <option value="{{ $user->id }}" {{ $project->user_id == $user->id? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-lg-4 col-md-4">
          <button class="btn btn-danger" id="delete-project" data-id={{$project->id}}>@lang('app.delete')</button>
          <a href="{{ route('webshop.edit', $project->id) }}" class="btn btn-success text-white">@lang('app.change_data')</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="panel">
          <div class="panel-item bg-white my-3">
              <div class="client-info my-2">
                <h3 class="mt-2"><strong>@lang('app.project'): {{ $project->project_name }}</strong></h3>
                <table class="col-md-8 ml-2 table table-striped table-hover table-borderless">
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
                    <tr>
                      <td><strong>@lang('app.created_at')</strong></td>
                      <td>{{ date('d-m-Y h:i', strtotime($project->created_at))}}</td>
                    </tr>
                    <tr>
                      <td><strong>@lang('app.notes')</strong></td>
                      <td>{!! $project->note !!}</td>
                    </tr>
                    @if ($project->reseller_id != null)
                    <tr>
                      <td><strong>@lang('app.reseller')</strong></td>
                      <td>{{ $project->reseller->company_name }}</td>
                    </tr>    
                    @endif
                    @if ($project->upfront_payment == 1)
                    <tr>
                      <td><strong>@lang('app.upfront_payment')</strong></td>
                      <td>@lang('app.paid')</td>
                    </tr>    
                    @endif
                  </tbody>
                </table>
              </div>
              <div class="project-timeline my-2">
                <h3><strong>@lang('app.project_timeline')</strong></h3>
                <hr>
                <div class="col-md-12">
                  @if ($project->sent_welcome != 1)
                  <div class="form-check">
                    <form action="{{route('welcome_email', $project->id)}}" method="post">
                      @csrf
                      <button type="submit" class="btn btn-link text-success p-0">@lang('app.send_welcome_email')</button>
                    </form>
                  </div>
                  @endif
                  @if ($project->upfront_payment != 1)
                  <div class="form-check">
                    <form action="{{route('upfront_payment', $project->id)}}" method="post">
                      @csrf
                      <input type="hidden" name="id" value="{{ $project->id }}">
                      <button type="submit" class="btn btn-link text-success p-0">@lang('app.upfront_payment')</button>
                    </form>
                  </div>
                  @endif
                </div>
                <table class="col-md-12 ml-2 my-4">
                  <thead>
                    <tr>
                      <th><strong>@lang('app.timeline')</strong></th>
                      <th><strong>@lang('app.deadline')</strong></th>
                      <th><strong>@lang('app.download')</strong></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="padding: 5px 0;"><strong>@lang('app.project_created')</strong></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    @if (in_array('logo_design', $available_status))
                    <tr class="timeline {{ ($project->logoDesign != null && $project->logoDesign->sent_email == 1) ? '': 'inactive'}}">
                      <td>
                        <ul style="margin-bottom:0;"><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li></ul>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="timeline {{ ($project->logoDesign != null && $project->logoDesign->sent_email == 1) ? '': 'inactive'}} ">
                      <td><strong>@lang('app.logo_design')</strong></td>
                      <td>
                        @if ($project->deadlineBySlug('logo_design'))
                        <button class="btn btn-round bg-white text-dark deadline" data-toggle="modal" data-target="#deadlineUpdate" data-value="{{ $project->deadlineBySlug('logo_design')->deadline }}" data-id="{{ $project->deadlineBySlug('logo_design')->id }}">{{ $project->deadlineBySlug('logo_design')->deadline }}</button>    
                        @endif
                      </td>
                      <td>
                        @if ($project->logoDesign && $project->logoDesign->status == 1)
                        <a href="{{ route('logo_design_pdf', $project->id) }}" class="text-success font-weight-bold">Download</a>
                        @else
                        <p class="{{ ($project->logoDesign && $project->logoDesign->sent_email == 1)? 'text-success': ''}} font-weight-bold">Pending</p>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group dropleft">
                          <button type="button" class="btn {{ ($project->logoDesign && $project->logoDesign->sent_email == 1) ? 'btn-success': ''}} dropdown-toggle btn-round p-0" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                            <span class="material-icons">
                              add
                            </span>
                          </button>
                          
                          <div class="dropdown-menu">
                            @if (!$project->deadlineBySlug('logo_design'))
                            <a class="dropdown-item" data-toggle="modal" data-target="#addDeadline" data-status-slug="logo_design"><strong>@lang('app.set_deadline')</strong></a>
                            @endif
                            <a class="dropdown-item" data-toggle="modal" data-target="#create_todo"><strong>@lang('app.add_to_do')</strong></a>
                            @if ($project->logoDesign && $project->logoDesign->sent_email == 1)
                            @if ($project->logoDesign && $project->logoDesign->sent_email == 1)
                            <a class="dropdown-item" href="#"><strong>@lang('app.add_project')</strong></a>
                            <a class="dropdown-item copy-link" href="{{ route('logo_design', ['id' => $project->logoDesign->id, 'token' => $project->logoDesign->token]) }}"><strong>@lang('app.copy_form_link')</strong></a>
                            <div class="dropdown-divider"></div>
                            <span class="dropdown-item resend-email" data-status="logo_design" data-project="{{ $project->id }}"><strong>@lang('app.resend_email')</strong></span>
                            @endif
                            @endif
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if (in_array('logo_version_1', $available_status))
                    <tr class="timeline {{ ($project->logoFeedbackFirst != null && $project->logoFeedbackFirst->sent_email == 1) ? '': 'inactive'}}">
                      <td>
                        <ul style="margin-bottom:0;"><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li></ul>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="timeline {{ ($project->logoFeedbackFirst != null && $project->logoFeedbackFirst->sent_email == 1) ? '': 'inactive'}}">
                      <td><strong>@lang('app.logo_version_1')</strong></td>
                      <td>
                        @if ($project->deadlineBySlug('logo_version_1'))
                        <button class="btn btn-round bg-white text-dark deadline" data-toggle="modal" data-target="#deadlineUpdate" data-value="{{ $project->deadlineBySlug('logo_version_1')->deadline }}" data-id="{{ $project->deadlineBySlug('logo_version_1')->id }}">{{ $project->deadlineBySlug('logo_version_1')->deadline }}</button>    
                        @endif
                      </td>
                      <td>
                        @if ($project->logoFeedbackFirst && $project->logoFeedbackFirst->status == 1)
                        <a href="{{ route('logo_first_feedback_pdf', $project->id) }}" class="text-success font-weight-bold">Download</a>
                        @else
                        <p class="{{ $project->logoFeedbackFirst ? 'text-success': ''}} font-weight-bold">Pending</p>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group dropleft">
                          <button type="button" class="btn dropdown-toggle {{ ($project->logoFeedbackFirst && $project->logoFeedbackFirst->sent_email == 1) ? 'btn-success': ''}} btn-round p-0" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                            <span class="material-icons">
                              add
                            </span>
                          </button>
                          @if ($project->logoFeedbackFirst)
                          <div class="dropdown-menu">
                            @if (!$project->deadlineBySlug('logo_version_1'))
                            <a class="dropdown-item" data-toggle="modal" data-target="#addDeadline" data-status-slug="logo_version_1"><strong>@lang('app.set_deadline')</strong></a>
                            @endif
                            <a class="dropdown-item" data-toggle="modal" data-target="#create_todo"><strong>@lang('app.add_to_do')</strong></a>
                            @if ($project->logoFeedbackFirst && $project->logoFeedbackFirst->sent_email == 1)
                            <a class="dropdown-item" href="#"><strong>@lang('app.add_project')</strong></a>
                            <a class="dropdown-item copy-link" href="{{ route('logo_version_1', ['id' => $project->logoFeedbackFirst->id, 'token' => $project->logoFeedbackFirst->token]) }}"><strong>@lang('app.copy_form_link')</strong></a>
                            <div class="dropdown-divider"></div>
                            <span class="dropdown-item resend-email" data-status="logo_version_1" data-project="{{ $project->id }}"><strong>@lang('app.resend_email')</strong></span>
                            @endif
                          </div>
                          @endif
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if (in_array('logo_version_2', $available_status))
                    <tr class="timeline {{ ($project->logoFeedbackFinal != null && $project->logoFeedbackFinal->sent_email == 1) ? '': 'inactive'}}">
                      <td>
                        <ul style="margin-bottom:0;"><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li></ul>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="timeline {{ ($project->logoFeedbackFinal != null && $project->logoFeedbackFinal->sent_email == 1) ? '': 'inactive'}}">
                      <td><strong>@lang('app.logo_version_2')</strong></td>
                      <td>
                        @if ($project->deadlineBySlug('logo_version_2'))
                        <button class="btn btn-round bg-white text-dark deadline" data-toggle="modal" data-target="#deadlineUpdate" data-value="{{ $project->deadlineBySlug('logo_version_2')->deadline }}" data-id="{{ $project->deadlineBySlug('logo_version_2')->id }}">{{ $project->deadlineBySlug('logo_version_2')->deadline }}</button>    
                        @endif
                      </td>
                      <td>
                        @if ($project->logoFeedbackFinal && $project->logoFeedbackFinal->status == 1)
                        <a href="{{ route('logo_final_feedback_pdf', $project->id) }}" class="text-success font-weight-bold">Download</a>
                        @else
                        <p class="{{ ($project->logoFeedbackFinal && $project->logoFeedbackFinal->sent_email == 1) ? 'text-success': ''}} font-weight-bold">Pending</p>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group dropleft">
                          <button type="button" class="btn dropdown-toggle {{ ($project->logoFeedbackFinal && $project->logoFeedbackFinal->sent_email == 1) ? 'btn-success': ''}} btn-round p-0" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                          <span class="material-icons">
                              add
                            </span>
                          </button>
                          @if ($project->logoFeedbackFinal)
                          <div class="dropdown-menu">
                            @if (!$project->deadlineBySlug('logo_version_2'))
                            <a class="dropdown-item" data-toggle="modal" data-target="#addDeadline" data-status-slug="logo_version_2"><strong>@lang('app.set_deadline')</strong></a>
                            @endif
                            <a class="dropdown-item" data-toggle="modal" data-target="#create_todo"><strong>@lang('app.add_to_do')</strong></a>
                            @if ($project->logoFeedbackFinal && $project->logoFeedbackFinal->sent_email == 1)
                            <a class="dropdown-item" href="#"><strong>@lang('app.add_project')</strong></a>
                            <a class="dropdown-item copy-link" href="{{ route('logo_version_2', ['id' => $project->logoFeedbackFinal->id, 'token' => $project->logoFeedbackFinal->token]) }}"><strong>@lang('app.copy_form_link')</strong></a>
                            <div class="dropdown-divider"></div>
                            <span class="dropdown-item resend-email" data-status="logo_version_2" data-project="{{ $project->id }}"><strong>@lang('app.resend_email')</strong></span>
                            @endif
                          </div>
                          @endif
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if (in_array('logo_completed', $available_status))
                    <tr class="timeline {{ ($project->logoCompleted != null && $project->logoCompleted->sent_email == 1) ? '': 'inactive'}}">
                      <td>
                        <ul style="margin-bottom:0;"><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li></ul>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="timeline {{ ($project->logoCompleted != null && $project->logoCompleted->sent_email == 1) ? '': 'inactive'}}">
                      <td><strong>@lang('app.logo_completed')</strong></td>
                      <td>
                        @if ($project->deadlineBySlug('logo_completed'))
                        <button class="btn btn-round bg-white text-dark deadline" data-toggle="modal" data-target="#deadlineUpdate" data-value="{{ $project->deadlineBySlug('logo_completed')->deadline }}" data-id="{{ $project->deadlineBySlug('logo_completed')->id }}">{{ $project->deadlineBySlug('logo_completed')->deadline }}</button>    
                        @endif
                      </td>
                      <td>
                        @if (!$project->logoCompleted)
                        <p class="{{ $project->logoCompleted? 'text-success': ''}} font-weight-bold">Pending</p>
                        @elseif($project->logoCompleted && $project->logoCompleted->status == 0)
                        <p class="{{ $project->logoCompleted? 'text-success': ''}} font-weight-bold">Pending</p>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group dropleft">
                          <button type="button" class="btn {{ ($project->logoCompleted && $project->logoCompleted->sent_email == 1) ? 'btn-success': ''}} dropdown-toggle btn-round p-0" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="material-icons">
                              add
                            </span>
                          </button>
                          <div class="dropdown-menu">
                            @if (!$project->deadlineBySlug('logo_completed'))
                            <a class="dropdown-item" data-toggle="modal" data-target="#addDeadline" data-status-slug="logo_completed"><strong>@lang('app.set_deadline')</strong></a>
                            @endif
                            <a class="dropdown-item" data-toggle="modal" data-target="#create_todo"><strong>@lang('app.add_to_do')</strong></a>
                            @if ($project->logoCompleted && $project->logoCompleted->sent_email == 1)
                            <a class="dropdown-item" href="#"><strong>@lang('app.add_project')</strong></a>
                            <div class="dropdown-divider"></div>
                            <span class="dropdown-item resend-email" data-status="logo_completed" data-project="{{ $project->id }}"><strong>@lang('app.resend_email')</strong></span>
                            @endif
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if (in_array('text_writing', $available_status))
                    <tr class="timeline {{ ($project->textWriting != null && $project->textWriting->sent_email == 1) ? '': 'inactive'}}">
                      <td>
                        <ul style="margin-bottom:0;"><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li></ul>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="timeline {{ ($project->textWriting != null && $project->textWriting->sent_email == 1) ? '': 'inactive'}}">
                      <td><strong>@lang('app.text_writing')</strong></td>
                      <td>
                        @if ($project->deadlineBySlug('text_writing'))
                        <button class="btn btn-round bg-white text-dark deadline" data-toggle="modal" data-target="#deadlineUpdate" data-value="{{ $project->deadlineBySlug('text_writing')->deadline }}" data-id="{{ $project->deadlineBySlug('text_writing')->id }}">{{ $project->deadlineBySlug('text_writing')->deadline }}</button>    
                        @endif
                      </td>
                      <td>
                        @if ($project->textWriting && $project->textWriting->status == 1)
                        <a href="{{ route('text_writing_pdf', $project->id) }}" class="text-success font-weight-bold">Download</a>
                        @else
                        <p class="{{ ($project->textWriting && $project->textWriting->sent_email == 1) ? 'text-success': ''}} font-weight-bold">Pending</p>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group dropleft">
                          <button type="button" class="btn {{ ($project->textWriting && $project->textWriting->sent_email == 1) ? 'btn-success': ''}} dropdown-toggle btn-round p-0" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="material-icons">
                              add
                            </span>
                          </button>
                          <div class="dropdown-menu">
                            @if (!$project->deadlineBySlug('text_writing'))
                            <a class="dropdown-item" data-toggle="modal" data-target="#addDeadline" data-status-slug="text_writing"><strong>@lang('app.set_deadline')</strong></a>
                            @endif
                            <a class="dropdown-item" data-toggle="modal" data-target="#create_todo"><strong>@lang('app.add_to_do')</strong></a>
                            @if ($project->textWriting && $project->textWriting->sent_email == 1)
                            <a class="dropdown-item" href="#"><strong>@lang('app.add_project')</strong></a>
                            <a class="dropdown-item copy-link" href="{{ route('text_writing', ['id' => $project->textWriting->id, 'token' => $project->textWriting->token]) }}"><strong>@lang('app.copy_form_link')</strong></a>
                            <div class="dropdown-divider"></div>
                            <span class="dropdown-item resend-email" data-status="text_writing" data-project="{{ $project->id }}"><strong>@lang('app.resend_email')</strong></span>
                            @endif
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if (in_array('text_version_1', $available_status))
                    <tr class="timeline {{ ($project->textFeedbackFirst != null && $project->textFeedbackFirst->sent_email == 1) ? '': 'inactive'}}">
                      <td>
                        <ul style="margin-bottom:0;"><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li></ul>
                      </td>
                      <td></td>
                      <td></td> 
                      <td></td>
                    </tr>
                    <tr class="timeline {{ ($project->textFeedbackFirst != null && $project->textFeedbackFirst->sent_email == 1) ? '': 'inactive'}}">
                      <td><strong>@lang('app.text_version_1')</strong></td>
                      <td>
                        @if ($project->deadlineBySlug('text_version_1'))
                        <button class="btn btn-round bg-white text-dark deadline" data-toggle="modal" data-target="#deadlineUpdate" data-value="{{ $project->deadlineBySlug('text_version_1')->deadline }}" data-id="{{ $project->deadlineBySlug('text_version_1')->id }}">{{ $project->deadlineBySlug('text_version_1')->deadline }}</button>    
                        @endif
                      </td>
                      <td>
                        @if ($project->textFeedbackFirst && $project->textFeedbackFirst->status == 1)
                        <a href="{{ route('text_first_feedback_pdf', $project->id) }}" class="text-success font-weight-bold">Download</a>
                        @else
                        <p class="{{ ($project->textFeedbackFirst && $project->textFeedbackFirst->sent_email == 1) ? 'text-success': ''}} font-weight-bold">Pending</p>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group dropleft">
                          <button type="button" class="btn {{ ($project->textFeedbackFirst && $project->textFeedbackFirst->sent_email == 1) ? 'btn-success': ''}} dropdown-toggle btn-round p-0" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                            <span class="material-icons">
                              add
                            </span>
                          </button>
                          <div class="dropdown-menu">
                            @if (!$project->deadlineBySlug('text_version_1'))
                            <a class="dropdown-item" data-toggle="modal" data-target="#addDeadline" data-status-slug="text_version_1"><strong>@lang('app.set_deadline')</strong></a>
                            @endif
                            <a class="dropdown-item" data-toggle="modal" data-target="#create_todo"><strong>@lang('app.add_to_do')</strong></a>
                            @if ($project->textFeedbackFirst && $project->textFeedbackFirst->sent_email == 1)
                            <a class="dropdown-item" href="#"><strong>@lang('app.add_project')</strong></a>
                            <a class="dropdown-item copy-link" href="{{ route('text_version_1', ['id' => $project->textFeedbackFirst->id, 'token' => $project->textFeedbackFirst->token]) }}"><strong>@lang('app.copy_form_link')</strong></a>
                            <div class="dropdown-divider"></div>
                            <span class="dropdown-item resend-email" data-status="text_version_1" data-project="{{ $project->id }}"><strong>@lang('app.resend_email')</strong></span>
                            @endif
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if (in_array('text_version_2', $available_status))
                    <tr class="timeline {{ ($project->textFeedbackFinal != null && $project->textFeedbackFinal->sent_email == 1) ? '': 'inactive'}}">
                      <td>
                        <ul style="margin-bottom:0;"><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li></ul>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="timeline {{ ($project->textFeedbackFinal != null && $project->textFeedbackFinal->sent_email == 1) ? '': 'inactive'}}">
                      <td><strong>@lang('app.text_version_2')</strong></td>
                      <td>
                        @if ($project->deadlineBySlug('text_version_2'))
                        <button class="btn btn-round bg-white text-dark deadline" data-toggle="modal" data-target="#deadlineUpdate" data-value="{{ $project->deadlineBySlug('text_version_2')->deadline }}" data-id="{{ $project->deadlineBySlug('text_version_2')->id }}">{{ $project->deadlineBySlug('text_version_2')->deadline }}</button>    
                        @endif
                      </td>
                      <td>
                        @if ($project->textFeedbackFinal && $project->textFeedbackFinal->status == 1)
                        <a href="{{ route('text_final_feedback_pdf', $project->id) }}" class="text-success font-weight-bold">Download</a>
                        @else
                        <p class="{{ ($project->textFeedbackFinal && $project->textFeedbackFinal->sent_email == 1) ? 'text-success': ''}} font-weight-bold">Pending</p>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group dropleft">
                          <button type="button" class="btn {{ ($project->textFeedbackFinal && $project->textFeedbackFinal->sent_email == 1) ? 'btn-success': ''}} dropdown-toggle btn-round p-0" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                            <span class="material-icons">
                              add
                            </span>
                          </button>
                          <div class="dropdown-menu">
                            @if (!$project->deadlineBySlug('text_version_2'))
                            <a class="dropdown-item" data-toggle="modal" data-target="#addDeadline" data-status-slug="text_version_2"><strong>@lang('app.set_deadline')</strong></a>
                            @endif
                            <a class="dropdown-item" data-toggle="modal" data-target="#create_todo"><strong>@lang('app.add_to_do')</strong></a>
                            @if ($project->textFeedbackFinal && $project->textFeedbackFinal->sent_email == 1)
                            <a class="dropdown-item" href="#"><strong>@lang('app.add_project')</strong></a>
                            <a class="dropdown-item copy-link" href="{{ route('text_version_2', ['id' => $project->textFeedbackFinal->id, 'token' => $project->textFeedbackFinal->token]) }}"><strong>@lang('app.copy_form_link')</strong></a>
                            <div class="dropdown-divider"></div>
                            <span class="dropdown-item resend-email" data-status="text_version_2" data-project="{{ $project->id }}"><strong>@lang('app.resend_email')</strong></span>
                            @endif
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if (in_array('text_completed', $available_status))
                    <tr class="timeline {{ ($project->textCompleted != null && $project->textCompleted->sent_email == 1) ? '': 'inactive'}}">
                      <td>
                        <ul style="margin-bottom:0;"><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li></ul>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="timeline {{ ($project->textCompleted != null && $project->textCompleted->sent_email == 1) ? '': 'inactive'}}">
                      <td><strong>@lang('app.text_completed')</strong></td>
                      <td>
                        @if ($project->deadlineBySlug('text_completed'))
                        <button class="btn btn-round bg-white text-dark deadline" data-toggle="modal" data-target="#deadlineUpdate" data-value="{{ $project->deadlineBySlug('text_completed')->deadline }}" data-id="{{ $project->deadlineBySlug('text_completed')->id }}">{{ $project->deadlineBySlug('text_completed')->deadline }}</button>    
                        @endif
                      </td>
                      <td>
                        @if (!$project->textCompleted)
                        <p class="{{ $project->textCompleted? 'text-success': ''}} font-weight-bold">Pending</p>
                        @elseif($project->textCompleted && $project->textCompleted->status == 0)
                        <p class="{{ $project->textCompleted? 'text-success': ''}} font-weight-bold">Pending</p>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group dropleft">
                          <button type="button" class="btn {{ ($project->textCompleted && $project->textCompleted->sent_email == 1) ? 'btn-success': ''}} dropdown-toggle btn-round p-0" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="material-icons">
                              add
                            </span>
                          </button>
                          <div class="dropdown-menu">
                            @if (!$project->deadlineBySlug('text_completed'))
                            <a class="dropdown-item" data-toggle="modal" data-target="#addDeadline" data-status-slug="text_completed"><strong>@lang('app.set_deadline')</strong></a>
                            @endif
                            <a class="dropdown-item" data-toggle="modal" data-target="#create_todo"><strong>@lang('app.add_to_do')</strong></a>
                            @if ($project->textCompleted && $project->textCompleted->sent_email == 1)
                            <a class="dropdown-item" href="#"><strong>@lang('app.add_project')</strong></a>
                            <div class="dropdown-divider"></div>
                            <span class="dropdown-item resend-email" data-status="text_completed" data-project="{{ $project->id }}"><strong>@lang('app.resend_email')</strong></span>
                            @endif
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if (in_array('webshop_onboarding', $available_status))
                    <tr class="timeline {{ ($project->webshopOnboarding != null && $project->webshopOnboarding->sent_email == 1) ? '': 'inactive'}}">
                      <td>
                        <ul style="margin-bottom:0;"><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li></ul>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="timeline {{ ($project->webshopOnboarding != null && $project->webshopOnboarding->sent_email == 1) ? '': 'inactive'}}">
                      <td><strong>@lang('app.webshop_onboarding')</strong></td>
                      <td>
                        @if ($project->deadlineBySlug('webshop_onboarding'))
                        <button class="btn btn-round bg-white text-dark deadline" data-toggle="modal" data-target="#deadlineUpdate" data-value="{{ $project->deadlineBySlug('webshop_onboarding')->deadline }}" data-id="{{ $project->deadlineBySlug('webshop_onboarding')->id }}">{{ $project->deadlineBySlug('webshop_onboarding')->deadline }}</button>    
                        @endif
                      </td>
                      <td>
                        @if ($project->webshopOnboarding && $project->webshopOnboarding->status == 1)
                        <a href="{{ route('webshop_onboarding_pdf', $project->id) }}" class="text-success font-weight-bold">Download</a>
                        @else
                        <p class="{{ ($project->webshopOnboarding && $project->webshopOnboarding->sent_email == 1) ? 'text-success': ''}} font-weight-bold">Pending</p>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group dropleft">
                          <button type="button" class="btn {{ ($project->webshopOnboarding && $project->webshopOnboarding->sent_email == 1) ? 'btn-success': ''}} dropdown-toggle btn-round p-0" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                            <span class="material-icons">
                              add
                            </span>
                          </button>
                          <div class="dropdown-menu">
                            @if (!$project->deadlineBySlug('webshop_onboarding'))
                            <a class="dropdown-item" data-toggle="modal" data-target="#addDeadline" data-status-slug="webshop_onboarding"><strong>@lang('app.set_deadline')</strong></a>
                            @endif
                            <a class="dropdown-item" data-toggle="modal" data-target="#create_todo"><strong>@lang('app.add_to_do')</strong></a>
                            @if ($project->webshopOnboarding && $project->webshopOnboarding->sent_email == 1)
                            <a class="dropdown-item" href="#"><strong>@lang('app.add_project')</strong></a>
                            <a class="dropdown-item copy-link" href="{{ route('webshop_onboarding', ['id' => $project->webshopOnboarding->id, 'token' => $project->webshopOnboarding->token]) }}"><strong>@lang('app.copy_form_link')</strong></a>
                            <div class="dropdown-divider"></div>
                            <span class="dropdown-item resend-email" data-status="webshop_onboarding" data-project="{{ $project->id }}"><strong>@lang('app.resend_email')</strong></span>
                            @endif
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if (in_array('content_adding', $available_status))
                    <tr class="timeline {{ ($project->contentAdding != null && $project->contentAdding->sent_email == 1) ? '': 'inactive'}}">
                      <td>
                        <ul style="margin-bottom:0;"><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li></ul>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="timeline {{ ($project->contentAdding != null && $project->contentAdding->sent_email == 1) ? '': 'inactive'}}">
                      <td><strong>@lang('app.content_adding')</strong></td>
                      <td>
                        @if ($project->deadlineBySlug('content_adding'))
                        <button class="btn btn-round bg-white text-dark deadline" data-toggle="modal" data-target="#deadlineUpdate" data-value="{{ $project->deadlineBySlug('content_adding')->deadline }}" data-id="{{ $project->deadlineBySlug('content_adding')->id }}">{{ $project->deadlineBySlug('content_adding')->deadline }}</button>    
                        @endif
                      </td>
                      <td>
                        @if ($project->contentAdding && $project->contentAdding->status == 1)
                        <a href="{{ route('content_adding_pdf', ['id'=>$project->id, 'status' => 'content_adding']) }}" class="text-success font-weight-bold">Download</a>
                        @else
                        <p class="{{ ($project->contentAdding && $project->contentAdding->sent_email == 1) ? 'text-success': ''}} font-weight-bold">Pending</p>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group dropleft">
                          <button type="button" class="btn {{ ($project->contentAdding && $project->contentAdding->sent_email == 1) ? 'btn-success': ''}} dropdown-toggle btn-round p-0" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                            <span class="material-icons">
                              add
                            </span>
                          </button>
                          <div class="dropdown-menu">
                            @if (!$project->deadlineBySlug('content_adding'))
                            <a class="dropdown-item" data-toggle="modal" data-target="#addDeadline" data-status-slug="content_adding"><strong>@lang('app.set_deadline')</strong></a>
                            @endif
                            <a class="dropdown-item" data-toggle="modal" data-target="#create_todo"><strong>@lang('app.add_to_do')</strong></a>
                            @if ($project->contentAdding && $project->contentAdding->sent_email == 1)
                            <a class="dropdown-item" href="#"><strong>@lang('app.add_project')</strong></a>
                            <a class="dropdown-item copy-link" href="{{ route('content_adding', ['id' => $project->contentAdding->id, 'token' => $project->contentAdding->token]) }}"><strong>@lang('app.copy_form_link')</strong></a>
                            <div class="dropdown-divider"></div>
                            <span class="dropdown-item resend-email" data-status="content_adding" data-project="{{ $project->id }}"><strong>@lang('app.resend_email')</strong></span>
                            @endif
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if (in_array('first_feedback', $available_status))
                    <tr class="timeline {{ ($project->firstFeedback != null && $project->firstFeedback->sent_email == 1) ? '': 'inactive'}}">
                      <td>
                        <ul style="margin-bottom:0;"><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li></ul>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="timeline {{ ($project->firstFeedback != null && $project->firstFeedback->sent_email == 1) ? '': 'inactive'}}">
                      <td><strong>@lang('app.first_feedback')</strong></td>
                      <td>
                        @if ($project->deadlineBySlug('first_feedback'))
                        <button class="btn btn-round bg-white text-dark deadline" data-toggle="modal" data-target="#deadlineUpdate" data-value="{{ $project->deadlineBySlug('first_feedback')->deadline }}" data-id="{{ $project->deadlineBySlug('first_feedback')->id }}">{{ $project->deadlineBySlug('first_feedback')->deadline }}</button>    
                        @endif
                      </td>
                      <td>
                        @if ($project->firstFeedback && $project->firstFeedback->status == 1)
                        <a href="{{ route('feedback_pdf', ['id'=>$project->id, 'status' => 'first_feedback']) }}" class="text-success font-weight-bold">Download</a>
                        @else
                        <p class="{{ ($project->firstFeedback && $project->firstFeedback->sent_email == 1) ? 'text-success': ''}} font-weight-bold">Pending</p>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group dropleft">
                          <button type="button" class="btn {{ ($project->firstFeedback && $project->firstFeedback->sent_email == 1) ? 'btn-success': ''}} dropdown-toggle btn-round p-0" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                            <span class="material-icons">
                              add
                            </span>
                          </button>
                          <div class="dropdown-menu">
                            @if (!$project->deadlineBySlug('first_feedback'))
                            <a class="dropdown-item" data-toggle="modal" data-target="#addDeadline" data-status-slug="first_feedback"><strong>@lang('app.set_deadline')</strong></a>
                            @endif
                            <a class="dropdown-item" data-toggle="modal" data-target="#create_todo"><strong>@lang('app.add_to_do')</strong></a>
                            @if ($project->firstFeedback && $project->firstFeedback->sent_email == 1)
                            <a class="dropdown-item" href="#"><strong>@lang('app.add_project')</strong></a>
                            <a class="dropdown-item copy-link" href="{{ route('first_feedback', ['id' => $project->firstFeedback->id, 'token' => $project->firstFeedback->token]) }}"><strong>@lang('app.copy_form_link')</strong></a>
                            <div class="dropdown-divider"></div>
                            <span class="dropdown-item resend-email" data-status="first_feedback" data-project="{{ $project->id }}"><strong>@lang('app.resend_email')</strong></span>
                            @endif
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if (in_array('extra_function', $available_status))
                    <tr class="timeline {{ ($project->extraFunction != null && $project->extraFunction->sent_email == 1) ? '': 'inactive'}}">
                      <td>
                        <ul style="margin-bottom:0;"><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li></ul>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="timeline {{ ($project->extraFunction != null && $project->extraFunction->sent_email == 1) ? '': 'inactive'}}">
                      <td><strong>@lang('app.extra_function')</strong></td>
                      <td>
                        @if ($project->deadlineBySlug('extra_function'))
                        <button class="btn btn-round bg-white text-dark deadline" data-toggle="modal" data-target="#deadlineUpdate" data-value="{{ $project->deadlineBySlug('extra_function')->deadline }}" data-id="{{ $project->deadlineBySlug('extra_function')->id }}">{{ $project->deadlineBySlug('extra_function')->deadline }}</button>    
                        @endif
                      </td>
                      <td>
                        @if ($project->extraFunction && $project->extraFunction->status == 1)
                        <a href="{{ route('extra_pdf', $project->id) }}" class="text-success font-weight-bold">Download</a>
                        @else
                        <p class="{{ ($project->extraFunction && $project->extraFunction->sent_email == 1) ? 'text-success': ''}} font-weight-bold">Pending</p>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group dropleft">
                          <button type="button" class="btn {{ ($project->extraFunction && $project->extraFunction->sent_email == 1) ? 'btn-success': ''}} dropdown-toggle btn-round p-0" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                          <span class="material-icons">
                            add
                          </span>
                        </button>
                        <div class="dropdown-menu">
                          @if (!$project->deadlineBySlug('extra_function'))
                          <a class="dropdown-item" data-toggle="modal" data-target="#addDeadline" data-status-slug="extra_function"><strong>@lang('app.set_deadline')</strong></a>
                          @endif
                          <a class="dropdown-item" data-toggle="modal" data-target="#create_todo"><strong>@lang('app.add_to_do')</strong></a>
                          @if ($project->extraFunction && $project->extraFunction->sent_email == 1)
                          <a class="dropdown-item" href="#"><strong>@lang('app.add_project')</strong></a>
                          <a class="dropdown-item copy-link" href="{{ route('extra_function', ['id' => $project->extraFunction->id, 'token' => $project->extraFunction->token]) }}"><strong>@lang('app.copy_form_link')</strong></a>
                          <div class="dropdown-divider"></div>
                          <span class="dropdown-item resend-email" data-status="extra_function" data-project="{{ $project->id }}"><strong>@lang('app.resend_email')</strong></span>
                          @endif
                        </div>
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if (in_array('final_feedback', $available_status))
                    <tr class="timeline {{ ($project->finalFeedback != null && $project->finalFeedback->sent_email == 1) ? '': 'inactive'}}">
                      <td>
                        <ul style="margin-bottom:0;"><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li></ul>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="timeline {{ ($project->finalFeedback != null && $project->finalFeedback->sent_email == 1) ? '': 'inactive'}}">
                      <td><strong>@lang('app.final_feedback')</strong></td>
                      <td>
                        @if ($project->deadlineBySlug('final_feedback'))
                        <button class="btn btn-round bg-white text-dark deadline" data-toggle="modal" data-target="#deadlineUpdate" data-value="{{ $project->deadlineBySlug('final_feedback')->deadline }}" data-id="{{ $project->deadlineBySlug('final_feedback')->id }}">{{ $project->deadlineBySlug('final_feedback')->deadline }}</button>    
                        @endif
                      </td>
                      <td>
                        @if ($project->finalFeedback && $project->finalFeedback->status == 1)
                        <a href="{{ route('feedback_pdf', ['id'=>$project->id, 'status' => 'final_feedback']) }}" class="text-success font-weight-bold">Download</a>
                        @else
                        <p class="{{ ($project->finalFeedback && $project->finalFeedback->sent_email == 1) ? 'text-success': ''}} font-weight-bold">Pending</p>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group dropleft">
                          <button type="button" class="btn {{ ($project->finalFeedback && $project->finalFeedback->sent_email == 1) ? 'btn-success': ''}} dropdown-toggle btn-round p-0" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="material-icons">
                              add
                            </span>
                          </button>
                          <div class="dropdown-menu">
                            @if (!$project->deadlineBySlug('final_feedback'))
                            <a class="dropdown-item" data-toggle="modal" data-target="#addDeadline" data-status-slug="final_feedback"><strong>@lang('app.set_deadline')</strong></a>
                            @endif
                            <a class="dropdown-item" data-toggle="modal" data-target="#create_todo"><strong>@lang('app.add_to_do')</strong></a>
                            @if ($project->finalFeedback && $project->finalFeedback->sent_email == 1)
                            <a class="dropdown-item" href="#"><strong>@lang('app.add_project')</strong></a>
                            <a class="dropdown-item copy-link" href="{{ route('final_feedback', ['id' => $project->finalFeedback->id, 'token' => $project->finalFeedback->token]) }}"><strong>@lang('app.copy_form_link')</strong></a>
                            <div class="dropdown-divider"></div>
                            <span class="dropdown-item resend-email" data-status="final_feedback" data-project="{{ $project->id }}"><strong>@lang('app.resend_email')</strong></span>
                            @endif
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if (in_array('hosting', $available_status))
                    <tr class="timeline {{ ($project->hosting != null && $project->hosting->sent_email == 1) ? '': 'inactive'}}">
                      <td>
                        <ul style="margin-bottom:0;"><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li><li style="line-height: 0.7"></li></ul>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="timeline {{ ($project->hosting != null && $project->hosting->sent_email == 1) ? '': 'inactive'}}">
                      <td><strong>@lang('app.hosting')</strong></td>
                      <td>
                        @if ($project->deadlineBySlug('hosting'))
                        <button class="btn btn-round bg-white text-dark deadline" data-toggle="modal" data-target="#deadlineUpdate" data-value="{{ $project->deadlineBySlug('hosting')->deadline }}" data-id="{{ $project->deadlineBySlug('hosting')->id }}">{{ $project->deadlineBySlug('hosting')->deadline }}</button>    
                        @endif
                      </td>
                      <td>
                        @if ($project->hosting && $project->hosting->status == 1)
                        <a href="{{ route('hosting_pdf', $project->id) }}" class="text-success font-weight-bold">Download</a>
                        @else
                        <p class="{{ ($project->hosting && $project->hosting->sent_email == 1) ? 'text-success': ''}} font-weight-bold">Pending</p>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group dropleft">
                          <button type="button" class="btn {{ ($project->hosting && $project->hosting->sent_email == 1) ? 'btn-success': ''}} dropdown-toggle btn-round p-0" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                          <span class="material-icons">
                            add
                          </span>
                        </button>
                        <div class="dropdown-menu">
                            @if (!$project->deadlineBySlug('hosting'))
                            <a class="dropdown-item" data-toggle="modal" data-target="#addDeadline" data-status-slug="hosting"><strong>@lang('app.set_deadline')</strong></a>
                            @endif
                            <a class="dropdown-item" data-toggle="modal" data-target="#create_todo"><strong>@lang('app.add_to_do')</strong></a>
                            @if ($project->hosting && $project->hosting->sent_email == 1)
                            <a class="dropdown-item" href="#"><strong>@lang('app.add_project')</strong></a>
                            <a class="dropdown-item copy-link" href="{{ route('hosting', ['id' => $project->hosting->id, 'token' => $project->hosting->token]) }}"><strong>@lang('app.copy_form_link')</strong></a>
                            <div class="dropdown-divider"></div>
                            <span class="dropdown-item resend-email" data-status="hosting" data-project="{{ $project->id }}"><strong>@lang('app.resend_email')</strong></span>
                            @endif
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endif
                  </tbody>
                </table>
                <div class="col-md-12 mb-3">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" value="" name="website_completed" id="website_completed" {{ $project->is_completed == 1? 'checked': ''}}>
                      @lang('app.website_paid')
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                </div>
                <hr>
              </div>
              <div class="manual-info my-2">
                <h3><strong>@lang('app.manual_input')</strong></h3>
                <h4 class="ml-4 mt-3"><strong>@lang('app.urls'):</strong></h4>
                <div class="row">
                  <table class="col-md-11 offset-md-1 mb-3 project-urls">
                    <tbody>
                      @if ($project->testing_url)
                      <tr class="project-testing-url">
                        <td><strong>@lang('app.testing_url')</strong></td>
                        <td><a href="{{ $project->testing_url}}" target="_blank">{{$project->testing_url}}</a></td>
                        <td>
                          <form method="POST" class="mb-0 delete-url">@csrf
                            <input type="hidden" name="type" value="testing">
                            <button type="submit" class="btn btn-link btn-sm text-danger"><span class="material-icons">delete</span></button>
                          </form>
                        </td>
                      </tr>
                      @endif
                      @if ($project->website_url)
                      <tr class="project-website-url">
                        <td><strong>@lang('app.website_url')</strong></td>
                        <td><a href="{{ $project->website_url}}" target="_blank">{{$project->website_url}}</a></td>
                        <td>
                          <form class="mb-0 delete-url">
                            <input type="hidden" name="type" value="website">
                            <button type="submit" class="btn btn-link btn-sm text-danger"><span class="material-icons">delete</span></button>
                          </form>
                        </td>
                      </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
                <div class="row">
                  <form class="testing-url">
                    <div class="col-md-8 offset-md-1">
                      <label for="testing_url" class="text-dark">@lang('app.testing_url')</label>
                      <div class="form-fields">
                        <input type="hidden" name="type" value="testing">
                        <input type="text" placeholder="http://company.iqscript.nl" id="testing_url" name="url" required>
                        <button type="submit" class="btn btn-success btn-round">{{ $project->testing_url? 'Update': 'Save'}}</button>
                      </div>
                    </div>
                  </form>
                  <form class="website-url">
                    <div class="col-md-8 offset-md-1">
                      <label for="website_url" class="text-dark">@lang('app.website_url')</label>
                      <div class="form-fields">
                        <input type="hidden" name="type" value="website">
                        <input type="text" placeholder="http://dropjob.nl" id="website_url" name="url" required>
                        <button type="submit" class="btn btn-success btn-round">{{ $project->website_url? 'Update': 'Save'}}</button>
                      </div>
                    </div>
                  </form>
                </div>
                {{-- @if ($media->count()>0) --}}
                <h4 class="ml-4 mt-3"><strong>@lang('app.manual_files')</strong></h4>
                <p class="ml-5 text-warning"><em>@lang('app.file_size_limit_note')</em></p>
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-striped borderless feedback-files" style="width: 100%;">
                      <thead>
                        <tr>
                          <th style="width: 55%"><strong>@lang('app.file_name')</strong></th>
                          <th style="width: 35%"><strong>@lang('app.status')</strong></th>
                          <th style="width: 10%"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($media as $file)
                        <tr>
                          <td><a href="/uploads/{{$file->media_name}}" class="text-success" target="_blank">{{$file->media_name}}</a></td>
                          <td>{{$file->status->name}}</td>
                          <td>
                            @if ($file->no_delete == 0)
                            <form class="mb-0 delete-file">@csrf
                              <input type="hidden" name="file_id" value="{{ $file->id }}">
                              <button type="submit" class="btn btn-link btn-sm text-danger p-1"><span class="material-icons">delete</span></button>
                            </form>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                {{-- @endif --}}
                <h4 class="ml-4 mt-3"><strong>@lang('app.upload_files')</strong></h4>
                <div class="row mb-5">
                  <form class="logo-file" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-11 offset-md-1">
                      <input type="hidden" name="type" value="0">
                      <div class="manual-files">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="text-dark" for="logo_file">@lang('app.file')</label>
                              <input type="file" name="file" id="logo_file" required>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="text-dark" for="status_picker">@lang('app.status'): </label>
                              <select class="statuspicker" id="status_picker" name="status" data-style="btn btn-light-success text-dark" required>
                                <option value="">@lang('app.select_status')</option>
                                @foreach ($statuses as $status)
                                @if (in_array($status->slug, $available_status) && $status->file_attachment == 1)
                                <option value="{{ $status->slug }}">{{ $status->name }}</option>
                                @endif
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-round">@lang('app.upload')</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
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
                    @foreach ($project->todos as $todo)
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
            <h3 class="mt-2"><strong>@lang('app.documents')</strong></h3>
            <div class="document-table row">
              <div class="col-md-12 table-responsive">
                <table class="document-files table table-hover">
                  <thead>
                    <tr>
                      <th><strong>@lang('app.name')</strong></th>
                      <th><strong>@lang('app.status')</strong></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($files->count()>0)
                      @foreach ($files as $file)
                      <tr>
                        <td><a href="{{ asset('uploads/' . $file->media_name ) }}" target="_blank">{{ $file->media_name }}</a></td>
                        <td>{{ $file->status_id ? $file->status->name : '' }}</td>
                      </tr>
                      @endforeach    
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row mb-3">
              <form class="logo-file" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                  <label for="">@lang('app.add_documents')</label>                    
                  <div class="manual-files">
                    <input type="hidden" name="type" value="1">
                    <input type="file" name="file" id="file" required>
                    <button type="submit" class="btn btn-success btn-round">@lang('app.upload')</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="panel-item bg-white my-3">
            <h3 class="mt-2"><strong>@lang('app.comments')</strong></h3>
            <div class="form-check my-3">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="show_comment" id="show_comment">
                @lang('app.show_system_comments')
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
              </label>
            </div>
            <div class="comment-list">
              @if ($comments->count()>0)
              @foreach ($comments as $comment)
              <div class="comments-item">  
                <div class="comment_image">
                  <i class="material-icons" style="font-size: 50px; color: {{ auth()->user()->company->main_color }}">account_circle</i>
                </div>
                <div class="comments-context">
                  <h4><strong>{{$comment->user_name}}</strong> <span class="comment-time">{{ date('d-m-Y H:i',strtotime($comment->created_at)) }}</span></h4>
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
                <textarea name="comment" id="comment" rows="4" tabindex="4" placeholder="Type your comments..."></textarea>
                <input name="submit" type="submit" class="add-comment btn btn-success" value="Submit comment">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('components.modals.deadline')
@include('components.modals.calendar', ['page' => 'webshop'])
@include('components.modals.email')
@endsection

@push('js')
<script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
  <script>
    var target_type;
    var target_value;
    var email_subject;
    var email_body;
    $(document).ready(function() {
      CKEDITOR.inline('comment') 
      $('.document-files').DataTable();
      $('.copy-link').click(function (e) {
        e.preventDefault();
        var copyText = $(this).attr('href');

        document.addEventListener('copy', function(e) {
            e.clipboardData.setData('text/plain', copyText);
            e.preventDefault();
        }, true);

        document.execCommand('copy');  
        console.log('copied text : ', copyText);
        toastr.success('Copied form link', toastr_options);
      });
    });
    $(document).ready(function() {
      
      $('.statuspicker').selectpicker();
      $('.selectpicker').selectpicker();
      var previous_value;
      $('select.project-data').on('shown.bs.select', function(e) {
        previous_value = $(this).val();
      }).change(function (e, clickedIndex, isSelected, previousValue) {
        var type = $(this).attr('name');
        var value = $(this).val();
        
        target_type = type;
        target_value = value;
        
        $.ajax({
          url : '{{ route("update_project", $project->id) }}',
          type: "POST",
          data: { 
            type: type,
            value: value,
            _token : '{{ csrf_token() }}' 
          },
          success : function (data) {
            if (data.success == 1){
              if(target_type != 'project_manager') {
                $('#buildEmail').modal('toggle');
              } else {
                toastr.success(data.msg, '@lang('app.success')', toastr_options);
              }
            } else {
              if (data.msg) {
                toastr.error(data.msg, toastr_options);
              } else {
                toastr.error('@lang("app.login_manager")', '@lang("app.error")', toastr_options);
              }
              setTimeout(function() {
                location.reload();
              }, 1000)
            }
          }
        });
      });

      $("#website_completed").change(function() {
        if(this.checked) {
          var value = 1
        }else { 
          var value = 0
        }
        $.ajax({
          url : '{{ route("update_project", $project->id) }}',
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
      var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
      $('#change_deadline').datepicker({
          showOtherMonths: true,
          format: 'yyyy-mm-dd',
          minDate: today
      });

      $('#add_deadline').datepicker({
          showOtherMonths: true,
          format: 'yyyy-mm-dd',
          minDate: today
      });
    });
    $(document).ready(function() {
      $('#delete-project').click(function() {
        if (!confirm('{{ trans('app.are_you_sure_delete_project') }}')) {
          return '';
        }
        var id = $(this).data('id');

        $.ajax({
          url: '{{ route("delete_project", $project->id) }}',
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            id: id
          },
          success: function(data) {
            toastr.success(data.msg, '@lang("app.success")', toastr_options);
            setTimeout(function() {
              window.location.href = '{{ route("webshop.index") }}'
            }, 2000)
          }
        });

      });
      $('#deadlineUpdate').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var value = button.data('value')
        var id = button.data('id')
        var modal = $(this)
        
        modal.find('.modal-body input').val(value)
        modal.find('.modal-body input').attr('data-id', id)
      });

      $('#addDeadline').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var status_slug = button.data('status-slug')
        var modal = $(this)
        modal.find('.modal-body input[name="status_slug"]').val(status_slug)
      });
      
      $('#commentform').on('submit',function(event){
        event.preventDefault();

        var comment = $('#comment').val();

        $.ajax({
            url: "{{route('add_comment')}}",
            type:"POST",
            data:{
                _token: "{{ csrf_token() }}",
                id: "{{$project->id}}",
                comment: comment,
            },
            success:function(data){
              if (data.success == 1){
                $( '#commentform' ).each(function(){
                    this.reset();
                });
                var html = '<div class="comments-item"><div class="comment_image"><i class="material-icons" style="font-size: 50px; color: {{ auth()->user()->company->main_color }}">account_circle</i></div><div class="comments-context"><h4><strong>{{Auth::user()->name}}</strong> <span class="comment-time">{{ date('d-m-Y  H:i') }}</span></h4><p>'+ comment +'<button class="btn btn-danger comment_delete" data-id="'+ data.id +'"><span><i class="fa fa-trash"></i> </span></button></p></div></div>';
                $('.comment-list').append(html);
                CKEDITOR.instances.comment.setData('')
              }
            },
        });
      });

      $('.testing-url, .website-url').on('submit', function(event) {
        event.preventDefault();
        var type = $(this).find('input[name="type"]').val();
        var value = $(this).find('input[name="url"]').val();
        if(value == ''){
          toastr.error('@lang("app.empty_value")', '@lang("app.error")', toastr_options);
          return;
        }
        $(this).find('input[name="url"]').val('')
        $.ajax({
          url: "{{ route('update_project_url') }}",
          type: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            id: "{{$project->id}}",
            type: type,
            value: value,
          },
          success:function(data){
            if (data.success == 1){
              var className = ".project-" + data.type + "-url";
              var ex_elem = $('.project-urls').find(className);
              if (ex_elem.length > 0) {
                ex_elem.remove()
              } 

              $('.project-urls').append(data.html)
            }
          },
        });
      });

      $(document).on('submit', 'form.delete-url', function(event) {
        event.preventDefault();
        var type = $(this).find('input[name="type"]').val();
        $.ajax({
          url: "{{ route('delete_url', $project->id) }}",
          type: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            type: type
          },
          success:function(data){
            if (data.success == 1){
              var className = ".project-" + data.type + "-url";
              var ex_elem = $('.project-urls').find(className);
              if (ex_elem.length > 0) {
                ex_elem.remove()
              } 
            }
          },
        });
      });

      $(document).on('submit', 'form.logo-file', function(event) {
        event.preventDefault();
        var form = $(this)
        var formData = new FormData(form[0]);

        $("#btnSubmit").prop("disabled", true);
        spinner.show()

        $.ajax({
          url: "{{ route('manual_file' , $project->id) }}",
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success:function(data){
            spinner.hide()
            if (data.success == 1){
              if(data.media.ref == 'manual_logo') {
                html = '<tr><td><a href="/uploads/' + data.media.media_name + '" class="text-success" target="_blank">' + data.media.media_name + '</a></td><td>' + data.media.status_name + '</td><td>';
                if (data.media.no_delete != 1) {
                  html += '<form class="mb-0 delete-file"><input type="hidden" name="file_id" value="' + data.media.id + '"><button type="submit" class="btn btn-link btn-sm text-danger p-1"><span class="material-icons">delete</span></button></form>';
                }
                html += '</td></tr>';
                $('table.feedback-files tbody').append(html)
              } else {
                location.reload();
              }
              $('form.logo-file').each(function() {
                $(this).find('input[name="file"]').val('');
              })
              $('form.logo-file #status_picker').val('');
              $('form.logo-file #status_picker').selectpicker("refresh");
            }
          },
        });
      });

      $(document).on('click','.comment_delete', function() {
        var id = $(this).data('id');
        $.ajax({
          url: "{{route('delete_comment')}}",
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

      $(document).on('click', '.save-deadline', function() {
        var id = $(this).closest('.modal-content').find('input').data('id')
        var deadline = $(this).closest('.modal-content').find('input').val();
        $.ajax({
          url: "{{ route('update_deadline') }}",
          type: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            id: id,
            deadline: deadline,
          },
          success: function(data){
            if (data.success == 1) {
              toastr.success(data.msg, '@lang('app.success')', toastr_options);
              setTimeout(function() {
                location.reload();
              }, 2000)
            }
          }
        })
      });
    });

    $(document).on('click', '#show_comment', function() {
      if($(this).is(':checked')) {
        $.ajax({
          url: "{{ route('get_comments_all', $project->id) }}",
          type: "GET",
          data: {
            _token: "{{ csrf_token() }}",
          },
          success: function(data){
            $('.comment-list .comments-item').each(function() {
              $(this).remove();
            })
            $('.comment-list').append(data);
          }
        })
      } else {
        $.ajax({
          url: "{{ route('get_comments_user', $project->id) }}",
          type: "GET",
          data: {
            _token: "{{ csrf_token() }}",
          },
          success: function(data){
            $('.comment-list .comments-item').each(function() {
              $(this).remove();
            })
            $('.comment-list').append(data);
          }
        })
      }
    });
    $(document).on('click', '.resend-email', function() {
      var status_id = $(this).data('status');
      var project_id = $(this).data('project');
      $.ajax({
        url: '{{ route("resend_email") }}',
        type: 'POST',
        data: {
          _token: "{{ csrf_token() }}",
          status_id: status_id,
          project_id: project_id
        },
        success: function(data) {
          if (data.success == 1){
            toastr.success(data.msg, '@lang('app.success')', toastr_options);
          } else {
              toastr.error('@lang("app.error_resend_email")','@lang("app.error")', toastr_options);
          }
          setTimeout(function() {
            location.reload();
          }, 2000)
        }
      });
    });
    $('#buildEmail').on('show.bs.modal', function (event) {
      var modal = $(this)
      $.ajax({
        url: "{{ route('build_email') }}",
        type: "POST",
        data: {
          _token: "{{ csrf_token() }}",
          type: target_type,
          project_id: "{{ $project->id }}",
          value: target_value
        },
        success: function(data){
          modal.find('#title').val(data.subject);
          modal.find('#data_type').val(target_type);
          modal.find('#data_value').val(target_value);
          if(data.file) {
            html = '<div class="form-group">@lang("app.attached_file"): <a href="{{asset('uploads')}}/' + data.file + '" target="_blank">'+ data.file +'</a></div>'
            modal.find('form .email-content').append(html)
            modal.find('input[name="file"]').val(data.file)
          }
          CKEDITOR.replace('email_body', {
            toolbar: [
              { name: 'document', items: [ 'Source'] },
              { name: 'clipboard', groups: ['Undo', 'Redo' ] },
              { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', '-', 'CopyFormatting', 'RemoveFormat' ] },
              { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
              { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
              { name: 'insert', items: [ 'Image', 'Flash', 'Table'] },
              { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
              { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            ]
          });
          CKEDITOR.instances.email_body.setData(data.content); 
        }
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