<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Info -->
	<title>The Voltage Community</title>
	<link rel="shortcut icon" type="image/x-icon" href="/favicon1.ico">
	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="/assets/libraries/bootstrap-wysihtml5/css/bootstrap-wysihtml5.css">
	<link rel="stylesheet" href="/assets/libraries/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/libraries/bootstrap/css/bootstrap-responsive.min.css">
	<link rel="stylesheet" href="/assets/css/style.css">
	<link rel="stylesheet" href="/assets/css/style2.css" type="text/css" media="screen">
	<link rel="stylesheet" href="/assets/css/shelf.css">
	<link rel="stylesheet" href="/assets/libraries/bootstrap-chosen/css/chosen.css">
	<link rel="stylesheet" href="/assets/libraries/select2/select2.css">
	<link rel="stylesheet" href="/assets/libraries/Font-Awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/assets/libraries/ajax-scroll/src/css/jquery.ias.css">

	<script src="/assets/js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="http://www.youtube.com/player_api"></script>

</head>

<body>

<div class="navbar navbar-static-top navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
      		
      		<a class="brand offset2 titlehead" href="{{URL::to("/")}}"><img src="/images/lightninglight.png" width="30"></a>
			<div class="nav-collapse">
				<ul class="nav pull-right itemsnav">
					
				<li>
          	 	@if(Auth::user())
					<form class="navbar-search " id="searchusers" action="">
						<input type="text" class="search-query span3" id="searchDatauser" placeholder="Search users" width="400">
						<ul id="suggestions" class="nav span4">
               			</ul>
					</form>
				@endif
			</li>
			@if(Auth::check())
			<li>
				<a href="{{ URL::action('HomeController@showActivity') }}"><i class="icon-th-list"></i></a>
			</li>
			@endif
			@if(Auth::check())
					<li class="dropdown pull-right">
							<a id="choose-instance" href="" role="button" class="dropdown-toggle" data-toggle="dropdown">
								@if(Auth::user()->accountUser()->image_id != 0 or Auth::user()->accountUser()->facebookpic == NULL )
									<img src="{{ url(Auth::user()->accountUser()->getImagePathname()) }}" width="25" alt="">
								@else
									<img src="{{ url(Auth::user()->accountUser()->facebookpic) }}" width="25" alt="">
								@endif
								
								@if(Auth::user())
									 Welcome {{Auth::user()->first_name}} {{Auth::user()->last_name}}
								@endif
								<b class="caret"></b></a>
								
								<ul class="dropdown-menu" role="menu" aria-labelledby="choose-instance">
									<li>
										@if(Auth::user())
											<a href="{{ URL::action('UserController@showAccount',array(Auth::user()->id)) }}"><i class="icon-eye-open"> View Account</i></a>
										@endif
									</li>
									<li><a href=""><i class="icon-key"> Change password</i></a></li>
									<li><a href="{{ URL::action('PostController@create') }}"><i class="icon-plus"> Create post</i></a></li>
									<li><a href="{{ URL::action('PlaylistController@index') }}"><i class="icon-list"> My playlists</i></a></li>
								</ul>
					</li>
					@endif
			@if(Auth::check())
			<li class="dropdown pull-right">
						<a id="choose-instance" href="" role="button" class="dropdown-toggle" data-toggle="dropdown"><span class="badge badge-important">{{count($notcount)}}</span><b class="caret"></b></a>
						
						<ul class="dropdown-menu notifications span4" role="menu">
							@foreach($notifications as $notification)
								@if($notification->post_id != 0)
									@if($notification->post->created_by == Auth::user()->id)
										@if($notification->activity == FALSE)
											@if($notification->viewed == FALSE)
												<li class="notificationsitem notread span3">
													<div class="span1">
														@if($notification->user->accountUser()->identifier == 0)
															<a href="{{ URL::action('UserController@visitAccount',array($notification->user->id)) }}">
																<img class="img-rounded" src="{{ url($notification->user->accountUser()->getImagePathname()) }}" alt="" width="35">
															</a>
														@else
														<a href="{{ URL::action('UserController@visitAccount',array($notification->user->id)) }}">
															<img class="img-rounded" src="{{ url($notification->user->accountUser()->facebookpic) }}" alt="" width="35">
														</a>
														@endif
													</div>

													<div class="span2 nottext">
														@if($notification->post->type == 'graph')
															<a href="{{URL::action('PostController@showGraph',array($notification->post_id)) }}">
																<p class="notificationfont">{{$notification->user->first_name}} {{$notification->body}}</p>
															</a>
														@else
															<a href="{{URL::action('PostController@showMusic',array($notification->post_id)) }}">
																<p class="notificationfont">{{$notification->user->first_name}} {{$notification->body}}</p>
															</a>
														@endif														
													</div>

													<div class="span1 readimg">
													@if($notification->post->type == 'graph')
														<img class="avatar" src="/{{ $notification->post->image->getSize('original')->getPathname() }}" alt="" width="35">
													@else
  									 					@if($notification->post->soundcloud_art != NULL)
															<img class="img-rounded pull-left" src="{{ url($notification->post->soundcloud_art) }}" alt="" width="35">
														@else
															<img class="img-rounded pull-left" src="{{ url($notification->post->youtube_art) }}" alt="" width="35">
														@endif
													@endif
													</div>
												</li>
											@else
												<li class="notificationsitem span4">
													<div class="span1">
														@if($notification->user->accountUser()->identifier == 0)
															<a href="{{ URL::action('UserController@visitAccount',array($notification->user->id)) }}">
																<img class="img-rounded" src="{{ url($notification->user->accountUser()->getImagePathname()) }}" alt="" width="35">
															</a>
														@else
														<a href="{{ URL::action('UserController@visitAccount',array($notification->user->id)) }}">
															<img class="img-rounded" src="{{ url($notification->user->accountUser()->facebookpic) }}" alt="" width="35">
														</a>
														@endif
													</div>

													<div class="span2 nottext">
														@if($notification->post->type == 'graph')
														<a href="{{URL::action('PostController@showGraph',array($notification->post_id)) }}">
															<p class="notificationfont">{{$notification->user->first_name}} {{$notification->body}}</p>
														</a>
														@else
														<a href="{{URL::action('PostController@showMusic',array($notification->post_id)) }}">
															<p class="notificationfont">{{$notification->user->first_name}} {{$notification->body}}</p>
														</a>
														@endif
													</div>

													<div class="span1 readimg">
														@if($notification->post->type == 'graph')
														<img class="avatar" src="/{{ $notification->post->image->getSize('original')->getPathname() }}" alt="" width="35">
														@else
  									 						@if($notification->post->soundcloud_art != NULL)
																<img class="img-rounded pull-left" src="{{ url($notification->post->soundcloud_art) }}" alt="" width="35">
															@else
																<img class="img-rounded pull-left" src="{{ url($notification->post->youtube_art) }}" alt="" width="35">
															@endif
														@endif
													</div>
												</li>
											@endif
										@endif
									@endif
								@endif
							@endforeach
							@foreach($following as $follow)
								<li class="notificationsitem span3">
									{{$follow->account->user->notification}}
								</li>
							@endforeach
						</ul>
					</li>
					@endif
          	@if (Auth::check())
				<li class="pull-right"><a href="{{ URL::to('logout')}}">Logout</a></li>
		 	@else
				<li><a href="{{ URL::route('login') }}">Login</a></li>
			@endif
        	</ul>
		</div><!-- /.nav-collapse -->
	</div><!-- /.container -->
  </div><!-- /.navbar-inner -->
</div>





<div class="container">
@yield('content')
</div>

	<footer class="site-footer">
	
		@yield('footer')
		<div class="span2 logofooter pull-right">
			<img src="/images/logovoltage.png" width="200">
		</div>
		<div class="span4">
			
		</div>


	</footer>   

</div><!-- .container -->


<!-- Scripts -->

<script src="/assets/libraries/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/assets/libraries/nestedSortable/jquery.mjs.nestedSortable.js"></script>
<script src="/assets/libraries/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/libraries/bootstrap-wysihtml5/js/wysihtml5-0.3.0.js"></script>
<script src="/assets/libraries/bootstrap-wysihtml5/js/bootstrap-wysihtml5.js"></script>
<script src="/assets/libraries/bootstrap-chosen/js/chosen.jquery.js"></script>
<script src="/assets/libraries/select2/select2.js"></script>
<script src="/assets/js/jquery.form.js"></script>
<script src="/assets/js/script.js"></script>
<script src="/assets/libraries/ajax-scroll/src/jquery-ias.js"></script>
<script src="/assets/libraries/infinite-scroll/jquery.infinitescroll.min.js"></script>
<script src="/assets/libraries/masonry2/jquery.masonry.min.js"></script>
<script src="/assets/libraries/tinycon/tinycon.min.js"></script>
<script type="text/javascript" src="/assets/js/sound.js"></script>



<script>
$(document).ready(function() {
  var $container = $('.graphposts');
  $('.pagination ul li:not(:last)').remove();

	$container.infinitescroll({

    navSelector  : ".pagination",            
                   // selector for the paged navigation (it will be hidden)
    nextSelector : ".pagination ul li a",    
                   // selector for the NEXT link (to page 2)
    itemSelector : ".box",          
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
    var $newElems = $( newElements );
    $container.masonry( 'appended', $newElems );
    	$container.imagesLoaded( function(){
  			$container.masonry({
    		itemSelector : '.box'
  		});
  			function Populate(){
    vals = $('input[type="checkbox"]:checked').map(function() {
        return this.value;
    }).get().join(',');
    console.log(vals);
    $('#removeposts').val(vals);
	}

	$('input[type="checkbox"]').on('change', function() {
    Populate()
    $('#buttonremove').show();

    if(!$('#removeposts').val()){
	$('#buttonremove').hide();
	}
	}).change();
	});
  }
);


});

</script>

<script>
$('#inputTextarea').wysihtml5({
	"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
	"emphasis": true, //Italics, bold, etc. Default true
	"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
	"html": false, //Button which allows you to edit the generated HTML. Default false
	"link": true, //Button to insert a link. Default true
	"image": false, //Button to insert an image. Default true,
	"color": false //Button to change color of font  
});
</script>

<script>
	$(document).ready(function(){
			var rootLimit = 8;
			$('#edit-menu > ul').nestedSortable({
			handle:'a',
			items: 'li',
			listType:'ul',
			maxLevels:'3',
			toleranceElement: '> a',
			update:function(event, ui){
				list = $('ul.sortable').nestedSortable('toArray');
				var page_id = ui.item.find('> a').attr('data-page-id');
				console.log(list);
					index = ui.item.index();
					for(var i=index, len=list.length; i<len; i++) {
						if (list[i].item_id === page_id) {
						parent = list[i].parent_id;
						break;
						}
					}
					console.log(index);
					console.log(parent);
				
				$.post('/page/updatemenu/' + page_id, { index : index , parent : parent },
				function(data)
				{
					
				});
			}
		});
	});
 </script>

 <script type="text/javascript">
$(document).ready(function(){

@section('scripts')
@show

@yield('scriptsremove')

@yield('scriptsdocuments')

@yield('scriptstags')

});
</script>

<script>
$('select[name=select-model]').change(function(){
	$('form[name=form-search]').submit();
	});
</script>

<script>
$('select[name=select-type]').change(function(){
	$('form[name=form-search]').submit();
	});
</script>

<script>
$('select[name=select-tag]').change(function(){
	$('form[name=form-search]').submit();
	});
</script>

<script type="text/javascript"> 
	 $(".chzn-select").chosen();
</script>


<script>

</script>

<script src="http://connect.soundcloud.com/sdk.js"></script>
			
			<script>
			SC.initialize({
			  client_id: '4dad0bbf95a4e0ab59b556e79fe2ce55'
			});
			</script>


<script>
$(document).ready(function() {	
$("#youtube").select2({
    placeholder: "Search for a track",
    minimumInputLength: 3,
    ajax: {
        url: "http://gdata.youtube.com/feeds/api/videos?format=5&max-results=20&v=2&alt=jsonc",
        dataType: 'jsonp',
        quietMillis: 100,
        data: function (term, page) { // page is the one-based page number tracked by Select2
            return {
                q: term, //search term
                page_limit: 10, // page size
                page: page, // page number
            };
        },
        results: function (data,page) {
            var more = (page * 10) < data.total; // whether or not there are more results available
 			console.log(data.data.items);
            // notice we return the value of more so Select2 knows if more results can be loaded
            return {results: data.data.items, more: more};
        }
    },
    formatResult: youtubeFormatResult, // omitted for brevity, see the source of this page
    formatSelection: youtubeFormatSelection, // omitted for brevity, see the source of this page
    dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
    escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
});
});
</script>

<script>

    function youtubeFormatResult(data) {
        var markup = "<table class='movie-result'><tr>";
        if (data.artwork_url !== null){
        markup += "<td class='soundcloud-image'><img src='" + data.thumbnail.hqDefault + "' width='100' height='100'/></td>";
    	}
        markup += "<td class='movie-info'><div class='movie-title'>" + data.title + "</div>";
        markup += "</td></tr></table>"
        return markup;
    }

    function youtubeFormatSelection(data) {
        
    	$('#postsoundcloud').empty();
        $('.preview').empty();
        $('#soundcloud').val('');
        $('.soundcloud-hidden').val('');
        $('.soundcloud-hidden').attr('value', data.permalink_url);
        $('#title').attr('value', data.title);
        $('.youtube-hidden').attr('value', data.id);
        $('#art_urlyoutube').attr('value', data.thumbnail.hqDefault);
        var image = "<div class='slider-img ch-img-1 soundimgslider' style='background-image: url(" + data.thumbnail.hqDefault +");'></div>"
        $('.preview').append(image);
        $('#postsoundcloud').append("<iframe id='player' src='http://www.youtube.com/embed/" + data.id + "?rel=0&wmode=Opaque&enablejsapi=1' frameborder='0' width='100%'' height='300'></iframe>");
        return data.title;
    }

</script>

<script>
$(document).ready(function() {
$("#soundcloud").select2({
    placeholder: "Search for a track",
    minimumInputLength: 3,
    ajax: {
        url: "https://api.soundcloud.com/tracks?client_id=4dad0bbf95a4e0ab59b556e79fe2ce55",
        dataType: 'json',
        quietMillis: 100,
        data: function (term, page) { // page is the one-based page number tracked by Select2
            return {
            	types:["bpm"],
                q: term, //search term
                page_limit: 10, // page size
                page: page, // page number
            };
        },
        results: function (data, page) {
            var more = (page * 10) < data.total; // whether or not there are more results available
 			console.log(data);
            // notice we return the value of more so Select2 knows if more results can be loaded
            return {results: data, more: more};
        }
    },
    formatResult: movieFormatResult, // omitted for brevity, see the source of this page
    formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
    dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
    escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
});
});
</script>

<script>

    function movieFormatResult(data) {
        var markup = "<table class='movie-result'><tr>";
        if (data.artwork_url !== null){
        markup += "<td class='soundcloud-image'><img src='" + data.artwork_url + "'/></td>";
    	}
        markup += "<td class='movie-info'><div class='movie-title'>" + data.title + "</div>";
        markup += "</td></tr></table>"
        return markup;
    }

    function movieFormatSelection(data) {
        $('.preview').empty();
        $('#postsoundcloud').empty();
        $('.soundcloud-hidden').attr('value', data.permalink_url);
        $('.soundcloudid-hidden').attr('value', data.id);
        $('#title').attr('value', data.title);
        $('.genre').attr('value', data.genre);
        $('.genre').change();
        var script   = document.createElement("script");
		script.type  = "text/javascript";    // use this for linked script
		script.text  = "SC.oEmbed('" + data.permalink_url + "', {color: 'c6e2cc'},  document.getElementById('postsoundcloud'));"               // use this for inline script
		$('#postsoundcloud').append(script);
        $('.genre-hidden').attr('value', data.genre);
        $('.genre-hidden').change();
        var str=data.artwork_url;
		var n=str.replace("large","t500x500");
        $('#art_urlsoundcloud').attr('value', n);
        var image = "<div class='slider-img ch-img-1 soundimgslider' style='background-image: url(" + data.artwork_url +");'></div>"
        $('.preview').append(image);
        return data.title;
    }

</script>

<script>

	$("#suggestions").hide();
	
	$('#searchDatauser').keyup(function() {
	var url = 'http://thevoltagecommunity.com';
	console.log(url);
 	var searchVal = $(this).val();
 	$("#suggestions").show();
 	if(searchVal !== '') {
 
            $.get(url + '/search?searchData='+searchVal, function(returnData) {
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
</script>





</body>
</html>