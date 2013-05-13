@extends('instance.layout')

@section('instanceContent')

<h2>Edit settings</h2>
<div class="row">
	<div class="span12">
		<form class="form-horizontal" method="POST" action="{{ URL::action('AccountController@update', array($account->id)) }}">
			<input type="hidden" name="_method" value="PUT">
			<div class="control-group">
				<label class="control-label">Biography  </label>
				<div class="controls">
					<textarea class="input-xlarge" type="text" size="100" name="biography" placeholder="Biography" value=""></textarea>
				</div>
			</div>
			@if(!Session::has('hybridAuth'))
			<div class="control-group">
				<label class="control-label" for="image">Image</label>
				<div class="controls">
					@include('file.account.upload')
				</div>
			</div>
			@endif
					
			<div class="form-actions">
				<a href="{{ URL::action('UserController@showAccount',array($account->id)) }}" class="btn">Cancel</a>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</form>
	</div>
</div>

@stop