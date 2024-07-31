<?php
session_start();
if(isset($_SESSION['user'])){
    header('location:profile.php');
    exit();
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container{
            margin:120px;
        }
        button{
            margin:20px;
            position: relative;
            left:260px;
            width:100px;
        }
        a{
            position: relative;
            left:30px;
            top:50px;
        }
    </style>
    <link rel="stylesheet" href="bootstrap.min.css">

  
</head>
<body>
    <a href="identifier.php" class="btn btn-primary">S'identifier</a>
    <div class="container w-50 alert alert-secondary">
        <h1 class="alert text-dark text-center">LOGIN</h1>

        <form action="" method="post">
            <input type="text" name="email" placeholder="Email or Username" class="form-control"> <br>
            <input type="text" name="motdepasse" placeholder="Password" class="form-control"> <br>
            <button name="valider" class="btn btn-outline-dark">Valider</button>
        </form>
    </div>
    


<?php
    if(isset($_POST['valider'])){
    extract($_POST);


    $con=mysqli_connect('localhost','root','','testphp') or die(mysqli_error($con));
     $query="SELECT email, motdepasse from users where email='$email' and motdepasse='$motdepasse'"; // hna ra drt extract dnc deja 3de variables
     $result=mysqli_query($con,$query) or die(mysqli_error($con));

   
    if(empty($email)){
        $errors[]= "Email est un champ obligatoire!";

    }elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
        $errors[]="Svp valider votre email";
        
    }
    if(empty($motdepasse)){     // hdiiiiiiiiiiiiiiiiiiiiiiiiiiiii
        $errors[]='kteb password ashbi';
    }
    elseif(mysqli_num_rows($result)==0){ 
        // echo "<script>alert('Email or mot de passe incorrect!!')</script>";
        $errors[]='email or password incorrect' ;
    }else{
        //session_start(); deja mstartya lfo9
        $row=mysqli_fetch_assoc($result);
        $_SESSION['user']['login']=$row['email'];
         //b7ala kan7to dak l email lli tkteb 3dna fsession ou flprofile ghangulih flbdya ila kant khawya khrjo mn lprofile hadshi z3ma ila kteb fl url profile.php ykhrjo llogin
        // $query="UPDATE loginn set etatcompte= true where id.users=id_user.loginn";
        mysqli_query($con,$query)or die(mysqli_error($con));
        header("location:profile.php") ;
       
    }

  

    if(isset($errors)){
        if(!empty($errors)){
            foreach($errors as $msg){
                echo $msg . "<br>";
            }
        }
    }


 }
?>

</body>
</html>