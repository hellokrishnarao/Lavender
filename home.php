<?php
  ob_start();
  session_start(); //Save the cookies
  //include ("dbconnect.php");
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

  $link= mysqli_connect("localhost", "root", "root", "dbtest");
 

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="lavender.png">
		<title>Welcome |
			<?php echo $userName; ?>
		</title>
		<link href="bootstrap.min.css" rel="stylesheet">
		<link href="home.css" rel="stylesheet">
		<script src="bootstrap.min.js"></script>
		<script src="jquery.min.js"></script>
		<script>
			window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')
		</script>
		<script src="dist/js/bootstrap.min.js"></script>
		<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
	</head>

	<body>
		<style>
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
				background: #01cb75;
			}
			
			.btn-primary {
				color: white;
			}
			
			.btn-success {
				color: white;
			}
			
			.btn-warning {
				color: white;
			}
			
			.active {
				background-color: aqua;
				color: aquamarine;
			}
			
			.heading {
				font-size: 3em;
			}
			
			.heading:hover {
				text-decoration: none;
			}
			
			.nv {
				background-color: #ffd633;
			}
		</style>
		<!-- Fixed navbar -
         <nav class="navbar nv" style="height: 100px; margin-top:-70px; border-radius:0px">
            <div class="container">
                    <a class="heading" href="home.php">Lavender</a>   
            </div>
            <!--/.nav-collapse --
        </nav> -->
		<nav class="navbar navbar-default" style="margin-top:-70px;">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> <a class="navbar-brand" href="home.php">Lavender</a> </div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
						<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entries<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Last Week</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">Last Month</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="allentries.php">All Entries</a></li>
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
					<p>What made your day memorable?</p>
				</div>
			</article>
			<form method="post" class="jumbotron form-group form-control alert" style="height:100%">
				<input placeholder="Title" name="title" class="form-control" value="Entry of <?php echo date(" d/m/Y ");?>" style="margin-bottom:20px" />
				<textarea class="form-control textarea" name="diary" style="resize:none; height:100px" maxlength="1500" placeholder="Write today's entry."></textarea>
				<input class="btn btn-lg btn-primary" style="margin-top: 20px" type="submit" role="button" value="Post It!" />
				<?php 
                    $userName=  $userRow['userName'];
                    //Create an empty row for the user in entries table and submit the form
                    $diary = mysql_real_escape_string($_POST['diary']);
                    $title = mysql_real_escape_string($_POST['title']);
                    $diary = htmlspecialchars($diary);
                    $title = htmlspecialchars($title);  
                    if($title == null)
                    {
                        $title =    "Entry of ".date(" d/m/Y "); 
                    }
                    
                    $date = date("dmY");
                    $userId = $userRow['userId'];
                    $timeOfEntry =time();
                    $query = "INSERT INTO entries(entryData,title,day,userId,timeOfEntry) VALUES('$diary', '$title', '$date', '$userId', '$timeOfEntry')";
                   
                ?>
					<div id="errorEmpty" class="warning">
						<?php

                        $tip = "<p style=\"font-size:17px;\"><br>Tip: Write in small points. Happy Writing! Make sure you don't leave it blank!</p>";
                         // Check if the entry is empty or not
                         if($diary!= NULL) 
                         {  
                             mysqli_query($link, $query);
                            
                         }
                        else 
                             echo $tip;
                    ?>
					</div>
			</form>
			<?php
                                                        
                            // to prevent the resubmission of post variables to the server
                           
                                // Create connection
                                $conn = mysqli_connect('localhost', 'root', 'root', 'dbtest');
                                // Check connection
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }
                                // In mySQL format
                                $date = date("Y-m-d");

                                // Fetch Each week's entry
                                $sql="SELECT * FROM entries WHERE userId='$userId' AND '$date' > DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER BY timeOfEntry DESC";


                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result)) {
                                    // output data of each row
                                    while($row = mysqli_fetch_assoc($result)) 

                                    {

                                        $entry= $row['entryData'];
                                        $title = $row['title'];
                                        nl2br($entry);
                                        $timeOfEntry = $row['timeOfEntry'];
                                        $timeElap = time_elapsed_string('@'.$row['timeOfEntry']);



    $article = <<<PHP

                                        <article class="jumbotron" style="padding-top:0px">
                                            <div class="entry">
                                                <form method="post" action="delete.php?userId=$userId&amp;timeofEntry=$timeOfEntry">
                                                    <input   type="submit" class="pull-right btn-lg btn btn-success del col-sm-1" name="userId" value="Delete" >
                                                </form>
                                                 <!----<form method="post" action="edit.php?userId=$userId&amp;timeofEntry=$timeOfEntry&amp;newData=$newEdit">
                                                    <input   type="submit" class="pull-right btn-lg btn btn-warning del col-sm-1" name="userId" value="Edit" >
                                                </form> ----->

                                                <p class="pull-right" style="margin-top:20px">$timeElap</p> 
                                                <p style="font-size:25px;padding:20px"> Title: $title</p>
                                                <div class="main">
               
PHP;
echo $article ;
echo "<p>".nl2br($entry)."</p>
        </div>
    </div>
</article>";    


                                   
                                   
                                }
                            } 
                            else 
                            {        
                                
                                echo "<p style=\"font-size:20px;\"class=\"jumbotron\">No entries available this week!</p>";
                            }
                             if (!isset($_SESSION)) {
                                session_start();
                            }

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $_SESSION['postdata'] = $_POST;
                                unset($_POST);
                                header("Location: ".$_SERVER['PHP_SELF']);
                                exit;
                            }
                            
                            mysqli_close($conn);
                            ?>
				<script src="jquery.min.js">
				</script>
				<footer class="footer">
					<p>&copy; 2017 Lavender</p>
				</footer>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	</body>

	</html>
	<?php ob_end_flush(); ?>
