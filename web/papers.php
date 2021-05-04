<!DOCTYPE html>
<?PHP

	session_start();
	

	
	// import connection details
	require 'connection.php';
	
	function getPaper($constr){
		$sql = 'select * from papers';
		$result = $constr->query($sql);
		return $result;
	}
?>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		<title> (PROJECT NAME) homepage </title>
		
		<script>
			function modalClick(p1, p2) {
				return p1 * p2;   // The function returns the product of p1 and p2
			}
		</script>
	</head>
	<body>
	
<nav class="navbar navbar-expand-sm bg-light">

  <!-- Links -->
  <ul class="navbar-nav">
	<li class="nav-item">
      <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="papers.php">Paper Management</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="visualisations.py">Visualisation</a>
    </li>
  </ul>

</nav>

<button data-toggle="modal" data-target="#addPaperModal" ID="addButton"> Add Paper </button>

<div class="modal fade" id="addPaperModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upload File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action = "addPaper.php" method="post" id="addPaperForm" enctype="multipart/form-data">
			<input type="file" required name="file" id="file"><br />
			<label for="title" required>Title:</label><br>
			<input type="text" id="title" name="title"><br>
			<label for="authors" required>Authors:</label><br>
			<input type="text" id="authors" name="authors"><br>
			<label for="pdate" required>Published Date:</label><br>
			<input type="date" id="pdate" name="pdate">
			<input type="submit" value="Upload File" name="submit">
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<div id="centreList">

	<?php 
		$result = getPaper($constr);

		// conditional handling of missing rows
		if ($result -> num_rows == 0){
			echo('<h1> No records </h1>');
		} else{
			// table printing code, need recursive looping
			echo('<table id="paperTable"><tr><td class = "tableCell">Title</td><td class = "tableCell">View</td><td class = "tableCell">Delete</td></tr>');
			// loop through each record
			//TODO include code here so there's a deletion function which takes the ID and deletes the paper
			
			while($row = $result->fetch_assoc()){
				echo('<tr><td class = "tableCell">'.$row["title"].'</td><td class = "tableCell"><a target="_blank" href="papers/'
				.$row["filepath"].'">View</a></td><td class = "tableCell"><a href ="deleteRecord.php?id='.$row["id"].'" >Delete</a></td></tr>');
			}
			echo('</table>');
		}
		
	?>
	
</div>
	
	</body>
</html>