@extends('instance.layout')

@section('instanceContent')
		<div class="span12 welcome">
			<div class="welcomecontent span6">
				<p class="welcometitle">YOUR MIX OF MUSIC</p>
				<p class="welcometext">The Voltage Community is a place to share what fuels your creativity, and discover what inspires others.
					Built by people who love music, for designers, this is your one-stop shop for creative inspiration.
				</p>
			</div>
			<div class="span5 getstarted">
				<div class="pull-right">
					@if(Auth::user())
					<img src="/images/lightninglight.png"/ width="75">
					
					@else
					<a href="{{ URL::route('login') }}" class="btn btn-large btn-inverse"><img src="/images/lightninglight.png"/ width="75">Power up!</a>
					@endif
				</div>
			</div>
		</div>


<div class ="span12 tracks-overview-home">
	<h2>Music</h2>
	<div class="row homemusic">
		<ul class="ch-grid nav nav-pills music-posts">
			@foreach ($musicposts as $musicpost)
				
					<li class= "musicpost span3">
						<a href ="{{ URL::action('PostController@showMusic', array($musicpost->id)) }}">
						@if($musicpost->image_id != 0)
							<div class="ch-item ch-img-1" style="background-image: url(/{{ $musicpost->image->getSize('thumb')->getPathname() }});">
						@else
						@if($musicpost->soundcloud_art != NULL)
							<div class="ch-item ch-img-1 soundcloudimg" style="background-image: url({{$musicpost->soundcloud_art}});">
						@else
							<div class="ch-item ch-img-1 youtubeimg" style="background-image: url({{$musicpost->youtube_art}});">
						@endif
						@endif

						<div class="ch-info">
							<?php 
								$string = $musicpost->title;
								$maxLength = 40;

								if (strlen($string) > $maxLength) {
									$stringCut = substr($string, 0, $maxLength);
									$string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
								}

								echo "<h3>$string</h3>"
							?>
							
								<a class="link" href=""></a>
							
            			</div>
        			</div>
        			</a>
        			<div class="row accountpost">
        				@if($musicpost->createdBy()->accountUser()->image_id != 0 or $musicpost->createdBy()->accountUser()->	facebookpic == NULL )
							<img src="{{ url($musicpost->createdBy()->accountUser()->getImagePathname()) }}" width="25" alt="">
						@else
							<img src="{{ url($musicpost->createdBy()->accountUser()->facebookpic) }}" width="25" alt="">
						@endif
						{{$musicpost->createdBy()->first_name}} {{$musicpost->createdBy()->last_name}}
					</div>
    				</li>
			@endforeach
		</ul>
	
		<div class="shelf">
			<div class="bookend_left"></div>
			<div class="bookend_right"></div>
			<div class="reflection"></div>
		</div>
	</div>
</div>

<div class ="span12 tracks-overview-home">
	<h2>Graphics</h2>
	<div class="row">
		<ul class="ch-grid nav nav-pills music-posts">
			@foreach ($graphposts as $graphpost)
				
					<li class= "musicpost span3">
						<a href ="{{ URL::action('PostController@showGraph', array($graphpost->id)) }}">
						@if($graphpost->image_id != 0)
							<div class="ch-item ch-img-1" style="background-image: url(/{{ $graphpost->image->getSize('thumb')->getPathname() }});">
						@endif

						<div class="ch-info">
							<?php 
								$string = $graphpost->title;
								$maxLength = 40;

								if (strlen($string) > $maxLength) {
									$stringCut = substr($string, 0, $maxLength);
									$string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
								}

								echo "<h3>$string</h3>"
							?>
							
								<a class="link" href=""></a>
							
            			</div>
        			</div>
        			</a>
        			<div class="row accountpost">
        				@if($graphpost->createdBy()->accountUser()->image_id != 0 or $graphpost->createdBy()->accountUser()->	facebookpic == NULL )
							<img src="{{ url($graphpost->createdBy()->accountUser()->getImagePathname()) }}" width="25" alt="">
						@else
							<img src="{{ url($graphpost->createdBy()->accountUser()->facebookpic) }}" width="25" alt="">
						@endif
						{{$graphpost->createdBy()->first_name}} {{$graphpost->createdBy()->last_name}}
					</div>
    				</li>
			@endforeach
		</ul>
	
		<div class="shelf span12">
			<div class="bookend_left"></div>
			<div class="bookend_right"></div>
			<div class="reflection"></div>
		</div>
	</div>
</div>




@stop

@section('scripts')
	@parent


	$("#home").addClass('active');

$("#suggestions").hide();
	
	$('#searchDatauser').keyup(function() {

 	var searchVal = $(this).val();
 	$("#suggestions").show();
 	if(searchVal !== '') {
 
            $.get('search?searchData='+searchVal, function(returnData) {
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
                 	$searchuser = "<li id='searchresultuser span3'><div class='span1 searchimg'><img src='" + returnData[i].image +"' width='30'></div><div class='span2'><h6><a href='http://thevoltagecommunity.com/user/visitaccount/"+ returnData[i].id +"'>"+ returnData[i].first_name + " "+returnData[i].last_name +"</a></h6></div></li>";

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
