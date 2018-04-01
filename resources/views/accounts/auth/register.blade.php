@extends('accounts.auth.layouts.main')

{{--  Start : Page Contetnts --}}
@section('page-contents')
    @include('accounts.auth.partials.alerts')

    <div class="row {{ $errors->isEmpty() ? ' animated fadeInRightBig' : '' }}">
        <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="logo margin-top-30">
                <img src="assets/images/logo.png" alt="Clip-Two"/>
            </div>
            <!-- start: REGISTER BOX -->
            <div class="box-register">
                <form action="{{ route('accounts.auth.register.register') }}" method="post" name="registerForm" class="form-register">
                    @csrf

                    <fieldset>
                        <legend>@lang('accounts.auth.register.Sign Up')</legend>

                        <p>@lang('accounts.auth.register.Enter your personal details below')</p>

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" placeholder="@lang('accounts.auth.register.First Name')" value="{{ old('first_name') }}">
                            @if($errors->has('first_name'))
                                @foreach($errors->get('first_name') as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" placeholder="@lang('accounts.auth.register.Last Name')" value="{{ old('last_name') }}">
                            @if($errors->has('last_name'))
                                @foreach($errors->get('last_name') as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label class="block">
                                @lang('accounts.auth.register.Gender')
                            </label>
                            <div class="clip-radio radio-primary">
                                <input type="radio" id="rg-female" name="gender" value="{{ \App\Types\Accounts\Gender::FEMALE }}" @if(old('gender') == \App\Types\Accounts\Gender::FEMALE) checked @endif />
                                <label for="rg-female">
                                    @lang('accounts.auth.register.Female')
                                </label>
                                <input type="radio" id="rg-male" name="gender" value="{{ \App\Types\Accounts\Gender::MALE }}" @if(old('gender') == \App\Types\Accounts\Gender::MALE) checked @endif />
                                <label for="rg-male">
                                    @lang('accounts.auth.register.male')
                                </label>
                            </div>
                            @if($errors->has('gender'))
                                <span class="text-danger">{{ $errors->first('gender') }}</span>
                            @endif
                        </div>

                        <p>@lang('accounts.auth.register.Enter your account details below')</p>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <span class="input-icon">
                                <input type="email" class="form-control" name="email" placeholder="@lang('accounts.auth.register.Email')" value="{{ old('email') }}">
                                <i class="fa fa-envelope"></i>
                            </span>

                            @if($errors->has('email'))
                                @foreach($errors->get('email') as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <span class="input-icon">
                                <input type="text" class="form-control" name="username" placeholder="@lang('accounts.auth.register.Username')" value="{{ old('username') }}">
                                <i class="fa fa-user"></i>
                            </span>

                            @if($errors->has('username'))
                                @foreach($errors->get('username') as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <span class="input-icon">
                                <input type="password" class="form-control" id="password" name="password" placeholder="@lang('accounts.auth.register.Password')">
                                <i class="fa fa-lock"></i>
                            </span>

                            @if($errors->has('password'))
                                @foreach($errors->get('password') as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <span class="input-icon">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="@lang('accounts.auth.register.Password Confirmation')">
                                <i class="fa fa-lock"></i>
                            </span>

                            @if($errors->has('password_confirmation'))
                                @foreach($errors->get('password_confirmation') as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('terms') ? ' has-error' : '' }}">
                            <div class="checkbox clip-check check-primary">
                                <input name="terms" type="checkbox" id="terms" @if(old('terms')) checked @endif />
                                <label for="terms">
                                    @lang('accounts.auth.register.I have read terms and policy')
                                </label>
                            </div>
                            @if($errors->has('terms'))
                                @foreach($errors->get('terms') as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary pull-right">
                                @lang('accounts.auth.register.Register') <i class="fa fa-arrow-circle-left"></i>
                            </button>
                        </div>

                        <div class="form-actions">
                            <p>
                                @lang('accounts.auth.register.Already have an account')
                                <a href="{{ route('accounts.auth.login.show') }}">
                                    @lang('accounts.auth.register.')@lang('accounts.auth.register.Log In')
                                </a>
                            </p>
                        </div>
                    </fieldset>
                </form>

                <!-- start: COPYRIGHT -->
                <div class="copyright">
                    @lang('accounts.auth.register.copyright')
                </div>
                <!-- end: COPYRIGHT -->
            </div>
            <!-- end: REGISTER BOX -->
        </div>
    </div>
@endsection
{{-- End : Page Contetnts --}}


{{-- Start : Page Title --}}
@section('page-title')
    @lang('accounts.auth.register.page title')
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

