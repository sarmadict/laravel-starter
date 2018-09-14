@extends('auth.layouts.main')


@section('contents')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">@lang('accounts.auth.password_reset.Reset Password')</div>

					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="{{ route('auth.password.reset') }}">
							{{ csrf_field() }}

							<input type="hidden" name="token" value="{{ $token }}">

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">@lang('accounts.auth.password_reset.Email')</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

									@if ($errors->has('email'))
										<span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label for="password" class="col-md-4 control-label">@lang('accounts.auth.password_reset.Password')</label>

								<div class="col-md-6">
									<input id="password" type="password" class="form-control" name="password" required>

									@if ($errors->has('password'))
										<span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
								<label for="password_confirmation" class="col-md-4 control-label">@lang('accounts.auth.password_reset.Password Confirmation')</label>
								<div class="col-md-6">
									<input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>

									@if ($errors->has('password_confirmation'))
										<span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										@lang('accounts.auth.password_reset.Reset Password')
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection


@section('page-title')
    @lang('auth.password_reset.page_title')
@endsection
