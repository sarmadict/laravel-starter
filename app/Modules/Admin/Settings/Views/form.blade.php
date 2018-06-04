@extends('admin.layouts.main')

@section('page-header')
    {{--<section id="page-title">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="mainTitle">@lang('admin.settings.elements.New Category')</h1>
                <span class="mainDescription">@lang('admin.settings.elements.Create New Category')</span>
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
                <div class="pull-left">
                    <a href="{{ route('admin.dashboard.index') }}" class="btn btn-grey">
                        <i class="fa fa-times"></i> @lang('admin.default.actions.Cancel')
                    </a>

                    {!! form_row($form->SaveAndReload) !!}
                </div>
            </div>

            <div class="col-md-12">

                @yield('form-contents')

            </div>

            {!! form_end($form, false) !!}
        </div>
    </div>
@endsection


@section('page-title')
    @lang('admin.settings.elements.form page title')
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