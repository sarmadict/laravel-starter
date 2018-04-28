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
                    @can('adminPostsCreate', \App\Models\Posts\Post::class)
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-green">
                            <i class="fa fa-plus"></i> @lang('admin.posts.elements.Create New Post')
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
                            <th class="{{ table_sort_class('title') }}">
                                <a href="{{ table_sort_link('title') }}">@lang('admin.categories.fields.title')</a>
                            </th>
                            <th class="{{ table_sort_class('excerpt') }}">
                                <a href="{{ table_sort_link('excerpt') }}">@lang('admin.categories.fields.excerpt')</a>
                            </th>
                            <th class="{{ table_sort_class('slug') }}">
                                <a href="{{ table_sort_link('slug') }}">@lang('admin.categories.fields.slug')</a>
                            </th>
                            <th class="{{ table_sort_class('status') }}">
                                <a href="{{ table_sort_link('status') }}">@lang('admin.categories.fields.status')</a>
                            </th>
                            <th class="{{ table_sort_class('user_id') }}">
                                <a href="{{ table_sort_link('user_id') }}">@lang('admin.categories.fields.user_id')</a>
                            </th>
                            <th class="{{ table_sort_class('category_id') }}">
                                <a href="{{ table_sort_link('category_id') }}">@lang('admin.categories.fields.category_id')</a>
                            </th>
                            <th class="{{ table_sort_class('published_at') }}">
                                <a href="{{ table_sort_link('published_at') }}">@lang('admin.categories.fields.published_at')</a>
                            </th>
                            <th class="{{ table_sort_class('expired_at') }}">
                                <a href="{{ table_sort_link('expired_at') }}">@lang('admin.categories.fields.expired_at')</a>
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
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->excerpt }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->status_name }}</td>
                                <td>{{ $item->user_name }}</td>
                                <td>{{ $item->category_name }}</td>
                                <td>{{ $item->j_published_at }}</td>
                                <td>{{ $item->j_expired_at }}</td>
                                <td>{{ $item->hits }}</td>
                                <td class="center">
                                    <div class="">
                                        @can('adminPostsShow', $item)
                                            <a href="{{ route('admin.posts.show', $item) }}" class="btn btn-block btn-xs btn-light-azure" data-toggle="tooltip" data-placement="left" title="@lang('admin.default.actions.show')">
                                                <i class="fa fa-eye"></i> @lang('admin.default.actions.show')
                                            </a>
                                        @endcan
                                        @can('AdminPostsEdit', $item)
                                            <a href="{{ route('admin.posts.edit', $item) }}" class="btn btn-block btn-xs btn-dark-purple" data-toggle="tooltip" data-placement="left" title="@lang('admin.default.actions.edit')">
                                                <i class="fa fa-pencil"></i> @lang('admin.default.actions.edit')
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="center">@lang('admin.posts.elements.No Items Found')</td>
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
    @lang('admin.posts.elements.index page title')
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