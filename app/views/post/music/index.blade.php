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
			<a class="btn btn-link btn-large likeref" href="{{ URL::action('PostController@showLikes', array($post->id)) }}"><i class="icon-thumbs-up"><p class="likevalue">{{count($post->likes)}}</p></i></a>
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
		@if(Auth::user())
		<div class="buttoncomment">
			<a class="btn btn-success" href="#comment-post" data-toggle="modal"><i class="icon-pencil"> Comment!</i></a>
		</div>
		@endif

		<div class="comments">
			@foreach($post->comments as $comment)
			<div class="well">
				<p class="pull-right">Posted by: {{$comment->user->first_name}} {{$comment->user->last_name}}</p>
				@if($comment->user->accountUser()->identifier == 0)
				<a href="{{ URL::action('UserController@visitAccount',array($comment->user->id)) }}">
					<img class="img-rounded" src="{{ url($comment->user->accountUser()->getImagePathname()) }}" alt="" width="100">
				</a>
				@else
				<a href="{{ URL::action('UserController@visitAccount',array($comment->user->id)) }}">
					<img class="img-rounded" src="{{ url($comment->user->accountUser()->facebookpic) }}" alt="" width="100">
				</a>
				@endif
				{{$comment->body}}
			</div>
			@endforeach
		</div>
	</div>
</div>

<div class="modal hide fade" id="comment-post">
	<form class="form-horizontal" method="POST" action="{{ URL::action('CommentController@store')}}?post_id={{$post->id}}"  id="upload-comment-form">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h3>Comment</h3>
		</div>
		<div class="modal-body">
			<textarea name="textcomment" class="input-xxlarge pull-left" rows="5" id="inputTextarea" placeholder="Enter text ..."></textarea>
			<span class="help-inline">{{ $errors->first('menu_title') }}</span>	
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Cancel</button>
			<input class="btn btn-primary" type="submit" value="Comment">
		</div>
	</form>
</div>

@stop

@section('scripts')
	@parent

	 $("#post").click(function(){ 

	$.post('/post/like/' + {{$post->id}},
	function(data)
	{
		var likecount = {{count($post->likes)}}+1;
		$('.likevalue').remove();
		counttext="<p class='likevalue'>"+likecount+"</p>";
		$('.likeref').append(counttext);
		$('#post').hide();
	});
});

// Ajax file upload for the file upload modal.
$("#upload-comment-form").ajaxForm({
	data: { 'ajax': 'true' },
	dataType: 'json',
	success: function(data) {
	console.log(data.id);
	@if(Auth::user()->accountUser()->image_id != 0 or Auth::user()->accountUser()->facebookpic == NULL)		
	var comment = "<div class='well' id='comment"+ data.id +"'><img class='img-rounded' src='{{ url(Auth::user()->accountUser()->getImagePathname()) }}' width='100'>"  + data.body + "</div>";
	@else
	var comment = "<div class='well' id='comment"+ data.id +"'><img class='img-rounded' src='{{ url(Auth::user()->accountUser()->facebookpic) }}' width='100'>"  + data.body + "</div>";
	@endif
	$(".comments").append(comment);

	// Hide the upload modal.
	$("#comment-post").modal('hide');

	}
});


@stop