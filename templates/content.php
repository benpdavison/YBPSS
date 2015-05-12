<?php
// Set all Variables
$container_top = '<div class="row article-container"><div id="article-column" class="col-xs-12 col-sm-9 col-md-9 col-lg-9 "><article id="article">';
$container_bottom = '</article></div>';
// code snippet adapted from http://rudiv.se/Development/Resource/creating-simple-dynamic-website-and-more-with-php
// accessed 11/03/2015
//
// The function of this code, is to convert the name value pare of page => pageName into a file that can then be loaded. For this to function the name of the webpage and the file must be exactly the same.
// the code will first check to see if the name value pair has been passed, if it has been passed then it will check for the existence of a file with that name.
// If the file exists then the var $checkFile will be set tot he name of the existing file and the file loaded within the content pane of the page.
// Additionally if the value of the name value pair is set to any of the disallowed paths, those being any of the template files, then it will display the page not found page.
function checkFile() {
	// Specify some disallowed paths
	$disallowed_paths = array (
			"head",
			"header",
			"menu",
			"sidebar",
			"footer",
			"content",
			"myPDO" 
	);
	//if page request is not empty
	if (! empty ( $_REQUEST ['page'] )) {
		$tmp_content = basename ( $_REQUEST ['page'] );
		$tmp_content = urldecode ( $tmp_content );
		$checkFile = "content/" . $tmp_content . ".php";
		// If it's not a disallowed path, and if the file exists, return the checkfile path
		if (! in_array ( $tmp_content, $disallowed_paths ) && file_exists ( $checkFile )) {
			return $checkFile;
		} else {
			$checkFile = "content/pageNotFound.php";
			return $checkFile;
		}
	//if page is empty set home as active page
	} else {
		return "content/home.php";
	}
}

echo $container_top;
include_once (checkFile ());
echo $container_bottom;

?>
