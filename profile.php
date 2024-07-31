<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location:login.php');
    exit();
    
}
$email2=$_SESSION['user']['login'];  // bash n9arno flquery bash fdik row ytl3 lya ghir les row dyal dak luser
$con=mysqli_connect('localhost','root','','testphp') or die(mysqli_error($con));
// $query='SELECT u.* ,l.* from users u,loginn l 
// where u.id=l.id_user;
//';
$query="SELECT * from users where email='$email2'";
$result=mysqli_query($con,$query) or die(mysqli_error($con));
$rows=mysqli_fetch_all($result,MYSQLI_ASSOC);







?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img{
            width: 200px;
            height: 100px;
        }
    </style>
</head>
<body>
    YOUR Email: <?php  echo $_SESSION['user']['login']?> <br><br><br><br>
    <?php foreach($rows as $row){ ?> 
        photo <img src="<?=$row['photo'] ?>" alt=""> <br> <br> <br>
        NOM   <?php   echo $row['nom']?>  <br> <br>
        PRENOM  <?php   echo $row['prenom']?> <br> <br>
        SEXE <?php   echo $row['sexe']?> <br> <br>
        AGE  <?php   echo $row['age']?> <br> <br>
        Loisirs  <?php   echo $row['loisirs']?> <br> <br>

        <?php } ?>
        
    
<a href="logout.php" class="btn btn-outline-danger">LOGOUT</a> <br><br>
<a href="index.php" class="btn btn-outline-danger">Home page</a> 
<!-- had home page kulshi kishufha gha kyn lli katla3 lih direct profile  -->
    
</body>
</html>


<!-- ddik sidentifier khsni nbda ndkhl les infos dl users wghnsyb photo -->


