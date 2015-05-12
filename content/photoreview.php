<?php
require_once ('libraries/myPDO.php');

// funtion to clean data from inputs to ensure safety
function clean_input($data) {
	$data = trim ( $data );
	$data = stripslashes ( $data );
	$data = htmlspecialchars ( $data );
	return $data;
}
// if the file approval has been sent
if (isset ( $_POST ['imgID'] )) {
	//approve or decline variable
	$adp = strcmp($_POST['adp'], "approve");
	//if adp = 0 (approve)
	if ($adp == 0) {
	
		//Open database connection 
		$db = new myPDO ( 'myPDODB' );
			
		//Create details for upload based on file attributes and form content
		$imgTitle = clean_input($_POST ['imgTitle']);
		$fileUploader = clean_input($_POST ['imgUpld']);
		$imgDesc = clean_input($_POST ['imgDesc']);
		$imgID = $_POST ['imgID'];
		$OK = 0; // 0 = yes

		
	
		//Prepare statement for file data insertion to DB
		$query = $db->prepare ( 'UPDATE imgGal 
									SET imgTitle = :imgTitle, imgUplder = :fileUploader, imgOK = :OK, imgDesc = :imgDesc
									WHERE imgID = :imgID;' );
		$query->bindParam ( ':imgID', $imgID, PDO::PARAM_INT );
		$query->bindParam ( ':OK', $OK, PDO::PARAM_INT );
		$query->bindParam ( ':imgTitle', $imgTitle, PDO::PARAM_STR );
		$query->bindParam ( ':fileUploader', $fileUploader, PDO::PARAM_STR );
		$query->bindParam ( ':imgDesc', $fileDesc, PDO::PARAM_STR );
		
		//Excecute query
		try {
			$query->execute ();
		} catch ( Exception $e ) {
			die ( "There was an error in approving the image: ".$e );
		}
		
		//Close DB
		$db = null;
		
		//Display succesful file upload text
		echo '<br>File ' . $fileName . ' approved and added to site<br>';
		
	} else if ($adp > 0){
		//Open database connection 
		$db = new myPDO ( 'myPDODB' );
		
		$imgID = $_POST['imgID'];
		
		$query = $db->prepare ( 'DELETE FROM imgGal 
									WHERE imgID = :imgID' );
		$query->bindParam ( ':imgID', $imgID, PDO::PARAM_INT );
		//Excecute query
			try {
				$query->execute ();
			} catch ( Exception $e ) {
				die ( "There was an error removing the image: ".$e );
			}
			//Close DB
			$db = null;
		
			//Display succesful file upload text
			echo '<br>File ' . $fileName . ' was removed from the site site<br>';
	
	}
}
	
echo '<h3>Photo Review Page</h3>
<p> <i>In the final distribution of this website, this page is intended to be accessible only by a secure lgoin by the web admin. 
		The functionality however, would remain largely the same.</i></p>
		<p> Whilst reviewing content please ensure all is appropriate to be displayed on the website. Please also indure the 
		description text provides and accurate description of the image as this will be used as alternative text if the photo cannot be displayed</p>';
try {
	//open DB connection and excecute statement
	$db = new myPDO ( 'myPDODB' );
	$sql = 'SELECT * FROM imgGal WHERE imgOK > 0'; // imgOK is a variable set after review. If imgOK = 0 image is ok to be displayed.
	$statement = $db->prepare ( $sql );
	$statement->execute ();

	//display photo's
	echo '<div class="photo-review-container">';
	if ($statement->rowCount ()) {
		while ( $imgGalRow = $statement->fetch ( PDO::FETCH_ASSOC ) ) {
			echo '<form class="review-panel" method="post"><div class="review-photo"><a href="?page=viewphoto&amp;pid=' . $imgGalRow [imgID] . '">';
			echo '<img src="libraries/img.php?id=' . $imgGalRow [imgID] . '" alt="' . $imgGalRow [imgDesc] . '">  ';
			echo '</a> <label for="imgID' . $imgGalRow [imgID] . '">Image ID = </label> <input type="text" id="imgID' . $imgGalRow [imgID] . '" name="imgID" value="' . $imgGalRow [imgID] . '" readonly>
					'. $imgGalRow [imgOK] . '</div>';
			echo '<div class="review-details"> <div class="review-inputs"> <label for="imgTitle' . $imgGalRow [imgID] . '">Photo Title</label><br>
					<input name="imgTitle" type="text" id="imgTitle' . $imgGalRow [imgID] . '" value="'.$imgGalRow [imgTitle].'" required></div>';
			echo '<div class="review-inputs"> <label for="imgDesc' . $imgGalRow [imgID] . '">Photo Description</label><br>
					<textarea name="imgDesc" id="imgDesc' . $imgGalRow [imgID] . '" required>'.$imgGalRow [imgDesc].'</textarea></div>';
			echo '<div class="review-inputs"> <label for="imgUpld' . $imgGalRow [imgID] . '">Photo Uploader</label><br>
					<input name="imgUpld" type="text" id="imgUpld' . $imgGalRow [imgID] . '" value="'.$imgGalRow [imgUplder].'" required></div>';
			echo '<div class="review-buttons"> 
					<input type="radio" name="adp" value="decline">Decline Image
					<input type="radio" name="adp" value="approve">Approve Image
					<button id="submit' . $imgGalRow [imgID] . '" type="submit" value="submit">Submit Review</button> 
					</div></div>
					</form>';
		}
	} else {
		echo 'There are currently no photos for review';
	}
	echo '</div>';

	// Close db connection
	$db = null;

} catch ( PDOException $e ) {
	echo $e->getMessage ();
}