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
<div class="row span11 lognoti music">
@if($notifications == NULL)
<p>You have currently no activitylogs</p>
@endif
<ul class="activitylog nav">
	@foreach($notifications as $notification)
		@if($notification->following($notification->user->accountUser()->id))
			@if($notification->activity == TRUE)
				@if($notification->user_id != Auth::user()->id)
				@if($notification->post_id == 0 and $notification->type == 7 )
				<li class=" activity">
					<ul class="nav nav-pills  activityref offset8">
  						<li class="dropdown">
    						<a class="dropdown-toggle activityref" data-toggle="dropdown" href="#">
        						<i class="icon-th-large"></i>
        						<b class="caret"></b>
      						</a>
    						
    						<ul class="dropdown-menu">
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
										<a href="{{ URL::action('UserController@visitAccount',array($notification->user->id)) }}">
										@if($notification->user->accountUser()->image_id != 0 or $notification->user->accountUser()->facebookpic == NULL )
										<img src="{{ url($notification->user->accountUser()->getImagePathname()) }}" width="50" alt="">
										@else
										<img src="{{ url($notification->user->accountUser()->facebookpic) }}" width="50" alt="">
										@endif
										</a>
										{{$notification->user->first_name}} {{$notification->user->last_name}} {{$notification->body}}
									</p>
								</div>
									
								<div class="pull-right">
									<h6>{{$notification->created_at}}<h6>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="offset3 span5">
									<a href="{{ URL::action('PlaylistController@show', array($notification->playlist->id)) }}">
									@if($notification->playlist->posts->first() != NULL and $notification->playlist->posts->first()->soundcloud != NULL )
										<div class="sliderz-img ch-img-1 soundimgsliderz offset3 span5" style="background-image: url({{ $notification->playlist->posts->first()->soundcloud_art }});">
									@elseif($notification->playlist->posts->first() != NULL)
									<div class="sliderz-img ch-img-1 soundimgsliderz offset3 span5" style="background-image: url({{ $notification->playlist->posts->first()->youtube_art }});">
									@endif
									@if($notification->playlist->posts->first() == NULL)
										<div class="sliderz-img ch-img-1 youtubeimgsliderz" style="background-image: url(http://placehold.it/500x500&text=Playlist);">
									@endif
									</div>
								</a>
							</div>
						</div>
					</li>
				@endif
				@if($notification->post_id == 0 and $notification->type != 7)
				<li class=" activity">
					<ul class="nav nav-pills  activityref offset8">
  						<li class="dropdown">
    						<a class="dropdown-toggle activityref" data-toggle="dropdown" href="#">
        						<i class="icon-th-large"></i>
        						<b class="caret"></b>
      						</a>
    						
    						<ul class="dropdown-menu">
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
							<div class="offset2 span6">
								@if($notification->type == 2 or $notification->type == 5 )
									<div class="alert alert-success">
										<h6>{{$notification->text}}</h6>
									</div>
								@endif
							</div>
						</div>
					</li>
				@endif
				@if($notification->post_id == 0 and $notification->type == 5)
				<li class=" activity">
					<ul class="nav nav-pills  activityref offset8">
  						<li class="dropdown">
    						<a class="dropdown-toggle activityref" data-toggle="dropdown" href="#">
        						<i class="icon-th-large"></i>
        						<b class="caret"></b>
      						</a>
    						
    						<ul class="dropdown-menu">
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
							<div class="offset2 span6">
								@if($notification->type == 2 or $notification->type == 5 )
									<div class="alert alert-success">
										<h6>{{$notification->text}}</h6>
									</div>
								@endif
							</div>
						</div>
					</li>
				@endif
				@if($notification->type != 7 and $notification->type != 5  )
					<li class=" activity">
						<ul class="nav nav-pills  activityref offset8">
  									<li class="dropdown">
    									<a class="dropdown-toggle activityref" data-toggle="dropdown" href="#">
        									<i class="icon-th-large"></i>
        									<b class="caret"></b>
      									</a>
    									<ul class="dropdown-menu">
    										@if(Auth::user()->identifier != 0)
    										<li class="fbshare"><a href="#share-post-{{ $notification->post->id }}" data-toggle="modal"><h6><img src="/images/facebook-logo-square.png" width="20" height="20"> Post to facebook!</h6></a></li>
    										@endif
    										<li>
    											<a href="#unfollow-{{ $notification->user->accountUser()->id }}" data-toggle="modal"><h6><i class="icon-user"></i> Unfollow!</h6></a>
    										</li>
    										<li>
    								<a id="share" href="#share-post-{{ $notification->post->id }}" data-toggle="modal"><img src= "/images/facebook.png" width="20" /> Facebook</a>
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
									<div class="sliderz-img ch-img-1 soundimgsliderz offset3 span5" style="background-image: url({{ $notification->post->image->getSize('medium')->getPathname() }});">
									</div>

								</a>
								@else
								<a class="" href="{{URL::action('PostController@showMusic',array($notification->post_id)) }}">
									@if($notification->post->soundcloud_art != NULL)
										<div class="sliderz-img ch-img-1 soundimgsliderz" style="background-image: url({{ $notification->post->soundcloud_art }});">
									@else
										<div class="sliderz-img ch-img-1 youtubeimgsliderz" style="background-image: url({{$notification->post->youtube_art}});">
									@endif
									</div>
								</a>
								@endif
							</div>
						</div>
						@if($notification->type == 1 and $notification->type != 5)
						<div class="row offset4">
							@if($notification->post->soundcloud != NULL)
								<div class="playacc">
									<a href="{{$notification->post->soundcloud}}" class="stratus" value="{{$notification->post->id}}" style="text-decoration: none;">
										<i class=" icon-2x icon-play playlisticon"></i>
									</a>
								</div>
							@else
							<div class="watchacc">
								<a value="{{$notification->post->youtube}}" href="#youtube-post-{{ $notification->post->youtube }}" data-toggle="modal" id="play" class="playyoutube">
									<i class=" icon-2x icon-film"></i>
								</a>
							</div>
							@endif
						</div>
						@endif
						<hr>
						<div class="modal hide fade" id="share-post-{{ $notification->post->id }}">
							<form class="form-horizontal" method="POST" action="{{ URL::action('PostController@activityshare', array($notification->post->id)) }}" id="upload-share-form">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h3>Share post</h3>
								</div>
								<div class="modal-body">
									<textarea name="textshare" class="input-xxlarge pull-left" rows="5" id="inputTextarea" placeholder="Enter message ..."></textarea>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal">Cancel</button>
									<input class="btn btn-inverse" type="submit" value="Post to facebook!">
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

$("activity").stratus({
      color: 'c6e2cc'
              
    });

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

if ($('.activitylog li').length == 0) {$('.lognoti').append("<h5>You currently have no activitylogs. Please make sure that you are following Voltage Community members</h5>")}

$('.activitylog').on('click',".playyoutube",function() {

 	var youtube = $(this).attr('value');

 	console.log(youtube);

 	 jQuery.iLightBox([
		{
			URL: "http://www.youtube.com/embed/"+ youtube + ""
		}
	]);
	
});
@stop
