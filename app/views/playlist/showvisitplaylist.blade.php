@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
	<div class="row">
		<div class="span10">
			<h2>{{$account->user->first_name}} playlists</h2>
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
								<h5>{{$playlist->title}}</h5>
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