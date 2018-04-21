@extends('admin.layouts.main')

@section('page-header')
    {{--<section id="page-title">--}}
        {{--<section id="page-title">--}}
            {{--<div class="row">--}}
                {{--<div class="col-sm-8">--}}
                    {{--<h1 class="mainTitle">@lang('admin.categories.elements.Categories')</h1>--}}
                    {{--<span class="mainDescription">@lang('admin.categories.elements.All Available Categories')</span>--}}
                {{--</div>--}}
                {{--<ol class="breadcrumb">--}}
                    {{--<li>--}}
                        {{--<span>Tables</span>--}}
                    {{--</li>--}}
                    {{--<li class="active">--}}
                        {{--<span>Basic Tables</span>--}}
                    {{--</li>--}}
                {{--</ol>--}}
            {{--</div>--}}
        {{--</section>--}}
    {{--</section>--}}
@endsection

@section('page-contents')

    <div class="container-fluid container-fullw bg-white">
        <div class="row">

            <div class="col-md-12 margin-bottom-30">
                <div class="pull-left">
                    @can('adminCategoriesCreate', \App\Models\Categories\Category::class)
                        <a href="{{ route('admin.categories.create', ['type' => \App\Types\General\Category::POST]) }}" class="btn btn-green">
                            <i class="fa fa-plus"></i> @lang('admin.categories.elements.Create Post Category')
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
                                <a href="{{ table_sort_link('state') }}">@lang('admin.categories.fields.state')</a>
                            </th>
                            <th class="{{ table_sort_class('name') }}">
                                <a href="{{ table_sort_link('name') }}">@lang('admin.categories.fields.name')</a>
                            </th>
                            <th class="{{ table_sort_class('title') }}">
                                <a href="{{ table_sort_link('title') }}">@lang('admin.categories.fields.title')</a>
                            </th>
                            <th class="{{ table_sort_class('slug') }}">
                                <a href="{{ table_sort_link('slug') }}">@lang('admin.categories.fields.slug')</a>
                            </th>
                            <th class="{{ table_sort_class('type') }}">
                                <a href="{{ table_sort_link('type') }}">@lang('admin.categories.fields.type')</a>
                            </th>
                            <th>
                                @lang('admin.categories.fields.parent')
                            </th>
                            <th class="{{ table_sort_class('hits') }}">
                                <a href="{{ table_sort_link('hits') }}">@lang('admin.categories.fields.hits')</a>
                            </th>
                            <th>
                                @lang('admin.categories.fields.actions')
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
                                        @can('adminCategoriesShow', $item)
                                            <a href="{{ route('admin.categories.show', $item) }}" class="btn btn-block btn-xs btn-light-azure" data-toggle="tooltip" data-placement="left" title="@lang('admin.default.actions.show')">
                                                <i class="fa fa-eye"></i> @lang('admin.default.actions.show')
                                            </a>
                                        @endcan
                                        @can('AdminCategoriesEdit', $item)
                                            <a href="{{ route('admin.categories.edit', $item) }}" class="btn btn-block btn-xs btn-dark-purple" data-toggle="tooltip" data-placement="left" title="@lang('admin.default.actions.edit')">
                                                <i class="fa fa-pencil"></i> @lang('admin.default.actions.edit')
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
                                <td colspan="9" class="center">@lang('admin.categories.elements.No Items Found')</td>
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
    @lang('admin.categories.elements.page title')
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