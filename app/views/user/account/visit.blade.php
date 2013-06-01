@extends('instance.layout')

@section('instanceContent')
<div class="span12">
	<div class="row">
		<div class="span4 headervisit">
			@if($user->accountUser()->image_id != 0 or $user->accountUser()->facebookpic == NULL )
				<img src="{{ url($user->accountUser()->getImagePathname()) }}" alt="">
			@else
				<img src="{{ url($user->accountUser()->facebookpic) }}" alt="">
			@endif
		</div>
		<div class="span4">
			@if(Auth::user() or Session::has('hybridAuth'))
			<div class="span3 socialbutton">
				<h3>Follow!</h3>
				@if(Auth::user())
					@if($user->accountUser()->canFollow(Auth::user()->accountUser()->id,$user->accountUser()->id))
						<a class="btn btn-primary" id="follow"><i class="icon-star"> Follow !</i></a>
					@else
						<a class="btn btn-danger" id="unfollow"><i class="icon-star-empty"> Unfollow !</i></a>
					@endif
				@else
					@if($user->accountUser()->canFollow($facebookuser->accountUser()->id,$user->accountUser()->id))
						<a class="btn btn-primary" id="follow"><i class="icon-star"> Follow !</i></a>
					@else
						<a class="btn btn-danger" id="unfollow"><i class="icon-star-empty"> Unfollow !</i></a>
					@endif
				@endif
			@endif
			</div>
		</div>
	</div>
</div>
<div class="span3">
	<div class="row">
		<div class="span3 infoaccount">
			<div class="span3 info">
				<p class="infofont">INFO</p>
			</div>
			<div class="span3">
				<div class="row">
					<p class="infofont">{{$user->first_name}} {{$user->last_name}}</p>
				</div>

				<div class="row">
					<p class="infofont">Music taste</p>
					<ul class="nav tastes">
						@foreach($tastes as $taste)
						<li>{{$taste->name}}</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span3 infoaccount">
			<div class="span3 info">
				<p class="infofont">MY MUSIC</p>
			</div>
			<a href=""><p class="infofont">Musicposts ({{count($musicposts)}})</p></a>
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
				<p class="infofont">MY GRAPHICS</p>
			</div>
			<a href=""><p class="infofont">Graphicposts ({{count($graphposts)}})</p></a>
			<ul class="nav nav-pills">
				@foreach($shortgraphposts as $shortgraphpost)
					<li class="accountposts">
						<a href="{{ URL::action('PostController@showGraph', array($shortgraphpost->id)) }}">
							<img src="{{ $shortgraphpost->image->getSize('original')->getPathname() }}" alt="" width="90" border="0">
						</a>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>

<div class="span6 offset1">
	<h2>Activity</h4>
	<div class="span5 messagesection">
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
		<div class="span6">
			<ul class="visitaccountlog nav">
				@foreach($notifications as $notification)
					@if($user->accountUser()->id == $notification->account_id and  $notification->account_id != 0)
					<li class=" activity">
						<div class="row log">
							<div class="span5">
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
					</li>
					<hr>

					@elseif($notification->user_id == $user->id and $notification->account_id == 0)
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
									@if($notification->post->soundcloud_art != NULL)
										<img class="img-rounded soundcloudactivity" src="{{ url($notification->post->soundcloud_art) }}" alt="" width="500">
									@else
										<img class="img-rounded" src="{{ url($notification->post->youtube_art) }}" alt="" width="500">
									@endif
								</a>
							</div>
						</div>
					</li>
					<hr>
					@endif
					
				@endforeach
			</ul>
		</div>
	</div>
</div>

@stop

@section('scripts')
	@parent

	 $("#follow").click(function(){ 

	$.post('/account/follow/' + {{$user->accountUser()->id}},
	function(data)
	{
		$("#follow").hide();
		var button = "<a class='btn btn-danger' id='unfollow'><i class='icon-star-empty'></i></a>";
		$(".socialbutton").append(button);
	});
});

	 $("#unfollow").click(function(){ 

	$.post('/account/unfollow/' + {{$user->accountUser()->id}},
	function(data)
	{
		$("#unfollow").hide();
		var button = "<a class='btn btn-primary' id='follow'><i class='icon-star'></i></a>";
		$(".socialbutton").append(button);
	});
});

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
	
	
		var message = "<li class='activity'><div class='row log'><div class='span4'><div class='pull-left'><p class='visitaccounttitle'>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</p></div><div class='pull-right'><h6>" + data.date.date +"<h6></div></div></div></li>";
	
	
	$(".visitaccountlog").prepend(message);


	}
});
@endif

@stop