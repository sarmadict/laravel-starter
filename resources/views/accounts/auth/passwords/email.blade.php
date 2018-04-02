@extends('accounts.auth.layouts.main')

{{--  Start : Page Contetnts --}}
@section('page-contents')
    @include('accounts.auth.partials.alerts')

    <!-- start: FORGOT -->
    <div class="row{{ $errors->isEmpty() ? ' animated fadeInRightBig' : '' }}" id="main-box">
        <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="logo margin-top-30">
                <img src="assets/images/logo.png" alt="Clip-Two"/>
            </div>
            <!-- start: FORGOT BOX -->
            <div class="box-forgot">
                <form class="form-forgot" method="post" action="{{ route('accounts.auth.password.email') }}">
                    @csrf

                    <fieldset>
                        <legend>@lang('accounts.auth.password_email.Forget Password')</legend>

                        <p>@lang('accounts.auth.password_email.Enter your e-mail address below to reset your password')</p>

                        <div class="form-group @if($errors->has('email')) has-error @endif">
                            <span class="input-icon">
                                <input type="email" class="form-control" name="email" placeholder="@lang('accounts.auth.password_email.Email address')" value="{{ old('email', '') }}">
                                <i class="fa fa-envelope-o"></i>
                            </span>
                            @if($errors->has('email'))
                                <span class="help-block">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary pull-left">
                                @lang('accounts.auth.password_email.Submit')
                                <i class="fa fa-arrow-circle-left"></i>
                            </button>
                        </div>

                        <div class="form-actions">
                            <a class="btn btn-primary btn-o" href="{{ route('accounts.auth.login.show') }}">
                                <i class="fa fa-chevron-circle-right"></i> @lang('accounts.auth.password_email.Log In')
                            </a>
                        </div>
                    </fieldset>
                </form>
                <!-- start: COPYRIGHT -->
                <div class="copyright">
                    @lang('accounts.auth.password_email.Copyright')
                </div>
                <!-- end: COPYRIGHT -->
            </div>
            <!-- end: FORGOT BOX -->
        </div>
    </div>
    <!-- end: FORGOT -->
@endsection
{{-- End : Page Contetnts --}}


{{-- Start : Page Title --}}
@section('page-title')
    @lang('accounts.auth.password_email.page title')
@endsection
{{-- End : Page Title --}}


@section('body-class', 'login')


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
