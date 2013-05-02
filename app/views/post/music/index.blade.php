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
	@if(Auth::user())
	@if(Auth::user()->id == $post->created_by)
	<a href="{{ URL::action('PostController@editMusic', array($post->id)) }}" class="btn btn-primary pull-right">Edit post</a>
	@endif
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
				@if($post->soundcloud_art != NULL)
				<div class="slider-img ch-img-1 soundimgslider" style="background-image: url({{$post->soundcloud_art}});">
				@else
				<div class="slider-img ch-img-1 youtubeimgslider" style="background-image: url({{$post->youtube_art}});">
				@endif
			@endif
		</div>
		<div class="row">
			@if(Auth::user())
			<div class="span4 offset1 likebutton">
       		@if($post->can($post->id,Auth::user()->id))
				<a class="btn btn-primary btn-large" id="post"><i class="icon-thumbs-up"> Like !</i></a>
			@endif
			<a class="btn btn-link btn-large" href="{{ URL::action('PostController@showLikes', array($post->id)) }}"><i class="icon-thumbs-up">{{count($post->likes)}} </i></a>
			</div>
			@endif
		</div>
	</div>
	<div class="span7">
		<div id="postsoundcloud">
			@if($post->soundcloud != NULL)
			<div id="putTheWidgetHere"></div>
			<script type="text/JavaScript">
  				SC.oEmbed('{{$post->soundcloud}}', {color: "c6e2cc"},  document.getElementById("postsoundcloud"));
			</script>
			@else
			<div class="video-container">
				<iframe class="youtube-player" type="text/html" width="640" height="385" src="http://www.youtube.com/embed/{{$post->youtube}}" allowfullscreen frameborder="0">
			</iframe>
			</div>
			@endif
		</div>
	
		<div class="postreview">
			{{$post->body}}
		</div>
		<div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'thevoltagecommunity'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
		

	</div>
</div>
@stop

@section('scripts')
	@parent

	 $("#post").click(function(){ 

	$.post('/post/like/' + {{$post->id}},
	function(data)
	{
		$('#post').hide();
	});
});

@stop