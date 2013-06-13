@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
	<div class="row">
		<div class="span10">
			<h2>Grab yourself a playlist and enjoy!</h2>
		</div>
	</div>
	<div class="row">
		<ul class="ch-grid nav nav-pills playlists">
		@foreach($playlists as $playlist)
			@if($playlist->posts->first() != NULL)
			<li class="playlistshowall">
				<div class="row">
					<div class="span3">
						@if(Auth::user())
						<div class="pull-right copybutton">
							<a class=" btn btn btn-link add" name="{{$playlist->id}}" value="{{$playlist->id}}" id="{{$playlist->id}}"><i class="icon-plus"></i></a>
						</div>
						@endif
					</div>
				</div>
		
				<div class="test">
					@if($playlist->posts->first() != NULL)
					<a href="{{ URL::action('PlaylistController@showplaylist', array($playlist->id)) }}">
						@if($playlist->posts->first()->soundcloud_art != NULL)
						<div class="ch-item ch-img-1 soundcloudimg" style="background-image: url({{$playlist->posts->first()->soundcloud_art}});">
						@else
						<div class="ch-item ch-img-1 youtubeimg" style="background-image: url({{$playlist->posts->first()->youtube_art}});">
						@endif
						</div>
					</a>
					@else
					<a href="{{ URL::action('PlaylistController@showplaylist', array($playlist->id)) }}">
						
						<div class="ch-item ch-img-1 youtubeimg" style="background-image: url('http://placehold.it/250x250&text= Empty Playlist');">
						</div>
					</a>
					@endif
				</div>

				<div class="row">
					<div class="span3">
						<div>
							<a class="play playplaylist" value="{{$playlist->id}}" style="text-decoration: none;">
								<i class=" icon-2x icon-play playlisticon"></i>
							</a>
						</div>
					</div>
				</div>
			</li>
			@endif
		@endforeach
		</ul>
	</div>
</div>
<div class="stratusplayer">
</div>
@stop

@section('scripts')
	@parent

if ($('.playlists li').length == 0) {$('.music').append("<h5>There are currently no playlists available.</h5>")}


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