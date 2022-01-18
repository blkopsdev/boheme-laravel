@extends('layouts.spaces.form')
@section('content')
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section>
                    <div class="wizard">
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step0">
                                <div class="tab-pane-title">
                                    <h1 class="text-dark-light"><strong>@lang('app.saved_answers')</strong></h1><br>
                                    <h3 class="text-dark-light">@lang('app.saved_answer_email_sent')</h3>
                                    <h3 class="text-dark-light">@lang('app.not_receive_email')</h3>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
