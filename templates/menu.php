<?php
// Generate menu based on variables
// Menu containter, contains * where menu code will be placed
$menuContainer = '<div id="mobile-navigation" role="navigation">
          				   		<a id="menu-button" href="#" onclick="mobileNavToggle();">
          				   			<span class="fa fa-bars"></span> 
          				   			Menu
          				   			</a>
          					</div>
						<!-- Accessible Menu -->
							<nav>
								<ul class="noJSmenu" id="nav-menu">
								*
								</ul>
							</nav>
						<!-- Accessible Menu End -->';

$menu = array (
		// Main Menu
		array (
				"home" 
		),
		array (
				"about",
				// sub-menu
				array (
						"awards",
						"constitution" 
				) 
		),
		array (
				"services",
				// sub-menu
				array (
						"computing sessions for VIP's",
						"equipment & information",
						"home visiting",
						"hospital & support" 
				) 
		),
		array (
				"fundraising",
				// sub-menu
				array (
						"events",
						"previous events",
						"collections",
						"ways to fundraise" 
				) 
		),
		array (
				"volunteering",
				// sub-menu
				array (
						"fundraising",
						"home visiting",
						"supporting activities",
						"trustees" 
				) 
		),
		array (
				"activities" 
		),
		array (
				"news & reports",
				// sub-menu
				array (
						"annual reports",
						"newsletters",
						"volunteer newsletter" 
				) 
		),
		array (
				"contact",
				// sub-menu
				array (
						"location & directions",
						"staff" 
				) 
		),
		array (
				"photo galleries",
				//sub-menu
				array (
						"upload image",
						"photo review"
				) 
		),
		array (
				"videos" 
		) 
);
// very basic string conversion function to help with creating href
function getSafeHref($str) {
	$safeHref = $str;
	// if string has space, remove it
	if (preg_match ( '/\s/', $str )) {
		$safeHref = '';
		$explStr = explode ( ' ', $str );
		for($strPart = 0; $strPart < count ( $explStr ); $strPart ++) {
			$safeHref .= $explStr [$strPart];
		}
	}
	// convert string to lower case and return
	$safeHref = strtolower ( $safeHref );
	// use urlencode to ensure any special characters are passed correctly.
	return urlencode ( $safeHref );
}
// function to check what page is currently active
function checkActive($str) {
	$returnVal = '';
	$menuItem = '';
	// remove spaces from $str
	$explStr = explode ( ' ', $str );
	for($i = 0; $i < count ( $explStr ); $i ++) {
		$menuItem .= $explStr [$i];
	}
	$activeMenuItem = 'home';
	// check if pagePar variable has been passed, if it has, current page is a child page and parentpage menu item must be set to active
	if (! empty ( $_REQUEST ['pagePar'] )) {
		$activeMenuItem = urldecode ( $_REQUEST ['pagePar'] );
	} 	// if page is not child page, then check if it is a parent page, if not, page is the home page
	else if (! empty ( $_REQUEST ['page'] )) {
		$activeMenuItem = urldecode ( $_REQUEST ['page'] );
	}
	// if menuItem is the activeMenuItem then set menuItem to active
	// strcmp returns 0 if true
	if (strcmp ( $menuItem, $activeMenuItem ) == 0) {
		$returnVal = ' active';
	}
	// will return null if no page found
	return $returnVal;
}
// funtion to encode the php variables into the menu links.
function getHTTPLink($str1, $str2) {
	if ($str2 != null) {
		$pages = array (
				'page' => getSafeHref ( $str1 ),
				'pagePar' => getSafeHref ( $str2 ) 
		);
	} else {
		$pages = array (
				'page' => getSafeHref ( $str1 ) 
		);
	}
	$queryPass = http_build_query ( $pages, '', '&amp;' );
	return $queryPass;
}
//get menu container
$menuConExpl = explode ( '*', $menuContainer );
echo $menuConExpl [0];
// if menu has items
if ($menu) {
	// For each menu item
	for($item = 0; $item < count ( $menu ); $item ++) {
		// echo menu item string into href to enable menu hyperlink
		// Transform the first letter of each word to uppercase and echo menu item
		echo '<li class="noJSitem"><a href="?' . getHTTPLink ( $menu [$item] [0], null ) . '" class="' . checkActive ( $menu [$item] [0] ) . '">' . ucwords ( $menu [$item] [0] );
		// if menuItem has a sub menu then
		if ($menu [$item] [1]) {
			// echo text to close <a> tag and create a <div> and <ul>
			echo ' <span class="fa fa-chevron-down"></span>
						</a>
						<div class="sub-nav">
						<ul class="sub-nav-group">
						';
			// for each sub menu item get the safe href and echo capitalized title
			for($subItem = 0; $subItem < count ( $menu [$item] [1] ); $subItem ++) {
				echo '<li><a href="?' . getHTTPLink ( $menu [$item] [1] [$subItem], $menu [$item] [0] ) . '">' . ucwords ( $menu [$item] [1] [$subItem] ) . '</a></li>';
			}
			echo '</ul>
					</div>
					</li>';
		} else {
			// else echo text to close <a> tag and <li> tag
			echo '</a></li>';
		}
	}
}
echo $menuConExpl [1];
?>