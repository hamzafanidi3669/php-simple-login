<?php

session_start();

$con = mysqli_connect('127.0.0.1', 'root', '', 'testphp') or die(mysqli_error($con)) ;
 
//$email = $_SESSION['user']['loginn'];  // drt hadi bash flta7t fash drt lvariable $email l9it m3amn n9arno
$email = $_POST['email'];  // drt hadi bash flta7t fash drt lvariable $email l9it m3amn n9arno

//$query = "UPDATE loginn SET etatcompte = false WHERE id.users= id_user.loginn " ;

// mysqli_query($con, $query2) or die(mysqli_error($con));
// mysqli_query($con, $query) or die(mysqli_error($con));

unset($_SESSION['email']); // b7ala khwi dak session mn dak email 

session_destroy() ; //hadi ra l3akss dyal session start

header("location:login.php") ;




 

?>