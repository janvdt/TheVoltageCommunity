@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
	<div class="row">
		<div class="span10">
			<h2>Playlists</h2>
		</div>
	</div>

<ul class="thumbnails">
@foreach($playlists as $playlist)
	<li class="span3">
		<div class="row">
			<div class="pull-right copybutton">
				<a class=" btn btn-inverse add" name="{{$playlist->id}}" value="{{$playlist->id}}" id="{{$playlist->id}}"><i class="icon-plus"> get this playlist</i></a>
			</div>
		</div>

		<div class="thumbnail">
			@if($playlist->posts->first() != NULL)
			<a href="{{ URL::action('PlaylistController@showplaylist', array($playlist->id)) }}"><img class="avatar img-polaroid" src="{{ $playlist->posts->first()->soundcloud_art }}" alt="" width="250"></a>
			@else
			<a href="{{ URL::action('PlaylistController@showplaylist', array($playlist->id)) }}"><img class="avatar img-polaroid" src="http://placehold.it/250x250&text=Playlist" alt="" width="250"></a>
			@endif
			<div class="title">
				<h5 class="playlisttitle">{{$playlist->title}}</h5>
			</div>
		</div>
	</li>
@endforeach
</ul>
</div>
<div class="stratusplayer">
</div>
@stop

@section('scripts')
	@parent

if ($('.thumbnails li').length == 0) {$('.music').append("<h5>There are currently no playlists available.</h5>")}


$("#playlist").addClass('active');


 $(".add").click(function(){

 	var playlist = $(this).attr('value');

 	console.log(playlist);

 	$(this).hide();

 	$.get('/playlist/copy/' +playlist,
	function(data)
	{
		

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

$("#suggestions").hide();
	
	$('#searchDatauser').keyup(function() {

 	var searchVal = $(this).val();
 	$("#suggestions").show();
 	if(searchVal !== '') {
 
            $.get('playlist/search?searchData='+searchVal, function(returnData) {
                /* If the returnData is empty then display message to user
                 * else our returned data results in the table.  */
                if (!returnData) {
                    $('.music-posts').html('<p style="padding:5px;">Search term entered does not return any data.</p>');
                } 
                else 
                {
                	
					console.log(returnData);
                	$('#suggestions div').each(function(i)
					{
						$(this).css("display", "none");
   						
					});

                 	for (var i = 0; i < returnData.length; i++) {
                 	
    				if(returnData[i].id !== undefined)
    				{
    					console.log(returnData[i].first_name);
                 	$searchuser = "<li id='searchresultuser span3'><div class='span1 searchimg'><img src='" + returnData[i].image +"' width='30'></div><div class='span2'><h6><a href='http://tvc.loc/user/visitaccount/"+ returnData[i].id +"'>"+ returnData[i].first_name + " "+returnData[i].last_name +"</a></h6></div></li>";

                 	$("#suggestions").append($searchuser);
                 	}

					}  
    				
                }
            });
        } else {
            $('#suggestions').empty();
            $("#suggestions").hide();
			
        }
 
    });

@stop