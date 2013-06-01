<!DOCTYPE html>
<html>
<head>

<title>The Wheels Of Steel: Turntables in your browser (a web-based DJ prototype)</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="A web browser-based turntable + mixer experiment. DJ, scratch and mix MP3s from your web browser, where supported. HTML + CSS3 + JavaScript + Flash (SoundManager 2) under the hood. BSD licensed." />
<meta name="keywords" content="DJ, turntable, virtual dj, web DJ, scratch, mix, record, vinyl, wheels of steel, prototype, html, css, javascript, dhtml, sound, audio, audio api, soundmanager2, flash 10 audio" />
<meta name="robots" content="all" />
<meta name="author" content="Scott Schiller" />
<meta name="copyright" content="Copyright (C) 2011 onwards Scott Schiller (BSD License)" />
<meta http-equiv="X-UA-Compatible" content="chrome=1" />

<link rel="stylesheet" media="screen" href="css/wheelsofsteel.css" />
<script src="script/soundmanager2.js"></script>
<script src="script/wheelsofsteel.js"></script>
</head>

<body>
<!-- hide non-js fallback open state for #moreinfo, etc. -->
<script>document.body.className='has_js';</script>

<div>

<div id="tt-wrapper-wrapper">

<div id="tt-wrapper">

<div id="tt-container">

<div id="tt-1" class="turntable">

 <div class="body">

  <div class="platter">
   <div class="ring"></div>
   <div class="record">
    <div class="record-ui">
     <div class="slipmat"></div>
     <div class="slipmat slipmat-y"></div>
     <div class="slipmat slipmat-f"></div>
     <div class="grooves"></div>
     <div class="loader"></div>
     <div class="label"></div>
     <div class="label-notches"></div>
    </div>
    <div class="spindle"></div>
    <div class="shiny"></div>
    <div class="cover"></div>

   </div>
  </div>

  <div class="powerlight"><div class="powerlight-on"></div></div>
  <div class="tonearm">
   <img src="image/table_tonearm.png" alt="" class="tonearm-image" />
  </div>

  <div class="pitch-box scratch-mode">
   <div class="pitch">
    <div class="label">pitch adj.</div>
    <div class="legend">
     <ul class="markers">
      <li>-8<span>■</span></li>
      <li>-</li>
      <li>6<span>■</span></li>
      <li>-</li>
      <li>4<span>■</span></li>
      <li>-</li>
      <li>2<span>■</span></li>
      <li>-</li>
      <li>&mdash;</li>
      <li>-</li>
      <li>2<span>■</span></li>
      <li>-</li>
      <li>4<span>■</span></li>
      <li>-</li>
      <li>6<span>■</span></li>
      <li>-</li>
      <li>+8<span>■</span></li>
     </ul>
    </div>
    <div class="rail"></div>

    <div class="pitch-slider" title="Pitch control">
     <div class="shade-top"></div>
     <div class="shade-bottom"></div>
     <div class="pitch-line"></div>
    </div>
    <div class="control-pitch-slider-text"></div>
    <div class="pitch-box-hider">
     <input id="tt-1-pitch-slider" class="control-pitch-slider-input" type="range" min="0" max="160" value="80" />
    </div>

   </div>
  </div>

  <div class="powerdial-led"></div>
  <a href="#110vac" title="Power on/off" class="powerdial" onclick="return false">on / off</a>
  <a href="#onoff" title="start/stop" class="startstop" onclick="return false">start &middot; stop</a>
  <a href="#33rpm" title="33 RPM" class="rpm-33" onclick="return false"><span>33rpm</span></a>
  <a href="#45rpm" title="45 RPM" class="rpm-45" onclick="return false"><span>45rpm</span></a>
 </div>

 <div id="tt-1-waveform" class="waveform">
  <div class="loader"></div>
  <div class="waveform-1">
   <div class="playhead"></div>
   <div class="playhead-arrow"></div>
  </div>
  <div class="waveform-2">
   <div class="playhead-arrow compact"></div>
  </div>
 </div>

</div>

<div id="tt-2" class="turntable">

 <div class="body">

  <div class="platter">

   <div class="ring"></div>
   <div class="record">
    <div class="record-ui">
     <div class="slipmat"></div>
     <div class="slipmat slipmat-y"></div>
     <div class="slipmat slipmat-f"></div>
     <div class="grooves"></div>
     <div class="loader"></div>
     <div class="label"></div>
     <div class="label-notches"></div>
    </div>
    <div class="spindle"></div>
    <div class="shiny"></div>
    <div class="cover"></div>
   </div>
  </div>
 
  <div class="powerlight"><div class="powerlight-on"></div></div>

  <div class="tonearm">
   <img src="image/table_tonearm.png" alt="" class="tonearm-image" />
  </div>

  <div class="pitch-box scratch-mode">
   <div class="pitch">
    <div class="label">pitch adj.</div>
    <div class="legend">
     <ul class="markers">
      <li>-8<span>■</span></li>
      <li>-</li>
      <li>6<span>■</span></li>
      <li>-</li>
      <li>4<span>■</span></li>
      <li>-</li>
      <li>2<span>■</span></li>
      <li>-</li>
      <li>&mdash;</li>
      <li>-</li>
      <li>2<span>■</span></li>
      <li>-</li>
      <li>4<span>■</span></li>
      <li>-</li>
      <li>6<span>■</span></li>
      <li>-</li>
      <li>+8<span>■</span></li>
     </ul>
    </div>
    <div class="rail"></div>
    <div class="pitch-slider">
     <div class="shade-top"></div>
     <div class="shade-bottom"></div>
     <div class="pitch-line"></div>
    </div>
    <div class="control-pitch-slider-text"></div>
    <div class="pitch-box-hider">
     <input id="tt-2-pitch-slider" class="control-pitch-slider-input" type="range" min="0" max="160" value="80" />
    </div>
   </div>
  </div>

  <div class="powerdial-led"></div>
  <a href="#110vac" title="Power on/off" class="powerdial" onclick="return false">on / off</a>
  <a href="#onoff" title="start/stop" class="startstop" onclick="return false">start &middot; stop</a>
  <a href="#33rpm" title="33 RPM" class="rpm-33" onclick="return false"><span>33rpm</span></a>
  <a href="#45rpm" title="45 RPM" class="rpm-45" onclick="return false"><span>45rpm</span></a>

 </div>

 <div id="tt-2-waveform" class="waveform">
  <div class="loader"></div>
  <div class="waveform-1">
   <div class="playhead"></div>
   <div class="playhead-arrow"></div>
  </div>
  <div class="waveform-2">
   <div class="playhead-arrow compact"></div>
  </div>
 </div>

</div>

<div id="mixer">

 <form id="mixer-form" action="#" onsubmit="return false">

 

 <div id="mixer-options">

  <div style="position:absolute;top:0px;left:0px;margin-top:-20px" class="scratch-mode">
   <input id="use-eq" name="use-eq" type="checkbox" title="Toggle experimental EQ (hi/mid/low frequency filters)" /> <label for="use-eq" title="Toggle experimental EQ (hi/mid/low frequency filters)">EQ</label>
  </div>

  <div style="position:absolute;top:0px;right:0px;margin-top:-1.55em;margin-right:0.5em">
   <a href="#y" onclick="return wheelsofsteel.nextSkin(event)" title="Change the turntable skin" style="color:#999;font-weight:normal">Y</a>
  </div>

 </div>

 <!-- GAIN -->

 <div id="channel-1-gain" class="mixer-panel">

  <div class="bd">

   <ul class="pots">

    <li>
     <input id="tt-1-gain" name="tt-1-gain" type="range" title="Gain (channel 1)" min="1" max="100" value="50" class="control-eq" data-table-id="0" data-type="gain" />
     <div id="tt1-gain" title="Gain (channel 1)" class="pot"></div>
    </li>

   </ul>

  </div>

 </div>

 <div id="channel-2-gain" class="mixer-panel right-panel">

  <div class="bd">

   <ul class="pots">

    <li>
     <input id="tt-2-gain" name="tt-2-gain" type="range" title="Gain (channel 2)" min="1" max="100" value="50" class="control-eq" data-table-id="1" data-type="gain" />
     <div id="tt2-gain" title="Gain (channel 2)" class="pot"></div>
    </li>

   </ul>

  <!-- /bd -->
  </div>

 </div>

 <!-- EQ -->

 <div id="channel-1-eq" class="mixer-panel scratch-mode-inline-block">

  <div class="bd">

   <ul class="pots">

    <li>
     <input id="tt-1-eq-2" name="tt-1-eq-2" type="range" title="Hi EQ (channel 1)" min="10" max="100" value="50" class="control-eq" data-type="eq" data-table-id="0" data-eq-offset="2" />
     <div id="tt1-eq2" title="High EQ (channel 1)" class="pot"></div>
    </li>

    <li>
     <input id="tt-1-eq-1" name="tt-1-eq-1" type="range" title="Mid EQ (channel 1)" min="10" max="100" value="50" class="control-eq" data-type="eq" data-table-id="0" data-eq-offset="1" />

     <div id="tt1-eq1" title="Mid EQ (channel 1)" class="pot"></div>
    </li>

    <li>
     <input id="tt-1-eq-0" name="tt-1-eq-0" type="range" title="Low EQ (channel 1)" min="10" max="100" value="50" class="control-eq" data-type="eq" data-table-id="0" data-eq-offset="0" />
     <div id="tt1-eq0" title="Low EQ (channel 1)" class="pot"></div>
    </li>
 
   </ul>

  <!-- /bd -->

  </div>

 </div>

 <div id="channel-2-eq" class="mixer-panel right-panel scratch-mode-inline-block">

  <div class="bd">

   <ul class="pots">

    <li>

     <input id="tt-2-eq-2" type="range" title="Hi EQ (channel 2)" min="10" max="100" value="50" class="control-eq" data-type="eq" data-table-id="1" data-eq-offset="2" />
     <div id="tt2-eq2" title="Hi EQ (channel 2)" class="pot"></div>
    </li>

    <li>
     <input id="tt-2-eq-1" type="range" title="Mid EQ (channel 2)" min="10" max="100" value="50" class="control-eq" data-type="eq" data-table-id="1" data-eq-offset="1" />
     <div id="tt2-eq1" title="Mid EQ (channel 2)" class="pot"></div>
    </li>

    <li>
     <input id="tt-2-eq-0" type="range" title="Low EQ (channel 2)" min="10" max="100" value="50" class="control-eq" data-type="eq" data-table-id="1" data-eq-offset="0" />
     <div id="tt2-eq0" title="Low EQ (channel 2)" class="pot"></div>
    </li>

   </ul>

  <!-- /bd -->
  </div>

 </div>

 <!-- upfaders -->

 <div class="mixer-panel">
  <div class="bd">
   <div id="upfader-1" class="upfader" data-id="tt-1-upfader">
    <div class="upfader-ui" title="Upfader (channel 1)">
     <div class="rail"></div>
     <div class="upfader-slider">
      <div class="shade-top"></div>
      <div class="shade-bottom"></div>
      <div class="line"></div>
      <div class="upfader-cover" data-id="tt-1-upfader"></div>
     </div>
    </div>
    <input id="tt-1-upfader" type="range" title="Upfader (channel 1)" min="1" max="100" value="75" class="control-upfader" data-type="upfader" data-table-id="0" data-id="tt-1-upfader" />
   </div>
  </div>
 </div>

 <div class="mixer-panel right-panel">
  <div class="bd">
   <div id="upfader-2" class="upfader" data-id="tt-2-upfader">
    <div class="upfader-ui" title="Upfader (channel 2)">
     <div class="rail"></div>
     <div class="upfader-slider">
      <div class="shade-top"></div>
      <div class="shade-bottom"></div>
      <div class="line"></div>
      <div class="upfader-cover" data-id="tt-2-upfader"></div>
     </div>
    </div>
    <input id="tt-2-upfader" type="range" min="1" max="100" value="75" class="control-upfader" data-type="upfader" data-table-id="1" data-id="tt-2-upfader" />
   </div>
  </div>
 </div>

 <!-- crossfader -->

 <div class="x-fader-panel mixer-panel full-panel">
  <div class="bd">

   <div id="crossfader-1" class="crossfader" data-id="crossfader-1">
    <div class="crossfader-ui" title="Crossfader" >
     <div class="rail"></div>
     <div class="crossfader-slider">
      <div class="shade-top"></div>
      <div class="shade-bottom"></div>
      <div class="line"></div>
      <div class="crossfader-cover" data-id="crossfader-1"></div>
     </div>
    </div>
    <input id="control-xfader" name="control-xfader" type="range" title="Crossfader" min="0" max="100" value="50" class="x-fader" />
   </div>

  </div>

  <!-- <p style="margin-top:0.5em;margin-bottom:1.5em">x-fader</p> -->
 </div>

 </form>

</div>

<form id="loader-form-1" action="." method="get" class="loader-form">
 <input id="loader-form-1-unload" type="button" title="Unload track" value="X" />
 <input id="track1" name="track1" type="text" value="" title="MP3 URL or SoundCloud ID to load (turntable 1)" autocomplete="false" spellcheck="false" onfocus="this.select()" />
 <input id="loader-form-1-submit" type="submit" title="Load this URL" value="&rarr;" />
</form>

<form id="loader-form-2" action="." method="get" class="loader-form">
 <input id="loader-form-2-unload" type="button" title="Unload track" value="X" />
 <input id="track2" name="track2" type="text" value="" title="MP3 URL or SoundCloud ID to load (turntable 2)" autocomplete="false" spellcheck="false" onfocus="this.select()" />
 <input id="loader-form-2-submit" type="submit" title="Load this URL" value="&rarr;" />
</form>



</div>

<!-- /tt-wrapper -->
</div>

<!-- /tt-wrapper-wrapper -->
</div>

<div id="content">
	<div id="info">

  <div id="control-stats">Spinning up The Wheels Of Steel<noscript> (JavaScript required)</noscript>... <img src="image/icon_loading_spinner_6699cc.gif" alt="" style="vertical-align:middle;width:32px;height:32px" /><!-- buffer, fps etc. end up here --></div>

  <div id="controls">

   <p id="moreinfo">
   <a id="moreinfo-link" href="#more">More info <span class="toggle"><span><b>&#9835;</b></span></span> <span style="font-size:20px;font-weight:normal">&laquo;</span> <span style="color:rgba(255,255,255,0.5)">New? Start here.</span></a>
   </p>

 <div class="controls-wrapper">

  <div class="controls-wrapper-heading">

   <h1>Welcome to The Wheels Of Steel: Turntables in your browser <br /><span style="color:rgba(255,255,255,0.33)">(a Web-based DJ prototype)</span></h1>

   <div style="margin-bottom:1.5em;margin-top:-0.5em">

    <p><b>What are the features like?</b> See a quick <a href="http://bit.ly/kikTFp" data-real-href="http://www.youtube.com/watch?v=F3OfmtE7qL4">demo video</a> of cueing, pitch bending and beat matching using scratch mode.</p>

   </div>

  </div>

 <div class="controls-wrapper-content">

  <div class="first-column">

   <h2>The basics: Controls</h2>

   <p class="keys" style="line-height:1.6em"><b>Left-click</b> a track to load it on the left turntable. <b>Right-click</b> or <b>shift + click</b> for the right turntable. Click and drag the needle to seek while the record is playing. If you're one of the "cool kids", you will see "scratch mode" which gives you more realistic DJ features like the <a href="http://bit.ly/kikTFp" data-real-href="http://www.youtube.com/watch?v=F3OfmtE7qL4">demo video</a>.</p>

   <ul id="keycontrols" class="keys">
    <li><b>&larr;</b> <b>&uarr;</b> <b>&rarr;</b> - Crossfader</li>
    <li><b>[</b> <b>]</b> - Pseudo-transform (cross-fader cut / override)</li>
    <li><b>1...5</b> / <b>6...0</b>: Cue points for left / right deck while playing. First keypress = set cue point, second = recall.<br />
     <b>shift+1</b> = set/update existing point #1, <b>ctrl+1</b> = delete.</li>
    <li><b>-</b> / <b>+</b>: "Nudge" pitch, adjust speed. Use <b>shift</b> for right turntable. (Scratch mode only.)</li>
    <li><b>&lt;</b> / <b>&gt;</b>: Start/stop button. +<b>shift</b> to use power dial.</li>
    <li><b>d</b>: Debug (outline) mode.</li>
    <li><b>double-click</b> a slider or rotary knob to reset it.</li>
   </ul>

   <h2>Tips &amp; Tricks</h2>

   <p>(Note that scratch and pitch bending are only available in "scratch mode".)</p>

   <p><b>Scratching and precision</b> <br />Once you grab the record, the mouse can move anywhere within the screen without losing position. The closer to the outside of the record, the smoother the mouse movement and scratching effects are.</p>

   <p><b>Record backspin</b> <br />Grab the record with the mouse and throw it forward or backward for a spin effect. During a backspin, the record will take slightly longer to catch up when it is near zero-velocity. Combine backspin with cue points as a fun way to loop beats.</p>

   <p><b>Pausing the record</b> <br />If you click and release without moving the mouse, the record will simply pause. This is handy when you want to briefly delay the record without losing tempo. Super-fast clicks can substitute for pitch bending in some cases.</p>

   <p><b>Cue point "drum machine"</b> <br />While on the left deck, use the number keys <b class="key">1</b> through <b class="key">5</b> to set cue points (shown as pieces of tape on the record) on bass drums, snares, hi-hats as they happen (look at the waveforms for timing) - and then press those keys again to play those sounds. You can cut, mix and match samples to make your own sequences or drum beats. Combine with brake effects, backspins etc. for even more fun. To  over-write an existing cue point, use <b class="key">shift</b> + <b class="key">1</b>. You can also set cue points when the power is off.</p>

   <p><b>Power scratch / beat juggling effects</b> <br />Cheat real-world turntable physics by setting a cue point (eg. <b class="key">1</b>) on a bass drum sound, then scratching over that sound; let the beat run for a bar or two, then hit <b class="key">1</b> and click + drag to seamlessly scratch from the beginning of the loop as though you were beat juggling two copies of the same record.</p>

   <p><b>Power brake mix</b> <br />When a snare or bass drum plays, press <b class="key">&lt;</b> to stop the left deck's motor and produce an electronic brake sound effect; combine this with <b class="key">&larr;</b> to cut the cross-fader to the left deck to play just this sound, then hit <b class="key">&darr;</b> or <b class="key">&rarr;</b> to bring the other turntable back into the mix for the next beat. Using <b class="key">shift</b> + <b class="key">&darr;</b> turns the power off, letting the motor spin down - a longer-running sound than stopping the motor.</p>

   <p><b>Quick pitch bending</b> <br />To match the other record, grab the pitch slider and drastically change the record speed (e.g., if behind, speed it up +6%); as it nears being in sync, bring it back towards the matching speed (e.g., +1%.)</p>

   <h2>Bonus URL parameters</h2>

   <ul>
    <li><a href="?scratch=1#more" class="exclude">?scratch=1</a>: Force scratch mode <i>on</i></li>

    <li><a href="?scratch=0#more" class="exclude">?scratch=0</a>: Force scratch mode <i>off</i></li>
    <li><a href="?debug=1#more" class="exclude">?debug=1</a>: Enable script + UI debug mode</li>
    <li><a href="?html5audio=1#more" class="exclude">?html5audio=1</a>: Enable HTML5 audio support</li>
    <li><a href="?raf=1#more" class="exclude">?raf=1</a>: Enable <code>requestAnimationFrame()</code> support</li>
    <li><a href="?tripmat=1#more" class="exclude">?tripmat=1</a>: "Tripmat" slipmat (<i>like, woah, man.</i>)</li>
    <li><a href="?skin=yahoo#more" class="exclude">?skin=yahoo</a>: Yahoo!-themed turntable skin</li>
    <li><a href="?skin=flickr#more" class="exclude">?skin=flickr</a>: Flickr-themed slipmats</li>
   </ul>

  </div>
<p id="experimental" style="clear:both;display:none;padding-top:1em"><span style="padding:3px 5px;background:rgba(255,48,48,0.25);color:#999;font-weight:bold">WARNING: Scratch mode is <em>highly experimental.</em> Sound may be terrible under high CPU load. No, really!</span></p>
</div>
</div>

  <div id="the-music">

   <div class="first-column">

    <h2>Sample music</h2>

   </div>

   <div id="soundcloud-tracks" class="second-column">

    <div id="soundcloud">
     <h2>Hot tracks from <a href="http://soundcloud.com/tracks/" target="_blank" class="exclude">SoundCloud</a></h2>
     <div id="soundcloud-top10">
     	<ul>
     		@foreach($musicposts as $musicpost)
     			@if($musicpost->soundcloud_id != 0)
     			<li><a href="#" data-track-id="{{$musicpost->soundcloud_id}}" oncontextmenu="return false">{{$musicpost->title}}</a></li>
     			@endif
     		@endforeach
     	
     </ul></div>
    </div>

    <p>(Note: Waveforms are currently excluded for SC tracks.)</p>

   </div>

   <div class="third-column">

    <h2>Beastie Boys - <a href="http://soundcloud.com/beastieboys/sets/hot-sauce-committee-part-two/" target="_blank" class="exclude">Hot Sauce Committee Pt. 2</a> <span style="white-space:nowrap">(via SoundCloud)</span></h2>

    <div id="soundcloud-beastieboys"><ol><li><a href="#" data-track-id="92584655" oncontextmenu="return false">Adele</a></li></ol></div>

    <p>The Beasties are pretty web-friendly musicians for making their album available for streaming from SoundCloud. Thanks, dudes.</p>

   </div>

   <div style="clear:both"></div>

  </div>

 </div>

</div>

</div>

<!-- GENERAL DISCLAIMER: Sorry, it's going to get a little Dreamweaver-y in here at points on the non-turntable content with inline style stuff. -->



 <p>This is a <a href="http://www.schillmania.com/projects/soundmanager2/" title="JavaScript Sound API for the Web">SoundManager 2</a> prototype by Scott Schiller (<a href="http://twitter.com/schill/">@schill</a>, or <a href="http://www.schillmania.com/content/react/contact/" title="Scott Schiller, say hello / contact info">say hello</a>.) Want more? Read about <a title="On the Tweeter" href="http://www.schillmania.com/content/entries/2011/wheels-of-steel/" title="The Wheels Of Steel: An Ode To Turntables (in HTML), schillmania.com">The Wheels Of Steel (in HTML)</a>.</p>

</div>

</div>

<script type="text/javascript">
if (document.domain.match(/wheelsofsteel\.net/i)) {
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23791443-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
  })();
}
</script>

<script type="text/javascript" src="http://include.reinvigorate.net/re_.js"></script>
<script type="text/javascript">
if (document.domain.match(/wheelsofsteel\.net/i)) {
  try {
    reinvigorate.track("860j9-p08a8ujx40");
  } catch(err) {}
}
</script>

</body>

</html>