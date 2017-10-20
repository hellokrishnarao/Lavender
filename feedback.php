<?php
  ob_start();
  session_start(); //Save the cookies
  include ("dbconnect.php");
  $link= mysqli_connect("localhost", "root", "root", "dbtest");
  $id_exists = mysqli_real_escape_string($link, $userRow['userId']);
  $query = "SELECT userId FROM entries WHERE userId=".$userRow['userId'];
  $check = mysqli_query($link, $query);



  if( !isset($_SESSION['user']) )
  {
    header("Location: login.php");
    exit;
  }

  $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
  $userRow=mysql_fetch_array($res);
  $userName=  $userRow['userName'];
  $userEmail = $userRow['userEmail'];
  $userId = $userRow['userId']; 

 

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
		<title>Feedback</title>
		<link href="bootstrap.min.css" rel="stylesheet"> </head>

	<body>
		<style>
			body {
				padding-top: 70px;
			}
			
			.textarea {
				padding: 10px;
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
				background: #66b3ff;
			}
		</style>
		<!-- Fixed navbar -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> <a class="navbar-brand" href="home.php">Lavender</a> </div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="home.php">Home</a></li>
						<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entries <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Last Week</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">Last Month</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="allentries.php">All Entries</a></li>
							</ul>
						</li>
						<li class="active"><a href="feedback.php">Feedback</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="profile.php">Profile</a></li>
						<li><a href="settings.php">Settings</a></li>
						<li><a href="logout.php?logout">Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<form class="jumbotron form-horizontal" method="post">
				<h2>Your Feedback</h2>
				<div class="row marketing form ">
					<div class="col-lg-6">
						<textarea class="textarea col-lg-6 form form-control" align="center" name="feed" placeholder="Your feedback is important! Please feel free to describe your experience with us!" style=" height: 200px;resize:none; border-radius:3px;"></textarea>
						<p style="margin-top:20px;">
							<button class="btn btn-lg btn-primary form form-control" style="margin-top:20px; padding-bottom:30px" type="submit">Submit!</button>
						</p>
						<?php
                        $feed = $_POST['feed'];
                        $date = date("Y-m-d");
                        $query = "INSERT INTO feedback(userName,feed,userId,day) VALUES('$userName','$feed','$userId','$date')";
                        $sucess= mysqli_query($link, $query);
                        if($feed)
                        {    
                            if($sucess)
                            {
                                echo "<p>Sucessfully submitted</p>";
                            }
                            else
                            {
                                echo "<p class=\"\">Try Again! Error in Submission</p>";
                            }
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
                    ?>
					</div>
				</div>
			</form>
			<footer class="footer">
				<p>&copy; 2017 Lavender</p>
			</footer>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script>
			window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')
		</script>
		<script src="bootstrap.min.js"></script>
	</body>

	</html>