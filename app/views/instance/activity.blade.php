@extends('instance.layout')

@section('instanceContent')
<script src="//connect.soundcloud.com/sdk.js"></script>
<script>
  SC.initialize({
    client_id: "706bb7625906c6e65ff8bb1bebdd22b7",
  });
</script>
<div class="row">
<div class="span11">
	<h2>Activity log </h2>
</div>
</div>
<div class="row span11">
<ul class="activitylog nav">
	@foreach($notifications as $notification)
		@if($notification->following($notification->user->accountUser()->id))
			@if($notification->activity == TRUE)
				@if($notification->user_id != Auth::user()->id)
				@if($notification->post_id == 0)
				<li class=" activity">
					<ul class="nav nav-pills  activityref offset8">
  						<li class="dropdown">
    						<a class="dropdown-toggle activityref" data-toggle="dropdown" href="#">
        						<i class="icon-th-large"></i>
        						<b class="caret"></b>
      						</a>
    						
    						<ul class="dropdown-menu">
    							</li>
    								<a href="#unfollow-{{ $notification->user->accountUser()->id }}" data-toggle="modal"><h6><i class="icon-user"></i> Unfollow!</h6></a>
    							</li>
    						</ul>
  						</li>
					</ul>
						<div class="row log">
							<div class="span6 offset2">
								<div class="pull-left">
									<p class="activitytitle">
										<a href="{{ URL::action('UserController@visitAccount',array($notification->user->id)) }}">
										@if($notification->user->accountUser()->image_id != 0 or $notification->user->accountUser()->facebookpic == NULL )
										<img src="{{ url($notification->user->accountUser()->getImagePathname()) }}" width="50" alt="">
										@else
										<img src="{{ url($notification->user->accountUser()->facebookpic) }}" width="50" alt="">
										@endif
										</a>
										{{$notification->user->first_name}} {{$notification->user->last_name}} {{$notification->	body}} on <a href="{{ URL::action('UserController@visitAccount',array(Account::Find($notification->account_id)->user->id)) }}">{{Account::Find($notification->account_id)->user->first_name}} {{Account::Find($notification->account_id)->user->last_name}}</a> wall
									</p>
								</div>
									
								<div class="pull-right">
									<h6>{{$notification->created_at}}<h6>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="offset3 span5">
								@if($notification->type == 2 or $notification->type == 5 )
									<div class="alert alert-success">
										<h6>{{$notification->text}}</h6>
									</div>
								@endif
							</div>
						</div>
					</li>
				@else
					<li class=" activity">
						<ul class="nav nav-pills  activityref offset8">
  									<li class="dropdown">
    									<a class="dropdown-toggle activityref" data-toggle="dropdown" href="#">
        									<i class="icon-th-large"></i>
        									<b class="caret"></b>
      									</a>
    									<ul class="dropdown-menu">
    										
    										<li class="fbshare"><a href="#share-post-{{ $notification->post->id }}" data-toggle="modal"><h6><img src="/images/facebook-logo-square.png" width="20" height="20"> Post to facebook!</h6></a></li>
    										<li>
    											<a href="#unfollow-{{ $notification->user->accountUser()->id }}" data-toggle="modal"><h6><i class="icon-user"></i> Unfollow!</h6></a>
    										</li>
    									</ul>
  									</li>
								</ul>
						<div class="row log">
							<div class="span6 offset2">
								<div class="pull-left">
									<p class="activitytitle">
									<a href="{{ URL::action('UserController@visitAccount',array($notification->user_id)) }}">
									@if($notification->user->accountUser()->image_id != 0 or $notification->user->accountUser()->facebookpic == NULL )
										<img src="{{ url($notification->user->accountUser()->getImagePathname()) }}" width="50" alt="">
									@else
										<img src="{{ url($notification->user->accountUser()->facebookpic) }}" width="50" alt="">
									@endif
									</a>
									{{$notification->user->first_name}} {{$notification->user->last_name}} {{$notification->body}}</p>
								</div>
								<div class="pull-right">
									<h6>{{$notification->created_at}}<h6>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="offset3 span5">
								<h5>{{$notification->post->title}}</h5>
								@if($notification->type == 2)
								<div class="alert alert-success">
									<h6>{{$notification->text}}</h6>
								</div>
								@endif
								@if($notification->post->type == 'graph')
								<a class="" href="{{URL::action('PostController@showGraph',array($notification->post_id)) }}">
									<img class="avatar" src="/{{ $notification->post->image->getSize('original')->getPathname() }}" alt="">
								</a>
								@else
								<a class="" href="{{URL::action('PostController@showMusic',array($notification->post_id)) }}">
									@if($notification->post->soundcloud_art != NULL)
										<img class="img-rounded soundcloudactivity" src="{{ url($notification->post->soundcloud_art) }}" alt="" width="500">
									@else
										<img class="img-rounded" src="{{ url($notification->post->youtube_art) }}" alt="" width="500">
									@endif
								</a>
								@endif
							</div>
						</div>
						<div class="row">
							<div class="offset3">
								<span class="badge badge-inverse">{{count($notification->post->comments)}} <i class="icon-comment"></i></span>
								<span class="badge badge-inverse">{{count($notification->post->likes)}} <i class="icon-heart"></i></span>
							</div>
						</div>
						@if($notification->type == 1)
						<div class="row">
						@if($notification->post->soundcloud != NULL)
							<div id="postsoundcloudactivity{{$notification->post->id}}" class="span5 offset3">
								<div id="putTheWidgetHere"></div>
								
							</div>
						@else
							<div class="video-container">
								<iframe class="youtube-player" type="text/html" width="640" height="385" src="http://www.youtube.com/embed/{{$notification->post->youtube}}" allowfullscreen 			frameborder="0">
								</iframe>
							</div>
						@endif
						</div>
						@endif
						<hr>
						<div class="modal hide fade" id="share-post-{{ $notification->post->id }}">
							<form class="form-horizontal" method="POST" action="{{ URL::action('PostController@share', array($notification->post->id)) }}" id="upload-share-form">
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

						<div class="modal hide fade" id="unfollow-{{ $notification->user->accountUser()->id }}">
							<form class="form-horizontal" method="POST" action="{{ URL::action('AccountController@unfollow', array($notification->user->accountUser()->id)) }}" id="unfollow-form">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h3>Share post</h3>
								</div>
								<div class="modal-body">
									Are you sure you wan't to unfollow this person?
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal">Cancel</button>
									<input class="btn btn-danger" type="submit" value="Unfollow">
								</div>
							</form>
						</div>
					</li>
					@endif
				@endif
			@endif
		@endif
	@endforeach
</ul>
</div>
<div class="row">
		<div class="span12">
			<div class="pagination pagination-centered">
				{{ $notifications->links() }}
			</div>
		</div>
	</div>
@stop

@section('scripts')
	@parent

$('.pagination ul li:not(:last)').remove();
$('.pagination').hide();
// infinitescroll() is called on the element that surrounds 
// the items you will be loading more of
  $('.activitylog').infinitescroll({
 
    navSelector  : ".pagination",            
                   // selector for the paged navigation (it will be hidden)
    nextSelector : ".pagination ul li a",    
                   // selector for the NEXT link (to page 2)
    itemSelector : ".activity",          
                   // selector for all items you'll retrieve
    loading: {
        finished: undefined,
        finishedMsg: "<em>Congratulations</em>",
        img: "/images/loader.gif",
        msg: null,
        msgText: "<em>Loading the next set of posts...</em>",
        selector: null,
        speed: 'fast',
        start: undefined
    }
});



@stop
