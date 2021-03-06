@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
<h2>Music Genre: {{$type}}</h2>
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
			<a class="brand" href="#">Genres</a>
 
			<!-- Everything you want hidden at 940px or less, place within here -->
			<div class="nav-collapse collapse">
			<!-- .nav, .navbar-search, .navbar-form, etc -->
			<ul class="nav">
				<li><a href="{{ URL::action('MusicController@index') }}">All</a></li>
				@if(Auth::user())
				<li><a href="{{ URL::action('MusicController@myTaste') }}">Own taste</a></li>
				@endif
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
                 <input type="text" class="search-query span2" id="searchDatagenre" placeholder="Search">
			</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="span10">
	@foreach($subgenresdata as $subgenre)
		<a href="{{ URL::action('PostController@showSubgenre') }}?type={{$subgenre}}&genre={{$type}}"><span class="label label-inverse">{{$subgenre}}</span></a>
	@endforeach
	</div>
</div>

	<div class="row musicnoti">
		<ul class="ch-grid nav nav-pills music-posts">
			@foreach ($musicposts as $musicpost)
			   @if($musicpost->genrescheck($type))
    			<li class= "musicpost" id="{{$musicpost->id}}" value="{{$musicpost->id}}">
    				<div class="row">
    					<div class="span3 titlemusicpost">
    						<h6>
    						@if(Auth::user())
    						<a href="{{ URL::action('UserController@visitAccount',array($musicpost->createdBy()->id)) }}">
    						@if($musicpost->createdBy()->accountUser()->image_id != 0 or $musicpost->createdBy()->accountUser()->facebookpic == NULL )
								<img src="{{ url($musicpost->createdBy()->accountUser()->getImagePathname()) }}" width="30" alt="">
							@else
								<img src="{{ url($musicpost->createdBy()->accountUser()->facebookpic) }}" width="30" alt="">
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
									<a href="{{$musicpost->soundcloud}}" class="stratus" value="{{$musicpost->id}}"><i class="icon-play"></i></a>
								@else
									<a value="{{$musicpost->youtube}}" name="{{$musicpost->id}}" href="#youtube-post-{{ $musicpost->youtube }}" data-toggle="modal" id="play" class="playyoutube"><i class="icon-film"></i></a>
									
							
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
      links: '<?php echo(implode(",", $soundcloudsurl)); ?>',
      random: true,
      color: 'c6e2cc'
              
    });

    $('.music').on('click',".playyoutube",function() {

 	var youtube = $(this).attr('value');

 	console.log(youtube);

 	 jQuery.iLightBox([
		{
			URL: "http://www.youtube.com/embed/"+ youtube + ""
		}
	]);
	
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
});

$('.music').on('click',".playyoutube",function() {

 	var youtube = $(this).attr('value');

 	console.log(youtube);

 	var postid = $(this).attr('name');
	console.log(postid);
     $.post('/music/listenpoints/' + postid ,
	function(data)
	{
		console.log('success');
	});

 	 jQuery.iLightBox([
		{
			URL: "http://www.youtube.com/embed/"+ youtube + ""
		}
	]);
	
});

$('.music').on('click',"a.stratus",function() {
	var postid = $(this).attr('value');
	console.log(postid);
     $.post('/music/listenpoints/' + postid ,
	function(data)
	{
		console.log('success');
	});
});

 $('#searchDatagenre').keyup(function() {
 	var searchVal = $(this).val();
 	var type = "{{Input::get('type')}}";

 	if(searchVal !== '') {
 
            $.get('genre/searchgenre?searchData='+searchVal+'&type='+type, function(returnData) {
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
					console.log(returnData);
                 	for (var i = 0; i < returnData.length; i++) {

                 	
    				if(returnData[i].id !== undefined)
    				{
                 	$searchpost = "<li class='musicpost' id='searchresults'><div class='row'><div class='span3 titlemusicpost'><h6><a href='http://thevoltagecommunity.com/user/visitaccount/"+ returnData[i].userid +"'><img src='" + returnData[i].image +"' width='30' alt=''></a>"+ returnData[i].title +"</h6></div></div><div class='test'><a href ='http://thevoltagecommunity.com/post/showmusic/"+ returnData[i].id +"'>@if(" + returnData[i].soundcloud_art +" !=  null)<div class='ch-item ch-img-1 soundcloudimg' style='background-image: url("+ returnData[i].soundcloud_art + ");'>@endif @if(" + returnData[i].youtube_art +" !=  null)<div class='ch-item ch-img-1 youtubeimg' style='background-image: url("+ returnData[i].youtube_art + ");'>@endif</div></a></div><div class='viewslikes span3'><div class='pull-left'><div class='pull-left'><a href='" +returnData[i].provider + "' class='"+returnData[i].class+"' value='"+returnData[i].value+"' name='"+returnData[i].name+"'><i class='"+returnData[i].icon+"'></i></a><i class='icon-eye-open watch'></i><span class='badge badge-inverse'>"+returnData[i].views+"</span></i></div></div><div class=''><div class='pull-left likes'><img src='/images/lightning.png' width='15' height='15'><span class='badge badge-inverse'>"+returnData[i].postlikes+"</span></i></div></div></div><div class='shelf shelfmusicpost'><div class='bookend_left'></div><div class='bookend_right'></div><div class='reflection'></div></div></li>";

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
 
    if ($('.music-posts li').length == 0) {$('.music').append("<h5>There is no music available in this genre.</h5>")}

@stop

