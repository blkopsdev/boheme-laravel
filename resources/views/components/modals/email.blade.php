<div class="modal fade" id="buildEmail" tabindex="-1" role="dialog" aria-labelledby="buildEmailLabel" aria-hidden="true" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-success" id="buildEmailLabel"><strong>@lang('app.confirm_email_content')</strong></h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('send_email') }}" method="post" class="m-0" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="project_id" value="{{ $project->id }}">
          <input type="hidden" name="type" id="data_type">
          <input type="hidden" name="value" id="data_value">
          <input type="hidden" name="file">
          <div class="row">
            <div class="col-md-12 email-content">
              <div class="form-group">
                <label for="email_title" class="relative-label">@lang('app.email_subject')</label>
                <input type="text" name="title" id="title" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="email_body" class="relative-label">@lang('app.email_content')</label>
                <textarea name="email_body" id="email_body" class="form-control" rows="10"></textarea>
              </div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12 text-right pt-3">
              <button type="button" class="btn btn-secondary" id="send_email_close">@lang('app.close')</button>
              <button type="submit" class="btn btn-success submit-email" id="email_submit">@lang('app.send')</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('js')
<script>
  $(document).on('click', '#email_submit', function() {
    spinner.show();
  })
  $(document).on('click', '#send_email_close', function() {
    var project_id = $(this).closest('form').find('input[name="project_id"]').val()
    var type = $(this).closest('form').find('input[name="type"]').val()
    var value = $(this).closest('form').find('input[name="value"]').val()

    $.ajax({
      url: "{{ route('reset_status') }}",
      type: "POST",
      data: {
        _token: "{{ csrf_token() }}",
        project_id: project_id,
        type: type,
        value: value
      },
      success: function(data) {
        location.reload()
      }
    });
  });
</script>
@endpush