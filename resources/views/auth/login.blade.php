@extends('layouts.frontsidelayout')

@section('content')



	<div id='loginform'>
		<div class="newraceform">
			<center><h2>Logga in</h2></center>
			<form action="{{ route('login') }}" method="post">
				@csrf

				<ul>
					<li>
						<input id="email" type="email" name="email" v-model='emailInput' value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" :class="emailClass">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
						<span :class="emailClass">Ange email.</span>
					</li>
					<li>
						<input id="password" type="password" name="password" v-model='passwordInput' required>
						<span :class="passwordClass">Ange lösenord.</span>
					</li>
				</ul>
				<div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                </div>
			</form>
		</div>
	</div>


@endsection
