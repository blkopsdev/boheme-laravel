<div class="modal fade" id="addDeadline" tabindex="-1" role="dialog" aria-labelledby="deadlineAddLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deadlineAddLabel"><strong>@lang('app.set_deadline')</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('set_deadline') }}" method="post" class="m-0">
          @csrf
          <input type="hidden" name="project_id" value="{{ $project->id }}">
          <input type="hidden" name="status_slug" value="">
          
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="deadline">@lang('app.deadline')</label>
                <input type="text" id="add_deadline" name="deadline" class="datetimepicker" autocomplete="false">
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

<div class="modal fade" id="deadlineUpdate" tabindex="-1" role="dialog" aria-labelledby="deadlineUpdateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deadlineUpdateLabel"><strong>@lang('app.change_deadline')</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 my-5">
            <input value="" id="change_deadline" width="200">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success save-deadline">Save changes</button>
      </div>
    </div>
  </div>
</div>