@extends("AdminSettings::form")

@section("form-contents")
    <div class="row">
        <div class="col-sm-9">
            <div class="panel panel-white" id="panel-general">
                <div class="panel-heading">
                    <h4 class="panel-title text-primary">@lang('admin.settings.elements.panel_general')</h4>
                </div>
                <div class="panel-body form-horizontal">
                    {!! form_row($form->application_title) !!}
                </div>
            </div>
        </div>

        <div class="col-sm-3">

        </div>
    </div>
@endsection