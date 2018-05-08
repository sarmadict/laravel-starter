@extends('admin.layouts.main')

@section('page-header')
    {{--<section id="page-title">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="mainTitle">@lang('admin.posts.elements.New Category')</h1>
                <span class="mainDescription">@lang('admin.posts.elements.Create New Category')</span>
            </div>
            <ol class="breadcrumb">
                <li>
                    <span>Tables</span>
                </li>
                <li class="active">
                    <span>Basic Tables</span>
                </li>
            </ol>
        </div>
    </section>--}}
@endsection

@section('page-contents')
    <div class="container-fluid container-fullw bg-white">
        <div class="row">
            {!! form_start($form) !!}

            <div class="col-md-12 margin-bottom-30">
                <div class="pull-right">
                    {!! form_row($form->state) !!}
                </div>

                <div class="pull-left">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-grey">
                        <i class="fa fa-times"></i> @lang('admin.default.actions.Cancel')
                    </a>

                    {!! form_row($form->SaveAndReload) !!}
                </div>
            </div>

            <div class="col-md-12">
                <div class="tabbable">
                    <ul id="form-tabs" class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab-general" data-toggle="tab">
                                @lang('admin.users.elements.Tab General')
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab-general">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="panel panel-white" id="panel-general">
                                        <div class="panel-heading">
                                            <h4 class="panel-title text-primary">@lang('admin.users.elements.panel_general')</h4>
                                        </div>
                                        <div class="panel-body form-horizontal">
                                            {!! form_row($form->first_name) !!}
                                            {!! form_row($form->last_name) !!}
                                            {!! form_row($form->display_name) !!}
                                            {!! form_row($form->username) !!}
                                            {!! form_row($form->email) !!}
                                            {!! form_row($form->mobile_number) !!}
                                            {!! form_row($form->position) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="panel panel-white" id="panel-image">
                                        <div class="panel-heading">
                                            <h4 class="panel-title text-primary">@lang('admin.users.elements.panel_image')</h4>
                                        </div>
                                        <div class="panel-body">
                                            {!! form_row($form->image_path) !!}
                                        </div>
                                    </div>

                                    <div class="panel panel-white" id="panel-meta">
                                        <div class="panel-heading">
                                            <h4 class="panel-title text-primary">@lang('admin.users.elements.panel_birthday')</h4>
                                        </div>
                                        <div class="panel-body">
                                            {!! form_row($form->gender) !!}
                                            {!! form_row($form->birthday) !!}
                                        </div>
                                    </div>

                                    @if(isset($item))
                                        <div class="panel panel-white" id="panel-info">
                                            <div class="panel-heading">
                                                <h4 class="panel-title text-primary">@lang('admin.users.elements.panel_info')</h4>
                                            </div>
                                            <div class="panel-body form-horizontal">
                                                {!! form_row($form->created_at) !!}
                                                {!! form_row($form->updated_at) !!}
                                                {!! form_row($form->approved_at) !!}
                                                {!! form_row($form->created_by) !!}
                                                {!! form_row($form->updated_by) !!}
                                                {!! form_row($form->approved_by) !!}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {!! form_end($form, false) !!}
        </div>
    </div>
@endsection


@section('page-title')
    @lang('admin.users.elements.form page title')
@endsection


@section('body-class', '')

@section('meta-tags')
    @parent

@endsection

@section('page-styles')
    @stack('styles')

@endsection


@section('page-before-scripts')

@endsection


@section('page-after-scripts')
    @stack('scripts')

@endsection