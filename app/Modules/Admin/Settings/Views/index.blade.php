@extends('admin.layouts.main')

@section('page-header')
    {{--<section id="page-title">
        <section id="page-title">
            <div class="row">
                <div class="col-sm-8">
                    <h1 class="mainTitle">@lang('admin.categories.elements.Categories')</h1>
                    <span class="mainDescription">@lang('admin.categories.elements.All Available Categories')</span>
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
    </section>--}}
@endsection

@section('page-contents')

    <div class="container-fluid container-fullw bg-white">
        <div class="row">
            <div class="col-md-12 margin-bottom-30">
                <div class="pull-left">
                    @can('adminSettingsCreate', \App\Models\Settings\Setting::class)
                        <a href="{{ route('admin.settings.create') }}" class="btn btn-green">
                            <i class="fa fa-plus"></i> @lang('admin.settings.elements.Create New Setting')
                        </a>
                    @endcan
                </div>
            </div>

            <div class="col-md-12">
                <div class="data-table-wrapper">
                    <table class="table table-hover table-striped table-bordered table-responsive" id="items-table">
                        <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>@lang('admin.settings.fields.state')</th>
                            <th>@lang('admin.settings.fields.name')</th>
                            <th>@lang('admin.settings.fields.title')</th>
                            <th>@lang('admin.settings.fields.description')</th>
                            <th>@lang('admin.settings.fields.created_at')</th>
                            <th>@lang('admin.settings.fields.actions')</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('page-title')
    @lang('admin.settings.elements.index page title')
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
        var page = function () {
            function initDatatable() {
                return $("#items-table").DataTable({
                    ajax: {
                        url: '{{ route("admin.settings.get") }}',
                        type: 'post'
                    },
                    columns: [
                        {data: 'id'},
                        {data: 'state_name'},
                        {data: 'name'},
                        {data: 'title'},
                        {data: 'description_excerpt'},
                        {data: 'j_created_at'},
                        {data: 'actions', searchable: false, sortable: false},
                    ],
                });
            }

            return {
                init: function () {
                    initDatatable();
                }
            };
        }();

        $(document).ready(function () {
            page.init();
        });
    </script>

@endsection