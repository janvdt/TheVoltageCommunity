@extends('instance.layout')

@section('instanceContent')
<div class="span12">
<h2>Create playlist</h2>

<form class="form-horizontal" method="POST" action="{{ URL::action('PlaylistController@store') }}" >
	<div class="control-group">
		<div class="controls">
			<input class="input-xxlarge" type="text" size="100" id="inputTitle" name="title" placeholder="Playlist title">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="inputTextarea"><h5>Choose type of playlist</h5></label>
		<div class="controls">
			<select name ="select">
				<option value="sound">Soundcloud</option>
				<option value="youtube">Youtube</option>
			</select>
		</div>
	</div>

	<div class="form-actions">
		<a href="{{ URL::action('PlaylistController@index') }}" class="btn">Cancel</a>
		<button type="submit" class="btn btn-primary">Save</button>
	</div>
</form>	
</div>
@stop