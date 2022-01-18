@extends('layouts.spaces.service_desk', [ 'activePanel' => 'service_desk', 'titlePage' => __('Service Desk')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12" style="display: flex; align-items: center; justify-content: space-between;">
          <span><span class="mr-3 h2">{{ $title }}</span> <a href="{{ route('create_ticket') }}" class="btn btn-success btn-round"><i class="material-icons">add</i>@lang('app.add_ticket')</a></span>
          <a href="{{ route('add_ticket') }}" class="text-success float-right"><span class="material-icons">visibility</span> View ticket dashboard</a>
        </div>
      </div>
      
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-success">
              <h4 class="card-title">@lang('app.total_tickets'): {{ $tickets->count() }}  &nbsp;&nbsp;| &nbsp;&nbsp;
                <select class="selectpicker" id="project_manager" name="project_manager" data-style="btn btn-success text-white" title="@lang('app.project_manager')">
                <option class="text-dark" value="">All</option>
                @foreach ($users as $user)
                <option class="text-dark" value="{{ $user->name }}">{{ $user->name }}</option>
                @endforeach
              </select></h4>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover ticket-list text-center">
                <thead class="text-black">
                  <th>@lang('app.id')</th>
                  <th>@lang('app.priority')</th>
                  <th>@lang('app.project_manager')</th>
                  <th>@lang('app.created_at')</th>
                  <th>@lang('app.client_name')</th>
                  <th>@lang('app.company')</th>
                  <th>@lang('app.action')</th>
                  <th></th>
                </thead>
                <tbody>
                  @foreach ($tickets as $ticket)
                  <tr>
                    <td>{{ $ticket->id }}</td>
                    <td><span class="ticket-priority ticket-priority-{{ $ticket->priority }} text-bold">{{ $ticket->priority }}</span></td>
                    <td>{{ $ticket->user_id? $ticket->user->name: '' }}</td>
                    <td>{{ $ticket->created_at }}</td>
                    <td>{{ $ticket->name }}</td>
                    <td>{{ $ticket->company_name }}</td>
                    <td>
                      <div class="dropdown project-action">
                        <button class="btn dropdown-toggle" data-action="{{ $ticket->action }}" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-id="{{ $ticket->id }}">
                          @if($ticket->action == 0) Bedrijf @elseif($ticket->action == 1) Klant @elseif ($ticket->action == 2) Partner @elseif ($ticket->action == 3) Completed @endif
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <span class="dropdown-item update-action" data-ticket-id="{{ $ticket->id }}" data-action="0">Bedrijf</span>
                          <span class="dropdown-item update-action" data-ticket-id="{{ $ticket->id }}" data-action="1">Klant</span>
                          <span class="dropdown-item update-action" data-ticket-id="{{ $ticket->id }}" data-action="2">Partner</span>
                          <span class="dropdown-item update-action" data-ticket-id="{{ $ticket->id }}" data-action="3">Completed</span>
                        </div>
                      </div>
                    </td>
                    <td><a href="{{ route('show_ticket', $ticket->id) }}" class="btn bg-white text-dark btn-round view-btn"> View &nbsp;<span class="material-icons">visibility</span></a></td>
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
      $('.ticket-list').DataTable({
        "paging":   false,
        "order": [[0, "desc"]],
        initComplete: function () {
          self = this;
          $('#project_manager').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            val = $(this).val()
            self.api().column('2').search(val).draw()
          });
        }
      });
      $('.update-action').click(function() {
        var ticket_id = $(this).data('ticket-id');
        var value = $(this).data('action');
        $.ajax({
          url: "{{ route('ticket_action_update') }}",
          type: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            ticket_id: ticket_id,
            value: value
          },
          success: function(data){
            if (data.success == 1) {
              if(data.ticket.action == 0) {
                var action = 'Bedrijf'
              }
              if(data.ticket.action == 1) {
                var action = 'Klant'
              }
              if(data.ticket.action == 2) {
                var action = 'Partner'
              }
              if(data.ticket.action == 3) {
                var action = 'Completed'
              }
              location.reload();
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