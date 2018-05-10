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
                    @can('adminUsersCreate', \App\Models\Users\User::class)
                        <a href="{{ route('admin.users.create') }}" class="btn btn-green">
                            <i class="fa fa-plus"></i> @lang('admin.users.elements.Create New User')
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
                            <th>@lang('admin.users.fields.state')</th>
                            <th>@lang('admin.users.fields.first_name')</th>
                            <th>@lang('admin.users.fields.last_name')</th>
                            <th>@lang('admin.users.fields.email')</th>
                            <th>@lang('admin.users.fields.username')</th>
                            <th>@lang('admin.users.fields.mobile_number')</th>
                            <th>@lang('admin.users.fields.position')</th>
                            <th>@lang('admin.users.fields.created_at')</th>
                            <th>@lang('admin.users.fields.approved_at')</th>
                            <th>@lang('admin.users.fields.actions')</th>
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
    @lang('admin.users.elements.index page title')
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
                    scrollX: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route("admin.users.get") }}',
                        type: 'post'
                    },
                    columns: [
                        {data: 'id'},
                        {data: 'state_name'},
                        {data: 'first_name'},
                        {data: 'last_name'},
                        {data: 'email'},
                        {data: 'username'},
                        {data: 'mobile_number', searchable: true, sortable: false},
                        {data: 'position', searchable: true, sortable: false},
                        {data: 'j_created_at'},
                        {data: 'j_approved_at'},
                        {data: 'actions', searchable: false, sortable: false},
                    ],
                    order: [[0, "desc"]],
                    searchDelay: 500,
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