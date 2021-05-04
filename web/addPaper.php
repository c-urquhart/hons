<?PHP
// file for adding papers
	$file = basename($_FILES["file"]["name"]);
	//echo($path);
	
	$uploadOk = 1;
	$fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
	
	//TODO include condition handling. DUplicates etc
	
if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["file"]["tmp_name"], $file)) {

	} else {
		echo "Sorry, there was an error uploading your file.";
	}
}

require 'connection.php';
//echo($file);

//add upload date

$sql =  'INSERT INTO papers (title, author, filepath) VALUES ("'.$_POST['title'].'","'.$_POST['authors'].'","'.$file.'")';

echo($sql);

$constr->query($sql);

header("Location: papers.php");

?>
