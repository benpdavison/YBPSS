<?php
echo '
<video id="video1" class="video-js vjs-default-skin" 
	AD="media/videos/rnibvideo1AD.mp4" nonAD="media/videos/rnibvideo1.mp4"
	preload="auto" width="640" height="360"
	poster="media/posters/rnibposter.jpg" data-setup=\'{}\' alt="video by the RNIB about loss of vision" controls>
	<source src="media/videos/rnibvideo1.mp4" type=\'video/mp4\'>
	<source src="media/videos/rnibvideo1.webm" type=\'video/webm\'>
	<track kind="captions"
		src="media/captions/rnibcaptions.vtt" srclang="en"
		label="English" default>
	<p class="vjs-no-js">
		To view this video please enable JavaScript, and consider upgrading to
		a web browser that <a href="http://videojs.com/html5-video-support/"
			target="_blank">supports HTML5 video</a>
	</p>
	
</video>
<br>
<br>

';
