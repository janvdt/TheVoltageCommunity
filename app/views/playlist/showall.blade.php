@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
	<div class="row">
		<div class="span10">
			<h2>Playlists</h2>
		</div>
	</div>

<ul>
@foreach($playlists as $playlist)
	<li class="span3 playlistpost">
		<div class="span2 authorplaylist">
		<a href="{{ URL::action('UserController@visitAccount',array($playlist->account->id)) }}">
    		<h6>
    		@if($playlist->account->image_id != 0 or $playlist->account->facebookpic == NULL )
				<img src="{{ url($playlist->account->getImagePathname()) }}" width="30" alt="">
			@else
				<img src="{{ url($playlist->account->facebookpic) }}" width="30" alt="">
			@endif
			 {{$playlist->account->user->first_name}} {{$playlist->account->user->last_name}}</h6>
		</a>
		</div>
		<div class="span1 pull-right btnplus">
			<a class="btn btn-inverse add" value="{{$playlist->id}}"><i class="icon-plus"></i></a>
		</div>
		<div class="thumbnail">
			<a href="{{ URL::action('PlaylistController@showplaylist', array($playlist->id)) }}"><img class="avatar img-polaroid" src="{{ $playlist->posts->first()->soundcloud_art }}" alt="" width="250"></a>
			<div class="title">
				<h5 class="playlisttitle">{{$playlist->title}}</h5>
				<a class='play' value="{{$playlist->id}}"><i class="icon-play"></i></a>
			</div>
		</div>
	</li>
@endforeach
</div>
<div class="stratusplayer">
</div>
@stop

@section('scripts')
	@parent

 $(".add").click(function(){

 	var playlist = $(this).attr('value');

 	console.log(playlist);

 	$.get('/playlist/copy/' +playlist,
	function(data)
	{
		$('.add').hide();
	});

	
});
$(".play").click(function(){

var playlistid = $(this).attr('value');
console.log(playlistid);
$('.stratusplayer').empty();

$.get('playlistsound?playlistid='+playlistid, function(returnData) {

    if (!returnData) 
    {
        
    } 
    else 
    {
    	console.log(returnData.url);
 		var script   = document.createElement("script");
		script.type  = "text/javascript";    // use this for linked script
		script.text  = "$('.playlistpost').stratus({links: '"+ returnData.url +"',auto_play: true,random: true,color: 'c6e2cc'});"
		$('.stratusplayer').append(script);
	}
});


});

@stop