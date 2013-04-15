@extends('instance.layout')

@section('instanceContent')

<div class="row">
	<div class="span12 content">
		<div class="login-box">
			<h2>Register</h2>

			<form class="form-horizontal" method="POST" action="{{ URL::action('UserController@store')}}" >
				<div class="control-group">
					<label class="control-label">E-mail </label>
					<div class="controls">
						<input class="" type="text"  placeholder="Email" name="email">
						<span class="help-inline">Required</span>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">First Name </label>
					<div class="controls">
						<input class="" type="text"  placeholder="First Name" name="firstname">
						<span class="help-inline">Required</span>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Last Name </label>
						<div class="controls">
						<input class="" type="text"  placeholder="First Name" name="lastname">
						<span class="help-inline">Required</span>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Password </label>
					<div class="controls">
						<input class="" type="password" name="password"  placeholder="">
						<span class="help-inline">Required</span>
					</div>
				</div>
	
				<div class="control-group">
					<label class="control-label">Re-type password </label>
					<div class="controls">
						<input class="" type="password" name="password_confirmation"  placeholder="">
						<span class="help-inline">Required</span>
					</div>
				</div>

				<div class="form-actions">
					<a href="" class="btn">Cancel</a>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>


@stop