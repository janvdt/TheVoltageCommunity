@extends('instance.layout')

@section('instanceContent')
<div class="span12">
	<h4>Welcome {{$user->first_name}} {{$user->last_name}} </h4>
</div>
<div class="row">
	<div class="span12">
		<div class="span4">
			<a href="{{ URL::action('AccountController@edit', array($user->accountUser()->id)) }}" class="btn btn-primary">Edit Account</a><br />
			@if(Auth::user()->accountUser()->image_id != 0 or Auth::user()->accountUser()->facebookpic == NULL )
			<img src="{{ url($user->accountUser()->getImagePathname()) }}" alt="">
			@elseif(Auth::user()->accountUser()->facebookpic != NULL)
			<img src="{{ url($user->accountUser()->facebookpic) }}" alt="">
			@endif
		</div>

		<div class="span4">
			<h4>Biografie</h4>
			<p class="span4">{{$user->accountUser()->biography}}</p>
		</div>
		<div class="span3">
			<h4>Social</h4>
			<div class="pull-left">
				<h5>Following</h5>
				<p>{{count($following)}}</p>
				@foreach($following as $follow)
				@if($follow->account->facebookpic == NULL)
				<img class="img-rounded" src="{{ url($follow->account->getImagePathname()) }}" alt="" width="25">
				@else
				<img class="img-rounded" src="{{ url($follow->account->facebookpic) }}" alt="" width="25">
				@endif
				@endforeach
			</div>

			<div class="pull-right">
				<h5>Followers</h5>
				<p>{{count($followers)}}</p>
				@foreach($followers as $follower)
					<img class="img-rounded" src="{{ url($follower->accountfollower->getImagePathname()) }}" alt="" width="25">
				@endforeach
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="span12">
		<div class="span4">
			<h4>Your Music Posts</h4>
			<ul class="nav">
				@foreach($musicposts as $musicpost)
					<li class="span3 accountmusicpost">
						<a href="#delete-post-{{ $musicpost->id }}" data-toggle="modal" class="btn btn-danger pull-right">Delete</a>
						@if($musicpost->image_id != 0)
							<img class="img-rounded" src="{{ url($musicpost->image->getPathname()) }}" alt="" width="100">
						@else
							@if($musicpost->soundcloud_art != NULL)
								<img class="img-rounded" src="{{ url($musicpost->soundcloud_art) }}" alt="" width="100">
							@else
								<img class="img-rounded" src="{{ url($musicpost->youtube_art) }}" alt="" width="100">
							@endif
						@endif
						<a href="{{ URL::action('PostController@showMusic', array($musicpost->id)) }}">{{$musicpost->title}}</a>
					</li>
					<div class="modal hide fade" id="delete-post-{{ $musicpost->id }}" >
					
						<form class="form-horizontal" method="POST" action="{{ URL::action('PostController@destroy', array($musicpost->id)) }}" >
							<input type="hidden" name="_method" value="DELETE">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h3>Delete Post</h3>
							</div>
							<div class="modal-body">
								<p>Are you sure you want to delete this post?</p>
							</div>
							<div class="modal-footer">
								<button class="btn" data-dismiss="modal">Cancel</button>
								<input class="btn btn-danger" type="submit" value="Delete image">
							</div>
						</form>
					</div>
				@endforeach
			</ul>
		</div>

		<div class="span4">
			<h4>Your Graph Posts</h4>
			<ul>
				@foreach($graphposts as $graphpost)
					<li class="span3"><a href="">{{$graphpost->title}}</a> <a href="" data-toggle="modal" class="btn btn-danger pull-right">Delete</a></li>
				@endforeach
			</ul>
		</div>
	</div>
</div>


@stop