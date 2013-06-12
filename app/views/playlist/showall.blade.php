@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
	<div class="row">
		<div class="span10">
			<h2>Grab yourself a playlist and enjoy!</h2>
		</div>
	</div>

<ul class="thumbnails">
@foreach($playlists as $playlist)
	<li class="span3 playlistshowall">
		<div class="row">
			<div class="span3">
			<div class="pull-left">
				<a class="play playplaylist" value="{{$playlist->id}}">
					<i class="icon-play playlisticon"></i>
				</a>
			</div>
			<div class="pull-right copybutton">
				<a class=" btn btn-inverse add" name="{{$playlist->id}}" value="{{$playlist->id}}" id="{{$playlist->id}}"><i class="icon-plus"></i></a>
			</div>
		</div>
		</div>

		<div class="thumbnail">
			@if($playlist->posts->first() != NULL)
			<a href="{{ URL::action('PlaylistController@showplaylist', array($playlist->id)) }}">
				@if($playlist->posts->first()->soundcloud_art != NULL)
				<img class="avatar img-polaroid" src="{{ $playlist->posts->first()->soundcloud_art }}" alt=""></a>
				@else
				<img class="avatar img-polaroid polaroidyoutube" src="{{ $playlist->posts->first()->youtube_art }}" alt=""></a>
				@endif
			@else
			<a href="{{ URL::action('PlaylistController@showplaylist', array($playlist->id)) }}"><img class="avatar img-polaroid" src="http://placehold.it/250x250&text= Empty Playlist" alt="" width="250"></a>
			@endif
			<div class="title">
				<h5 class="playlisttitle">{{$playlist->title}}</h5>
			</div>
		</div>
	</li>
@endforeach
</ul>
</div>
<div class="stratusplayer">
</div>
@stop

@section('scripts')
	@parent

if ($('.thumbnails li').length == 0) {$('.music').append("<h5>There are currently no playlists available.</h5>")}


$("#playlist").addClass('active');


 $(".add").click(function(){

 	var playlist = $(this).attr('value');

 	console.log(playlist);

 	$(this).hide();

 	$.get('/playlist/copy/' +playlist,
	function(data)
	{
		

	});

	
});
$(".play").click(function(){

var playlistid = $(this).attr('value');
console.log(playlistid);
$('.stratusplayer').empty();


$.get('playlistsound?playlistid='+playlistid, function(returnData) {

    if (!returnData) 
    {
        
    } 
    else 
    {
    	$('#stratus').remove();
    	console.log(returnData);
 		var script   = document.createElement("script");
		script.type  = "text/javascript";    // use this for linked script
		script.text  = "$('.playlistpost').stratus({links: '"+ returnData +"',auto_play: true,random: true,color: 'c6e2cc'});"
		console.log(script);
		$('.stratusplayer').append(script);

	}
});


});


@stop