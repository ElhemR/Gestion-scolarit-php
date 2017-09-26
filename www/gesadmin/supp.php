<?php

if(isset($_POST['rech'])){
$ens=$_POST['etud'];
$conn=mysqli_connect("localhost","root","", "scolarite") or die ("could not connect to mysql");
$result=mysqli_query($conn,"SELECT cin FROM admin WHERE cin=$ens")or die(mysqli_error($conn));
    if (!$result) {
    die(mysqli_error($conn));
}
$lign_rs = mysqli_num_rows($result);
    
if($lign_rs==1){ 
     $supp="DELETE FROM admin WHERE cin=$ens";
    mysqli_query($conn,$supp);
  echo '<script type="text/javascript">alert("Enseignant supprimé");</script>';
  
}
else {echo '<script type="text/javascript">alert("Le cin inséré ne coresspond à aucun employé");</script>';}
}

?>

<html>
<head>
    <meta charset="utf-8">
    <style>
    .zonerech {
    position: relative;
    top:200px;
    border-radius: 25px;
    border: 2px solid RGB(0,34,85);
    padding: 20px; 
    text-align:center;
    
    }
    h2{
    text-align: center;
    }    
    
    </style>
</head>
<body>
 <?php include("../entete.php") ?>    
<div class="zonerech">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 <h2> Gestion cadre administratif - Supprimer </h2>
 <input type="search" name="etud"><br> <br>
 <input type="submit" name="rech" value="Rechercher">
</div>
</form>

    
</body>
</html>