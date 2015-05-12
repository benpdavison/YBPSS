/**
 * modified from https://github.com/Hussnain1/Video.js-HD-Toggle-Plugin
 * The original plugin was used to be able to switch between HD and nonHD video, it is modified now to switch between, an Audio Described and Non audio Described video.
 * 
 */
        
        function ADtoggle () {
           
		   var AD1 = false;
		   /* It is the variable which tells us that that AD video is getting played or not.
			  AD1 = false ---> video is not AD
			  AD1 = true ----> video is AD */
          
             videojs.AD = videojs.Button.extend({
           /* @constructor */
               init: function(player, options){
                 videojs.Button.call(this, player, options);
                 this.on('click', this.onClick);
               }
             });
            
			/* Changing sources by clicking on AD button */
			/* This function is called when AD button is clicked */
            videojs.AD.prototype.onClick = function() {
         	
         	
         var ADsrc = $("#video1").find( "video" ).attr("AD"); 
		 /* Value of AD attribute in video tag is saved in ADsrc. */
         var noADsrc = $("#video1").find( "video" ).attr("nonAD");
		 /* Value of nonAD attribute in video tag is saved in noADsrc. */
         	
			if (AD1) { /* If video is not AD */
         var css = document.createElement("style");
         css.type = "text/css";
         css.innerHTML = ".vjs-control.vjs-AD-button { color: silver; font-weight:normal; text-shadow: 0 0 5em #fff;}";
		  /* Changing the AD button to initial styling when we play non AD video by clicking on AD button.*/
         document.body.appendChild(css);
         videojs("video1").src([{type: "video/mp4", src: noADsrc }]);
		 
         videojs("video1").play();
		 /* This automatically plays the video when we click on AD button to change the source.*/
         AD1 = false;
         }
         else { /* if video is AD */
         var css = document.createElement("style");
         css.type = "text/css";
         css.innerHTML = ".vjs-control.vjs-AD-button { color: #36D8DE; font-weight:bold; text-shadow: 0 0 1em #fff;}";
		/*This css applies when AD video is played. You can easily change the blue color of AD button by changing the value of color above. If you would like to remove the shadow from AD button, remove text-shadow from above.*/
		document.body.appendChild(css);
         videojs("video1").src([{type: "video/mp4", src: ADsrc }]);
         videojs("video1").play();
          /*This automatically plays the video when we  click on AD button to change the source.*/
		 AD1 = true;
         }
         	
         };
         
		 /* Create AD button */
		 var createADButton = function() {
               var props = {
                   className: 'vjs-AD-button vjs-control',
                   innerHTML: '<div class="vjs-control-content">' + ('AD') + '</div>',
                   role: 'button',
                   'aria-live': 'polite', 
                   tabIndex: 0
                 };
               
               return videojs.Component.prototype.createEl(null, props);
             };
         
		 /* Add AD button to the control bar */
         var AD;
             videojs.plugin('AD', function() {
               var options = { 'el' : createADButton() };
               AD = new videojs.AD(this, options);
               this.controlBar.el().appendChild(AD.el());
             });
         
          /* Set Up Video.js Player */
		 var vid = videojs("video1", {
              plugins : { AD : {} }
            });
             
}
    ADtoggle();/**
 * 
 */