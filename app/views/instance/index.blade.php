@extends('instance.layout')

@section('instanceContent')
		<div class="span12 welcome">

			<div class="span5">
				<a href="#" id="playintro">
					<img src="/images/logo2.png" width="200">
				</a>
			</div>
			<div class="welcomecontent span6 pull-right">
				<p class="welcometitle">YOUR MIX OF MUSIC</p>
				<p class="welcometext">Come home to the Voltage community, a great place to browse through the latest music while finding inspiration for your creativity and 
 your kind of people !
Finally meet the designers and music lovers who share the same passion as you.
<br>
<br>
We give you the space, you give us the music ! 
<a href="{{ URL::route('login') }}" class="btn btn-inverse go"><i class="icon-chevron-right"></i></a>
				</p>
				
			</div>
		</div>

<div class ="span12 music">
	<h2>Music</h2>
	<div class="row homemusic">
		<ul class="ch-grid homegrid nav nav-pills music-posts">
			@foreach ($musicposts as $musicpost)
				
					<li class= "musicpost" id="{{$musicpost->id}}" value="{{$musicpost->id}}">
    				<div class="row">
    					<div class="span3 titlemusicpost">
    						<h6>
    						@if(Auth::user())
    						<a href="{{ URL::action('UserController@visitAccount',array($musicpost->createdBy()->id)) }}">
    						@if($musicpost->createdBy()->accountUser()->image_id != 0 or $musicpost->createdBy()->accountUser()->facebookpic == NULL )
								<img src="{{ url($musicpost->createdBy()->accountUser()->getImagePathname()) }}" width="25" alt="">
							@else
								<img src="{{ url($musicpost->createdBy()->accountUser()->facebookpic) }}" width="25" alt="">
							@endif
							</a>
							@endif
    						<?php $string = $musicpost->title;
							$maxLength = 40;

						if (strlen($string) > $maxLength) {
    					$stringCut = substr($string, 0, $maxLength);
    					$string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
						}

						echo stripslashes("$string</h6>")
						?>
						
    					</div>
    				</div>
    				
    					
    				<div class="test">
    					<a href ="{{ URL::action('PostController@showMusic', array($musicpost->id)) }}">
        			@if($musicpost->soundcloud_art != NULL)
        			<div class="ch-item ch-img-1 soundcloudimg" style="background-image: url({{$musicpost->soundcloud_art}});">
        			@else
        			<div class="ch-item ch-img-1 youtubeimg" style="background-image: url({{$musicpost->youtube_art}});">
        			@endif
        			
        				
            			
            			
        			</div>
        		</a>

        			</div>
        			
        			<div class="viewslikes span3">
        				<div class="pull-left">
        					<div class="pull-left">
        						@if($musicpost->soundcloud != NULL)
									<a href="{{$musicpost->soundcloud}}" class="stratus"><i class="icon-play"></i></a>
								@else
									<a value="{{$musicpost->youtube}}" href="#youtube-post-{{ $musicpost->youtube }}" data-toggle="modal" id="play" class="playyoutube"><i class="icon-film"></i></a>
									
							
								@endif
        						<i class='icon-eye-open watch'></i>
        						<span class="badge badge-inverse">{{$musicpost->views}}</span></i>
        					</div>
        				</div>
        				<div class="">
        					<div class="pull-left likes">
        						<img src="/images/lightning.png" width="15" height="15">
        						<span class="badge badge-inverse">{{count($musicpost->likes)}}</span></i>
   
        					</div>
        				</div>

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
		<ul class="ch-grid homegrid nav nav-pills music-posts">
			@foreach ($graphposts as $graphpost)
				
					<li class= "musicpost">
						<div class="row">
							<div class="span3 titlemusicpost">
								<h6>
								@if(Auth::user())
								<a href="{{ URL::action('UserController@visitAccount',array($graphpost->createdBy()->id)) }}">
    								@if($graphpost->createdBy()->accountUser()->image_id != 0 or $graphpost->createdBy()->accountUser()->facebookpic == NULL )
										<img src="{{ url($graphpost->createdBy()->accountUser()->getImagePathname()) }}" width="25" alt="">
									@else
										<img src="{{ url($graphpost->createdBy()->accountUser()->facebookpic) }}" width="25" alt="">
									@endif
								</a>
								@endif
								<?php $string = $graphpost->title;
								$maxLength = 40;

									if (strlen($string) > $maxLength) {
    									$stringCut = substr($string, 0, $maxLength);
    									$string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
									}

								echo stripslashes("$string</h6>")
								?>
							</div>
						</div>

						<div class="test">
							<a href ="{{ URL::action('PostController@showGraph', array($graphpost->id)) }}">
								@if($graphpost->image_id != 0)
									<div class="ch-item ch-img-1" style="background-image: url(/{{ $graphpost->image->getSize('thumb')->getPathname() }});">
								@endif
								</div>
							</a>
						</div>

						<div class="span3">
        					<div class="pull-left">
        						<div class="pull-left">
        							<i class='icon-eye-open watch'></i>
        							<span class="badge badge-inverse">{{$graphpost->views}}</span></i>
        						</div>
        					</div>
        					
        					<div class="">
        						<div class="pull-left likes">
        							<img src="/images/lightning.png" width="15" height="15">
        							<span class="badge badge-inverse">{{count($graphpost->likes)}}</span></i>
   								</div>
        					</div>
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

	$('.tracks-overview-home').on('click',".playyoutube",function() {

 	var youtube = $(this).attr('value');

 	console.log(youtube);

 	 jQuery.iLightBox([
		{
			URL: "http://www.youtube.com/embed/"+ youtube + ""
		}
	]);
	
});

$("#playintro").click(function(){

	 jQuery.iLightBox([
		{
			URL: "http://player.vimeo.com/video/68196007?autoplay=1"
		}
	]);
});

$("musicpost").stratus({
      color: 'c6e2cc'
              
    });


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
                 	$searchuser = "<li id='searchresultuser span3'><div class='span1 searchimg'><img src='" + returnData[i].image +"' width='30'></div><div class='span2'><h6><a href='http://tvcbeta3.eu1.frbit.net/user/visitaccount/"+ returnData[i].id +"'>"+ returnData[i].first_name + " "+returnData[i].last_name +"</a></h6></div></li>";

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
