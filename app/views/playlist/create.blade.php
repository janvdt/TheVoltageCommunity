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

	<div class="form-actions">
		<a href="{{ URL::action('PlaylistController@index') }}" class="btn">Cancel</a>
		<button type="submit" class="btn btn-primary">Save</button>
	</div>
</form>	
</div>
@stop