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
		@if($post->image_id != 0)
        			<div class="slider-img ch-img-1" style="background-image: url(/{{ $post->image->getSize('thumb')->getPathname() }});">
        			@else
        			<div class="slider-img ch-img-1" style="background-image: url({{$post->soundcloud_art}});">
        			@endif
        		</div>
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