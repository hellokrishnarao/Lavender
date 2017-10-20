<?php
  ob_start();
  session_start(); //Save the cookies
  include ("dbconnect.php");
  require('timetaken.php');
  $link= mysqli_connect("localhost", "root", "root", "dbtest");
  $id_exists = mysqli_real_escape_string($link, $userRow['userId']);
  $query = "SELECT userId FROM entries WHERE userId=".$userRow['userId'];
  $check = mysqli_query($link, $query);


        
  if( !isset($_SESSION['user']) ) {
    header("Location: login.php");
    exit;
  }

  // select loggedin users detail
  
  $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
  $userRow=mysql_fetch_array($res);
  $userName=  $userRow['userName'];
  //Create an empty row for the user in entries table and submit the form
  $diary = $_POST['diary'];
  $title = $_POST['title'];
  $date = date("dmY");
  $userId = $userRow['userId'];
  $query = "SELECT userId FROM users WHERE userEmail='$email'";

  /////////////////////////////////////////////////////////////////////////
 
  /////////////////////////////////////////////////////////////////////////

  $link= mysqli_connect("localhost", "root", "root", "dbtest");
  //$query="UPDATE entries SET entryData='".mysqli_real_escape_string($link, $_POST['diary'])."'WHERE userId='". $userRow['userId']."' LIMIT 1";
  

  //mysqli_query($link, $query);
  //$query="UPDATE entries SET title='".mysqli_real_escape_string($link, $_POST['title'])."'WHERE userId='". $userRow['userId']."' LIMIT 1";
  //mysqli_query($link, $query);

  //$query="UPDATE entries SET date='".date("dmY")."'WHERE userId='". $userRow['userId']."' LIMIT 1";
  //mysqli_query($link, $query);    
  

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="lavender.png">
		<title>All Entries |
			<?php echo $userName; ?>
		</title>
		<link href="bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script>
			window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')
		</script>
		<script src="bootstrap.min.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="jquery.min.js"></script>
	</head>

	<body>
		<style>
			body {
				min-height: auto;
				padding-top: 70px;
			}
			
			.del,
			.edt {
				margin: 10px;
				font-size: 1em;
				color: black;
			}
			
			.main {
				border: solid 2px black;
				padding: 30px;
				border-radius: 6px;
			}
			
			.del,
			.edt {
				margin: 10px;
				font-size: 1em;
				color: black;
			}
			
			.main {
				border: solid 2px #4d4d4d;
				padding: 30px;
				border-radius: 6px;
			}
			
			.editArea {
				display: none;
				padding: 30px;
				border-radius: 6px;
			}
			
			.jumbotron {
				background: white;
			}
			
			.nav,
			.navbar,
			.navbar-default,
			.navbar-fixed-top {
				color: white;
				background: white;
			}
			
			body {
				background: #ffd633;
			}
			
			a:hover {
				text-decoration: none;
				color: deepskyblue;
			}
			
			.btn-success {
				color: white;
			}
		</style>
		<!-- Fixed navbar -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> <a class="navbar-brand" href="home.php">Lavender</a> </div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">All Entries</a></li>
						<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entries<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Last Week</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">Last Month</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="home.php">Home</a></li>
							</ul>
						</li>
						<li><a href="feedback.php">Feedback</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="profile.php">Profile</a></li>
						<li><a href="settings.php">Settings</a></li>
						<li><a href="logout.php?logout">Logout</a></li>
					</ul>
				</div>
			</div>
			<!--/.nav-collapse -->
		</nav>
		<div class="container ">
			<article>
				<div class="jumbotron welcome">
					<h2>Hello
                        <?php echo $userName; ?>! </h2>
					<p>Here are all the entries you made</p>
				</div>
			</article>
			<?php
                            // Create connection
                            $conn = mysqli_connect('localhost', 'root', 'root', 'dbtest');
                            // Check connection
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }
                            
                            $date = date("Y-m-d");

                            // Fetch Each week's entry
                            $sql="SELECT * FROM entries WHERE userId='$userId' ORDER BY timeOfEntry DESC";
                            
                             $newEdit = "Helakdas dasjdsfsDF";
                            $result = mysqli_query($conn, $sql);
                           
                            if (mysqli_num_rows($result)) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                   
                                    $timeOfEntry = $row['timeOfEntry'];
                                    echo "                
                                    
				                           
				                                <article class=\"jumbotron\" style=\"padding-top:0px\">
                
                <div class=\"entry\">
                            <form method=\"post\" action=\"delete.php?userId=";echo $userId; echo"&timeofEntry=$timeOfEntry"; echo "\">
							<input   type=\"submit\" class=\"pull-right btn-lg btn btn-success del col-sm-1\" name=\"userId\" value=\"Delete\" >
							</form>
                          
                             <p class=\"pull-right\" style=\"margin-top:20px;\" >"; 
                                    
                                    echo time_elapsed_string('@'.$row['timeOfEntry']); 
                                    echo "</p> <p style=\"font-size:30px; padding:20px\">";
                                    echo " Title: ".$title; 
                                    echo "</p>";
                                    echo " <div class=\"main\"><p>";
                                    echo " ".$row['entryData']."<br>"; 
                                    echo "</p>
                            </div>
						</div>
				</article>
			"; 
                                   
                                }
                            } else {
                                echo "<p style=\"font-size:20px;\"class=\"jumbotron\">No entries available, <a href=\"home.php\">add</a> some?!</p>";
                            }

                            mysqli_close($conn);
                            ?>
				<footer class="footer">
					<p>&copy; 2017 Lavender</p>
				</footer>
		</div>
	</body>

	</html>
	<?php ob_end_flush(); ?>