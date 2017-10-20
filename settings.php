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
		<title>Settings</title>
		<link href="dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<link href="navbar-fixed-top.css" rel="stylesheet">
		<script src="assets/js/ie-emulation-modes-warning.js"></script>
	</head>

	<body>
		<style>
			body {
				padding-top: 70px;
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
			
			a:hover {
				text-decoration: none;
				color: deepskyblue;
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
						<li><a href="feedback.php">Feedback</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="profile.php">Profile</a></li>
						<li class="active"><a href="settings.php">Settings</a></li>
						<li><a href="logout.php?logout">Logout</a></li>
					</ul>
				</div>
				<!--/.nav-collapse -->
			</div>
		</nav>
		<div class="container">
			<form method="post">
				<div class="jumbotron">
					<h2>Settings</h2>
					<div class="row marketing">
						<div class="col-lg-6">
							<h3>Profile Name</h3>
							<input class="textarea form-control form" name="newName" value="<?php echo $userRow['userName'];?>">
							<h3>Email Address</h3>
							<input class="textarea form-control form" name="newEmail" value="<?php echo $userRow['userEmail'];?>">
							<h3>Password</h3>
							<input class="textarea form-control form" name="newPass" placeholder="New Password" type="password"> </div>
						<div class="col-lg-6">
							<h3>Delete Account?</h3> <a href="delacc.php" class="btn btn-warning" value="Delete" type="submit" style="width:150px;">Delete</a>
							<h4></h4>
							<p>Deleting the account shall delete all your records. Please make sure you <a href="allentries.php">review</a> all your entries before deleting!</p>
							<h3>Suggestions</h3>
							<p>Please help us improve. Your <a href="feedback.php">feedback</a> is beyond valuable</p>
						</div>
					</div>
					<?php
                        
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $_SESSION['postdata'] = $_POST;
                            unset($_POST);
                            header("Location: ".$_SERVER['PHP_SELF']);
                            exit;
                        }
                        if($_POST['newName'] && $_POST['newEmail'])
                        {
                            
                         $newName = trim($_POST['newName']);
                         $newName = strip_tags($newName);
                         $newName = htmlspecialchars($newName);

                         $newEmail = trim($_POST['newEmail']);
                         $newEmail = strip_tags($newEmail);
                         $newEmail = htmlspecialchars($newEmail);

                         $newPass = trim($_POST['newPass']);
                         $newPass = strip_tags($newPass);
                         $newPass = htmlspecialchars($newPass);
                         $newPass = hash('sha256', $newPass);

                            $query = "UPDATE users SET userName='$newName' , userEmail='$newEmail', userPass='$newPass' WHERE userId=$userId";
                            $sucess= mysqli_query($link, $query);  
                            if($sucess)
                            {
                                echo "<p>Sucessfully submitted</p>";
                            }
                            else
                            {
                                echo "<p class=\"\">Try Again! Error in Submission! Details already exist!</p>";
                            }
                            // Unsets all post variables 
                           if (!isset($_SESSION)) {
                                session_start();
                            }

                        }   
                        
                        
                                    
                        
                  ?>
						<p style="margin-top:20px;">
							<input class="btn btn-primary" value="Save Changes" type="submit" style="width:150px; ;"> </p>
				</div>
				<footer class="footer">
					<p>&copy; 2017 Lavender</p>
				</footer>
			</form>
		</div>
		<!-- /container -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script>
			window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')
		</script>
		<script src="dist/js/bootstrap.min.js"></script>
		<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
	</body>

	</html>