
<?php
$idErr=$modErr=$examErr=$dsErr=$tpErr="";

if(isset($_POST['valide'])){
    if(empty($_POST['identifiant'])or empty($_POST['module'])) {
    $idErr = "Identifiant et module obligatoire";
    } elseif(!is_numeric($_POST['identifiant'])){ $idErr="Identifiant ne doit pas contenir des caracatères autre que chiffres";}
    else {$identifiant=$_POST['identifiant'];
    $conn=mysqli_connect("localhost","root","", "scolarite") or die ("could not connect to mysql");
    $id=$_POST['identifiant'];
    $cm=$_POST['module'];
    $result=mysqli_query($conn,"SELECT id FROM notes WHERE id=$id and cm='$cm'")or die(mysqli_error($conn));
    if (!$result) {  die(mysqli_error($conn));}
    $lign_rs = mysqli_num_rows($result); 
    if($lign_rs==1){ 
    $suj=$_POST['sujet'];
    $sql="INSERT INTO doublecorrection VALUES('$id','$cm','$suj')";
    $res=mysqli_query($conn,$sql);
     if(!$res){echo '<script type="text/javascript">alert("La demande est déjà déposée");</script>';   
    }
    }
   
else {echo '<script type="text/javascript">alert("L\'identifiant inséré ne coresspond à aucun étudiant ou déjà inséré ou aucune note attribuée");</script>';}
}
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
<legend> <h2> Demande double correction </h2></legend>
<fieldset>
<legend>Notes</legend>
Identifiant étudiant: <br> <input type="text" name="identifiant"><span class="error">* <?php echo $idErr;?></span> <br>
Code module: <br> <input type="text" name="module">  <span class="error">*</span> <br>
Sujet: <br>  <select name="sujet">
    <option value="ds">DS</option>
    <option value="exam">Examen</option>
   </select>
    
<input type="submit" name ="valide" value="Valider">     
<input type="reset" value="Effacer"> 
   
</form>
</script> 
</body>
</html>