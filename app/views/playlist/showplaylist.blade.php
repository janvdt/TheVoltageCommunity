@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
<div class="row">
	<div class="span10">
		<h2>{{$playlist->title}}</h2>
	</div>
</div>

<div class="row">
<div class="span6 offset2">
	@if($playlist->posts->first()->youtube != NULL)
	<div class="youtubeplayer">
    <div class="yt_holder">
        <div id="ytvideo" style="z-index:1;"></div>
            <!--Up and Down arrow -->
  			<div class="you_up"><img src="/images/up_arrow.png" alt="+ Slide" title="HIDE" /></div>
  			<div class="you_down"><img src="/images/down_arrow.png" alt="- Slide" title="SHOW" /></div>
            <!-- END  -->
			<div class="youplayer">
				<ul class="videoyou">
	            <?php
	            /***************************************************************************
	            //youtube playlist jquery plugin Html5 Gdata Api v2  : 4.0
	            //released:             : Sep 12 2012
	            //copyright             : Copyright © 2012 cfconsultancy
	            //email                 : info@cfconsultancy.nl
	            //website               : http://www.cfconsultancy.nl
	            ***************************************************************************/
	            // Use like this.
	            include_once('class/class.youtubelist.php');

                

                //This part is the foreach list
	            if ( $playlist->posts !=null ) {
	                foreach ($playlist->posts as $musicpost) {
	                    echo '<li><p>' . $musicpost->title . '</p><span class="time">' . 100 . '</span><a class="videoThumb" href="http://www.youtube.com/watch?v=' . $musicpost->youtube . '">' . $musicpost->body . '</a></li>';
	                }
	            }else{
	                echo '<li>Sorry, no video\'s found</li>';
	            }
	            //End list
	            ?>
       			</ul>
	      		<!-- remove this if you don't want anyone to change the results -->
	      		<!-- END -->
        </div>
        <!-- Remove if you don't want the footer shadow -->
        <div style="height:0px; font-size:0em;clear:both;">&nbsp;</div>
        <div class="ytfooter">&nbsp;</div>
        <!-- END -->
    </div>
</div>
@endif
</div>
</div>

<div class="row">
	<ul class="ch-grid playlistgrid nav nav-pills music-posts" id="sortableplaylist">
		@foreach ($playlist->posts as $musicpost)
    		<li class= "musicpost" id="{{$musicpost->id}}" value="{{$musicpost->id}}">
    			<div class="row" data-playlist-id="{{ $playlist->id }}" data-post-id="{{ $musicpost->id }}">
    				<div class="span3 titlemusicpost">
    					<h6>
    						
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

        			<div class="viewslikes span2">
        				<div class="pull-left">
        					<div class="pull-left">
        						@if($playlist->type != 'youtube')
        						<a href="{{$musicpost->soundcloud}}" class="stratus"><i class="icon-play"></i></a>
        						@endif
        					</div>
        				</div>
        			</div>
        			
        			<div class="shelf shelfmusicpost">
					<div class="bookend_left"></div>
					<div class="bookend_right"></div>
					<div class="reflection"></div>
					</div>

    			</li>
    			
    			
    		@endforeach
		</ul>
	</div>
</div>

@stop

@section('scripts')
	@parent


$("musicpost").stratus({
      links: '<?php echo(implode(",", $soundcloudsurl)); ?>',
      random: false,
      color: 'c6e2cc'
              
    });
@stop