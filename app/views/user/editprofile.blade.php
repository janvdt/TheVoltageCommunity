@extends('instance.layout')

@section('instanceContent')
<div class="row">
	<div class="span12 content">
		<div class="span9">
			<h2>Write and choose an image</h2>
		</div>
		
		<div class="span2 pull-right">
			<h3>Step 2/3 </h3>
		</div>
		
		<div class="row">
			<div class="span12">
				<form class="form-horizontal" method="POST" action="{{ URL::action('AccountController@updateprofile', array(Auth::user()->accountUser()->id)) }}">
					<input type="hidden" name="_method" value="POST">
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
						<button type="submit" class="btn btn-primary pull-right">Next step</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@stop