@extends('accounts.auth.layouts.main')

{{--  Start : Page Contetnts --}}
@section('page-contents')
    @include('accounts.auth.partials.alerts')

    <main>
        <div id="wrapper">
            <div class="content-wrapper">
                <div class="content custom-scrollbar">

                    <div id="login-v2" class="row no-gutters">

                        <div class="intro col-12 col-md light-fg">

                            <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-left py-16 py-md-16 px-12">

                            </div>
                        </div>

                        <div class="form-wrapper col-12 col-md-auto d-flex justify-content-center p-4 p-md-0">

                            <div class="form-content md-elevation-8 h-100 bg-white text-auto py-16 py-md-16 px-12">

                                <div class="title h5">@lang('accounts.auth.login.login')</div>

                                <div class="description mt-2">@lang('accounts.auth.login.Login using your Email, Username or Mobile Number')</div>

                                <form action="{{ route('accounts.auth.login.login') }}" method="post" name="loginForm" novalidate class="mt-8">
                                    @csrf

                                    <div class="form-group mb-4">
                                        <input type="text" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="loginFormInputUsername" value="{{ old('username') }}"/>
                                        <label for="loginFormInputUsername">@lang('accounts.auth.login.Username')</label>
                                        @if($errors->has('username'))
                                            @foreach($errors->get('username') as $error)
                                                <span class="invalid-feedback">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="form-group mb-4">
                                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="loginFormInputPassword"/>
                                        <label for="loginFormInputPassword">@lang('accounts.auth.login.Password')</label>
                                        @if($errors->has('password'))
                                            @foreach($errors->get('password') as $error)
                                                <span class="invalid-feedback">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="terms-conditions row pt-4 mb-8">
                                        <div class="form-check mr-1 mb-1">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="remember" class="form-check-input" aria-label="Remember Me" {{ old('remember') ? 'checked' : ''}}/>
                                                <span class="checkbox-icon"></span>
                                                <span class="col-sm-12">@lang('accounts.auth.login.Remember me')</span>
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="submit-button btn btn-block btn-secondary my-4 mx-auto" aria-label="LOG IN">
                                        @lang('accounts.auth.login.Sign In')
                                    </button>

                                </form>

                                <div class="login d-flex flex-column flex-sm-row align-items-center justify-content-center mt-8 mb-6 mx-auto">
                                    <span class="text mr-sm-2">
                                        @lang('accounts.auth.login.Dont have an account')
                                        <a class="link text-secondary" href="{{ route('accounts.auth.register.show') }}">@lang('accounts.auth.login.Register')</a>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

@endsection
{{-- End : Page Contetnts --}}


{{-- Start : Page Title --}}
@section('page-title')
    @lang('accounts.auth.login.page title')
@endsection
{{-- End : Page Title --}}


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

