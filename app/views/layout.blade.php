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
	<link rel="stylesheet" href="/assets/css/shelf.css">
	<link rel="stylesheet" href="/assets/libraries/bootstrap-chosen/css/chosen.css">
	<link rel="stylesheet" href="/assets/libraries/select2/select2.css">
	<link rel="stylesheet" href="/assets/libraries/Font-Awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/assets/libraries/ajax-scroll/src/css/jquery.ias.css">
	

</head>

<body>

<div class="container">
@yield('content')

	<footer class="site-footer">
		

		<div class="row">
			<div class="span2">
			
			</div>

			<div class="span3 offset7">
				
			</div>
		</div>

		<hr>

		@yield('footer')

		<p>&copy; 2013 Thevoltagecommunity</p>

	</footer>
</div><!-- .container -->

<!-- Scripts -->
<script src="/assets/js/jquery-1.8.0.min.js"></script>
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
<script type="text/javascript" src="http://stratus.sc/stratus.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $.stratus({
      links: '<?php echo(implode(",", $soundcloudsurl)); ?>'
              
    });
  });
</script>

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
        

        $('.preview').empty();
        $('#soundcloud').val('');
        $('.soundcloud-hidden').val('');
        $('.soundcloud-hidden').attr('value', data.permalink_url);
        $('#title').attr('value', data.title);
        $('.youtube-hidden').attr('value', data.id);
        $('#art_urlyoutube').attr('value', data.thumbnail.hqDefault);
        $('.preview').append("<img src='" + data.thumbnail.hqDefault + "' width='100' height='100'/>");
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
        $('.soundcloud-hidden').attr('value', data.permalink_url);
        $('#title').attr('value', data.title);
        $('.genre').attr('value', data.genre);
        $('.genre').change();
        $('.genre-hidden').attr('value', data.genre);
        $('.genre-hidden').change();
        var str=data.artwork_url;
		var n=str.replace("large","t500x500");
        $('#art_urlsoundcloud').attr('value', n);
        $('.preview').append("<img src='" + data.artwork_url + "'/>");
        return data.title;
    }

</script>





</body>
</html>