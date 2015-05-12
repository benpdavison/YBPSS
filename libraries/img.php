<?php
///////////////////////////////////////////
//script to retreive image data from database
/////////////////////////////////////////////
// if id value is set
if (isset ( $_GET ['id'] )) {
	//get file ID
	$fileID = $_GET ['id'];
	
	// open DB connection and prepare query and execute
	require_once ('myPDO.php');
	$db = new myPDO ( 'myPDODB' );
	$sql = "SELECT imgName, imgType, imgSize, imgCont " . "FROM imgGal WHERE imgID = :id";
	$statement = $db->prepare ( $sql );
	$statement->bindParam ( ':id', $fileID, PDO::PARAM_INT );
	$statement->execute ();
	
	//assign $img the results from the query and assign variables or query
	$img = $statement->fetch ( PDO::FETCH_ASSOC );
	$name = $img [imgName];
	$type = $img [imgType];
	$size = $img [imgSize];
	$content = $img [imgCont];
	//strip slases from content
	$content = stripslashes ( $content );
	
	//write image to page
	header ( "Content-Type: " . $type );
	header ( 'Content-Disposition: inline; filename="' . $name . '"' );
	echo $content;
	
	//close db connection and script
	$db = null;	
	exit ();
}

?>