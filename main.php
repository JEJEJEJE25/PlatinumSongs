<?php
include_once('config.php');
require_once ('core/controller.class.php');
if(isset($_COOKIE["sess"])){
	
	$cookies = $_COOKIE["sess"];
	$sql = "SELECT ID, Code, Title,sess FROM tblqueue where sess='$cookies' order by ID asc";
	$result = mysqli_query($conn, $sql);  
	$fisrtRow =mysqli_fetch_assoc($result);
	$reset = mysqli_data_seek($result,0); //reset the pointer
}


?>
<!DOCTYPE html>
<html>
<head>
		 <title>Karaoke</title>
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<!-- navigation bar -->
<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
	<img src="img/logo.png" alt="Bootstrap" width="50" height="50">
		Platinum Songs</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Platinum Songs</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="main.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/YoutubeAPI/list.php" target="_blank">Songbook</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="http://localhost/YoutubeAPI/logout.php">Logout</a>
          </li>
        </ul>
     
      </div>
    </div>
  </div>
</nav>

<!-- end of nav bar -->

<div class="container-fluid">
		<?php
		if(isset($_COOKIE["id"]) && isset($_COOKIE["sess"])){
			// echo "Coockie Detected";
			$Controller = new Controller;
			if($Controller->checkUserStatus($_COOKIE["id"], $_COOKIE["sess"])){
				// echo "User Logged In";
			}else{
				echo "Error";
			}
		}
		?>
		<!-- Session Code -->
		<input type="hidden" name="session" id="session" placeholder="sesioncode"
		value="<?php
		if(isset($_COOKIE["sess"])){
			$cookiecode = $_COOKIE["sess"];
		}
		echo $cookiecode;
		?>">
		
		<!-- refresh Container -->
		
			<form id="start" action="main.php" method="POST">
				<input class="btn btn-primary" type="submit" value="Refresh Queue" name="submit">
			</form>
		
		

		<!-- start button container -->
		
			<?php

			function searchFirstRow() {
				// Database connection details
				include("config.php");

				// SQL query to select the first row from the table
				$fisrtRow = $conn->query("SELECT searchCode FROM tblqueue LIMIT 1");

				if ($fisrtRow) {
					$row = $fisrtRow->fetch_assoc();
					if ($row) {
						$searchCode = $row['searchCode'];
						?>
						<!-- The value of the searchcode from the first row on the queue -->
						<form id="youtubeform">
							<input type="hidden" name="searchCode" id="searchCode" value="<?php echo $searchCode?>">
							<input class="btn btn-danger" type="submit" id="submit" value="Sing!">
						</form>
						<?php
						
					} else {
						echo "Select Songs Here <a href=\"http://localhost/YoutubeAPI/list.php\" target=\"_blank\">Songbook</a>";
					}
				} else {
					echo "Error: " . $conn->error;
				}

				// Close the connection
				$conn->close();
			}

			if (isset($_POST['submit'])) {
				searchFirstRow();
			}

			?>
</div>
<!-- video Container -->
<div class="container-fluid" id="videos"></div>
<!-- queue table -->
<div class="container" id="queue">
	<table class="table table-striped">
		<h2>Song Queue</h2>
		<thread>
			<tr>
				<td>Code</td>
				<td>Title</td>
				<td>Delete</td>
			</tr>
		</thread>
		<?php
		
		while ($row = mysqli_fetch_array($result)) {
			echo '<tr>
			<td>'.$row["Code"].'</td>
			<td>'.$row["Title"].'</td>'.
			'<td><a href="main.php?del='.$row["ID"].'">
			<img src="img/remove.png" width="24px" height="24px"></a></td>'
			.'<tr>';
		}
		?>
	</table>
<!-- delete queue here -->
	<form method="post" action="main.php">
    <input class="btn btn-danger" type="submit" name="btnDelAll" value="Delete All from Queue">
	</form>
	<?php
	function deleteall(){
		// Database connection details
		include("config.php");

		// SQL query to delete all records from the table
		$deletesql = "DELETE FROM tblqueue";

		if ($conn->query($deletesql) === TRUE) {
			?>
			<script> alert("All Deleted"); </script>
			<?php
			header("Location: main.php");
		} else {
			echo "Error deleting records: " . $conn->error;
		}

		// Close the connection
		$conn->close();
	}

	if(isset($_POST['btnDelAll'])){
		deleteall();
	}

	if(isset($_GET['del']))
	{
		$delID = htmlspecialchars($_GET['del']);
		$delete_single = "DELETE FROM tblqueue WHERE ID = $delID";

		if( ! $conn->query($delete_single))
		{
			echo $conn->error;
		}
		else
		{
			header("Location: main.php");
		}
	}
	?>

</div>
<!-- Scoreboard -->
<!-- <div id="score">ScoreBoard</div> -->
<!-- hiddenfields -->
<div> 
	<!-- VideoID -->
	<input type="hidden" id="videoID" placeholder="videoID" >
	<!-- duratiom -->
	<input type="hidden" id="min" placeholder="minutes">
	<input type="hidden" id="sec" placeholder="seconds">
	
    <input type="hidden" id="time" name="time" placeholder="Timer">


	<!-- if the value of timer becomes 0 -->
	

</div>


</body>
<!-- google cdn -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>
