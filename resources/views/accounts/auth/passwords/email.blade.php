@extends('auth.layouts.main')

{{--  Start : Page Contetnts --}}
@section('page-contents')
    @include('auth.partials.alerts')

    <!-- start: FORGOT -->
    <div class="row animated fadeInRight" id="main-box">
        <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="logo margin-top-30">
                <img src="assets/images/logo.png" alt="Clip-Two"/>
            </div>
            <!-- start: FORGOT BOX -->
            <div class="box-forgot">
                <form class="form-forgot" method="post" action="{{ url('auth/password/email') }}">
                    {!! csrf_field() !!}
                    {!! method_field('POST') !!}

                    <fieldset>
                        <legend>
                            {{ trans('accounts.auth.password.email.Forget Password') }}
                        </legend>
                        <p>
                            {{ trans('accounts.auth.password.email.Enter your e-mail address below to reset your password') }}
                        </p>
                        <div class="form-group @if($errors->forgetPassword->has('email')) has-error @endif">
                            <span class="input-icon">
                                <input type="email" class="form-control" name="email" placeholder="{{ trans('accounts.auth.password.email.PLACEHOLDER.email') }}" value="{{ old('email', '') }}">
                                <i class="fa fa-envelope-o"></i>
                            </span>
                            @if($errors->forgetPassword->has('email'))
                                <span class="help-block">
                                    {{ $errors->forgetPassword->first('email') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-actions">
                            <a class="btn btn-primary btn-o" href="{{ url('auth/login') }}">
                                <i class="fa fa-chevron-circle-right"></i> {{ trans('accounts.auth.password.email.LINK.Log-In') }}
                            </a>
                            <button type="submit" class="btn btn-primary pull-left">
                                {{ trans('accounts.auth.password.email.Submit') }}
                                <i class="fa fa-arrow-circle-left"></i>
                            </button>
                        </div>
                    </fieldset>
                </form>
                <!-- start: COPYRIGHT -->
                <div class="copyright">
                    &copy; <span class="current-year"></span><span class="text-bold text-uppercase"> ClipTheme</span>. <span>All rights reserved</span>
                </div>
                <!-- end: COPYRIGHT -->
            </div>
            <!-- end: FORGOT BOX -->
        </div>
    </div>
    <!-- end: FORGOT -->
@endsection
{{-- End : Page Contetnts --}}



{{-- Start : Specific header assets fot this page --}}
@section('page-head-assets')
    @stack('styles')
@endsection
{{-- End : Specific header assets fot this page --}}


{{-- Start : Specific footer assets fot this page --}}
@section('page-foot-assets')
    <script>
        $('a').click(function(e){
            $('#main-box').removeClass('fadeInRight').addClass('fadeOutLeft');
        });
    </script>

    @stack('scripts')
@endsection
{{-- End : Specific footer assets fot this page --}}


{{-- Start : Page Title --}}
@section('page-title')
    {{ trans('accounts.auth.password.email.page title') }}
@endsection
{{-- End : Page Title --}}


