@extends('instance.layout')

@section('instanceContent')
<script src="//connect.soundcloud.com/sdk.js"></script>
<script>
  SC.initialize({
    client_id: "706bb7625906c6e65ff8bb1bebdd22b7",
  });
</script>
 
<div class="span12">
	<div class="row">
		<div class="span10">	
			<p class="posttitle">{{$post->title}}</p>
		</div>
		@if(Auth::user() and $post->can($post->id,Auth::user()->id))
		<div class="span2">
			<a class="btn btn-inverse btn-large" id="post">AC<img src="/images/lightning.png"/ width="50">DC</a>
		</div>
		@endif
	</div>
	<div class="row">
		<div class="span2 offset10">
			@if(Auth::user())
			<ul class="nav nav-pills">
  				<li class="dropdown">
    				<a class=" btn dropdown-toggle" data-toggle="dropdown" href="#">
        						<i class="icon-plus"></i>Playlist
    							<span class="caret"></span>
      						</a>
    						
    						<ul class="dropdown-menu">
    							@foreach(Auth::user()->accountUser()->playlists as $playlist)
   	 						<li value="{{$playlist->id}}" class="playlist" class="span"><a>{{$playlist->title}}</a></li>
   	 					@endforeach
    						</ul>
  						</li>
					</ul>
			@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="span12">
		<div class="span4 detailspost pull-left">
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
			<div class="span4 likebutton">
			<a class="btn btn-link btn-large likeref" href="{{ URL::action('PostController@showLikes', array($post->id)) }}">People who <img src="/images/lightning.png"/ width="30"> this post<span class="badge badge-inverse likevalue">{{count($post->likes)}}</span></i></a>
			</div>
			@endif
		</div>
		<div class="row">
			@if(Auth::user() and Auth::user()->accountUser()->facebook != NULL)
			<div class="span4 offset1 sharebutton">
				<a class="btn btn-inverse btn-large" href="{{ URL::action('PostController@share', array($post->id)) }}"><img src="/images/facebook-logo-square.png"></a>
				
			</div>
			@endif
		</div>
	</div>
	<div style="width:2px;height:400px;background-color:#C6E2CC;float:left;"></div>
	<div class="span7 contentbox">
		@if($post->soundcloud != NULL)
		<div id="postsoundcloud">
			<div id="putTheWidgetHere"></div>
			<script type="text/JavaScript">
  				SC.oEmbed('{{$post->soundcloud}}', {color: "c6e2cc"},  document.getElementById("postsoundcloud"));
			</script>
		</div>
		@else
		<div class="video-container">
			<iframe class="youtube-player" type="text/html" width="640" height="385" src="http://www.youtube.com/embed/{{$post->youtube}}" allowfullscreen frameborder="0">
			</iframe>
		</div>
		@endif
		
		<div class="postreview">
			<div class="row">
				<div class="pull-right">
					<ul class="nav">
					<li><a class="editbody" href="{{ URL::action('PostController@editMusic', array($post->id)) }}"><i class="icon-pencil"></i></a></li>
					</ul>
				</div>
				<div class="span1">
					<ul class="nav">
						<li><img src="/images/bullhorn.png" /></li>
					</ul>
				</div>
			</div>
				<p class="postbody">{{$post->body}}</p>
			</div>
		</div>
	</div>
	<div class="span12" style="height:2px;background-color:#C6E2CC;float:left;"></div>
	@if(Auth::user())
	<div class="row">
		<div class="span11 offset1 commentsection">
			
			<div class="row">
				<div class="writecomment">
					<form class="form-horizontal" method="POST" action="{{ URL::action('CommentController@store')}}?post_id={{$post->id}}"  id="upload-comment-form">
						<div class="span2 commentpost">
							@if(Auth::user()->accountUser()->identifier == 0)
								<a href="{{ URL::action('UserController@visitAccount',array(Auth::user()->id)) }}">
									<img class="img-rounded" src="{{ url(Auth::user()->accountUser()->getImagePathname()) }}" alt="" width="100">
								</a>
							@else
							<a href="{{ URL::action('UserController@visitAccount',array(Auth::user()->id)) }}">
								<img class="img-rounded" src="{{ url(Auth::user()->accountUser()->facebookpic) }}" alt="" width="100">
							</a>
							@endif
						</div>
							<div class="control-group">
								<div class="controls">
									<textarea name="textcomment" class="input-xxlarge pull-left" id="commenttext" rows="5" placeholder="Enter text ..."></textarea>
								</div>
							</div>	
						</div>
					</form>
				</div>
			</div>
			
		</div>
	</div>
	@endif
	<div class="row commentsattach">
	@foreach($post->comments as $comment)
	
		<div class="span11 offset1 commentsection">	
			<div class="comments">
				<div class="well">
					
					<div class="row">
						<div class="span5 pull-right">
							<h6 class="pull-right">Posted by: {{$comment->user->first_name}} {{$comment->user->last_name}}</h6>
						</div>
					</div>

					<div class="row">

						<div class="span1">
							@if($comment->user->accountUser()->identifier == 0)
								<a href="{{ URL::action('UserController@visitAccount',array($comment->user->id)) }}">
									<img class="img-rounded" src="{{ url($comment->user->accountUser()->getImagePathname()) }}" alt="" width="75">
								</a>
							@else
								<a href="{{ URL::action('UserController@visitAccount',array($comment->user->id)) }}">
									<img class="img-rounded" src="{{ url($comment->user->accountUser()->facebookpic) }}" alt="" width="75">
								</a>
							@endif
						</div>

						<div class="span7">
							<h6>{{$comment->body}}</h6>
						</div>
					</div>
					<div class="row">
						<div class="span5 pull-right">
							<h6 class="pull-right">{{$comment->created_at}}</h6>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
</div>
	
	
<div class="modal hide fade" id="delete-post-{{ $post->id }}">
	<form class="form-horizontal" method="POST" action="{{ URL::action('PostController@destroy', array($post->id)) }}">
		<input type="hidden" name="_method" value="DELETE">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h3>Delete post</h3>
		</div>
		<div class="modal-body">
			<p>Are you sure you want to delete this post?</p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Cancel</button>
			<input class="btn btn-danger" type="submit" value="Delete page">
		</div>
	</form>
</div>

<div class="modal hide fade" id="share-post-{{ $post->id }}">
	<form class="form-horizontal" method="POST" action="{{ URL::action('PostController@share', array($post->id)) }}" id="upload-share-form">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h3>Share post</h3>
		</div>
		<div class="modal-body">
			<textarea name="textshare" class="input-xxlarge pull-left" rows="5" id="inputTextarea" placeholder="Enter message ..."></textarea>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Cancel</button>
			<input class="btn btn-danger" type="submit" value="Post to facebook!">
		</div>
	</form>
</div>

@stop

@section('scripts')
	@parent

	$("#commenttext").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#upload-comment-form").submit();
        $("#commenttext").val('');
    }
});

	 $("#post").click(function(){ 

	$.post('/post/like/' + {{$post->id}},
	function(data)
	{
		var likecount = {{count($post->likes)}}+1;
		$('.likevalue').remove();
		counttext="<span class='badge badge-inverse likevalue'>"+likecount+"</span>";
		$('.likeref').append(counttext);
		$('#post').hide();
	});
});

$(".playlist").click(function(){ 

	var searchVal = $(this).val();

	var postid = {{$post->id}}

	$.post('/post/addplaylist/?playlistid='+searchVal+'&postid='+postid,
	function(data)
	{
	
	});

});

$("#share").click(function(){ 
 	console.log('succes');
	$.get('/post/share/' + {{$post->id}},
	function(data)
	{
		console.log('succes');
		$('#share').hide();
	});
});

@if(Auth::user())
// Ajax file upload for the file upload modal.
$("#upload-comment-form").ajaxForm({
	data: { 'ajax': 'true' },
	dataType: 'json',
	success: function(data) {
	console.log(data.date.date);
	
			
	var comment = "<div class='span11 offset1 commentsection'><div class='comments'><div class='well' id='comment"+ data.id +"'><div class='row'><div class='span5 pull-right'><h6 class='pull-right'>Posted by: {{Auth::user()->first_name}} {{Auth::user()->last_name}}</h6></div></div><div class='row'><div class='span1'>@if(Auth::user()->accountUser()->identifier == 0)<a href='{{ URL::action('UserController@visitAccount',array(Auth::user()->id)) }}'><img class='img-rounded' src='{{ url(Auth::user()->accountUser()->getImagePathname()) }}' alt='' width='75'></a>@else<a href='{{ URL::action('UserController@visitAccount',array(Auth::user()->id)) }}'><img class='img-rounded' src='{{ url(Auth::user()->accountUser()->facebookpic) }}' alt='' width='75'></a>@endif</div><div class='span7'><h6>"  + data.body + "</h6></div></div><div class='row'><div class='span5 pull-right'><h6 class='pull-right'>" + data.date.date + "</h6></div></div></div></div></div>";
	
	$(".commentsattach").append(comment);

	// Hide the upload modal.
	$("#comment-post").modal('hide');

	}
});
@endif
// Ajax file upload for the file upload modal.
$("#upload-share-form").ajaxForm({
	data: { 'ajax': 'true' },
	dataType: 'json',
	success: function(data) {
	console.log('kak');
	// Hide the upload modal.
	$("#share-post-{{ $post->id }}").modal('hide');

	}
});
@stop

