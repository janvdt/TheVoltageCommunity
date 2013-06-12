@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
	<div class="row">
		<div class="span10">
			<h2>Your Playlists</h2>
		</div>
		<div class="span2">
			<a class="btn btn-inverse pull-right" href="{{ URL::action('PlaylistController@create') }}">Create new Playlist</a>
		</div>
	</div>

<ul class="thumbnails">
@foreach($playlists as $playlist)
	
	<li class="span3">
		<div class="row">
			<div class="span3">
			<div class="pull-left">
				<a class="play playplaylist" value="{{$playlist->id}}">
					<i class="icon-play playlisticon"></i>
				</a>
			</div>
			<div class="pull-right">
				<a href="#edit-playlist-{{ $playlist->id }}" data-toggle="modal"><i class='icon-pencil'></i></a>
			</div>
			<div class="pull-right">
				<a href="#delete-playlist-{{ $playlist->id }}" data-toggle="modal"><i class='icon-remove'></i></a>
			</div>
		</div>
		</div>

		<div class="thumbnail">
			@if($playlist->posts->first() != NULL)
			<a href="{{ URL::action('PlaylistController@show', array($playlist->id)) }}">
				@if($playlist->posts->first()->soundcloud_art != NULL)
				<img class="avatar img-polaroid" src="{{ $playlist->posts->first()->soundcloud_art }}" alt="" width="250"></a>
				@else
				<img class="avatar img-polaroid polaroidyoutube" src="{{ $playlist->posts->first()->youtube_art }}" alt="" width="250" heigh="250"></a>
				@endif
			@else
			<a href="{{ URL::action('PlaylistController@show', array($playlist->id)) }}"><img class="avatar img-polaroid" src="http://placehold.it/250x250&text=Empty Playlist" alt="" width="250"></a>
			@endif
			<div class="title">
				<h5 class="playlisttitle">{{$playlist->title}}</h5>
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

if ($('.thumbnails li').length == 0) {$('.music').append("<h5>You have no playlists. Please make one and score some points</h5>")}

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