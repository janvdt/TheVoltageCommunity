//-------------------------------------------------
//		youtube playlist jquery plugin
//		Created by dan@geckonm.com
//		www.geckonewmedia.com
//
//		v4.2 - updated with sliding effect and social icons
//           - modified by Ceasar Feijen www.cfconsultancy.nl
//-------------------------------------------------
jQuery.fn.ytplaylist = function (options) {
    var options = jQuery.extend({
        holderId: 'ytvideo',
        playerHeight: '390',
        playerWidth: '640',
        adjustHeight: '30',
        addThumbs: true,
        thumbSize: 'small',
        autoPlay: true,
        playOnLoad: false,
        playfirst: 0,
        start: 0,
        showRelated: false,
        showInfo: true,
        sliding: false,
        social: true,
        listsliding: true,
        slidingshow: false,
        delay: 1500,
        wmode: true,
        iv_load_policy: true,
        hd: false,
        autoHide: true,
        modestbranding: true,
        theme: '&theme=dark&color=red',
        html5: true,
        slideshow: false,
        controls: true,
        allowFullScreen: true
    }, options);

    var selector = $(this),
          autoPlay = '',
          showRelated = '&rel=0',
          showInfo = '&showinfo=0',
          wmode = '',
          autoHide = '&autohide=2',
          theme = '',
          playerColor = '',
          modestbranding = '',
          fullScreen = '',
          iv_load_policy = '',
          slideshow = '',
          controls = '&controls=0';

    if (options.showRelated) showRelated = '&rel=1';
    if (options.showInfo) showInfo = '&showinfo=1';
    if (options.wmode) wmode = '&wmode=opaque';
    if (options.autoHide) autoHide = '&autohide=1';
    if (options.allowFullScreen) fullScreen = '&fs=1';
    if (options.iv_load_policy) iv_load_policy = '&iv_load_policy=3';
    if (options.modestbranding) modestbranding = '&modestbranding=1';
    if (options.controls) controls = '&controls=1';

    var holder = $('#' + options.holderId + '');
	var playerHeightcss = Math.ceil(options.playerWidth / 16*9) + parseInt(options.adjustHeight, 10);
	holder.css({'height' : '' + (playerHeightcss+5) + '' });

	//shuffles list in-place
	function shuffle(list) {
	  var i, j, t;
	  for (i = 1; i < list.length; i++) {
	    j = Math.floor(Math.random()*(1+i));  // choose j in [0..i]
	    if (j != i) {
	      t = list[i];                        // swap list[i] and list[j]
	      list[i] = list[j];
	      list[j] = t;
	    }
	  }
	}

    if (options.slideshow) {
	var links = [];
	var $lis = holder.parents('.yt_holder').find('li');
	var $as = $lis.children('a');
	for(var i = 0, count = $lis.length; i < count; i++){
    	links.push(youtubeid($as[i].href));
    }
     //shuffle(links);
     links.shift();
     slideshow = '&playlist=' + links + '';
    }

    function play(id) {
        if (options.autoPlay && options.playOnLoad) autoPlay = "&autoplay=1";
        options.playOnLoad = true;

        var html = '';
        if (id == false) {
        	return html;
        }
        else {

        if (options.html5) {
		html += '<iframe id="' + options.holderId + 'iframe" style="visibility:hidden;" onload="this.style.visibility=\'visible\';" class="youtube-player" type="text/html" width="' + options.playerWidth + '" height="' + playerHeightcss + '" src="http://www.youtube.com/embed/' + id + '?' + options.theme + autoPlay + autoHide + showRelated + showInfo + fullScreen + wmode + controls + modestbranding + slideshow + '&enablejsapi=1" frameborder="0">';
		html += '</iframe>';
        }
		else {

        html += '<object class="youtube-player" height="' + playerHeightcss + '" width="' + options.playerWidth + '">';
        html += '<param name="movie" value="http://www.youtube.com/v/' + id + '?' + autoPlay + showRelated + showInfo + fullScreen + iv_load_policy + controls + autoHide + modestbranding + options.theme + slideshow + '" />';
        html += '<param name="wmode" value="opaque" />';
        html += '<param name="allowscriptaccess" value="always" />';
        html += '<param name="bgcolor" value="#000000" />';
        if (options.allowFullScreen) {
            html += '<param name="allowfullscreen" value="true" /> ';
        }
        html += '<embed class="youtube-player" src="http://www.youtube.com/v/' + id + '?' + autoPlay + showRelated + showInfo + fullScreen + iv_load_policy + controls + autoHide + modestbranding + options.theme + slideshow + '"';
        if (options.allowFullScreen) {
            html += ' allowfullscreen="true" ';
        }
        html += 'type="application/x-shockwave-flash" wmode="opaque" bgcolor="#000000" allowscriptaccess="always" height="' + playerHeightcss + '" width="' + options.playerWidth + '"></embed>';
        html += '</object>';
        }
        return html;
        }
    };

    function addIframeHandles(){
    	if(!options.slidingshow || !options.html5){
        	return;
        }
	    // Add function to execute when the API is ready
	    YT_ready(function(){
	        var frameID = getFrameID(options.holderId);
	        if (frameID) { //If the frame exists
	            player = new YT.Player(frameID, {
	                events: {
	                    "onStateChange": stopCycle
	                }
	            });
	        }
	    });
    }

    function youtubeid(url) {
        if (url == undefined) {
            return false;
        } else {
            var ytid = url.match("[\\?&]v=([^&#]*)");
            ytid = ytid[1];
            return ytid;
        }
    };

    var itemindex = 0;
    var scrolls = holder.parents('.yt_holder').find('ul:first').addClass('a' + options.holderId + '');
    var up = holder.parents('.yt_holder').find('.you_up').addClass('i' + options.holderId + '');
    var down = holder.parents('.yt_holder').find('.you_down').addClass('i' + options.holderId + '');

	if (options.slideshow && options.playerversion != '&version=2') {
			scrolls.hide();
			up.hide();
			down.hide();
	}

    var firstVid = $(selector).filter(function (index) {
	return index == options.playfirst
    	}).addClass('currentvideo').attr('href');

    holder.html(play(youtubeid(firstVid)));
    addIframeHandles();

    function socialicons () {
        holder.hover(function(){
            holder.find('.yfacebook, .ytwitter, .ytpin').fadeIn('slow');
        },
        function(){
            $('.yfacebook , .ytwitter, .ytpin').fadeOut();
        });
    }

    //remove single and double quotes
	function delquote(str){
		return (str=str.replace(/["']{1}/gi,""));
	}

    var titlefirsttext = selector.filter('.currentvideo').siblings('p').html();
    var firstmovie = selector.filter('.currentvideo');
    var sociali = '';
    if (options.social && !options.slideshow) {
        sociali +='<div class="yfacebook" title="+ facebook" onclick="window.open(\'http://www.facebook.com/sharer.php?s=100&amp;p[title]=' + delquote(encodeURIComponent(titlefirsttext)) + '&amp;p[summary]=' + delquote(encodeURIComponent(firstmovie.text())) + '&amp;p[url]=' + encodeURIComponent(document.location) + '&amp;p[images][0]=' + encodeURIComponent('http://img.youtube.com/vi/' + youtubeid(firstmovie.attr('href')) + '/0.jpg') + '\', \'ysharer\', \'toolbar=0,status=0,width=548,height=325\');"></div>';
        sociali +='<div class="ytwitter" title="+ twitter" onclick="window.open(\'https://twitter.com/share?url=' + encodeURIComponent(document.location) + '&amp;text=' + delquote(encodeURIComponent(firstmovie.text().substring(0, 100))) + '\', \'ysharert\', \'toolbar=0,status=0,width=548,height=325\');"></div>';
        sociali +='<div class="ytpin" title="+ pinit" onclick="window.open(\'http://pinterest.com/pin/create/bookmarklet/?media=' + encodeURIComponent('http://img.youtube.com/vi/' + youtubeid(firstmovie.attr('href')) + '/0.jpg') + '&amp;url=' + encodeURIComponent(document.location) + '&amp;description=' + delquote(encodeURIComponent(titlefirsttext)) + '\', \'yspinnit\', \'toolbar=0,status=0,width=548,height=325\');"></div>';
        holder.prepend(sociali);
        socialicons();
    }

    selector.click(function () {
        if (options.sliding) {
            setTimeout(function(){
        		scrolls.slideUp(1500,'swing');
        	down.show();
        	},options.delay);
        }

		if(holder.find('iframe').size() == 1){
			holder.find('iframe').attr('src','');
		}

        holder.html(play(youtubeid($(this).attr('href'))));
        addIframeHandles();
        selector.filter('.currentvideo').removeClass('currentvideo');
        $(this).addClass('currentvideo');

        var titletext = selector.filter('.currentvideo').siblings('p').html();
        if (options.social && !options.slideshow) {
            sociali +='<div class="yfacebook" title="+ facebook" onclick="window.open(\'http://www.facebook.com/sharer.php?s=100&amp;p[title]=' + delquote(encodeURIComponent(titletext)) + '&amp;p[summary]=' + delquote(encodeURIComponent($(this).text())) + '&amp;p[url]=' + encodeURIComponent(document.location) + '&amp;p[images][0]=' + encodeURIComponent('http://img.youtube.com/vi/' + youtubeid($(this).attr('href')) + '/0.jpg') + '\', \'ysharer\', \'toolbar=0,status=0,width=548,height=325\');"></div>';
            sociali +='<div class="ytwitter" title="+ twitter" onclick="window.open(\'https://twitter.com/share?url=' + encodeURIComponent(document.location) + '&amp;text=' + delquote(encodeURIComponent($(this).text().substring(0, 100))) + '\', \'ysharert\', \'toolbar=0,status=0,width=548,height=325\');"></div>';
            sociali +='<div class="ytpin" title="+ pinit" onclick="window.open(\'http://pinterest.com/pin/create/bookmarklet/?media=' + encodeURIComponent('http://img.youtube.com/vi/' + youtubeid($(this).attr('href')) + '/0.jpg') + '&amp;url=' + encodeURIComponent(document.location) + '&amp;description=' + delquote(encodeURIComponent(titletext)) + '\', \'yspinnit\', \'toolbar=0,status=0,width=548,height=325\');"></div>';
        	holder.prepend(sociali);
            socialicons();
	    }

        itemindex = $(this).parent().index() * 64;

        if (!options.sliding && options.listsliding) {
            setTimeout(function(){
        		scrolls.animate({scrollTop: itemindex},'slow','swing');
        	},options.delay);
        }
        return false;
    });

	if (options.sliding && !options.slideshow) {
	    up.show();

	    down.bind('click', function() {

	    scrolls.slideDown('slow','swing', function() {
	            up.show();
	            down.hide();
                scrolls.animate({scrollTop: itemindex},'slow','swing');
	        });
	    });

	    up.click(function() {
	        scrolls.slideUp('slow','swing', function() {
	            up.hide();
	            down.show();
	        });
	    });
	}

    if (options.addThumbs && !options.slideshow) {
        selector.each(function (i) {
            var replacedText = $(this).text();
            var replacedTextTitle = $(this).text().substring(0, 35);
            if (options.thumbSize == 'small') {
                var thumbUrl = 'http://img.youtube.com/vi/' + youtubeid($(this).attr('href')) + '/default.jpg'
            } else {
                var thumbUrl = 'http://img.youtube.com/vi/' + youtubeid($(this).attr('href')) + '/0.jpg'
            }
            $(this).empty().html('<img src="' + thumbUrl + '" alt="' + replacedTextTitle + '" onmouseout="clearTimeout(timer)" onmouseover="mousoverimage(this,\'' + youtubeid($(this).attr('href')) + '\',\'1\')" />' + replacedText).attr('title', replacedTextTitle)
        });
    }

    // function stopCycle, bound to onStateChange
    function stopCycle(event) {
        //console.log("onStateChange has fired!\nNew state:" + event.data);
        if (event.data == 0) {
		var holder = $('#' + options.holderId).parent();
		if(holder.find('.currentvideo').parent('li').next().size() == 1){
			var next = holder.find('.currentvideo').parent('li').next();
		}else{
			var next = holder.find('li:first');
		}
		var current = holder.find('.currentvideo');

		next.find($(selector)).addClass('currentvideo');
		current.removeClass('currentvideo');
		$('#' + options.holderId).html(play(youtubeid(next.find($(selector)).attr('href'))));
        addIframeHandles();

		itemindex = next.index() * 64;

        if (options.listsliding) {
            setTimeout(function(){
        		scrolls.animate({scrollTop: itemindex},'slow','swing');
        	},options.delay);
        }
        }
    }
};

	//youtube rotating thumbs
	function mousoverimage(name,id,nr){if(name)imname = name;
	        imname.src = 'http://img.youtube.com/vi/' + id + '/' + nr + '.jpg';
	        nr++;if(nr > 3)nr = 1;
	        timer =  setTimeout('mousoverimage(false,\'' + id + '\',' + nr + ');',1000);
	}
    //youtube iframe detection
    function getFrameID(id){
        var elem = document.getElementById(id);
        if (elem) {
            if(/^iframe$/i.test(elem.tagName)) return id; //Frame, OK
            // else: Look for frame
            var elems = elem.getElementsByTagName("iframe");
            if (!elems.length) return null; //No iframe found, FAILURE
            for (var i=0; i<elems.length; i++) {
               if (/^https?:\/\/(?:www\.)?youtube(?:-nocookie)?\.com(\/|$)/i.test(elems[i].src)) break;
            }
            elem = elems[i]; //The only, or the best iFrame
            if (elem.id) return elem.id; //Existing ID, return it
            // else: Create a new ID
            do { //Keep postfixing `-frame` until the ID is unique
                id += "-frame";
            } while (document.getElementById(id));
            elem.id = id;
            return id;
        }
        // If no element, return null.
        return null;
    }

    // Define YT_ready function.
    var YT_ready = (function(){
        var onReady_funcs = [], api_isReady = false;
        return function(func, b_before){
            if (func === true) {
                api_isReady = true;
                for (var i=0; i<onReady_funcs.length; i++){
                    // Removes the first func from the array, and execute func
                    onReady_funcs.shift()();
                }
            }
            else if(typeof func == "function") {
                if (api_isReady) func();
                else onReady_funcs[b_before?"unshift":"push"](func);
            }
        }
    })();
    // This function will be called when the API is fully loaded
    function onYouTubePlayerAPIReady() {YT_ready(true)}

    // Load YouTube Frame API
    (function(){ //Closure, to not leak to the scope
      var s = document.createElement("script");
      s.src = "http://www.youtube.com/player_api"; /* Load Player API*/
      var before = document.getElementsByTagName("script")[0];
      before.parentNode.insertBefore(s, before);
    })();

    var player; //Define a player object, to enable later function calls, without
                // having to create a new class instance again.