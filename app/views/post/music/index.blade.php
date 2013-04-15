@extends('instance.layout')

@section('instanceContent')
<script src="//connect.soundcloud.com/sdk.js"></script>
<script>
  SC.initialize({
    client_id: "706bb7625906c6e65ff8bb1bebdd22b7",
  });
</script>
<div class="span12">
	<div class="span11">
	@if(Auth::user()->id == $post->created_by)
	<a href="{{ URL::action('PostController@editMusic', array($post->id)) }}" class="btn btn-primary pull-right">Edit post</a>
	@endif
	<h4>{{$post->title}}</h4>
	</div>
</div>
<div class="row">
	<div class="span12">
		<div class="span4">
		<img class="avatar img-polaroid" src="/{{ $post->image->getSize('thumb')->getPathname() }}" alt="">
	</div>
	<div class="span7">
		<div id="postsoundcloud">
		<div id="putTheWidgetHere"></div>
		<script type="text/JavaScript">
  			SC.oEmbed('{{$post->soundcloud}}', {color: "ff0066"},  document.getElementById("postsoundcloud"));
		</script>
		</div>
		<div>
		<p>{{$post->body}}</p>
		</div>
	</div>
</div>

@stop