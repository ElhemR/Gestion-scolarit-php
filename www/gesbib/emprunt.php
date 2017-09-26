<?php
$idErr=$livErr="";
$time=date("Y-m-d");
if(isset($_POST['valide'])){
    $id=$_POST['identifiant'];
    $cote=$_POST['cote'];
    $conn=mysqli_connect("localhost","root","", "scolarite") or die ("could not connect to mysql");

    $etud=mysqli_query($conn,"SELECT identifiant FROM etudiant WHERE identifiant=$id");
    $etudl=mysqli_num_rows($etud);
    if($etudl==0){$idErr="Identifiant invalide";}
    $rtrd=mysqli_query($conn,"SELECT id,penalite FROM retard WHERE id=$id");
    $rtrdl=mysqli_num_rows($rtrd);
    $pen=mysqli_fetch_row($rtrd);
    if($rtrdl==1 and strcmp($time,$pen[0])<0){$idErr="Retard de remise du livre";}
    if($rtrdl==1 and strcmp($pen[0],$time)>0){
    $del=mysqli_query($conn,"DELETE FROM retard WHERE id=$id and cote=$cote");
    }
    $dispo=mysqli_query($conn,"SELECT ncopies FROM livres WHERE cote=$cote");
    $nbr=mysqli_fetch_row($dispo);
    if($nbr[0]==0){$livErr="Livre indisponible";}  
    
    if(($rtrdl==0 or $del) and $nbr[0]>0){
   $ins=mysqli_query($conn,"INSERT INTO emprunt(id,cote,dateemprunt,dateretourprevue)
   values('$id','$cote','$time',adddate(curdate(),interval 7 day))");  
    mysqli_query($conn,"UPDATE livres SET ncopies=ncopies-1 WHERE cote=$cote");
    }
    mysqli_close($conn);
}
?>


<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="ajout.css">
</head>
<body>
<?php include("../entete.php") ?> 

<form id="etudiant" class="etudiant" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  >
<legend> <h2> Gestion bibliothèque - Emprunt </h2></legend>
<fieldset>

Identifiant étudiant: <br> <input type="text" name="identifiant"> <span class="error">* <?php echo $idErr;?></span><br>
Cote: <br> <input type="text" name="cote">   <span class="error">* <?php echo $livErr;?></span><br> <br>
<input type="submit" name="valide" value="Valider">
<input type="reset" value="Effacer"> 
   </fieldset>
</form>
</script> 
</body>
</html>