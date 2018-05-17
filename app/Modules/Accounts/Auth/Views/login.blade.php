@extends('accounts.auth.layouts.main')

{{--  Start : Page Contetnts --}}
@section('page-contents')
    @include('accounts.auth.partials.alerts')

    <div class="row {{ $errors->isEmpty() ? ' animated fadeInRightBig' : '' }}">
        <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="logo margin-top-30">
                <img src="/assets/accounts/auth/images/logo.png" alt="{{ config('app.name') }}"/>
            </div>
            <!-- start: LOGIN BOX -->
            <div class="box-login">
                <form class="form-login" action="{{ route('accounts.auth.login.login') }}" method="post">
                    @csrf

                    <fieldset>
                        <legend>@lang('accounts.auth.login.Sign in to your account')</legend>

                        <p>@lang('accounts.auth.login.Please enter your name and password to log in')</p>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <span class="input-icon">
                                <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" placeholder="@lang('accounts.auth.login.Username')">
                                <i class="fa fa-user"></i>
                            </span>
                            @if($errors->has('username'))
                                @foreach($errors->get('username') as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>

                        <div class="form-group form-actions{{ $errors->has('password') ? ' has-error' : '' }}">
                            <span class="input-icon">
                                <input type="password" class="form-control password{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="@lang('accounts.auth.login.Password')">
                                <i class="fa fa-lock"></i>
                                <a class="forgot" href="{{ route('accounts.auth.password.forget') }}">@lang('accounts.auth.login.I forgot my password')</a>
                            </span>
                            @if($errors->has('password'))
                                @foreach($errors->get('password') as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>

                        <div class="form-actions">
                            <div class="checkbox clip-check check-primary">
                                <input name="remember" type="checkbox" id="remember" {{ old('remember') ? 'checked' : ''}}>
                                <label for="remember">@lang('accounts.auth.login.Keep me signed in')</label>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">
                                @lang('accounts.auth.login.Login') <i class="fa fa-arrow-circle-left"></i>
                            </button>
                        </div>
                        <div class="new-account">
                            @lang('accounts.auth.login.Dont have an account')
                            <a href="{{ route('accounts.auth.register.show') }}">@lang('accounts.auth.login.Create an account')</a>
                        </div>
                    </fieldset>
                </form>
                <!-- start: COPYRIGHT -->
                <div class="copyright">
                    @lang('accounts.auth.login.copyright')
                </div>
                <!-- end: COPYRIGHT -->
            </div>
            <!-- end: LOGIN BOX -->
        </div>
    </div>
@endsection
{{-- End : Page Contetnts --}}


{{-- Start : Page Title --}}
@section('page-title')
    @lang('accounts.auth.login.page title')
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

