@extends('instance.layout')

@section('instanceContent')

<div class="span12">
	<h4>{{$post->title}}</h4>
</div>
<div class="row">
	<div class="span12">
		<div class="span4">
		<img class="avatar img-polaroid" src="/{{ $post->image->getSize('medium')->getPathname() }}" alt="">
	</div>
	<div class="span7">
		<div class="postsoundcloud">
		
		</div>
		<div>
		<p>{{$post->body}}</p>
		</div>
	</div>
</div>

@stop