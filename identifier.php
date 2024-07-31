

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       
        input[type='button'],button{
            margin:20px;
            position: relative;
            left:260px;
            width:100px;
        }
        .a{
            text-decoration:none;
        }
        a:hover{
            text-decoration: underline;

            color:blue;

       }

    </style>
    <link rel="stylesheet" href="bootstrap.min.css">

  
</head>
<body>
    <div class="container w-50 alert alert-secondary form">

        <h1 class="alert text-dark text-center form_title">S'IDENTIFIER</h1>
        <!--value= ?php?> if(isset($_POST['email']));{$_POST['email']='';};?>   -->

        <form action="" method="post" enctype='multipart/form-data'>
            <span>Photo:</span>
        <input type="file" name="photo"  class="form-control"> <br>
        <input type="text" name="nom" placeholder="Entrez Votre Nom" class="form-control"> <br>
        <input type="text" name="prenom" placeholder="Entrez Votre Prenom" class="form-control"> <br>
        <input type="text" name="telephone" placeholder="Entrez Votre telephone" class="form-control"> <br>
        <input type="text" name="age" placeholder="Entrez Votre age" class="form-control"> <br>
        <input type="radio" name="sexe" id='rd1' value="Homme">   Homme
        <input type="radio" name="sexe" id='rd2'  value="Femme">   Femme
        <br> <br> 

            <input type="text" name="email" value="<?php 
        if(isset($_POST['email'])){
            echo $_POST['email'];
        }?>"  placeholder="Email or Username" class="form-control email"> <br> 
            <!-- hna fash kaytla3 shi erreur hya fash ayb9a l email mktoob -->
            <input type="text" name="motdepasse" placeholder="Password" class="form-control"> <br>

            <label for="">Loisirs</label>
            <input type="checkbox" name="ch1" id=""> Sport
            <input type="checkbox" name="ch2" id=""> Walo
            <input type="checkbox" name="ch3" id=""> Music
            <button name="valider2" class="btn btn-outline-dark">Valider</button>
            <!-- <input type="button" value="Valider" name="valider2" class="btn btn-outline-dark" onclick=emailreset()> --> <br> <br>
            <span>Déja membre?<a class='a' href="login.php" class="">Login</a></span>
        
        </form>
    </div>
    

    <?php

if(isset($_POST['valider2'])){
    $con=mysqli_connect('localhost','root','','testphp') or die(mysqli_error($con));

    $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL); // bash yt799 mno wash email oula la wlkin tal dik filter validate hya fin kayt7a99 mnha
    $motdepasse=$_POST['motdepasse']; // bash yyakhud dik la valeur lli tktbat
    
        $errors=[];
        if(empty($email)){
            $errors[]= "Email est un champ obligatoire!";

        }elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
            $errors[]="Svp valider votre email";
        }
      


 

         //email norepeat
         $query="SELECT * from users where email='$email'";
         $result=mysqli_query($con,$query) or die(mysqli_error($con));
         $row=mysqli_fetch_assoc($result);


         if($row){ // ila kan un row dnc ra deja kyn
            $errors[]="email deja " ;
            
            echo "<a href='login.php' class='btn'>LOGIN</a>";
            
         }
         if(isset($errors)){ // ila kant errors
            if(!empty($errors)){
                foreach($errors as $msg){
                    echo  $msg . "<br>" ;
                    exit();
             // bash ykhruj bmarra wmayshofsh lta7t
            // bash ila l9a email m3awd may7tash yhbat lta7t wy9alb 3la password wsh7aal mn 7aja akhra ghadi ytbe3 email deja + login 
                }
            }
        }








         //$motdepasse=password_verify($motdepasse,$motdepasse_hash); kiverifie lk dak lpassword wash houwa hadak lhash dyalo 'galo'

         

           //password    
           if(empty($motdepasse)){
            $errors[]="Password est un champ obligatoire!";
         }elseif(strlen($motdepasse)<5){
            $errors[]="Password must be at least 5caracters";           //dik strlen stringlenght ila kanu sghar mn 7 dl7orof mhm 7na md
        } 

        $loisirs="";
        if(isset($_POST['ch1'])){
            $loisirs .= " Sport";
        }
        if(isset($_POST['ch2'])){
            $loisirs .= " Walo";
        }
        if(isset($_POST['ch3'])){
            $loisirs .= "  Music";
        }
       
       
        
         //errors
        if(empty($errors)){          // hna ra b7ala glna lih ila makan tashi error /ila kan $errors khawi dnc mal9ash erreur
            extract($_POST);
             // $motdepasse=password_hash($motdepasse,PASSWORD_DEFAULT);   // Hna bash ykhbi lpassword fdatabase

             $source=$_FILES['photo']['tmp_name'] ;
             $destination='img/'. $_FILES['photo']['name'] ;
             move_uploaded_file($source,$destination);
            $query="INSERT into users(id,photo,nom,prenom,email,motdepasse,telephone,age,sexe,loisirs) values(null,'$destination','$nom','$prenom','$email','$motdepasse','$telephone','$age','$sexe','$loisirs')";
//            INSERT into loginn(email,motdepasse,id_user) values('hamzafanidi64@gmail.com','11111',3); where id_user.loginn=id.users

            // $con ->prepare($query) -> execute() ; // b7al mysqli_query
            mysqli_query($con,$query) or die(mysqli_error($con)) ;
           $_POST['email']='';
            $_SESSION['user']=[
                "login"=>$email,  // b7alakatgulih ra login huwa l email
                "password"=>$motdepasse,
                "nom"=>$nom,
                "nom"=>$prenom,
                "nom"=>$age,
                "nom"=>$sexe,
                "telephone"=>$telephone
            ];






        //    session_start();

        //    $_SESSION['email']=$row['email'] ;
           header("location:profile.php") ;
           
            
            
         } //else{
        //     var_dump($errors); // b7al include 
      
            
        // } hadi lli lta7t 7sen
        if(isset($errors)){ // ila kant errors
            if(!empty($errors)){
                foreach($errors as $msg){
                    echo  $msg . "<br>" ;
                    // dik $msg wlhma 3rft kidarleha w9
                }
            }
        }



    

        // if($error==1){
        //     ;
        // }

}





?>

 
</body>
</html>

<!-- 3di probleme fash kan inserer makitms7sh lmail -->
<!-- if(!isset()) hadi if not isset -->



<!-- 
DELIMITER // 
CREATE PROCEDURE nomAgent2()  
BEGIN 
select * FROM agent;

end ; //
DELIMITER ;     hnaya katreje3 delimiter l2asli
call nomAgent2() -->

<!--
EX1:    
faire une procedure qui affiche les commandes today -->
<!-- qui affiche les produits en rupture en stock -->
<!-- faire une procedure qui affiche les produits dune catehgrorie passe comme par parametre
in out inout type parametre 



EX2:
faire une procedure qui affiche la designation , quantité et le prix des produits de la commande dont le numero est en parametre
faire une procedure modifachatproduit qui modifie la quantité en stock d'un produit dont la reference et la nuvelle valeur quantité sont  passés en parametre
faire un procedure qui affiche les fournisseurs dont un produit est vendu aujordhui d'une quantité superieur a une valeur passé en parametre et la designation contient unbe sous chaine passé au param

-->




<!-- 
DELIMITER //


CREATE PROCEDURE afficher2(in ref int)
BEGIN
select designation_produit , quantite_stock_produit ,prix_produit from produit where reference_produit=ref;
END //
DELIMITER ;
 -->






<!-- 
 DELIMITER //
create PROCEDURE listClientVille(in v varchar(20) )
BEGIN
SELECT * from client where ville=v;
end//
DELIMITER ;



call listclientville('rabat')



l age dans la cin est passé en param -->


<!-- 
DELIMITER ///
create PROCEDURE listAgeClient(in cin varchar(10))
begin
select timestampdiff(year,date_naissance_client,sysdate()) from client where cin_client=cin ;
end ///
DELIMITER ;
 -->
<!-- 

select timestampdiff(year,date_naissance_client,sysdate()) from client;


qui affiche la designation le prix et la quantité commandé des produits de la commande  dont le numero est passé en parametre


 -->


<!-- 



DELIMITER //

create procedure detail_dune_commande(in numcommande int(5))
BEGIN
select designation_produit ,prix_produit ,quantite_commande from produit inner JOIN detail_commande on detail_commande.reference_produit=produit.reference_produit where detail_commande=numcommande;



end //
DELIMITER ;


 -->


 <!-- faire une procedure qui affiche le total une commande dont le numero  est passé en parametre -->
<!-- quanité *prix


DELIMITER //

create procedure total_commande(in numerocommande int(5))
BEGIN
select sum(prix_produit*quantite_commande) from detail_commande INNER join produit on produit.reference_produit=detail_commande.reference_produit where detail_commande.numero_commande=numerocommande ;



end //
DELIMITER ;






faire une proce affiche le total d une commande d un client dans une periode les param sont la cin des clients la date de debut et la date fin

date comm hya lli m7sora
commande detail commande produit


tsweera






qui ajoute un detail d une commande dans les valeurs dyal detail commande sont passés en param 

tswera





qui affiche la quantité des produits vendus par produit dans une periode en se limitant sur les produits dont la qunatité vendus à superieur à 10











______________OUT_______________________:


ex1:
realiser une procedure  qui admet comme parametre le numero de commande et qui affiche le reste à payer en question


detail commande et produit jointure reglement













DELIMITER //
create PROCEDURE restepayer(in nc int)   
BEGIN
DECLARE tc float;
DECLARE tr float;
set tc=(select sum(prix_produit * quantite_commande) from produit inner join detail_commande on produit.reference_produit=detail_commande.reference_produit WHERE 
detail_commande.numero_commande=nc);
set tr=(SELECT sum(reglement.montant_reglement) from reglement where reglement.numero_commande=nc);
select (tc-tr);
END //
DELIMITER ;



varchar hwa lli kan3tewh une taille specifique


ex2:
ecrire une procedure





DELIMITER //
create PROCEDURE test(out x int)
BEGIN
set x=3;


END //
DELIMITER ;


DELIMITER //
create PROCEDURE test2(out x int)
BEGIN
select count(*) into x from client;


END //
DELIMITER ;







ex2
faire une procedure qui returne la moyenne d'age des clients








create PROCEDURE moyenneage(out moy int) BEGIN set moy=(select AVG(timestampdiff(year,date_naissance_client,sysdate())) from client) ; END;


call moyenneage(@moyenne) 
select @moyenne;



ex3:
faire une procedure qui retourne la moyenne des prix , la valeur maximale et minimale des prix des produits
"3output" 


DELIMITER //
create PROCEDURE details_prix(out moy int,out mini int, out maxi int)
BEGIN 
set moy=(SELECT avg(prix_produit) FROM produit); 
set mini=(SELECT min(prix_produit) from produit); 
set maxi=(select max(prix_produit) FROM produit); 

END //
DELIMITER ;


call details_prix(@moyenne,@minimum,@maximum);
SELECT @moyenne,@minimum, @maximum




ex:
faire une procedure qui retourne le nombre de produit d'une commande dont le numero est passé en parametre

in le numero du commande
out ch7al mn produit dla commande(nmbr_produit)




DELIMITER //
create PROCEDURE nombre_produit(in nc int,out np int)
BEGIN 
set np=(SELECT count(*) FROM detail_commande where numero_commande=nc);
 

END //
DELIMITER ;








ex 
faire une procedure qui retourne le nombre de produit jamais vendu d'un fournisseur dont le nom est passé en parametre 
an3tewha un founisseur!  raison social

ex2
faire une procedure qui retourne le pourcentage des ventes d'un fournisseur dont le nom est passé en parametre 



ex1:
DELIMITER //
create PROCEDURE produit_jamais_vendu(out np int,in nf varchar(20))
BEGIN  
WITH toto as (
select DISTINCT (detail_fourniture.raison_social_fournisseur) FROM detail_fourniture ; 
except
    SELECT DISTINCT(reference_produit) from detail_commande 
) 


END //
DELIMITER ;
makamlsh!!

test test
DELIMITER //
create PROCEDURE produit_jamais_vendu(out np int,in nf varchar(20))
BEGIN 
set np=(SELECT count(*) from produit INNER JOIN detail_fourniture on produit.reference_produit!=detail_fourniture.reference_produit where produit.reference_produit=np);
 

END //
DELIMITER ; -->

...


<!-- 
ex2:
sh7al shrina vs sh7al b3na 
an7tohom f deux variables wn7sbohom blama ndero count
somme du quantité achete


DELIMITER //
create PROCEDURE pourcentage(in nom varchar(30),out pourcentage float)
BEGIN
declare nbachat int;
declare nbvendu int ;
set nbachat=(SELECT sum(quantite_fourniture) from detail_fourniture where raison_social_fournisseur=nom );
set nbvendu=(SELECT sum(quantite_commande) from detail_commande inner join produit on produit.reference_produit=detail_commande.reference_produit INNER JOIN detail_fourniture on produit.reference_produit=detail_fourniture.reference_produit where raison_social_fournisseur=nom  );

set pourcentage=(nbvendu*100)/nbachat;
end //
DELIMITER ;



call pourcentage("aaa",@pourcentage)
select @pourcentage






DELIMITER //
create PROCEDURE testinout(inout x int)
BEGIN
select count(*) into x from produit where quantite_stock_produit > x;


end //
DELIMITER ;



set  @s=10;
call testinout(@s);
select @s ;





ex :
proced à l aide d un seul param entrer sortie retourne  le total d une commande connu par son numero  




DELIMITER //
create PROCEDURE total_commande_inout(inout num int)
BEGIN
select sum(prix_produit * quantite_commande) into num from produit INNER join detail_commande on produit.reference_produit=detail_commande.reference_produit where numero_commande=num ;


END //
DELIMITER ;


set @s=10;
call total_commande_inout(@s);
SELECT @s;







ex
en utilisant un seul param inout qui retourne par exemple la chaine suivante meftah khalil 06/11/2003 : total commande :500dhs ces infos concerne le client qui a passé la derniere commande concernant le client qui a passe une commande  relative au produit dont le nom est passé en param  aujourdhui 




























-->


































-->


<!-- 

