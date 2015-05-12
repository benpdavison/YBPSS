<?php
try {
	//open DB connection and excecute statement
	require_once ('libraries/myPDO.php');
	$db = new myPDO ( 'myPDODB' );
	$sql = 'SELECT * FROM imgGal WHERE imgOK = 0'; // imgOK is a variable set after review. If imgOK = 0 image is ok to be displayed.
	$statement = $db->prepare ( $sql );
	$statement->execute ();
	
	//display photo's
	echo '<h3> Photo Galleries </h3>';
	echo '<div class="photo-gallery-container">';
	if (($statement->rowCount ()) > 1) {
		while ( $imgGalRow = $statement->fetch ( PDO::FETCH_ASSOC ) ) {
			echo '<div class="square"><a href="?page=viewphoto&amp;pid=' . $imgGalRow [imgID] . '">';
			echo '<img src="libraries/img.php?id=' . $imgGalRow [imgID] . '" alt="' . $imgGalRow [imgDesc] . '"> <br> ';
			echo '</a> </div>';
		}
	} else {
		echo 'There are currently no photos';
	}
	echo '</div>';
	
	// Close db connection
	$db = null;
	
} catch ( PDOException $e ) {
	echo $e->getMessage ();
}
?>