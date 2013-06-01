@extends('instance.layout')

@section('instanceContent')

<script src="//connect.soundcloud.com/sdk.js"></script>
<script>
  SC.initialize({
    client_id: "706bb7625906c6e65ff8bb1bebdd22b7",
  });
</script>
<div class="span12">
<h2>Create Music post </h2>
</div>
<div class="row">
	<div class="span3">
		<div class="pull-left preview span1">
			<div class="slider-img ch-img-1 soundimgslider" style="background-image: url(../images/mac.jpg);"></div>
		</div>
		<div class="span2" id="postsoundcloud">
		</div>
	</div>
	<div class="span9 pull-left">
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
			<input type="hidden" class="soundcloudid-hidden" value="" name="soundcloudid-hidden">
			<div class="control-group">
				<input type="hidden" id="art_urlsoundcloud" name="art_urlsoundcloud" value="">
				
			</div>

			<div class="control-group">
				<label class="control-label" for="inputTextarea">Youtube</label>
				<div class="controls">
					<input type="hidden" class="bigdrop" id="youtube" name="youtube" style="width:600px" value="click here"/>
					<input type="hidden" class="youtube-hidden" value="" name="youtube-hidden">
					<span class="help-inline">{{ $errors->first('soundcloud') }}</span>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Music style</label>
				<div class="controls">
					 <select id='e1' name="genre">
        				<option value="Electronic">Electronic</option>
        				<option value="Hiphop">Hiphop</option>
        				<option value="House">House</option>
        				<option value="Drum&bass">Drum&bass</option>
        				<option value="Dubstep">Dubstep</option>
        				<option value="Pop">Pop</option>
        				<option value="Dance">Dance</option>
        				<option value="Indie">Indie</option>
  					</select>
				</div>
			</div>
			

			<div class="control-group">
				<label class="control-label">Genre</label>
				<div class="controls">
					<input style="width: 300px;" type="text" name="subgenre" value="" class="subgenre"/>
					<input type="hidden" type="text" name="subgenre-hidden" value="" class="subgenre-hidden"/>
				</div>
			</div>

			<div class="control-group">
				<input type="hidden" id="art_urlyoutube" name="art_urlyoutube" value="">
				
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

	$("#e1").select2();

	$(".subgenre").select2({
		createSearchChoice:function(term, data) { if ($(data).filter(function() { return this.text.localeCompare(term)===0; }).length===0) {return {id:term, text:term};} },
		multiple: true,
		data: <?php print(json_encode(array_values($subgenresdata))); ?>,
		initSelection : function (element, callback) {
    	   var data = [];
        	$(element.val().split(",")).each(function () {
        	    data.push({id: this, text: this});
        	});
        	callback(data);
    	}
	}).on("change", function(e) {
		var subgenres = JSON.stringify({val:e.val, added:e.added, removed:e.removed});
		console.log(subgenres);
		$('.subgenre-hidden').attr('value', subgenres);
	});

	
@stop