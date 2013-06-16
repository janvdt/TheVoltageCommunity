@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
	<div class="row">
		<div class="span10">
			<h2>Grab yourself a playlist and enjoy!</h2>
		</div>
	</div>
	<div class="navbar navbarmusic span12">
	<div class="navbar-inner navbarinnermusic">
		<div class="container">
 
		<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
 
			<!-- Be sure to leave the brand out there if you want it shown -->
			<a class="brand" href="#">Playlists</a>
 
			<!-- Everything you want hidden at 940px or less, place within here -->
			<div class="nav-collapse collapse">
			<!-- .nav, .navbar-search, .navbar-form, etc -->
			<ul class="nav">
				<li><a href="{{ URL::action('PlaylistController@showAll') }}">All</a></li>
				<li><a href="{{ URL::action('PlaylistController@showtype') }}?type=youtube">Youtube</a></li>
				<li><a href="{{ URL::action('PlaylistController@showtype') }}?type=sound">Soundcloud</a></li>
			</ul>
			</div>
		</div>
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
						<div class="pull-left">
							<h5>
							<a href="{{ URL::action('UserController@visitAccount',array($playlist->account->user->id)) }}">
    						@if($playlist->account->image_id != 0 or $playlist->account->facebookpic == NULL )
								<img src="{{ url($playlist->account->getImagePathname()) }}" width="30" alt="">
							@else
								<img src="{{ url($playlist->account->facebookpic) }}" width="30" alt="">
							@endif
							</a>
							{{$playlist->account->user->first_name}} {{$playlist->account->user->last_name}}</h5>
						</div>
						<div class="pull-right copybutton">
							<img src="/images/vinyl.png" width="40">
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
							@if($playlist->posts->first() != NULL and $playlist->type == 'sound')
							<a class="play playplaylist" value="{{$playlist->id}}" style="text-decoration: none;">
								<i class=" icon-2x icon-play playlisticon"></i>
							</a>
							@else
							<a href="{{ URL::action('PlaylistController@showplaylist', array($playlist->id)) }}" class="play playplaylist" style="text-decoration: none;">
								<i class=" icon-2x icon-film playlisticon"></i>
							</a>
							@endif
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