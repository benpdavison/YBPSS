<?php
//individual photo page.
if (! empty ( $_REQUEST ['pid'] )) {
	//set variable of photo requested
	$selectedID = $_REQUEST ['pid'];
	try {
		//open DB connection and prepare/execute query
		require_once ('libraries/myPDO.php');
		$db = new myPDO ( 'myPDODB' );
		$sql = 'SELECT * FROM imgGal WHERE imgID = :selectedID';
		$statement = $db->prepare ( $sql );
		$statement->bindParam ( ':selectedID', $selectedID, PDO::PARAM_INT );
		$statement->execute ();
		//get the image
		if ($statement->rowCount ()) {
			while ( $singImg = $statement->fetch ( PDO::FETCH_ASSOC ) ) {
				echo '<h3> ' . $singImg [imgTitle] . ' </h3>';
				//possible back to gallery button
				// echo '<a href="?page=photogalleries"><button> Back to Gallery </button></a>';
				echo '<div class="photo-gallery-container">';
				echo '<img src="libraries/img.php?id=' . $singImg [imgID] . '" alt="' . $singImg [imgDesc] . '" class="single-photo">';
				echo '<p>Uploaded by: ' . $singImg [imgUplder] . ' </p><p>Description:<br>' . $singImg [imgDesc] . '</p></div>';
			}
		//if image not found
		} else {
			include_once ("content/pageNotFound.php");
		}
		
		// Close db connection
		$db = null;
		
	} catch ( PDOException $e ) {
		echo $e->getMessage ();
	}
} else {
	include_once ("content/pageNotFound.php");
}
?>