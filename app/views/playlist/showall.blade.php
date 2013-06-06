@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
	<div class="row">
		<div class="span10">
			<h2>Playlists</h2>
		</div>
	</div>

<ul class="thumbnails">
@foreach($playlists as $playlist)
	<li class="span3">
		<div class="row">
			<div class="pull-right copybutton">
				<a class=" btn btn-inverse add" name="{{$playlist->id}}" value="{{$playlist->id}}" id="{{$playlist->id}}"><i class="icon-plus"> get this playlist</i></a>
			</div>
		</div>

		<div class="thumbnail">
			@if($playlist->posts->first() != NULL)
			<a href="{{ URL::action('PlaylistController@showplaylist', array($playlist->id)) }}"><img class="avatar img-polaroid" src="{{ $playlist->posts->first()->soundcloud_art }}" alt="" width="250"></a>
			@else
			<a href="{{ URL::action('PlaylistController@showplaylist', array($playlist->id)) }}"><img class="avatar img-polaroid" src="http://placehold.it/250x250&text=Playlist" alt="" width="250"></a>
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
    	console.log(returnData.url);
 		var script   = document.createElement("script");
		script.type  = "text/javascript";    // use this for linked script
		script.text  = "$('.playlistpost').stratus({links: '"+ returnData.url +"',auto_play: true,random: true,color: 'c6e2cc'});"
		$('.stratusplayer').append(script);
	}
});


});

@stop