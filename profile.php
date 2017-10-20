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

  $query = "SELECT userId FROM entries WHERE userId=".$userRow['userId'];
  $check = mysqli_query($link, $query);
  $res= mysqli_num_rows($check);
  $allowed_images = array('jpg', 'jpeg', 'png');
  $workDir = 'localhost';
    //Upload of images

    if(isset($_FILES['image']))
    {
        
        $file_name = $_FILES['image']['name']; 
        $tmp = explode('.',$file_name);
        $file_ext = end($tmp);
        $file_ext = strtolower($file_ext);
        $file_size =$_FILES['image']['size'];
        $file_tmplocation = $_FILES['image']['tmp_name'];
        
    }
    
    if(in_array($file_ext, $allowed_images))
    {
        if(move_uploaded_file($file_tmp, 'uploads/'.$file_name)) //Bug to be fixed!!!!
        {
            //code to show that upload was sucessful!
        }
           
    } 
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
		<title>Profile |
			<?php echo $userName; ?>
		</title>
		<link href="dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="profile.css" rel="stylesheet">
		<script src="assets/js/ie-emulation-modes-warning.js"></script>
		<script src="jquery.min.js"></script>
	</head>

	<body>
		<style type="text/css">
			body {
				background-color: yellow;
				padding-top: 70px;
			}
			
			#nameHead {
				font-size: 50px;
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
			
			.editArea {
				display: none;
				padding: 30px;
				border-radius: 6px;
			}
			
			.jumbotron {
				background: blue;
			}
			
			.nav,
			.navbar,
			.navbar-default,
			.navbar-fixed-top {
				color: white;
				background: white;
			}
			
			#hova:hover {
				text-decoration: none;
				color: deepskyblue;
			}
            #upload{
                background: url('lavender.png');
            }
		</style>
		<div class="container">
			<!-- Fixed navbar -->
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> <a class="navbar-brand" href="home.php">Lavender</a> </div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a href="home.php">Home</a></li>
							<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entries<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="home.php">This week</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="allentries.php">All Entries</a></li>
								</ul>
							</li>
							<li><a href="feedback.php">Feedback</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="active"><a href="profile.php">Profile</a></li>
							<li><a href="settings.php">Settings</a></li>
							<li><a href="logout.php?logout">Logout</a></li>
						</ul>
					</div>
				</div>
				<!--/.nav-collapse -->
			</nav>
			<form method="post" enctype="multipart/form-data">
				<div class="jumbotron">
					<h2 id="nameHead">
                        <?php echo $userName; ?> </h2>
					<p><a class="edit btn btn-lg btn-success" href="settings.php" role="button">Edit Profile <span class="glyphicon glyphicon-pencil"></span></a></p>
				</div>
                <input type="file" valaue="upload" class="glyphicon glyphicon-camera" id="upload"> 
				<div class="row marketing">
					<div class="col-lg-6">
						<h4>Email Address</h4>
						<p>
							<?php echo $userEmail; ?>
						</p>
					</div>
					<div class="col-lg-6">
						<h4>Account Settings</h4> <a href="settings.php" id="hova">Settings</a>
						<h4>Total Entries So Far</h4>
						<p>
							<?php   echo $res;?>
						</p>
					</div>
				</div>
			</form>
		</div>
		<!-- /container -->
		<link href="bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script>
			window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')
		</script>
		<script src="bootstrap.min.js"></script>
		<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
		<script type="text/javascript">
			<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
			script src = "assets/js/ie10-viewport-bug-workaround.js" >
		</script>
		<footer class="footer" style="position:absolute; margin-top:100px;">
			<p>&copy; 2017 Lavender</p>
		</footer>
	</body>

	</html>