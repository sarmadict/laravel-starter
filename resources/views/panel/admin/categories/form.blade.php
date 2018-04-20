@extends('panel.admin.layouts.main')


@section('page-contents')
    <!-- start: PAGE TITLE -->
    <section id="page-title">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="mainTitle">@lang('panel.admin.categories.New Category')</h1>
                <span class="mainDescription">@lang('panel.admin.categories.Create New Category')</span>
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
    </section>
    <div class="container-fluid container-fullw bg-white">
        <div class="row">
            {!! form_start($form) !!}
            <div class="col-md-12 margin-bottom-30">
                <div class="pull-left">
                    <a href="{{ route('panel.admin.categories.index') }}" class="btn btn-grey">
                        <i class="fa fa-times"></i> @lang('panel.admin.default.Cancel')
                    </a>

                    @if(isset($item))
                        <a href="{{ route('panel.admin.categories.destroy', $item) }}" class="btn btn-red">
                            <i class="fa fa-trash"></i> @lang('panel.admin.default.Destroy')
                        </a>
                    @endif

                    {!! form_row($form->SaveAndReload) !!}
                </div>
            </div>

            <div class="col-md-12">
                <div class="tabbable">
                    <ul id="form-tabs" class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab-general" data-toggle="tab">
                                @lang('panel.admin.categories.Tab General')
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab-general">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="panel panel-white" id="panel-general">
                                        <div class="panel-heading">
                                            <h4 class="panel-title text-primary">@lang('panel.admin.categories.panel_general')</h4>
                                        </div>
                                        <div class="panel-body form-horizontal">
                                            {!! form_row($form->name) !!}
                                            {!! form_row($form->title) !!}
                                            {!! form_row($form->slug) !!}
                                            {!! form_row($form->description) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="panel panel-white" id="panel-meta">
                                        <div class="panel-heading">
                                            <h4 class="panel-title text-primary">@lang('panel.admin.categories.panel_meta')</h4>
                                        </div>
                                        <div class="panel-body">
                                            {!! form_row($form->parent_id) !!}
                                            {!! form_row($form->keywords) !!}
                                        </div>
                                    </div>
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
    @lang('panel.admin.categories.page title')
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
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection