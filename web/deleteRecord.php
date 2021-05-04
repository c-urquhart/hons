// file for deletion of records

// use $post or whatever to get id


// use ID to make a $sql to delete the shit

<?PHP

require 'connection.php';

$id = $_GET['id'];

$sql = 'DELETE FROM papers WHERE id = '.$id;

$constr->query($sql);

header("Location: papers.php");
?>