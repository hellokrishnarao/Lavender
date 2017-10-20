<?php
require_once 'dbconnect.php';
//Define the query

$id = $_GET['userId'];
$timeOf = $_GET['timeofEntry'];

$query = "DELETE FROM entries WHERE userId=$id AND timeOfEntry=$timeOf";

//sends the query to delete the entry
mysql_query ($query);

if (mysql_affected_rows() == 1) { 
    
        
		header("Location: home.php");
		exit;
	
?>

           
<?php
 } else { 
//if it failed
?>

            <strong>Deletion failed. Delete.php page</strong><br /><br />
            

<?php
    
		header("Location: home.php");
		exit;
} 
?>