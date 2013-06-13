@extends('instance.layout')

@section('instanceContent')
<div class="span9 offset2">
<h2>Create Graph post </h2>
</div>
<div class="row">
	<div class="span9 offset2">
		<form class="form-horizontal" method="POST" action="{{ URL::action('PostController@storeGraph') }}">
			<input type="hidden" name="type" value="{{ Input::get('type') }}">
			<div class="control-group">
				<label class="control-label">Post title  </label>
				<div class="controls title">
					<input class="input-xlarge" type="text" size="100" id="titlegraph" name="title" placeholder="Post title" value="{{ Input::old('title') }}">
					<span class="help-inline required reqtitle"><i class="icon-certificate"> required</i></span>
				</div>
			</div>
 			
 			<div class="control-group">
				<label class="control-label" for="inputTextarea">Text</label>
				<div class="controls">
					<textarea class="input-xxlarge pull-left" rows="5" id="inputTextarea" name="body" placeholder="Enter text ..."></textarea>
					
				</div>
			</div>
					
			<div class="control-group">
				<label class="control-label" for="image">Image</label>
				<div class="controls">
					@include('file.image.upload')
					
				</div>
			</div>
					
			<div class="form-actions">
				<a href="{{{ URL::to('/') }}}" class="btn">Cancel</a>
				<button type="submit" class="btn btn-inverse">Save</button>
			</div>
		</form>
	</div>
</div>

@stop

@section('scripts')
	@parent

	$('#titlegraph').keyup(function() {
	var title = $(this).val();
	if(title !== '') {
		$('.reqtitle').hide();
		$('.acctitle').remove();
		$('.title').append("<span class='help-inline required acctitle'><i class='icon-ok'></i></span>");
	}
	else
	{
		$('.acctitle').remove();
		$('.reqtitle').show();
	}
});


@stop