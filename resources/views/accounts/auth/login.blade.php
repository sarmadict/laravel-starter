@extends('accounts.auth.layouts.main')

{{--  Start : Page Contetnts --}}
@section('page-contents')

    @include('accounts.auth.partials.alerts')



@endsection
{{-- End : Page Contetnts --}}


{{-- Start : Specific header assets for this page --}}
@section('page-styles')
    @stack('styles')
@endsection
{{-- End : Specific header assets for this page --}}



{{-- Start : Specific footer assets for this page --}}
@section('page-before-scripts')

@endsection
{{-- End : Specific footer assets for this page --}}



{{-- Start : Specific footer assets for this page --}}
@section('page-after-scripts')
    @stack('scripts')

@endsection
{{-- End : Specific footer assets for this page --}}


{{-- Start : Page Title --}}
@section('page-title')
    @lang('accounts.auth.login.page title')
@endsection
{{-- End : Page Title --}}

