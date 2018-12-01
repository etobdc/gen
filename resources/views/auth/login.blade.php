@extends('layouts.app')

@section('body')
<body class="hold-transition login-page">
	<div class="login-box" id="app">
	  <div class="login-logo">
		<img src="{{ asset('img/logoo2200-black.png') }}">
	  </div>
	  <!-- /.login-logo -->
	  <div class="login-box-body">
		<h4 class="text-center">Painel Administrativo</h4>

		<form class="form-horizontal" method="POST" action="{{ route('login') }}">
						{{ csrf_field() }}

			<div class="form-group has-feedback{{ $errors->has('username') ? ' has-error' : '' }}">
				<input name="username" type="username" class="form-control" placeholder="Usuário" value="{{ old('username') }}" required autofocus>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>

				@if ($errors->has('username'))
					<span class="help-block">
						<strong>{{ $errors->first('username') }}</strong>
					</span>
				@endif
			</div>


			<div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
				<input name="password" type="password" class="form-control" placeholder="Senha" required>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>

				@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
			</div>

			<div class="row">
				<div class="col-xs-8">
				  <div class="checkbox">
					<label>
					  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembrar-me
					</label>
				  </div>
				</div>
				<div class="col-xs-4">
				  	<button type="submit" class="btn btn-success btn-block btn-flat">
						Acessar
					</button>
				</div>
			</div>
		</form>
	  </div>
	  <!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

</body>

@endsection;
