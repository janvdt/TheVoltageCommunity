@extends('instance.layout')

@section('instanceContent')

<div class="span9 offset2">
<h2>Edit Graphic post </h2>
</div>
<div class="row">
	<div class="span9 offset2">
		<form class="form-horizontal" method="POST" action="{{ URL::action('PostController@updateGraph',array($post->id)) }}">
			<input type="hidden" name="_method" value="POST">
			<div class="control-group">
				<label class="control-label">Post title  </label>
				<div class="controls">
					<input class="input-xlarge" type="text" size="100" name="title" placeholder="Post title" value="{{ Input::old('title', $post->title) }}">
				</div>
			</div>
 			
 			<div class="control-group">
				<label class="control-label" for="inputTextarea">Text</label>
				<div class="controls">
					<textarea class="input-xxlarge pull-left" rows="5" id="inputTextarea" name="body" placeholder="Enter text ...">{{$post->body}}</textarea>
					<span class="help-inline">{{ $errors->first('body') }}</span>
				</div>
			</div>
					
			<div class="form-actions">
				<a href="{{{ URL::to('/') }}}" class="btn">Cancel</a>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</form>
	</div>
</div>

@stop

@section('scripts')
	@parent

	
@stop