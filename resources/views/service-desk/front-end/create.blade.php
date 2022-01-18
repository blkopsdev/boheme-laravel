@extends('layouts.spaces.frontpage')

@section('content')
<div class="content my-5">
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-6 col-md-6" style="margin-bottom: 150px">
        <h2 class="text-bold">{{ $title }}</h2>
        <form class="form" method="POST" action="" enctype="multipart/form-data" id="ticket">
          @csrf
          <div class="card py-5">
            <div class="col-md-8 offset-md-1 mt-3">
              <h4><strong>@lang('app.contact_details')</strong></h4>
            </div>
            <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
              <div class="input-group col-md-8 offset-md-1">
                <input type="text" name="name" class="form-control" placeholder="@lang('app.name')" value="{{ old('name') }}" required>
              </div>
              @if ($errors->has('name'))
                <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                  <strong>{{ $errors->first('name') }}</strong>
                </div>
              @endif
            </div>
            
            <div class="bmd-form-group{{ $errors->has('company_name') ? ' has-danger' : '' }} mt-3">
              <div class="input-group col-md-8 offset-md-1">
                <input type="text" name="company_name" class="form-control" placeholder="@lang('app.company_name')" value="{{ old('company_name') }}" required>
              </div>
              @if ($errors->has('company_name'))
                <div id="company-name-error" class="error text-danger pl-3" for="company_name" style="display: block;">
                  <strong>{{ $errors->first('company_name') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('phone') ? ' has-danger' : '' }} mt-3">
              <div class="input-group col-md-8 offset-md-1">
                <input type="text" name="phone" class="form-control" placeholder="@lang('app.phone')" value="{{ old('phone') }}" required>
              </div>
              @if ($errors->has('phone'))
                <div id="phone-error" class="error text-danger pl-3" for="phone" style="display: block;">
                  <strong>{{ $errors->first('phone') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }} mt-3">
              <div class="input-group col-md-8 offset-md-1">
                <input type="email" name="email" class="form-control" placeholder="@lang('auth.email')" value="{{ old('email') }}" required>
              </div>
              @if ($errors->has('email'))
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                  <strong>{{ $errors->first('email') }}</strong>
                </div>
              @endif
            </div>
            
            {{-- <div class="col-md-8 offset-md-1 mt-2">
              <hr class="underline-dotted">
            </div> --}}

            <div class="col-md-8 offset-md-1 mt-5">
              <h4><strong>@lang('app.describe_your_problem')</strong></h4>
            </div>
            <div class="bmd-form-group{{ $errors->has('subject') ? ' has-danger' : '' }} mt-3">
              <div class="input-group col-md-8 offset-md-1">
                <input type="text" name="subject" class="form-control" placeholder="@lang('app.subject')" value="{{ old('subject') }}" required>
              </div>
              @if ($errors->has('subject'))
                <div id="name-error" class="error text-danger pl-3" for="subject" style="display: block;">
                  <strong>{{ $errors->first('subject') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('description') ? ' has-danger' : '' }} mt-3">
              <div class="col-md-8 offset-md-1">
                <label for="note">@lang('app.note')</label>
              </div>
              <div class="input-group col-md-8 offset-md-1">
                <textarea name="note" class="form-control ckeditor" id="note" required>{{ old('note') }}</textarea>
                @if ($errors->has('note'))
                  <div id="note-error" class="error text-danger pl-3" for="note" style="display: block;">
                    <strong>{{ $errors->first('note') }}</strong>
                  </div>
                @endif
              </div>
            </div>
            <div class="form-group mt-3">
              <div class="col-md-8 offset-md-1">
                <label class="text-dark" for="file">@lang('app.file')</label>
                <input type="file" name="file" id="file" class="upload-file">
              </div>
            </div>
            <div class="form-group mt-3">
              <div class="col-md-8 offset-md-1">
                <label for="priority">@lang('app.choose_priority')</label>
                <select class="selectpicker" id="priority" name="priority" data-style="btn btn-success text-white" title="@lang('app.choose_priority')" required>
                  <option value="Urgent" class="priority-option-urgent">{{ __('Urgent') }}</option>
                  <option value="High" class="priority-option-high">{{ __('High') }}</option>
                  <option value="Medium" class="priority-option-medium">{{ __('Medium') }}</option>
                  <option value="Low" class="priority-option-low">{{ __('Low') }}</option>
                </select>
              </div>
            </div>
            
            <div class="bmd-form-group mt-3 mb-5">
              <div class="col-md-8 offset-md-1">
                <button type="submit" class="btn btn-success btn-round">@lang('app.submit')</button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-lg-5 col-md-5 offset-lg-1 offset-md-1">
        <h2 class="text-bold">Hoe werkt het?</h2>
        <div class="row mt-5 align-items-center">
          <div class="col-md-2">
            <span class="material-icons text-success big-icon">keyboard_return</span>
          </div>
          <div class="col-md-10">
            <h3 class="text-bold mt-0">1. Maak een Ticket aan</h3>
            <p>Via dit portal kunt u een ticket aanmaken. Beschrijf hierin zo goed mogelijk het probleem of vraag.</p>
          </div>
          <div class="col-md-2">
            <span class="material-icons text-success big-icon">leaderboard</span>
          </div>
          <div class="col-md-10">
            <h3 class="text-bold mt-0">2. Bekijk de vooruitgang</h3>
            <p>U krijgt een speciale link waar u de progressie kunt volgen. U kunt hier ook direct berichten versturen naar de agent die verantwoordelijk is voor uw ticket.</p>
          </div>
          <div class="col-md-2">
            <span class="material-icons text-success big-icon">done</span>
          </div>
          <div class="col-md-10">
            <h3 class="text-bold mt-0">3. Uw probleem wordt opgelost</h3>
            <p>Nadat u de ticket heeft aangemaakt zorgen wij dat een agent zo snel mogelijk zorgt dat het probleem wordt opgelost.</p>
          </div>
        </div>

        <hr>

        <h3 class="text-bold">Uitleg priority:</h3>
        <div class="row mt-3">
          <div class="col-md-3">
            <span class="priority-urgent">Urgent</span>
          </div>
          <div class="col-md-9">
            <p>Response tijd: 1-3 uur. Een van mijn servers of diensten op die server is niet bereikbaar, ik heb zo snel mogelijk ondersteuning nodig.*</p>
          </div>
          <div class="col-md-3">
            <span class="priority-high">High</span>
          </div>
          <div class="col-md-9">
            <p>Response tijd: 3-6 uur. Ik heb een probleem op een server en zou dit graag laten analyseren en oplossen*</p>
          </div>
          <div class="col-md-3">
            <span class="priority-medium">Medium</span>
          </div>
          <div class="col-md-9">
            <p>Response tijd: 6-12 uur. Ik wil instellingen op een van mijn servers wijzigen. Of ik wil enkele wijzigingen doorgeven.*</p>
          </div>
          <div class="col-md-3">
            <span class="priority-low">Low</span>
          </div>
          <div class="col-md-9">
            <p>Response tijd: 12-24 uur. Ik heb een vraag of opmerking.*</p>
          </div>
        </div>
        <p class="text-bold">*Let op: de response tijden kunnen buiten werktijden afwijken.</p>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script src="//cdn.ckeditor.com/4.15.1/basic/ckeditor.js"></script>
<script>
  $(document).ready(function() {
    $('#ticket').on('submit', function() {
      spinner.show();
    })
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