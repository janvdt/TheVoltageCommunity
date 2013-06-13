@extends('instance.layout')

@section('instanceContent')
<div class="span12">
	<div class="row headervisit">
		<div class="span1 greyprofile">
			
		</div>
		<div class="span2 profilepicture">
			@if($user->accountUser()->image_id != 0 or $user->accountUser()->facebookpic == NULL )
				<img class="img-polaroid" src="{{ url($user->accountUser()->getImagePathname()) }}" alt="" width="162px">
			@else
				<img class="img-polaroid" src="{{ url($user->accountUser()->facebookpic) }}" alt="" width="162">
			@endif
		</div>
		<div class="span1 greyprofile">
			
		</div>
		<div class="span6">
			<p class="namevisit">{{$user->first_name}} {{$user->last_name}}</p>
			<img src="/images/lightning.png" width="50">
			@foreach($tastes as $taste)
			{{$taste->name}},
			@endforeach
			<a class="btn" href="{{ URL::action('AccountController@editTaste', array($user->accountuser()->id)) }}">
				<i class="icon-pencil"></i>
			</a>
			<div class="row">
			<div class="span2">
				<img src="/images/{{$user->accountuser()->levels->first()->image}}" width="50">{{$user->accountuser()->levels->first()->value}}
			</div>
			<div class="progress progress-info progress-striped scorebar progressbalk span4">
  				<div class="bar" style="width: {{$user->accountUser()->points->value}}%"></div>{{$user->accountUser()->points->value}}%
			</div>
		</div>
		</div class="span2">
			<a href="{{ URL::action('AccountController@edit', array($user->accountUser()->id)) }}" class="btn btn-inverse editaccount">Edit Account</a>
		</div>
	</div>

<div class="span3" id="sticky">
	<div class="row">
		<div class="span3 infoaccount">
			<div class="span3 info">
				<p class="infofont">Social</p>
			</div>
			<div class="span3">
				<div class="pull-left">
				<p class="followcount">Following ({{count($following)}})</p>
				@foreach($following as $follow)
				@if($follow->account->facebookpic == NULL)
				<img class="img-rounded" src="{{ url($follow->account->getImagePathname()) }}" alt="" width="25">
				@else
				<img class="img-rounded" src="{{ url($follow->account->facebookpic) }}" alt="" width="25">
				@endif
				@endforeach
			</div>

			<div class="pull-right followers">
				<p class="followcount">Followers ({{count($followers)}})</p>
				@foreach($followers as $follower)
					<img class="img-rounded" src="{{ url($follower->accountfollower->getImagePathname()) }}" alt="" width="25">
				@endforeach
			</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span3 infoaccount">
			<div class="span3 info">
				<p class="infofont">Biography</p>
			</div>
			<div class="span3">
				<p>{{$user->accountUser()->biography}}</p>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="span3 infoaccount">
			<div class="span3 info">
				<p class="infofont">Music</p>
			</div>
			<a href="{{ URL::action('AccountController@visitmusicposts', array($user->id)) }}"><p class="musiccount">Musicposts ({{count($musicposts)}})</p></a>
			<ul class="nav nav-pills">
				@foreach($shortmusicposts as $shortmusicpost)
					<li class="accountposts">
						<a href="{{ URL::action('PostController@showMusic', array($shortmusicpost->id)) }}">
						@if($shortmusicpost->soundcloud_art != NULL)
								<img src="{{ url($shortmusicpost->soundcloud_art) }}" alt="" width="90" border="0">
							@else
								<img src="{{ url($shortmusicpost->youtube_art) }}" alt="" width="90" height="80px" border="0">
							@endif

							</a>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="span3 infoaccount">
			<div class="span3 info">
				<p class="infofont">Playlists</p>
			</div>
			<a href="{{ URL::action('PlaylistController@index') }}"><p class="musiccount">Playlists ({{count($playlists)}})</p></a>
			<ul class="nav nav-pills">
				@foreach($playlists as $playlist)
					<li class="accountposts">
						@if($playlist->posts->first() != NULL)
							<a href="{{ URL::action('PlaylistController@show', array($playlist->id)) }}"><img class="avatar img-polaroid" src="{{ $playlist->posts->first()->soundcloud_art }}" alt="" width="90"></a>
						@else
							<a href="{{ URL::action('PlaylistController@show', array($playlist->id)) }}"><img class="avatar img-polaroid" src="http://placehold.it/90x90&text=Playlist" alt="" width="90"></a>
						@endif
					</li>
				@endforeach
			</ul>
		</div>
	</div>

	<div class="row">
		<div class="span3 infoaccount">
			<div class="span3 info">
				<p class="infofont">Graphics</p>
			</div>
			<a href="{{ URL::action('AccountController@visitgraphposts', array($user->id)) }}"><p class="musiccount">Graphicposts ({{count($graphposts)}})</p></a>
			<ul class="nav nav-pills">
				@foreach($shortgraphposts as $shortgraphpost)
					<li class="accountposts">
						<a href="{{ URL::action('PostController@showGraph', array($shortgraphpost->id)) }}">
							<img class="avatar visitgraph" src="/{{ $shortgraphpost->image->getSize('original')->getPathname() }}" alt="" width="90" height="90px">
						</a>
					</li>
				@endforeach
			</ul>
		</div>
	</div>

	
</div>
<div class="span7 offset1">
	<h2>Activity</h4>
	<div class="span6 messagesection">
			Message
			@if(Auth::user())
			<div class="row">
				<div class="writemessage">
					<form class="form-horizontal" method="POST" action="{{ URL::action('AccountController@storeMessage')}}?account_id={{$user->accountUser()->id}}"  id="upload-message-form">
						<div class="span2 messagepost">
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
						<div class="row">
							
							<textarea name="textmessage" class="input-xlarge pull-left" id="messagetext" rows="5" placeholder="Enter text ..."></textarea>
						</div>	
						</div>
					</form>
				</div>
			</div>
			@endif
			
	<div class="row">
		<div class="offset1 span4">
			<ul class="visitaccountlog nav">
				@foreach($notifications as $notification)
					@if($user->accountUser()->id == $notification->account_id and  $notification->account_id != 0)
					<li class="activity">
						<div class="row log">
							<div class="span4">
								<div class="pull-left">
									<p class="visitaccounttitle">
										<a href="{{ URL::action('UserController@visitAccount',array($notification->user->id)) }}">
										@if($notification->user->accountUser()->image_id != 0 or $notification->user->accountUser()->facebookpic == NULL )
										<img src="{{ url($notification->user->accountUser()->getImagePathname()) }}" width="30" alt="">
										@else
										<img src="{{ url($notification->user->accountUser()->facebookpic) }}" width="30" alt="">
										@endif
										</a>
										{{$notification->user->first_name}} {{$notification->user->last_name}} {{$notification->	body}}
									</p>
								</div>
									
								<div class="pull-right">
									<h6>{{$notification->created_at}}<h6>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="offset span4">
								@if($notification->type == 2 or $notification->type == 5 )
									<div class="alert alert-success">
										<h6>{{$notification->text}}</h6>
									</div>
								@endif
							</div>
						</div>
						<hr>
					</li>
					

					@elseif($notification->user_id == $user->id and $notification->account_id == 0)
					@if($notification->type == 6)
					<li class=" activity">
						<div class="row log">
							<div class="span4">
								<div class="pull-left">
									<p class="visitaccounttitle">
									{{$notification->user->first_name}} {{$notification->user->last_name}} {{$notification->body}}</p>
								</div>
								
								<div class="pull-right">
									<h6>{{$notification->created_at}}<h6>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="offset span4">
								<h5>{{$notification->post->title}}</h5>
								@if($notification->type == 2)
									<div class="alert alert-success">
										<h6>{{$notification->text}}</h6>
									</div>
								@endif
								<a class="" href="{{URL::action('PostController@showMusic',array($notification->post_id)) }}">
									<img class="avatar" src="/{{ $notification->post->image->getSize('original')->getPathname() }}" alt="">
								</a>
							</div>
						</div>
						<hr>
					</li>
					@endif
					@if($notification->type != 6 and $notification->type != 7)
					<li class=" activity">
						<div class="row log">
							<div class="span4">
								<div class="pull-left">
									<p class="visitaccounttitle">
									{{$notification->user->first_name}} {{$notification->user->last_name}} {{$notification->body}}</p>
								</div>
								
								<div class="pull-right">
									<h6>{{$notification->created_at}}<h6>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="offset span4">
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
						<hr>
					</li>
					@endif
					@if($notification->type == 7)
					<li class=" activity">
						<div class="row log">
							<div class="span4">
								<div class="pull-left">
									<p class="visitaccounttitle">
									{{$notification->user->first_name}} {{$notification->user->last_name}} {{$notification->body}}</p>
								</div>
								
								<div class="pull-right">
									<h6>{{$notification->created_at}}<h6>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="offset span4">
								<h5>{{$notification->playlist->title}}</h5>
								@if($notification->playlist->posts->first() != NULL)
									<a href="{{ URL::action('PlaylistController@show', array($notification->playlist->id)) }}"><img class="avatar img-polaroid" src="{{ $notification->playlist->posts->first()->soundcloud_art }}" alt="" width="500"></a>
								@else
									<a href="{{ URL::action('PlaylistController@show', array($notification->playlist->id)) }}"><img class="avatar img-polaroid" src="http://placehold.it/500x500&text=Playlist" alt="" width="500"></a>
								@endif
							</div>
						</div>
						<hr>
					</li>
					@endif
					
					@endif
					
				@endforeach
			</ul>
		</div>
	</div>
</div>



@stop

@section('scripts')
	@parent

$("#messagetext").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#upload-message-form").submit();
        $("#messagetext").val('');
    }
});

@if(Auth::user())
// Ajax file upload for the file upload modal.
$("#upload-message-form").ajaxForm({
	data: { 'ajax': 'true' },
	dataType: 'json',
	success: function(data) {
	
	
		var message = "<li class='activity'><div class='row log'><div class='span4'><div class='pull-left'><p class='visitaccounttitle'><a href=''>@if(Auth::user()->accountUser()->image_id != 0 or Auth::user()->accountUser()->facebookpic == NULL )<img src='{{ url(Auth::user()->accountUser()->getImagePathname()) }}' width='30' alt=''>@else<img src='{{ url(Auth::user()->accountUser()->facebookpic) }}' width='30' alt=''>@endif</a> {{Auth::user()->first_name}} {{Auth::user()->last_name}} " + data.text + "</p></div><div class='pull-right'><h6>" + data.date.date +"<h6></div></div></div><div class='row'><div class='offset span4'><div class='alert alert-success'><h6>" + data.body + "</h6></div></div></div></li>";
	
	
	$(".visitaccountlog").prepend(message);


	}
});
@endif

$('.pagination ul li:not(:last)').remove();
$('.pagination').hide();
// infinitescroll() is called on the element that surrounds 
// the items you will be loading more of
  $('.visitaccountlog').infinitescroll({
 
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