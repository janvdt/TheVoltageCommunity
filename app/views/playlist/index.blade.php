@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
	<div class="row">
		<div class="span9">
			<h2>Your Playlists</h2>
		</div>
		<div class="span2">
			<a class="btn btn-inverse pull-right newplaylist" href="{{ URL::action('PlaylistController@create') }}">Create new Playlist</a>
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
				<li class="active"><a href="{{ URL::action('PlaylistController@index') }}">All</a></li>
				<li><a href="{{ URL::action('PlaylistController@showowntype') }}?type=youtube">Youtube</a></li>
				<li><a href="{{ URL::action('PlaylistController@showowntype') }}?type=sound">Soundcloud</a></li>
			</ul>
			</div>
		</div>
	</div>
</div>
	<div class="row">
		<ul class="ch-grid playlistgrid nav nav-pills playlists">
		@foreach($playlists as $playlist)
			<li class="playlistshowown">
				<div class="row">
					<div class="span3">
						<div class="pull-left headerplaylist">
							<div class="title">
								<h5>{{$playlist->title}}<a href="#edit-playlist-{{ $playlist->id }}" data-toggle="modal"><i class='icon-pencil'></i></a><a href="#delete-playlist-{{ $playlist->id }}" data-toggle="modal"><i class='icon-remove'></i></a></h5>
							</div>
						</div>
					</div>
				</div>

				<div class="test">
					@if($playlist->posts->first() != NULL)
						<a href="{{ URL::action('PlaylistController@show', array($playlist->id)) }}">
						@if($playlist->posts->first()->soundcloud_art != NULL)
							<div class="ch-item ch-img-1 soundcloudimg" style="background-image: url({{$playlist->posts->first()->soundcloud_art}});">
						@else
							<div class="ch-item ch-img-1 soundcloudimg" style="background-image: url({{$playlist->posts->first()->youtube_art}});">
						@endif
						</div>
						</a>
					@else
						<a href="{{ URL::action('PlaylistController@show', array($playlist->id)) }}">
						<div class="ch-item ch-img-1 youtubeimg" style="background-image: url('http://placehold.it/250x250&text= Empty Playlist');">
						</div>
						</a>
					@endif
				</div>

				<div class="row">
					<div class="span3">
						<div class="pull-left">
							@if($playlist->posts->first() != NULL and $playlist->type == 'sound')
							<a class="play playplaylist" value="{{$playlist->id}}" style="text-decoration: none;">
								<i class=" icon-2x icon-play playlisticon"></i>
							</a>
							@else
							<a href="{{ URL::action('PlaylistController@show', array($playlist->id)) }}" class="play playplaylist" value="{{$playlist->id}}" style="text-decoration: none;">
								<i class=" icon-2x icon-film playlisticon"></i>
							</a>
							@endif
						</div>
					</div>
				</div>
			</li>
	
			<div class="modal hide fade" id="delete-playlist-{{ $playlist->id }}">
				<form class="form-horizontal" method="POST" action="{{ URL::action('PlaylistController@destroy', array($playlist->id)) }}">
					<input type="hidden" name="_method" value="DELETE">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3>Delete playlist</h3>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete this playlist?</p>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal">Cancel</button>
						<input class="btn btn-danger" type="submit" value="Delete playlist">
					</div>
				</form>
			</div>
		
			<div class="modal hide fade" id="edit-playlist-{{ $playlist->id }}" class="titlemodal">
			<form class="form-horizontal" method="POST" action="{{ URL::action('PlaylistController@updatetitle', array($playlist->id)) }}" id="upload-playlist-form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3>Edit playlist</h3>
				</div>
				<div class="modal-body">
					<input type="text" size="100" name="title" placeholder="Playlist title" value="{{ Input::old('title') }}">
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal">Cancel</button>
					<input class="btn btn-inverse" type="submit" value="Edit playlist">
				</div>
			</form>
			</div>
		@endforeach
	</ul>
</div>
</div>
<div class="stratusplayer">
</div>


@stop

@section('scripts')
	@parent




@if(Auth::user())
// Ajax file upload for the file upload modal.
$("#upload-playlist-form").ajaxForm({
	data: { 'ajax': 'true' },
	dataType: 'json',
	success: function(data) {
	
		$(".title").empty()
		console.log('success');

		$(".title").append("<h5>"+ data.title +"</h5>")

		// Hide the upload modal.
		$('.modal.in').modal('hide')

	}
});
@endif

if ($('.playlists li').length == 0) {$('.music').append("<h5>You have no playlists. Please make one and score some points</h5>")}

$(".play").click(function(){

var playlistid = $(this).attr('value');
console.log(playlistid);
$('.stratusplayer').empty();


$.get('playlist/playlistsound?playlistid='+playlistid, function(returnData) {

    if (!returnData) 
    {
        
    } 
    else 
    {
    	$('#stratus').remove();
 		var script   = document.createElement("script");
		script.type  = "text/javascript";    // use this for linked script
		script.text  = "$('.playlistpost').stratus({links: '"+ returnData +"',auto_play: true,random: true,color: 'c6e2cc'});"
		console.log(script);
		$('.stratusplayer').append(script);

	}
});


});

@stop