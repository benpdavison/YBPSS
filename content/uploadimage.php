<!-- Code has been adapted from guide at http://www.php-mysql-tutorial.com/wikis/mysql-tutorials/uploading-files-to-mysql-database.aspx
	accessed: 20-03-2015 -->
<?php

$formOK = 0;

// Error variables in case input does not validate
$validName = $validFile = $validTitle= $validDesc = "";

// funtion to clean data from inputs to ensure safety
function clean_input($data) {
	$data = trim ( $data );
	$data = stripslashes ( $data );
	$data = htmlspecialchars ( $data );
	return $data;
}

//Check form Data
if (isset ( $_POST ['upload'] )) {
	if ($_FILES ['userfile'] ['size'] < 1) {
		$validFile = "<span class=\"require\">* File is too small</span>";
		$formOK = 1; // form is not OK
	}
	if (empty ( $_POST ["imgTitle"] ) || ctype_space ( $_POST ["imgTitle"] )) {
		$validTitle = "<span class=\"require\">* required</span>";
		$formOK = 1; // form is not OK
	}
	if (empty ( $_POST ["userName"] ) || ctype_space ( $_POST ["userName"] )) {
		$validName = "<span class=\"require\">* required</span>";
		$formOK = 1; // form is not OK
	}
	if (empty ( $_POST ["description"] ) || ctype_space ( $_POST ["description"] )) {
		$validDesc = "<span class=\"require\">* required</span>";
		$formOK = 1; // form is not OK
	}
	
}
// if the file upload has been sent and the file size is greater than 0 and form is ok
if (isset ( $_POST ['upload'] ) && $formOK  == 0) {

	
	//Open database connection and increment the ID for the image file
	require_once ('libraries/myPDO.php');
	$db = new myPDO ( 'myPDODB' );
	$statement = $db->prepare ( 'SELECT max(imgID) as imgIDM FROM imgGal' );
	$statement->execute ();
	$result = $statement->fetch ( PDO::FETCH_ASSOC );
	$fileID = ($result [imgIDM] + 1);
	
	//Create details for upload based on file attributes and form content
	$fileName = $_FILES ['userfile'] ['name'];
	$tmpName = $_FILES ['userfile'] ['tmp_name'];
	$fileSize = $_FILES ['userfile'] ['size'];
	$fileType = $_FILES ['userfile'] ['type'];
	$fileTitle = clean_input($_POST ['imgTitle']);
	$fileUploader = clean_input($_POST ['userName']);
	$fileDesc = clean_input($_POST ['description']);
	
	//Open the file content and dd slashes for security
	$fp = fopen ( $tmpName, 'r' );
	$content = fread ( $fp, filesize ( $tmpName ) );
	$content = addslashes ( $content );
	fclose ( $fp );
	
	//Add slashes to file name for security
	$fileName = addslashes ( $fileName );
	
	//Prepare statement for file data insertion to DB
	$query = $db->prepare ( 'INSERT INTO imgGal (imgID, imgName, imgTitle, imgType, imgSize, imgCont, imgUplder, imgUpDate, imgOK, imgDesc) ' . 'VALUES (:fileID, :fileName, :fileTitle, :fileType, :fileSize, :content, :fileUploader, NOW(), 1, :fileDesc)' );
	$query->bindParam ( ':fileID', $fileID, PDO::PARAM_INT );
	$query->bindParam ( ':fileName', $fileName, PDO::PARAM_STR );
	$query->bindParam ( ':fileTitle', $fileTitle, PDO::PARAM_STR );
	$query->bindParam ( ':fileType', $fileType, PDO::PARAM_STR );
	$query->bindParam ( ':fileSize', $fileSize, PDO::PARAM_INT );
	$query->bindParam ( ':content', $content, PDO::PARAM_LOB );
	$query->bindParam ( ':fileUploader', $fileUploader, PDO::PARAM_STR );
	$query->bindParam ( ':fileDesc', $fileDesc, PDO::PARAM_STR );
	
	//Excecute query
	try {
		$query->execute ();
	} catch ( Exception $e ) {
		echo $e;
		die ( "Oh noes! There's an error in the query!" );
	}
	
	//Close DB
	$db = null;
	
	//Display succesful file upload text
	echo '<h2> Thank You</h2> <p> Your file:<br>File ' . $fileName . '<br>has been uploaded. This will be submitted for review by out Staff and if accepted, displayed in our photo gallery.</p><a href="?page=uploadimage&pagePar=photogalleries"><button>Back to File Upload</button></a>';
	
} else {
	echo '
			<h3> Upload your Photo to our Gallery </h3>
			
			<form method="post" enctype="multipart/form-data">
				<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
				<label for="userfile">File: </label>
				<br>
				<input name="userfile" type="file" id="userfile" required>'.$validFile.'
				<br>
				<label for="imgTitle">Enter a title for your image: </label>
				<br>
				<input name="imgTitle" type="text" id="imgTitle" required>'.$validTitle.'
				<br>
				<label for="username">Please enter you name: </label>
				<br>
				<input name="userName" type="text" id="username" required>'.$validName.'
				<br>
				<label for="desctextf">Please enter a brief description of the image: </label>'.$validDesc.'
				<br>
				<textarea name="description" id="desctextf" required></textarea>
		
				<br>
				<br>
				<button name="upload" type="submit" value="upload">Upload Image</button>
				<br>
			</form>
		';
}

?>