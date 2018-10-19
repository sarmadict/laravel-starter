@extends('admin.layouts.main')

@section('page-header')

@endsection

@section('page-contents')


@endsection


@section('page-title')
    @lang('admin.dashboard.elements.page title')
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