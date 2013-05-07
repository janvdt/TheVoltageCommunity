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
<div class="row">
	<div class="span12">
		<div class="pagination pagination-centered">
			{{$followers->links()}}
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
  $('.activity').infinitescroll({
 
    navSelector  : ".pagination",            
                   // selector for the paged navigation (it will be hidden)
    nextSelector : ".pagination ul li a",    
                   // selector for the NEXT link (to page 2)
    itemSelector : ".log",          
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