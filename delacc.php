<?php
  ob_start();
  session_start(); 
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
  $query = "DELETE FROM entries WHERE userId=$userId";
  $check = mysqli_query($link, $query);

  if ($check) 
  {
	  	//Deletes the user detials
	  $query = "DELETE FROM users WHERE userId = $userId";
	  $check = mysqli_query($link, $query);
	  $res= mysqli_num_rows($check);
	  if ($check) 
	  {
		unset($_SESSION['user']);
		session_unset();
		session_destroy();
		header("Location: index.html");
		exit;
	  }
	  else{
	  	echo "Error in deletion of user tables";
	  }
  }
  else{
  	echo "Error in deletion of tables";
  }

  

  ?> 