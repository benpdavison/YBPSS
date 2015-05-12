<?php echo '
<h3>Set the Color Theme</h3>
<h4>Preset Color Themes</h4>
<div class="colorThemes">
	<p>
		<button id="hC0" onclick="resetColor();return false;">
			Default</button>
		<button id="hC1"
			onclick="changeColor(\'#FFFF00\',\'#000000\',\'#FF0000\',\'#FFFF00\');return false;">
			High Contrast #1</button>
		<button id="hC2"
			onclick="changeColor(\'#00FF00\',\'#000000\',\'#FF00FF\',\'#00FF00\');return false;">High
			Contrast #2</button>
		<button id="hcB"
			onclick="changeColor(\'#FFFFFF\',\'#000000\',\'#FFFF11\',\'#FFFFFF\');return false;">
			High Contrast Black</button>
		<button id="hcW"
			onclick="changeColor(\'#000000\',\'#FFFFFF\',\'#0000EE\',\'#000000\');return false;">
			High Contrast White</button>
	</p>
	<button id="saveColorScheme" onclick="saveColorScheme()">Save
		Color Scheme</button>

</div>
<h4>Custom Color</h4>
<p></p>
<div id=\'colorSelectors\'>
	<p> 
		<label for="textColorSelector"> Text Color: </label>
		<input type="text" id="textColorSelector" class="fullCP" /> 
		<label for="bgColorSelector"> Background Color: </label>
		<input type="text" id="bgColorSelector" class="fullCP" /> 
		<label for="linkColorSelector"> Link Color: </label>
		<input type="text" id="linkColorSelector" class="fullCP" /> 
		<label for="borderColorSelector"> Border Color: </label>
		<input type="text" id="borderColorSelector" class="fullCP" />
	</p>
	<button id="resetColor" onclick="resetColor()">Reset Color</button>
	<button id="setCustomColor" onclick="changeToCustomColor()">Apply
		Custom Color</button>
	<button id="saveCustomColor" onclick="saveColorScheme()">
		Save Current Color Scheme
	</button>
</div>
<p></p>
<h3>Change Font Size</h3>
		<button title="decrease text size" onclick="changeTextSize(-1);return false;"><span class="fa fa-font"></span><span class="fa fa-arrow-down"></span></button>
		<span id="fontSizeDisplay">Font Size: 14 px</span>
		<button title="increase text size" onclick="changeTextSize(1);return false;"><span class="fa fa-font"></span><span class="fa fa-arrow-up"></span></button>
		<br>
		<button title="reset font size" onclick="setFontSize(14); return false;">Reset Font Size</button>
		<button title="save font size" onclick="saveColorScheme(); return false;">Save Font Size</button>
';?>
