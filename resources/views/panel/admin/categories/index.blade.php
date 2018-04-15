@extends('panel.admin.layouts.main')


@section('page-contents')
    <!-- start: PAGE TITLE -->
    <section id="page-title">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="mainTitle">@lang('panel.admin.categories.Categories')</h1>
                <span class="mainDescription">@lang('panel.admin.categories.All Available Categories')</span>
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

            <div class="col-md-12 margin-bottom-30">
                <div class="pull-left">
                    @can('panelAdminCategoriesCreate', \App\Models\Categories\Category::class)
                        <a href="{{ route('panel.admin.categories.create') }}" class="btn btn-green">
                            <i class="fa fa-plus"></i> @lang('panel.admin.default.create')
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
                                <a href="{{ table_sort_link('state') }}">@lang('panel.admin.categories.state')</a>
                            </th>
                            <th class="{{ table_sort_class('name') }}">
                                <a href="{{ table_sort_link('name') }}">@lang('panel.admin.categories.name')</a>
                            </th>
                            <th class="{{ table_sort_class('title') }}">
                                <a href="{{ table_sort_link('title') }}">@lang('panel.admin.categories.title')</a>
                            </th>
                            <th class="{{ table_sort_class('slug') }}">
                                <a href="{{ table_sort_link('slug') }}">@lang('panel.admin.categories.slug')</a>
                            </th>
                            <th class="{{ table_sort_class('type') }}">
                                <a href="{{ table_sort_link('type') }}">@lang('panel.admin.categories.type')</a>
                            </th>
                            <th>
                                @lang('panel.admin.categories.parent')
                            </th>
                            <th class="{{ table_sort_class('hits') }}">
                                <a href="{{ table_sort_link('hits') }}">@lang('panel.admin.categories.hits')</a>
                            </th>
                            <th>
                                @lang('panel.admin.categories.actions')
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->state }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->type_name }}</td>
                                <td>{{ $item->parent_title }}</td>
                                <td>{{ $item->hits }}</td>
                                <td class="center">
                                    <div class="">
                                        @can('panelAdminCategoriesShow', $item)
                                            <a href="{{ route('panel.admin.categories.show', $item) }}" class="btn btn-block btn-xs btn-light-azure" data-toggle="tooltip" data-placement="left" title="@lang('panel.admin.default.show')">
                                                <i class="fa fa-eye"></i> @lang('panel.admin.default.show')
                                            </a>
                                        @endcan
                                        @can('panelAdminCategoriesEdit', $item)
                                            <a href="{{ route('panel.admin.categories.edit', $item) }}" class="btn btn-block btn-xs btn-dark-purple" data-toggle="tooltip" data-placement="left" title="@lang('panel.admin.default.edit')">
                                                <i class="fa fa-pencil"></i> @lang('panel.admin.default.edit')
                                            </a>
                                        @endcan
                                        {{--@can('panelAdminCategoriesDelete', $item)--}}
                                            {{--<a href="#" class="btn btn-block btn-xs btn-dark-red" data-toggle="tooltip" data-placement="left" title="@lang('panel.admin.default.delete')">--}}
                                                {{--<i class="fa fa-times fa-white"></i> @lang('panel.admin.default.delete')--}}
                                            {{--</a>--}}
                                        {{--@endcan--}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="center">@lang('panel.admin.categories.No Items Found')</td>
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