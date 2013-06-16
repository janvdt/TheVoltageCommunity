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
			<div class="control-group">
				<div class="controls">
					<div class="pull-left">
						<h5> Choose a song from Youtube or Soundcloud</h5>
					</div>
					<div class="pull-left offset1 song">
						<span class="help-inline required reqsong"><i class='icon-certificate'> required</i></span>
					</div>
				</div>
			</div>

			<div class="control-group soundcloudcr">
				<label class="control-label" for="inputTextarea"><h5>Soundcloud</h5></label>
				<div class="controls">
					<input type="hidden" class="bigdrop" id="soundcloud" name="soundcloud" style="width:80%" value="click here"/>
					<input type="hidden" class="soundcloud-hidden" value="" name="soundcloud-hidden">
					<span class="help-inline">{{ $errors->first('soundcloud') }}</span>
				</div>
			</div>
			<input type="hidden" class="soundcloudid-hidden" value="" name="soundcloudid-hidden">
			<div class="control-group">
				<input type="hidden" id="art_urlsoundcloud" name="art_urlsoundcloud" value="">
				
			</div>


			<div class="control-group youtube">
				<label class="control-label" for="inputTextarea"><h5>Youtube</h5></label>
				<div class="controls">
					<input type="hidden" class="bigdrop" id="youtube" name="youtube" style="width:80%" value="click here"/>
					<input type="hidden" class="youtube-hidden" value="" name="youtube-hidden">
					<span class="help-inline">{{ $errors->first('soundcloud') }}</span>
				</div>
			</div>


			<input type="hidden" name="type" value="{{ Input::get('type') }}">
			<div class="control-group">
				<label class="control-label"><h5>Title</h5>  </label>
				<div class="controls title">
					<input class="input-xlarge" id="title" type="text" size="100" name="title" placeholder="Post title" value="{{ Input::old('title') }}">
					<span class="help-inline required reqtitle"><i class="icon-certificate"> required</i></span>
				</div>
			</div>
 			
 			<div class="control-group">
				<label class="control-label" for="inputTextarea"><h5>Text</h5></label>
				<div class="controls bodyp">
					<textarea class=" pull-left textarea" rows="5" id="inputTextarea" name="body" placeholder="Enter text ..." style="width:80%"></textarea>
				</div>
			</div>

			

			<div class="control-group">
				<label class="control-label"><h5>Music style</h5></label>
				<div class="controls style">
					 <select id='e1' name="genre" style="width: 300px;">
        				<option value="Electronic">Electronic</option>
        				<option value="Hiphop">Hiphop</option>
        				<option value="House">House</option>
        				<option value="Drum&bass">Drum&bass</option>
        				<option value="Dubstep">Dubstep</option>
        				<option value="Pop">Pop</option>
        				<option value="Dance">Dance</option>
        				<option value="Indie">Indie</option>
  					</select>
  					<span class="help-inline required reqstyle"><i class="icon-certificate"> required</i></span>
				</div>
			</div>
			

			<div class="control-group">
				<label class="control-label"><h5>Genre</h5></label>
				<div class="controls">
					<input style="width: 300px;" type="text" name="subgenre" value="" class="subgenre"/>
					<span class="help-inline optional"><i class="icon-certificate"> Optional but you get points for it!</i></span>
					<input type="hidden" type="text" name="subgenre-hidden" value="" class="subgenre-hidden"/>
				</div>
			</div>

			<div class="control-group">
				<input type="hidden" id="art_urlyoutube" name="art_urlyoutube" value="">
				
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



	$("#e1").select2();
	$('#e1').on("select2-selecting", function() {
		$(".reqstyle").hide();
		$(".style").append("<span class='help-inline styleacc'><i class='icon-ok'></i></span>");
	})

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
	$('#title').keyup(function() {
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
 $('#inputTextarea').keydown(function() {
console.log('lol');
	var text = $('#inputTextarea').val();
	console.log(text);
	if(text !== '') {
		$('.reqbody').hide();
		$('.accbody').remove();
		$('.bodyp').append("<span class='help-inline required accbody'><i class='icon-ok'></i></span>");
	}
	else
	{
		$('.accbody').remove();
		$('.reqbody').show();
	}
});

$('#soundcloud').on("select2-opening", function(){ 
	 $('.youtube').hide();
})

$('#soundcloud').on("select2-close", function(){ 
	 $('.youtube').show();
})




$('#soundcloud').on("select2-removed", function(){ 
	$('.youtube').show();
	$('.song').empty();
	$('.song').append("<span class='help-inline required reqsong'><i class='icon-certificate'> required</i></span>");
	$('#title').val('');
	$('.acctitle').remove();
	$('.reqtitle').show();
	$('#postsoundcloud').empty();
	var value = editor.getValue();
		var text = '';
		editor.setValue(text, true);
	$('.soundcloudid-hidden').val("");
	$('#art_urlsoundcloud').val("");
	console.log('test');

})

 $('#soundcloud').on("select2-selecting", function() { 
	$('.youtube').hide();
	$('.song').empty();
	$('.song').append("<span class='help-inline required accsong'><i class='icon-ok'></i></span>");
	$('.reqtitle').hide();
		$('.acctitle').remove();
		$('.title').append("<span class='help-inline required acctitle'><i class='icon-ok'></i></span>");
	
 })
 

$('#youtube').on("select2-opening", function(){ 
	 $('.soundcloudcr').hide();
})

$('#youtube').on("select2-close", function(){ 
	 $('.soundcloudcr').show();
})

 $('#youtube').on("select2-removed", function(){ 
	$('.soundcloudcr').show();
	$('.song').empty();
	$('.song').append("<span class='help-inline required reqsong'><i class='icon-certificate'> required</i></span>");
	$('#title').val('');
	$('.acctitle').remove();
	$('.reqtitle').show();
	$('#postsoundcloud').empty();
	var value = editor.getValue();
		var text = '';
		editor.setValue(text, true);
		$('.youtube-hidden').val("");
	$('#art_urlyoutube').val("");
})

$('#youtube').on("select2-selecting", function() { 
	$('.soundcloudcr').hide();
	$('.song').empty();
	$('.song').append("<span class='help-inline required accsong'><i class='icon-ok'></i></span>");
	$('.reqtitle').hide();
		$('.acctitle').remove();
		$('.title').append("<span class='help-inline required acctitle'><i class='icon-ok'></i></span>");
 })




	
@stop