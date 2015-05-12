//Set global vars
var textColorVar = "";
var bgColorVar = "";
var linkColorVar = "";
var borderColorVar = "";
var fontSize = 0;
var headingFontSize = 0;
var defaultSchemeVar = 0;


// funtion to assign colors to global vars
function setColorVars(tCol, bgCol, lCol, bCol, dSch) {
	textColorVar = tCol;
	bgColorVar = bgCol;
	linkColorVar = lCol;
	borderColorVar = bCol;
	defaultSchemeVar = dSch;
}
// function manually applies inline css to all the elements that need the color
// changing.
function changeColor(textColor, bgColor, linkColor, borderColor) {
	setColorVars(textColor, bgColor, linkColor, borderColor, 1);
	$(document.body).css({
		"color" : textColor,
		"background-color" : bgColor
	});
	$('a').css("color", linkColor);
	$('.container').css({
		"border-bottom-color" : borderColor,
		"border-right-color" : borderColor,
		"border-left-color" : borderColor
	});
	$('.nav-menu').css({
		"color" : textColor,
		"background-color" : bgColor
	});
	$('.nav-item > a').css({
		"background-color" : bgColor,
		"border" : "solid thin " + borderColor,
		"color" : textColor
	});
	$('.sub-nav').css({
		"background-color" : bgColor,
		"border" : "solid thin " + borderColor,
		"color" : textColor
	});
	$('.sub-nav > .sub-nav-group > li > a').css("color", textColor);
	$('.article-container').css({
		"border-top-color" : borderColor,
		"border-bottom-color" : borderColor,
		"border-right-color" : borderColor,
		"border-left-color" : borderColor
	});
	$('textarea').css({
		"background" : bgColor,
		"border" : "solid thin" + borderColor
	});
	$('input').css({
		"background" : bgColor,
		"border" : "solid thin" + borderColor
	});
	$('legend').css({
		"color" : textColor,
		"border-bottom-color" : borderColor
	});
	$('button').css({
		"background" : bgColor,
		"border" : "solid thin" + borderColor,
		"color" : textColor,
		"text-shadow" : "none"
	});
	$('.sp-input').css("color", textColor);
	$('.sidebar').css({
		"border-right-color" : borderColor,
		"border-left-color" : borderColor
	});
	$('.well').css({
		"border-top-color" : borderColor,
		"border-right-color" : borderColor,
		"border-bottom-color" : borderColor,
		"border-left-color" : borderColor,
		"background-color" : bgColor
	});
	$('#footer').css("border-top", "solid medium " + borderColor);
	$('h2').css({
		"border-top-color" : borderColor,
		"border-bottom-color" : borderColor
	});
	$('.footer-container').css({
		"color" : textColor,
		"background-color" : bgColor
	});
}
// by assigning a null value to all the css elements, jquery will remove the
// inline styling
function resetColor() {
	setColorVars("", "", "", "", 0);
	$(document.body).css({
		"color" : "",
		"background-color" : ""
	});
	$('a').css("color", "");
	$('.container').css({
		"border-bottom-color" : "",
		"border-right-color" : "",
		"border-left-color" : ""
	});
	$('.nav-menu').css({
		"color" : "",
		"background-color" : ""
	});
	$('.nav-item > a').css({
		"background-color" : "",
		"border" : "",
		"color" : ""
	});
	$('.sub-nav').css({
		"background-color" : "",
		"border" : "",
		"color" : ""
	});
	$('.sub-nav > .sub-nav-group > li > a').css("color", "");
	$('.article-container').css({
		"border-top-color" : "",
		"border-bottom-color" : "",
		"border-right-color" : "",
		"border-left-color" : ""
	});
	$('textarea').css({
		"background" : "",
		"border" : ""
	});
	$('input').css({
		"background" : "",
		"border" : ""
	});
	$('legend').css({
		"color" : "",
		"border-bottom-color" : ""
	});
	$('button').css({
		"background" : "",
		"border" : "",
		"color" : "",
		"text-shadow" : ""
	});
	$('.sp-input').css("color", "");
	$('.sidebar').css({
		"border-right-color" : "",
		"border-left-color" : ""
	});
	$('.well').css({
		"border-top-color" : "",
		"border-right-color" : "",
		"border-bottom-color" : "",
		"border-left-color" : "",
		"background-color" : ""
	});
	$('#footer').css("border-top", "");
	$('h2').css({
		"border-top-color" : "",
		"border-bottom-color" : ""
	});
	$('.footer-container').css({
		"color" : "",
		"background-color" : ""
	});
}
// get the colors from the custom color pickers and use them to apply the color
function changeToCustomColor() {
	var custTextColor = $("#textColorSelector").spectrum("get").toHexString();
	var custBgColor = $("#bgColorSelector").spectrum("get").toHexString();
	var custLinkColor = $("#linkColorSelector").spectrum("get").toHexString();
	var custBorderColor = $("#borderColorSelector").spectrum("get").toHexString();
	if (compareColors(custTextColor, custBgColor)) {
		alert("Poor visibility between text and background colors. Please rechoose and try again");
	} else {
		changeColor(custTextColor, custBgColor, custLinkColor,
				custBorderColor);
	 }
}
// get current font size, parse the int from the font size, add the int var
// passed and then set the font size
function changeTextSize(incr){
	fontSize = $(document.body).css(
			"font-size" );
	fontSize = parseInt(fontSize);
	if ((fontSize += incr) < 8){
		alert("Sorry the font size cannot be reduced below 8px as this would result in Poor visibility");
		return;
	} 
	fontSize += incr;
	setFontSize(fontSize);
}
// gets each text elemnt and assigns the new value
function setFontSize(num){
	num = parseInt(num);
	$(document.body).css(
			"font-size" , num + "px"
		);
		$('a').css(
				"font-size" , num + "px"
			);
		$('p').css(
				"font-size" , num + "px"
			);
		$('h1').css(
				"font-size" , (num+10) + "px"
			);
		$('h2').css(
				"font-size" , (num+10) + "px"
			);
		$('h3').css(
				"font-size" , (num+10) + "px"
			);
		$('h4').css(
				"font-size" , (num+4) + "px"
			);
		if ($('#fontSizeDisplay')){
			$('#fontSizeDisplay').text("Font Size: " + num + "px");
		}
}
//based on guidelines from W3 available online: http://www.w3.org/TR/AERT#color-contrast
function compareColors(t, bg) {
	var returnVal = true;
	// convert into hex
	var tCol= t.replace('#', '');
	var bgCol= bg.replace('#', '');
	// get hex values
	var tColR = parseInt("0x".concat(tCol.substr(0, 2)));
	var tColG = parseInt("0x".concat(tCol.substr(2, 4)));
	var tColB = parseInt("0x".concat(tCol.substr(4, 6)));
	var bgColR = parseInt("0x".concat(bgCol.substr(0, 2)));
	var bgColG = parseInt("0x".concat(bgCol.substr(2, 4)));
	var bgColB = parseInt("0x".concat(bgCol.substr(4, 6)));

	//get brightness values for colours
	var tColBrightness = Math.abs(((tColR * 299) + (tColG * 587) + (tColB * 114)) / 1000);
	var bgColBrightness = Math.abs(((bgColR * 299) + (bgColG * 587) + (bgColB * 114)) / 1000);
	//Brightness Difference = Brightness of color 1 - Brightness of color 2
	var brightnessDifference = Math.abs((tColBrightness) - (bgColBrightness));
	    //Color difference = Maximum (Red1, Red2) - Minimum (Red1, Red2) etc for Blue and Green
    var colorDifference = Math.max(tColR, bgColR ) - Math.min(tColR , bgColR) + 
    					Math.max(tColG, bgColG) - Math.min(tColG, bgColG) + 
    					Math.max(tColB, bgColB) - Math.min(tColB, bgColB);
	// check values
	if (brightnessDifference > 8000 && colorDifference > 100){
		returnVal = false;
	}
	// compare int to get result
	return returnVal;
	
}

// assigns the color values to the local storage in the browser.
function saveColorScheme() {
	localStorage.setItem('locTextColor', textColorVar);
	localStorage.setItem('locBgColor', bgColorVar);
	localStorage.setItem('locLinkColor', linkColorVar);
	localStorage.setItem('locBorderColor', borderColorVar);
	localStorage.setItem('locDefaultScheme', defaultSchemeVar);
	localStorage.setItem('locFontSize', fontSize);
}
// check if local storage is available
// http://stackoverflow.com/questions/16427636/check-if-localstorage-is-available
// accessed:07/04/2015
function lsTest(){
		  var test = 'test';
		  try {
		      localStorage.setItem(test, test);
		      localStorage.removeItem(test);
		      return true;
		  } catch(e) {
		      return false;
		  }
}

// when the page loads, check if the values are set, if they are, load them and
// apply.
$(document).ready(

		function() {

			var storedTextCol = "";
			var storedBgCol = "";
			var storedLinkCol = "";
			var storedBorderCol = "";
			var storedFontSize = 0;
			var storedDefaultScheme = 0;

			if(lsTest() === true){
				storedTextCol = localStorage.getItem('locTextColor');
				storedBgCol = localStorage.getItem('locBgColor');
				storedLinkCol = localStorage.getItem('locLinkColor');
				storedBorderCol = localStorage.getItem('locBorderColor');
				storedDefaultScheme = localStorage.getItem('locDefaultScheme');
			}
			if (localStorage.getItem('locFontSize') >= 8){
				storedFontSize = localStorage.getItem('locFontSize');
				setFontSize(storedFontSize);
			}
			// If the default scheme is set to false, then load the custome
			// colors.
			if (storedDefaultScheme > 0) {
				changeColor(storedTextCol, storedBgCol, storedLinkCol,
						storedBorderCol);
			} else {
				// Ensure default scheme by resetting color scheme.
				resetColor();
			}

		});