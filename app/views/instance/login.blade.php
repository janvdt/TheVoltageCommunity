@extends('layout')

@section('content')

@include('instance.header')


<hr>

<div class="row">
		<div class="span12 content">
			<div class="login-box">
				<h2>Login</h2>
				<p>Register <a href ="{{ URL::action('UserController@create') }}">here</a></p>
				@if (Session::has('login_errors'))
				<div class="alert alert-error">
					<button type="button" class="close" data-dismiss="alert">×</button>
					Invalid login. Please try again.
				</div>
				@endif

				<form class="form-horizontal" method="POST" action="{{ URL::route('login') }}">
					<div class="control-group">
						<label class="control-label" for="email">E-mail</label>
						<div class="controls">
							<input type="text" name="email" id="email" placeholder="Email" value="{{{ Input::old('email') }}}">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="password">Password</label>
						<div class="controls">
							<input type="password" name="password" id="password" placeholder="Password">
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<label class="checkbox">
								<input type="checkbox"> Remember me
							</label>
							<button type="submit" class="btn">Sign in</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<a href="{{ URL::route('socialAuth', 'facebook') }}" class="btn"><img src= "/images/facebook.png" width="50" /></a>
@stop