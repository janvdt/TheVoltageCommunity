@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
<h2>Music Genre: {{$type}}</h2>
<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
 
		<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar">lol</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
 
			<!-- Be sure to leave the brand out there if you want it shown -->
			<a class="brand" href="#">Genres</a>
 
			<!-- Everything you want hidden at 940px or less, place within here -->
			<div class="nav-collapse collapse">
			<!-- .nav, .navbar-search, .navbar-form, etc -->
			<ul class="nav">
				<li><a href="{{ URL::action('MusicController@index') }}">All</a></li>
				<li><a href="#">Own taste</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Choose genre <b class="caret"></b></a>
						<ul class="dropdown-menu">
							@foreach($genres as $genre)
							<li><a href="{{ URL::action('PostController@showGenre') }}?type={{$genre}}">{{$genre}}</a></li>
							@endforeach
							
						</ul>
				</li>
			</ul>
			<form class="navbar-search pull-right" action="">
                 <input type="text" class="search-query span2" placeholder="Search">
			</form>
			</div>
		</div>
	</div>
</div>
	<div class="row">
		<ul class="ch-grid nav nav-pills music-posts">
			@foreach ($musicposts as $musicpost)
			   @if($musicpost->genrescheck($type))
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
                				<a href="{{ URL::action('UserController@visitAccount',array($musicpost->createdBy()->id)) }}">{{$musicpost->createdBy()->first_name}} {{$musicpost->createdBy()->last_name}}</a>
                			</p>
            			</div>
        			</div>
        			<div class="viewslikes span2">
        				<div class="pull-left">
        					<div class="pull-left">
        						@if($musicpost->soundcloud != NULL)
									<a href="{{$musicpost->soundcloud}}" class="stratus"><i class="icon-play"></i></a>
								@endif
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
    			@endif
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
				
				
				
			</div>
		</div>
	</div>
</div>
<div class="row loadmore">
		<div class="span12">
			
		</div>
	</div>
</div>
@stop

@section('scripts')
	@parent

	 $('#loadmore').click(function(){
      $(document).trigger('retrieve.infscr');
      return false;
    });

    $("musicpost").stratus({
      links: '<?php echo(implode(",", $soundcloudsurl)); ?>'
              
    });


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
   
    
 $('.music').on('click',".musicpost",function() {
      $.postMessage($(this).attr('href'), src, $('#stratus iframe')[0].contentWindow);
      return false;
    });
    console.log('test');



  
   
  }
);
 


@stop

