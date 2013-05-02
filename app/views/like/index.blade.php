@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
<h2>People who like this post!</h2>
@foreach($post->likes as $like)
<div class="span2">
	<a href="{{ URL::action('UserController@visitAccount',array($like->user->id)) }}">
		<img class="img-rounded" src="{{ url($like->user->accountUser()->getImagePathname()) }}" alt="" width="100">
	</a>
</div>
@endforeach

@stop