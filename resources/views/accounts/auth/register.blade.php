@extends('accounts.auth.layouts.main')

{{--  Start : Page Contetnts --}}
@section('page-contents')
    @include('accounts.auth.partials.alerts')

    <main>
        <div id="wrapper">
            <div class="content-wrapper">
                <div class="content custom-scrollbar">

                    <div id="register-v2" class="row no-gutters">

                        <div class="intro col-12 col-md light-fg">

                            <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-left py-16 py-md-16 px-12">

                            </div>
                        </div>

                        <div class="form-wrapper col-12 col-md-auto d-flex justify-content-center p-4 p-md-0">

                            <div class="form-content md-elevation-8 h-100 bg-white text-auto py-16 py-md-16 px-12">

                                <div class="title h5">@lang('accounts.auth.register.Create Account')</div>

                                <div class="description mt-2">@lang('accounts.auth.register.Type your information below to create account')</div>

                                <form action="{{ route('accounts.auth.register.register') }}" method="post" name="registerForm" novalidate class="mt-8">
                                    @csrf

                                    <div class="form-group mb-4">
                                        <input type="text" name="first_name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="registerFormInputFirstName" value="{{ old('first_name') }}"/>
                                        <label for="registerFormInputFirstName">@lang('accounts.auth.register.First Name')</label>
                                        @if($errors->has('first_name'))
                                            @foreach($errors->get('first_name') as $error)
                                                <span class="invalid-feedback">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="form-group mb-4">
                                        <input type="text" name="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="registerFormInputLastName"value="{{ old('last_name') }}"/>
                                        <label for="registerFormInputLastName">@lang('accounts.auth.register.Last Name')</label>
                                        @if($errors->has('last_name'))
                                            @foreach($errors->get('last_name') as $error)
                                                <span class="invalid-feedback">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="form-group mb-4">
                                        <div>@lang('accounts.auth.register.Gender')</div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="gender" id="gender-{{ \App\Types\Accounts\Gender::FEMALE }}" value="{{ \App\Types\Accounts\Gender::FEMALE }}" checked="">
                                                <span class="radio-icon fuse-ripple-ready"></span>
                                                <span>@lang('accounts.auth.register.Female')</span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="gender" id="gender-{{ \App\Types\Accounts\Gender::MALE }}" value="{{ \App\Types\Accounts\Gender::MALE }}">
                                                <span class="radio-icon fuse-ripple-ready"></span>
                                                <span>@lang('accounts.auth.register.Male')</span>
                                            </label>
                                        </div>

                                        @if($errors->has('gender'))
                                            <span class="text-right text-danger">{{ $errors->first('gender') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group mb-4">
                                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="registerFormInputEmail"value="{{ old('email') }}"/>
                                        <label for="registerFormInputEmail">@lang('accounts.auth.register.Email Address')</label>
                                        @if($errors->has('email'))
                                            @foreach($errors->get('email') as $error)
                                                <span class="invalid-feedback">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="form-group mb-4">
                                        <input type="text" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="registerFormInputUsername"value="{{ old('username') }}"/>
                                        <label for="registerFormInputUsername">@lang('accounts.auth.register.Username')</label>
                                        @if($errors->has('username'))
                                            @foreach($errors->get('username') as $error)
                                                <span class="invalid-feedback">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="form-group mb-4">
                                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="registerFormInputPassword"/>
                                        <label for="registerFormInputPassword">@lang('accounts.auth.register.Password')</label>
                                        @if($errors->has('password'))
                                            @foreach($errors->get('password') as $error)
                                                <span class="invalid-feedback">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="form-group mb-4">
                                        <input type="password" name="password_confirmation" class="form-control" id="registerFormInputPasswordConfirmation"/>
                                        <label for="registerFormInputPasswordConfirmation">@lang('accounts.auth.register.Password Confirmation')</label>
                                    </div>

                                    <div class="terms-conditions row pt-4 mb-8">
                                        <div class="form-check mr-1 mb-1">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="terms" class="form-check-input{{ $errors->has('password') ? ' is-invalid' : '' }}" aria-label="Terms" {{ old('terms') ? 'checked' : ''}}/>
                                                <span class="checkbox-icon"></span>
                                                <span class="col-sm-12">@lang('accounts.auth.register.I have read terms and policy')</span>
                                            </label>
                                        </div>
                                        @if($errors->has('terms'))
                                            <span class="col-sm-12 text-danger text-right">{{ $errors->first('terms') }}</span>
                                        @endif
                                    </div>

                                    <button type="submit" class="submit-button btn btn-block btn-secondary my-4 mx-auto" aria-label="LOG IN">
                                        @lang('accounts.auth.register.Sign Up')
                                    </button>

                                </form>

                                <div class="login d-flex flex-column flex-sm-row align-items-center justify-content-center mt-8 mb-6 mx-auto">
                                    <span class="text mr-sm-2">
                                        @lang('accounts.auth.register.Already have an account')
                                        <a class="link text-secondary" href="{{ route('accounts.auth.login.show') }}">@lang('accounts.auth.register.Log In')</a>
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
    @lang('accounts.auth.register.page title')
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

