@extends('instance.layout')

@section('instanceContent')
<div class="span9 offset2">
<h2>Create Music post </h2>
</div>
<div class="row">
	<div class="span9 offset2">
		<form class="form-horizontal" method="POST" action="{{ URL::action('PostController@storeMusic') }}">
			<input type="hidden" name="type" value="{{ Input::get('type') }}">
			<div class="control-group">
				<label class="control-label">Post title  </label>
				<div class="controls">
					<input class="input-xlarge" id="title" type="text" size="100" name="title" placeholder="Post title" value="{{ Input::old('title') }}">
				</div>
			</div>
 			
 			<div class="control-group">
				<label class="control-label" for="inputTextarea">Text</label>
				<div class="controls">
					<textarea class="input-xxlarge pull-left" rows="5" id="inputTextarea" name="body" placeholder="Enter text ..."></textarea>
					<span class="help-inline">{{ $errors->first('body') }}</span>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputTextarea">Soundcloud</label>
				<div class="controls">
					<input type="hidden" class="bigdrop" id="soundcloud" name="soundcloud" style="width:600px" value="click here"/>
					<input type="hidden" class="soundcloud-hidden" value="" name="soundcloud-hidden">
					<span class="help-inline">{{ $errors->first('soundcloud') }}</span>
				</div>
			</div>

			<div class="control-group">
				<input type="hidden" id="art_url" name="art_url" value="">
				<div class="controls preview">

				</div>
			</div>

					
			<div class="control-group">
				<label class="control-label" for="image">Image</label>
				<div class="controls">
					@include('file.image.upload')
				</div>
			</div>
					
			<div class="form-actions">
				<a href="{{ URL::action('InstanceController@index') }}" class="btn">Cancel</a>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</form>
	</div>
</div>

@stop