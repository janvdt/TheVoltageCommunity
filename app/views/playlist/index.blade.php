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
			<div class="pull-right">
				<a href="#edit-playlist-{{ $playlist->id }}" data-toggle="modal"><i class='icon-pencil'></i></a>
			</div>
			<div class="pull-right">
				<a href="#delete-playlist-{{ $playlist->id }}" data-toggle="modal"><i class='icon-remove'></i></a>
			</div>
		</div>

		<div class="thumbnail">
			@if($playlist->posts->first() != NULL)
			<a href="{{ URL::action('PlaylistController@show', array($playlist->id)) }}"><img class="avatar img-polaroid" src="{{ $playlist->posts->first()->soundcloud_art }}" alt="" width="250"></a>
			@else
			<a href="{{ URL::action('PlaylistController@show', array($playlist->id)) }}"><img class="avatar img-polaroid" src="http://placehold.it/250x250&text=Playlist" alt="" width="250"></a>
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

@stop