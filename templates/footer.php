<?php

echo '
	<footer id="footer">
		<div class="row footer-container">
			<p class="footer-address">
				York Blind and Partially Sighted Society,<br /> Rougier House, <br />
				5 Rougier Street, <br /> York, <br /> YO1 6HZ. <br /> Tel: 01904
				636269,<br /> Fax: 01904 671154 <br /> Email: enquiries@ybpss.org <br />
				Registered charity: 508914 <br />
			</p>
		</div>
		<!--JS Files  in footer for better load time-->
		<!-- jQuery -->
		<script
			src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"
			type="text/javascript"></script>
		<!-- accessible Mega Menu JS -->
		<script src="js/jquery-accessibleMegaMenu.js" type="text/javascript"></script>
		<!-- initialize a selector as an accessibleMegaMenu -->
		<!-- This just sets the css class names for the accesible menu -->
		<script type="text/javascript">
	                $("nav:first").accessibleMegaMenu({
	                    /* prefix for generated unique id attributes, which are required 
	                       to indicate aria-owns, aria-controls and aria-labelledby */
	                    uuidPrefix: "accessible-megamenu",
	        
	                    /* css class used to define the megamenu styling */
	                    menuClass: "nav-menu",
	        
	                    /* css class for a top-level navigation item in the megamenu */
	                    topNavItemClass: "nav-item",
	        
	                    /* css class for a megamenu panel */
	                    panelClass: "sub-nav",
	        
	                    /* css class for a group of items within a megamenu panel */
	                    panelGroupClass: "sub-nav-group",
	        
	                    /* css class for the hover state */
	                    hoverClass: "hover",
	        
	                    /* css class for the focus state */
	                    focusClass: "focus",
	        
	                    /* css class for the open state */
	                    openClass: "open"
	                });
	            </script>
	
		<!-- Creare\'s \'Implied Consent\' EU Cookie Law Banner v:2.4 // Conceived by Robert Kent, James Bavington & Tom Foyster -->
		<script src="js/cookieConsent.js" type="text/javascript"></script>
		<!-- Mobile Menu Nav Toggle to hide and display nav -->
		<script type="text/javascript">
					var backupNavClass;
					// get the mobile menu. On click, if it is not expanded, add the expanded class. Else if it is expanded, close it by removing the expanded class.				
					function mobileNavToggle(){
						var menu = document.getElementById("nav-menu");
						var menuClass = menu.className;
						if (backupNavClass === null){
							backupNavClass = menuClass;
						}
						menu.getElementsByClassName("fa");
						if (menuClass == "nav-menu expanded"){
							menu.className = "nav-menu";
						} else {
							menu.className += " expanded";
						}
					  }
	            </script>
		<!-- remove noJS class names from menu and replace with normal class -->
		<!-- The no js was placed to ensure the menu displayed correctly without JS. This JD function simply removers the no JS class so that the accessible mega menu functions correctly. -->
		<script type="text/javascript">
					jQuery("#nav-menu").removeClass(\'noJSmenu\');
					jQuery(".noJSitem").removeClass(\'noJSitem\');
		</script>
		
		<!--Colorpicker JS for selecting custom color-->
		<script src="js/spectrum.js" type="text/javascript"></script>
			
		<!-- Colorpicker functions -->
		<script src="js/colorChange.js" type="text/javascript"></script>
		<!-- custom colorpicker JS -->
		<!-- intilize the color picker -->
		<script type="text/javascript">
					$(".fullCP").spectrum({
					    color: "#000",
					    showInput: true,
					    className: "full-spectrum",
					    showInitial: true,
					    showPalette: true,
					    showSelectionPalette: true,
					    maxPaletteSize: 10,
					    preferredFormat: "hex",
					    localStorageKey: "spectrum.demo",
					    clickoutFiresChange: true,
					    move: function (color) {
					        
					    },
					    show: function () {
					    
					    },
					    beforeShow: function () {
					    
					    },
					    hide: function () {
					    
					    },
					    change: function() {
					        
					    },
					    palette: [
					        ["rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)",
					        "rgb(204, 204, 204)", "rgb(217, 217, 217)","rgb(255, 255, 255)"],
					        ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
					        "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"], 
					        ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)", 
					        "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)", 
					        "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)", 
					        "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)", 
					        "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)", 
					        "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
					        "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
					        "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
					        "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)", 
					        "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"]
					    ]
					});
				</script>';
// IF on the video page, echo video JS, this is to stop element not found errors
if (! empty ( $_REQUEST ['page'] )) {
	$page = basename ( $_REQUEST ['page'] );
	if (strcmp ( $page, 'videos' ) == 0) {
		echo '				
<script src="https://vjs.zencdn.net/4.11/video.js" type="text/javascript"></script>
<script src="js/adVideo.js" type="text/javascript"></script>
<!-- Script to control the size of a video when java is enabled-->
<script type="text/javascript">
				//window resize event listener
				window.addEventListener("resize", setVideoJSSize);
			//this will get the width of the video container and calculate height for 16:9. Then apply both to the videoJS plugin.
				function setVideoJSSize(){
					var custWidth = $(\'#article-column\').width();
					//need a 5% margin for the element. get 5% of width.
					var custMargin = (custWidth *0.05).toFixed();
					custWidth = custWidth - custMargin;
					var custHeight = (custWidth * 0.56).toFixed();
					var myPlayer = videojs(\'video1\');
					myPlayer.width(custWidth, false);
					myPlayer.height(custHeight, false);
					$(\'#article-column\').css(\'padding-top\', custMargin+\'px\');
				};
				$(document).ready(function() {
					setVideoJSSize();
				});
			</script>
			';
	}
}
echo '
	
    </footer>
	

	
	 
<!-- A warning message for visitors who have JS Disabled; Modified from the no script warning on stack overflow https://www.stackoverflow.com-->
<noscript> <div id="noscript-warning">You currently have Javascript disabled. You do not have to enable Javascript, but some of the sites may not function correctly.
		</div> </noscript>

';
?>
