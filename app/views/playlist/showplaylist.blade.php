@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
<div class="row">
	<div class="span10">
		<h2>{{$playlist->title}}</h2>
	</div>
</div>

<div class="row">
	<ul class="ch-grid nav nav-pills music-posts" id="sortableplaylist">
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
        						<a href="{{$musicpost->soundcloud}}" class="stratus"><i class="icon-play"></i></a>
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