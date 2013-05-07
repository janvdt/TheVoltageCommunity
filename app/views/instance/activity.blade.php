@extends('instance.layout')

@section('instanceContent')

<div class="span11">
<h2>Activity log </h2>
</div>
<div class="row">
	<div class="span11 offset1 activity">
		@foreach($followers as $follower)
			@foreach($follower->account->user->notifications as $notification)
				@if($notification->activity == TRUE)
				<div class="row log">
					<div class="span6 offset2">
						
							<div class="pull-right">
								{{$notification->post->created_at}}
							</div>
						<a href="{{ URL::action('UserController@visitAccount',array($notification->user_id)) }}">
						<img class="img-rounded" src="{{ url($notification->user->accountUser()->getImagePathname()) }}" alt="" width="50"></a>
						{{$notification->user->first_name}} {{$notification->body}}
						<div class="row">
							<div class="offset1">
								<h5>{{$notification->post->title}}</h5>
								<a class="" href="{{URL::action('PostController@showMusic',array($notification->post_id)) }}">
  									@if($notification->post->soundcloud_art != NULL)
									<img class="img-rounded" src="{{ url($notification->post->soundcloud_art) }}" alt="" width="300">
									@else
									<img class="img-rounded" src="{{ url($notification->post->youtube_art) }}" alt="" width="300">
								@endif
							</a>
						</div>
						</div>
					</div>
				</div>
				<hr>
				@endif
			@endforeach
		@endforeach
	</div>
</div>

@stop
