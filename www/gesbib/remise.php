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
    $emp=mysqli_query($conn,"SELECT * FROM emprunt WHERE id=$id and cote=$cote");
    $empl=mysqli_num_rows($etud);
    $empll=mysqli_fetch_row($emp);
    if($empl==0){$idErr="L'étudiant n'a pas emprunté ce livre";}
    elseif(!strcmp($empll[4],"0000-00-00")){
    mysqli_query($conn,"UPDATE emprunt SET dateretoureffective=curdate() WHERE id=$id and cote=$cote");
    mysqli_query($conn,"UPDATE livres SET ncopies=ncopies+1 WHERE cote=$cote");
    if(strcmp($empll[3],$time)<0)//Ajouter retard
    {
    $diff=round(abs(strtotime($time)-strtotime($empll[3]))/86400);
    $dd=$empll[2];   
    mysqli_query($conn,"INSERT INTO retard VALUES ($id,$cote,'$dd',adddate(curdate(),interval $diff day))");    
    }
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
<legend> <h2> Gestion bibliothèque - Remise </h2></legend>
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