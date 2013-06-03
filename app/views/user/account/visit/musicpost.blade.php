@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
<h2>{{$user->first_name}} {{$user->last_name}} Music posts</h2>

	<div class="row">
		<ul class="ch-grid nav nav-pills music-posts">
			@foreach ($musicposts as $musicpost)
    			<li class= "musicpost" id="{{$musicpost->id}}" value="{{$musicpost->id}}">
    				<div class="row">
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
        				<a href ="{{ URL::action('PostController@showMusic', array($musicpost->id)) }}">
            			<div class="ch-info">
            				
                			<?php $string = $musicpost->title;
							$maxLength = 40;

						if (strlen($string) > $maxLength) {
    					$stringCut = substr($string, 0, $maxLength);
    					$string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
						}

						echo "<h3>$string</h3>"
						?>

                			
                				<a href=""></a>
                			
            			</div>
            			</a>
        			</div>
        			
        			<div class="viewslikes span2">
        				<div class="pull-left">
        					<div class="pull-left">
        						@if($musicpost->soundcloud != NULL)
									<a href="{{$musicpost->soundcloud}}" class="stratus"><i class="icon-play"></i></a>
								@else
									<a value="{{$musicpost->youtube}}" href="#youtube-post-{{ $musicpost->youtube }}" data-toggle="modal" id="play"><i class="icon-film"></i></a>
									<div class="modal hide fade" id="youtube-post-{{ $musicpost->youtube }}" >
										<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<p class="youtubetitle">{{$musicpost->title}}<p>
										</div>
										<div class="modal-body">
										<div id="whateverID">
										</div>
										</div>
										<div class="modal-footer">
										</div>
										<script>
										$('#youtube-post-{{ $musicpost->youtube }}').on('show', function () {
  											$(".modal-body").append("<iframe id='player' src='http://www.youtube.com/embed/{{$musicpost->youtube}}?rel=0&wmode=Opaque&enablejsapi=1' frameborder='0' width='100%'' height='380'></iframe>");
										});


            							$('#youtube-post-{{ $musicpost->youtube }}').on('hidden', function () {
            								$(".modal-body").empty();
            							})
            							
     									</script>
									</div>
								@endif
        						<i class='icon-eye-open'></i>
        						<span class="badge badge-inverse">{{$musicpost->views}}</span></i>
        					</div>
        				</div>
        				<div class="">
        					<div class="pull-left likes">
        						<i class='icon-heart'></i>
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
    			
    			
    		@endforeach
		</ul>
	</div>
</div>
<div class="row">
	<div class="span12 loader">
	</div>
</div>

</div>
<div class="row span12">
	<div class="finished span5 offset3">
		
	</div>
</div>
</div>
@stop

@section('scripts')
	@parent


	




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
        finishedMsg: "",
        img: "/images/loader.gif",
        msg: null,
        msgText: "",
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
$('#searchData').keyup(function() {
 	var searchVal = $(this).val();

 	if(searchVal !== '') {
 
            $.get('music/search?searchData='+searchVal, function(returnData) {
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
                 	$searchpost = "<li class='musicpost' id='searchresults'><div class='row'><div class='span3 titlemusicpost'><h6><a href='http://tvctheme.loc/user/visitaccount/"+ returnData[i].userid +"'><img src='" + returnData[i].image +"' width='30' alt=''></a>"+ returnData[i].title +"</h6></div></div>@if(" + returnData[i].soundcloud_art +" !=  null)<div class='ch-item ch-img-1 soundcloudimg' style='background-image: url("+ returnData[i].soundcloud_art + ");'>@endif @if(" + returnData[i].youtube_art +" !=  null)<div class='ch-item ch-img-1 youtubeimg' style='background-image: url("+ returnData[i].youtube_art + ");'>@endif<a href ='http://tvctheme.loc/post/showmusic/"+ returnData[i].id +"'><div class='ch-info'><h3>" + returnData[i].title +"</h3><a href=''></a></div></div></a></div><div class='viewslikes span2'><div class='pull-left'><div class='pull-left'>@if(" + returnData[i].soundcloud +" != null)<a href='" +returnData[i].soundcloud + "' class='stratus'><i class='icon-play'></i></a>@endif<i class='icon-eye-open'></i><span class='badge badge-inverse'>"+returnData[i].views+"</span></i></div></div><div class=''><div class='pull-left likes'><i class='icon-heart'></i><span class='badge badge-inverse'>"+returnData[i].postlikes+"</span></i></div></div></div><div class='shelf shelfmusicpost'><div class='bookend_left'></div><div class='bookend_right'></div><div class='reflection'></div></div></li>";

                 	$(".music-posts").append($searchpost);
                 	}

					}  
                }
            });
        } else {
            $('.music-posts li').each(function(i)
			{
				$(this).css("display", "block");
				$('#searchresult').remove();
			});""
        }
 
    });
 


@stop