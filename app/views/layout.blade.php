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
		<hr>

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
$(document).ready(function() {
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
  });
});
</script>



</body>
</html>