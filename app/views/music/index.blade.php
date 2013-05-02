@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
<h2>Music</h2>

	<div class="row">
		<ul class="ch-grid nav nav-pills music-posts">
			@foreach ($musicposts as $musicpost)
    			<a href ="{{ URL::action('PostController@showMusic', array($musicpost->id)) }}">
    			<li class= "musicpost">
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
                			<?php $string = $musicpost->title;
							$maxLength = 40;

						if (strlen($string) > $maxLength) {
    					$stringCut = substr($string, 0, $maxLength);
    					$string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
						}

						echo "<h3>$string</h3>"
						?>

                			<p>
                				<a href="">{{$musicpost->createdBy()->first_name}} {{$musicpost->createdBy()->last_name}}</a>
                			</p>
            			</div>
        			</div>
        			<div class="viewslikes span2">
        				<div class="pull-left">
        					<div class="pull-left">
        						<i class='icon-eye-open'></i>
        						<span class="badge badge-inverse">{{$musicpost->views}}</span></i>
        					</div>
        				</div>
        				<div class="">
        					<div class="pull-left likes">
        						<i class='icon-thumbs-up'></i>
        						<span class="badge badge-inverse">{{count($musicpost->likes)}}</span></i>
        					</div>
        					
        				</div>
        			</div>
        			<div class="shelf shelfmusicpost">
					<div class="bookend_left"></div>
					<div class="bookend_right"></div>
					<div class="reflection"></div>
					</div>
    			</li>
    			</a>
    			
    		@endforeach
		</ul>
	</div>
</div>
<div class="row">
	<div class="span12 loader">
	</div>
</div>
<div class="row">
		<div class="span12">
			<div class="pagination pagination-centered">
				{{ $musicposts->links() }}
			</div>
		</div>
	</div>
</div>
<div class="row loadmore">
		<div class="span12 offset7">
			
		</div>
	</div>
@stop

@section('scripts')
	@parent

	 $('#loadmore').click(function(){
      $(document).trigger('retrieve.infscr');
      return false;
    });

@stop