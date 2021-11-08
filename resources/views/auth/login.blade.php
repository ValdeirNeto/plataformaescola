@extends('layouts.login')

@section('content')
<div class="container-educa">
    <div class="error-pagewrap">
		<div class="error-page-int">
			<div class="text-center m-b-md custom-login" style="width: 50%;margin-left: 25%;margin-right: 25%;">
                <img class="main-logo" src="{{ asset('img/logo/logocodeaz.png') }}" alt="" />
			</div>
			<div class="content-error">
				<div class="hpanel">
                    <div class="panel-body">
                        <form action="{{ route('login') }}" id="loginForm" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="control-label" for="username">Email</label>
                                <input type="text" placeholder="example@gmail.com" title="Please enter you username" required="" value="" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Senha</label>
                                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div> -->
                            <button class="btn btn-success btn-block loginbtn">Login</button>
                            <!-- <a class="btn btn-default btn-block" href="{{ route('register') }}">Register</a> -->
                        </form>
                    </div>
                </div>
			</div>
			<div class="text-center login-footer">
				<p>Copyright © <?= (new DateTime())->format('Y');?>. Todos os direitos reservados</p>
			</div>
		</div>   
    </div>
</div>
@endsection
