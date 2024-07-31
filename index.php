<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
    a{
        margin:20px;
    }
    </style>
</head>
<body>
    <?php if(isset($_SESSION['user'])){
    ?>
    <a href="profile.php" class='btn btn-outline-secondary'>Profile</a> 
    <?php }else{ // ila kant dik session user feha shi 7aja tl3 lya lien dlprofile wila makansh 3tini ndekhel login dyali ula nt identifia
           ?> 
            <a href="identifier.php" class='btn btn-outline-success'>Register</a> <br> <br>
            <a href="login.php" class='btn btn-primary'>Login</a>
        <?php } ?>


</body>
</html>