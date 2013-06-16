@extends('instance.layout')

@section('instanceContent')

<div class="span9 offset2">
<h2>Edit Music post </h2>
</div>
<div class="row">
	<div class="span9 offset2">
		<form class="form-horizontal" method="POST" action="{{ URL::action('PostController@updateMusic',array($post->id)) }}">
			<input type="hidden" name="_method" value="POST">
			<div class="control-group">
				<label class="control-label">Post title  </label>
				<div class="controls">
					<input class="input-xlarge" type="text" size="100" name="title" placeholder="Post title" value="{{ Input::old('title', $post->title) }}">
					<i class='icon-certificate'></i>
					<span class="help-inline">{{ $errors->first('title') }}</span>
				</div>
			</div>
 			
 			<div class="control-group">
				<label class="control-label" for="inputTextarea">Text</label>
				<div class="controls">
					<textarea class="input-xxlarge pull-left" rows="5" id="inputTextarea" name="body" placeholder="Enter text ...">{{$post->body}}</textarea>
					<i class='icon-certificate'></i>
						<span class="help-inline">{{ $errors->first('body') }}</span>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Genre</label>
				<div class="controls">
					<input style="width: 300px;" type="text" name="genre" value="<?php echo($selectedgenres) ?>" class="genre"/>
					<input type="hidden" type="text" name="genre-hidden" value="<?php echo($selectedgenres) ?>" class="genre-hidden"/>
				</div>
			</div>

			<div class="control-group">
				<input type="hidden" id="art_urlyoutube" name="art_urlyoutube" value="">
				
			</div>

			<div class="control-group">
				<div class="controls">
					<div class="controls preview">
					</div>
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

	$(".genre").select2({
		createSearchChoice:function(term, data) { if ($(data).filter(function() { return this.text.localeCompare(term)===0; }).length===0) {return {id:term, text:term};} },
		multiple: true,
		data: <?php print(json_encode(array_values($genresdata))); ?>,
		initSelection : function (element, callback) {
    	   var data = [];
			$(element.val().split(",")).each(function () {
			data.push({id: this, text: this});
		});
			callback(data);
		}
	}).on("change", function(e) {
		var genres = JSON.stringify({val:e.val, added:e.added, removed:e.removed});
		console.log(genres);
		$('.genre-hidden').attr('value', genres);
	});
@stop