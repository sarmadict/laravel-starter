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
                    @can('adminUsersCreate', \App\Models\Accounts\User::class)
                        <a href="{{ route('admin.users.create') }}" class="btn btn-green">
                            <i class="fa fa-plus"></i> @lang('admin.users.elements.Create New User')
                        </a>
                    @endcan
                </div>
            </div>

            <div class="col-md-12">
                <div class="responsive-table-wrapper">
                    <table class="table table-hover table-striped table-bordered table-responsive" id="items-table">
                        <thead>
                        <tr>
                            <th class="center">#</th>
                            <th class="{{ table_sort_class('state') }}">
                                <a href="{{ table_sort_link('state') }}">@lang('admin.users.fields.state')</a>
                            </th>
                            <th class="{{ table_sort_class('first_name') }}">
                                <a href="{{ table_sort_link('first_name') }}">@lang('admin.users.fields.first_name')</a>
                            </th>
                            <th class="{{ table_sort_class('last_name') }}">
                                <a href="{{ table_sort_link('last_name') }}">@lang('admin.users.fields.last_name')</a>
                            </th>
                            <th class="{{ table_sort_class('email') }}">
                                <a href="{{ table_sort_link('email') }}">@lang('admin.users.fields.email')</a>
                            </th>
                            <th class="{{ table_sort_class('username') }}">
                                <a href="{{ table_sort_link('username') }}">@lang('admin.users.fields.username')</a>
                            </th>
                            <th class="{{ table_sort_class('mobile_number') }}">
                                <a href="{{ table_sort_link('mobile_number') }}">@lang('admin.users.fields.mobile_number')</a>
                            </th>
                            <th class="{{ table_sort_class('position') }}">
                                <a href="{{ table_sort_link('position') }}">@lang('admin.users.fields.position')</a>
                            </th>
                            <th class="{{ table_sort_class('created_at') }}">
                                <a href="{{ table_sort_link('created_at') }}">@lang('admin.users.fields.created_at')</a>
                            </th>
                            <th class="{{ table_sort_class('approved_at') }}">
                                <a href="{{ table_sort_link('approved_at') }}">@lang('admin.users.fields.approved_at')</a>
                            </th>
                            <th>
                                @lang('admin.users.fields.actions')
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->state_name }}</td>
                                <td>{{ $item->first_name }}</td>
                                <td>{{ $item->last_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->mobile_number }}</td>
                                <td>{{ $item->position }}</td>
                                <td>{{ $item->j_created_at }}</td>
                                <td>{{ $item->j_approved_at }}</td>
                                <td class="center">
                                    <div class="">
                                        @can('adminUsersShow', $item)
                                            <a href="{{ route('admin.users.show', $item) }}" class="btn btn-block btn-xs btn-light-azure" data-toggle="tooltip" data-placement="left" title="@lang('admin.default.actions.show')">
                                                <i class="fa fa-eye"></i> @lang('admin.default.actions.show')
                                            </a>
                                        @endcan
                                        @can('AdminUsersEdit', $item)
                                            <a href="{{ route('admin.users.edit', $item) }}" class="btn btn-block btn-xs btn-dark-purple" data-toggle="tooltip" data-placement="left" title="@lang('admin.default.actions.edit')">
                                                <i class="fa fa-pencil"></i> @lang('admin.default.actions.edit')
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="center">@lang('admin.users.elements.No Items Found')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="text-center">
                    {!! $items->appends(request()->all())->links() !!}
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

@endsection