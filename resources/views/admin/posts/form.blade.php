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
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-grey">
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
                                @lang('admin.posts.elements.Tab General')
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab-general">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="panel panel-white" id="panel-general">
                                        <div class="panel-heading">
                                            <h4 class="panel-title text-primary">@lang('admin.posts.elements.panel_general')</h4>
                                        </div>
                                        <div class="panel-body">
                                            {!! form_row($form->title) !!}
                                            {!! form_row($form->content) !!}
                                            {!! form_row($form->excerpt) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="panel panel-white" id="panel-publish">
                                        <div class="panel-heading">
                                            <h4 class="panel-title text-primary">@lang('admin.posts.elements.panel_publish')</h4>
                                        </div>
                                        <div class="panel-body">
                                            {!! form_row($form->slug) !!}
                                            {!! form_row($form->status) !!}
                                            {!! form_row($form->published_at) !!}
                                            {!! form_row($form->expired_at) !!}
                                        </div>
                                    </div>

                                    <div class="panel panel-white" id="panel-meta">
                                        <div class="panel-heading">
                                            <h4 class="panel-title text-primary">@lang('admin.posts.elements.panel_meta')</h4>
                                        </div>
                                        <div class="panel-body">
                                            {!! form_row($form->category_id) !!}
                                            {!! form_row($form->user_id) !!}
                                            {!! form_row($form->user_name) !!}
                                            {!! form_row($form->image_path) !!}
                                            {!! form_row($form->meta_keywords) !!}
                                            {!! form_row($form->meta_description) !!}
                                        </div>
                                    </div>

                                    @if(isset($item))
                                        <div class="panel panel-white" id="panel-info">
                                            <div class="panel-heading">
                                                <h4 class="panel-title text-primary">@lang('admin.posts.elements.panel_info')</h4>
                                            </div>
                                            <div class="panel-body form-horizontal">
                                                {!! form_row($form->hits) !!}
                                                {!! form_row($form->likes_count) !!}
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
    @lang('admin.posts.elements.form page title')
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