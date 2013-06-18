@extends('diy.layout')

@section('content')
<div class="row">
	<div class="span4">
		<img src="/images/logofooter.png" width="300">
	</div>
<div class=" offset2 span6 navigation">
	<div class="container menu clearfix pull-right">
		<div class="navbar navbar_">
			<div class="container">
				 <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse_">Menu <span class="icon-bar"></span> </a>
				<div class="nav-collapse nav-collapse_  collapse menu">
	                <ul class="nav sf-menu">
	                	<li id="home"><a href="{{URL::to("/")}}">Home</a></li>
						<li id="music"><a href="{{ URL::action('MusicController@index') }}">Music</a></li>
						<li id="playlist"><a href="{{ URL::action('PlaylistController@showAll') }}">Playlists</a></li>
						<li id="diy"><a href="{{ URL::action('TurntableController@index') }}?scratch=1">DIY</a></li>
						<li id="graph"><a href="{{ URL::action('GraphController@index') }}">Graphics</a></li>
						@if(Auth::user())
						<li id="graph"><a href="{{ URL::action('AccountController@showscores') }}">Scores</a></li>
						<li id="feedback"><a href="{{ URL::action('FeedbackController@index') }}">Feedback</a></li>
						@endif
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div>
	@if(Auth::user())
		<h2>{{Auth::user()->first_name}} show us what you got</h2>
	@endif
	<div id="tt-wrapper-wrapper">
		<div id="tt-wrapper">
			<div id="tt-container">
				<div id="tt-1" class="turntable">
					<div class="body">
						<div class="platter">
							<div class="ring">
							</div>
						<div class="record">
					<div class="record-ui">
				<div class="slipmat"></div>
				<div class="slipmat slipmat-y"></div>
				<div class="slipmat slipmat-f"></div>
				<div class="grooves"></div>
				<div class="loader"></div>
				<div class="label"></div>
				<div class="label-notches"></div>
			</div>
			<div class="spindle"></div>
			<div class="shiny"></div>
			<div class="cover"></div>
		</div>
	</div>

	<div class="powerlight">
		<div class="powerlight-on"></div>
	</div>
	<div class="tonearm">
   	<img src="image/table_tonearm.png" alt="" class="tonearm-image" />
  </div>

	<div class="pitch-box scratch-mode">
		<div class="pitch">
			<div class="label">pitch adj.</div>
				<div class="legend">
					<ul class="markers">
						<li>-8<span>■</span></li>
						<li>-</li>
						<li>6<span>■</span></li>
						<li>-</li>
						<li>4<span>■</span></li>
						<li>-</li>
						<li>2<span>■</span></li>
						<li>-</li>
						<li>&mdash;</li>
						<li>-</li>
						<li>2<span>■</span></li>
						<li>-</li>
						<li>4<span>■</span></li>
						<li>-</li>
						<li>6<span>■</span></li>
						<li>-</li>
						<li>+8<span>■</span></li>
					</ul>
				</div>
    			<div class="rail"></div>
					<div class="pitch-slider" title="Pitch control">
						<div class="shade-top"></div>
						<div class="shade-bottom"></div>
						<div class="pitch-line"></div>
					</div>
    			<div class="control-pitch-slider-text"></div>
   				
   				 <div class="pitch-box-hider">
     				<input id="tt-1-pitch-slider" class="control-pitch-slider-input" type="range" min="0" max="160" value="80" />
    			</div>
    		</div>
  		</div>

  		<div class="powerdial-led"></div>
  		<a href="#110vac" title="Power on/off" class="powerdial" onclick="return false">on / off</a>
		<a href="#onoff" title="start/stop" class="startstop" onclick="return false">start &middot; stop</a>
		<a href="#33rpm" title="33 RPM" class="rpm-33" onclick="return false"><span>33rpm</span></a>
		<a href="#45rpm" title="45 RPM" class="rpm-45" onclick="return false"><span>45rpm</span></a>
 	</div>

	<div id="tt-1-waveform" class="waveform">
		<div class="loader"></div>
		<div class="waveform-1">
			<div class="playhead"></div>
			<div class="playhead-arrow"></div>
		</div>
		<div class="waveform-2">
			<div class="playhead-arrow compact"></div>
		</div>
 	</div>
</div>

<div id="tt-2" class="turntable">
	<div class="body">
		<div class="platter">
			<div class="ring"></div>
			<div class="record">
				<div class="record-ui">
				<div class="slipmat"></div>
				<div class="slipmat slipmat-y"></div>
				<div class="slipmat slipmat-f"></div>
				<div class="grooves"></div>
				<div class="loader"></div>
				<div class="label"></div>
				<div class="label-notches"></div>
			</div>
			<div class="spindle"></div>
			<div class="shiny"></div>
			<div class="cover"></div>
		</div>
  	</div>
 	
 	<div class="powerlight">
 		<div class="powerlight-on"></div>
 	</div>

	<div class="tonearm">
		<img src="image/table_tonearm.png" alt="" class="tonearm-image" />
	</div>

	<div class="pitch-box scratch-mode">
		<div class="pitch">
			<div class="label">pitch adj.</div>
			<div class="legend">
				<ul class="markers">
					<li>-8<span>■</span></li>
					<li>-</li>
					<li>6<span>■</span></li>
					<li>-</li>
					<li>4<span>■</span></li>
					<li>-</li>
					<li>2<span>■</span></li>
					<li>-</li>
					<li>&mdash;</li>
					<li>-</li>
					<li>2<span>■</span></li>
					<li>-</li>
					<li>4<span>■</span></li>
					<li>-</li>
					<li>6<span>■</span></li>
					<li>-</li>
					<li>+8<span>■</span></li>
				</ul>
			</div>
			
			<div class="rail"></div>
			<div class="pitch-slider">
				<div class="shade-top"></div>
				<div class="shade-bottom"></div>
				<div class="pitch-line"></div>
   			 </div>
    		
			<div class="control-pitch-slider-text"></div>
				<div class="pitch-box-hider">
					<input id="tt-2-pitch-slider" class="control-pitch-slider-input" type="range" min="0" max="160" value="80" />
				</div>
			</div>
		</div>

		<div class="powerdial-led"></div>
		<a href="#110vac" title="Power on/off" class="powerdial" onclick="return false">on / off</a>
		<a href="#onoff" title="start/stop" class="startstop" onclick="return false">start &middot; stop</a>
		<a href="#33rpm" title="33 RPM" class="rpm-33" onclick="return false"><span>33rpm</span></a>
		<a href="#45rpm" title="45 RPM" class="rpm-45" onclick="return false"><span>45rpm</span></a>
	</div>

	<div id="tt-2-waveform" class="waveform">
		<div class="loader"></div>
		<div class="waveform-1">
			<div class="playhead"></div>
   			<div class="playhead-arrow"></div>
		</div>
		
		<div class="waveform-2">
			<div class="playhead-arrow compact"></div>
		</div>
	</div>
</div>

<div id="mixer">
	<form id="mixer-form" action="#" onsubmit="return false">
		<div id="mixer-options">
			<div style="position:absolute;top:0px;left:0px;margin-top:-20px" class="scratch-mode">
				<input id="use-eq" name="use-eq" type="checkbox" title="Toggle experimental EQ (hi/mid/low frequency filters)" /> <label for="use-eq" title="Toggle experimental EQ (hi/mid/low frequency filters)">EQ</label>
			</div>
			
			<div style="position:absolute;top:0px;right:0px;margin-top:-1.55em;margin-right:0.5em">
				
			</div>
		</div>

		<div id="channel-1-gain" class="mixer-panel">
			<div class="bd">
				<ul class="pots">
				<li><input id="tt-1-gain" name="tt-1-gain" type="range" title="Gain (channel 1)" min="1" max="100" value="50" class="control-eq" data-table-id="0" data-type="gain" />
     			<div id="tt1-gain" title="Gain (channel 1)" class="pot"></div>
    			</li>
    			</ul>
			</div>
		</div>

		<div id="channel-2-gain" class="mixer-panel right-panel">
			<div class="bd">
				<ul class="pots">
					<li>
						<input id="tt-2-gain" name="tt-2-gain" type="range" title="Gain (channel 2)" min="1" max="100" value="50" class="control-eq" data-table-id="1" data-type="gain" />
						<div id="tt2-gain" title="Gain (channel 2)" class="pot"></div>
					</li>
				</ul>
			</div>
		</div>

		<div id="channel-1-eq" class="mixer-panel scratch-mode-inline-block">
			<div class="bd">
				<ul class="pots">
					<li>
						<input id="tt-1-eq-2" name="tt-1-eq-2" type="range" title="Hi EQ (channel 1)" min="10" max="100" value="50" class="control-eq" data-type="eq" data-table-id="0" data-eq-offset="2" />
						<div id="tt1-eq2" title="High EQ (channel 1)" class="pot"></div>
					</li>

					<li>
						<input id="tt-1-eq-1" name="tt-1-eq-1" type="range" title="Mid EQ (channel 1)" min="10" max="100" value="50" class="control-eq" data-type="eq" data-table-id="0" data-eq-offset="1" />
						<div id="tt1-eq1" title="Mid EQ (channel 1)" class="pot"></div>
					</li>
					
					<li>
						<input id="tt-1-eq-0" name="tt-1-eq-0" type="range" title="Low EQ (channel 1)" min="10" max="100" value="50" class="control-eq" data-type="eq" data-table-id="0" data-eq-offset="0" />
						<div id="tt1-eq0" title="Low EQ (channel 1)" class="pot"></div>
					</li>
 				</ul>
 			</div>
		</div>

		<div id="channel-2-eq" class="mixer-panel right-panel scratch-mode-inline-block">
			<div class="bd">
				<ul class="pots">
					<li>
						<input id="tt-2-eq-2" type="range" title="Hi EQ (channel 2)" min="10" max="100" value="50" class="control-eq" data-type="eq" data-table-id="1" data-eq-offset="2" />
						<div id="tt2-eq2" title="Hi EQ (channel 2)" class="pot"></div>
					</li>

					<li>
						<input id="tt-2-eq-1" type="range" title="Mid EQ (channel 2)" min="10" max="100" value="50" class="control-eq" data-type="eq" data-table-id="1" data-eq-offset="1" />
						<div id="tt2-eq1" title="Mid EQ (channel 2)" class="pot"></div>
					</li>

					<li>
						<input id="tt-2-eq-0" type="range" title="Low EQ (channel 2)" min="10" max="100" value="50" class="control-eq" data-type="eq" data-table-id="1" data-eq-offset="0" />
						<div id="tt2-eq0" title="Low EQ (channel 2)" class="pot"></div>
					</li>
				</ul>
			</div>
		</div>

		<div class="mixer-panel">
			<div class="bd">
				<div id="upfader-1" class="upfader" data-id="tt-1-upfader">
					<div class="upfader-ui" title="Upfader (channel 1)">
					<div class="rail"></div>
					<div class="upfader-slider">
						<div class="shade-top"></div>
						<div class="shade-bottom"></div>
						<div class="line"></div>
						<div class="upfader-cover" data-id="tt-1-upfader"></div>
					</div>
				</div>
				<input id="tt-1-upfader" type="range" title="Upfader (channel 1)" min="1" max="100" value="75" class="control-upfader" data-type="upfader" data-table-id="0" data-id="tt-1-upfader" />
			</div>
		</div>
	</div>

	<div class="mixer-panel right-panel">
		<div class="bd">
			<div id="upfader-2" class="upfader" data-id="tt-2-upfader">
				<div class="upfader-ui" title="Upfader (channel 2)">
					<div class="rail"></div>
					<div class="upfader-slider">
						<div class="shade-top"></div>
						<div class="shade-bottom"></div>
						<div class="line"></div>
						<div class="upfader-cover" data-id="tt-2-upfader"></div>
					</div>
				</div>
				<input id="tt-2-upfader" type="range" min="1" max="100" value="75" class="control-upfader" data-type="upfader" data-table-id="1" data-id="tt-2-upfader" />
			</div>
		</div>
	</div>
	
	<div class="x-fader-panel mixer-panel full-panel">
		<div class="bd">
			<div id="crossfader-1" class="crossfader" data-id="crossfader-1">
				<div class="crossfader-ui" title="Crossfader" >
					<div class="rail"></div>
					<div class="crossfader-slider">
						<div class="shade-top"></div>
						<div class="shade-bottom"></div>
						<div class="line"></div>
						<div class="crossfader-cover" data-id="crossfader-1"></div>
					</div>
				</div>
    			<input id="control-xfader" name="control-xfader" type="range" title="Crossfader" min="0" max="100" value="50" class="x-fader" />
			</div>
		</div>
 	</div>
</form>
</div>

<form id="loader-form-1" action="." method="get" class="loader-form">
	<input id="loader-form-1-unload" type="button" title="Unload track" value="X" />
	<input id="track1" name="track1" type="text" value="" title="MP3 URL or SoundCloud ID to load (turntable 1)" autocomplete="false" spellcheck="false" onfocus="this.select()" />
	<input id="loader-form-1-submit" type="submit" title="Load this URL" value="&rarr;" />
</form>

<form id="loader-form-2" action="." method="get" class="loader-form">
	<input id="loader-form-2-unload" type="button" title="Unload track" value="X" />
	<input id="track2" name="track2" type="text" value="" title="MP3 URL or SoundCloud ID to load (turntable 2)" autocomplete="false" spellcheck="false" onfocus="this.select()" />
	<input id="loader-form-2-submit" type="submit" title="Load this URL" value="&rarr;" />
</form>



</div>

<!-- /tt-wrapper -->
</div>

<!-- /tt-wrapper-wrapper -->
</div>
<div class="row">
	<div class="span5">
		<h5> Just click for the left-deck </h5>
	</div>
	<div class="span5 pull-right">
		<h5> Press shift+click for the right-deck </h5>
	</div>
</div>

<div id="content span12">
	<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
 
		<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
 
			<!-- Be sure to leave the brand out there if you want it shown -->
			<a class="brand" href="#">Look what's inside my recordbag</a>
 
			<!-- Everything you want hidden at 940px or less, place within here -->
			<div class="nav-collapse collapse">
			<!-- .nav, .navbar-search, .navbar-form, etc -->
			<ul class="nav">
				
			</ul>
			<form class="navbar-search pull-right" action="">
                 <input type="text" class="search-query span2" id="searchData" placeholder="Search">
			</form>
			</div>
		</div>
	</div>
</div>
	<div id="the-music">
		<div class="row">
			<ul class="ch-grid nav nav-pills music-posts" id="music-posts">
				@foreach ($musicposts as $musicpost)
					@if($musicpost->soundcloud_id != 0)
						<li class= "musicpost" id="{{$musicpost->id}}" value="{{$musicpost->id}}">
							<div class="row">
								<div class="span3 titlemusicpost">
									<h6>
										<a href="{{ URL::action('UserController@visitAccount',array($musicpost->createdBy()->id)) }}">
										@if($musicpost->createdBy()->accountUser()->image_id != 0 or $musicpost->createdBy()->accountUser()->facebookpic == NULL )
											<img src="{{ url($musicpost->createdBy()->accountUser()->getImagePathname()) }}" width="30" alt="">
										@else
											<img src="{{ url($musicpost->createdBy()->accountUser()->facebookpic) }}" width="30" alt="">
										@endif
										</a>
										
										<?php $string = $musicpost->title;
										
										$maxLength = 50;

										if (strlen($string) > $maxLength) {
										$stringCut = substr($string, 0, $maxLength);
										$string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
										}

										echo stripslashes("$string</h6>")
										?>
								</div>
							</div>
    				
    						<div class="test">
    							<a href="#" data-track-id="{{$musicpost->soundcloud_id}}" oncontextmenu="return false">
									@if($musicpost->image_id != 0)
										<div class="ch-item ch-img-1" style="background-image: url(/{{ $musicpost->image->getSize('thumb')->getPathname() }});">
									@else
										@if($musicpost->soundcloud_art != NULL)
											<div class="ch-item ch-img-1 soundcloudimg" style="background-image: url({{$musicpost->soundcloud_art}});">
										@else
											<div class="ch-item ch-img-1 youtubeimg" style="background-image: url({{$musicpost->youtube_art}});">
										@endif
        							@endif
        							</div>
        						</a>
        					</div>
							<div class="shelf shelfmusicpost">
							<div class="bookend_left"></div>
							<div class="bookend_right"></div>
							<div class="reflection"></div>
						</div>
						</li>
            		@endif
            	@endforeach
            </ul>
		</div>
	</div>
</div>
</div>
<div class="row">
	<div class="span12">
		<div class="pagination pagination-centered">
			{{ $musicposts->links() }}
		</div>
	</div>
</div>

 <script type="text/javascript">
$(document).ready(function(){
	$("#diy").addClass('active');
$('.pagination ul li:not(:last)').remove();
$('.pagination').hide();
// infinitescroll() is called on the element that surrounds 
// the items you will be loading more of
  $('.music-posts').infinitescroll({
 
    navSelector  : ".pagination",            
                   // selector for the paged navigation (it will be hidden)
    nextSelector : ".pagination ul li a",    
                   // selector for the NEXT link (to page 2)
    itemSelector : ".musicpost",          
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
    },
  // trigger Masonry as a callback
  function( newElements ) {
   
    
});
$('#searchData').keyup(function() {
 	var searchVal = $(this).val();

 	if(searchVal !== '') {
 
            $.get('turntable/search?searchData='+searchVal, function(returnData) {
                /* If the returnData is empty then display message to user
                 * else our returned data results in the table.  */
                if (!returnData) {
                    $('.music-posts').html('<p style="padding:5px;">Search term entered does not return any data.</p>');
                } 
                else 
                {
                	$('.music-posts li').each(function(i)
					{
						$(this).css("display", "none");
   						
					});
                	for (var i = 0; i < returnData.length; i++) {
                 	console.log(returnData);
    				if(returnData[i].id !== undefined)
    				{
                 	$searchpost = "<li class='musicpost' id='searchresults'><div class='row'><div class='span3 titlemusicpost'><h6><a href='#' data-track-id='"+ returnData[i].soundcloudid + "' oncontextmenu='return false'>"+ returnData[i].title +"</a></h6></div></div>@if(" + returnData[i].soundcloud_art +" !=  null)<div class='ch-item ch-img-1 soundcloudimg' style='background-image: url("+ returnData[i].soundcloud_art + ");'>@endif @if(" + returnData[i].youtube_art +" !=  null)<div class='ch-item ch-img-1 youtubeimg' style='background-image: url("+ returnData[i].youtube_art + ");'>@endif<a href ='http://tvctheme.loc/post/showmusic/"+ returnData[i].id +"'></div></a></div><div class='shelf shelfmusicpost'><div class='bookend_left'></div><div class='bookend_right'></div><div class='reflection'></div></div></li>";

                 	$(".music-posts").append($searchpost);
                 	}

					}  
                }
            });
        } else {
            $('.music-posts li').each(function(i)
			{
				$(this).css("display", "block");
				$('#searchresults').remove();
			});""
        }
 
    });
});

document.body.className = ['has_js tvc'];


</script>
@stop




