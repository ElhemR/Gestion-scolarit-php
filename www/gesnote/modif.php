
<?php
$idErr="";
if(isset($_POST['valide'])){
    if(empty($_POST['identifiant'])or empty($_POST['module'])) {
    $idErr = "Identifiant et module obligatoires";
    } elseif(!is_numeric($_POST['identifiant'])){ $idErr="Identifiant ne doit pas contenir des caracatères autre que chiffres";}
    else {$identifiant=$_POST['identifiant'];
    $conn=mysqli_connect("localhost","root","", "scolarite") or die ("could not connect to mysql");
    $id=$_POST['identifiant'];
    $cm=$_POST['module'];
    $result=mysqli_query($conn,"SELECT id FROM notes WHERE (id=$id) and (cm='$cm')")or die(mysqli_error($conn));
    if (!$result) {  die(mysqli_error($conn));}
    $lign_rs = mysqli_num_rows($result); 
    if($lign_rs==1){ 
    $ds=$_POST['ds'];
    $exam=$_POST['exam'];
    $tp=$_POST['tp'];
    $cm=$_POST['module'];
    if(verif($tp)and !empty($tp)){
    $sql="UPDATE notes SET tp='$tp' WHERE (id=$identifiant) and (cm='$cm')";
    $res=mysqli_query($conn,$sql);
    }
    if(verif($ds)and !empty($ds)){
    $sql="UPDATE notes SET ds='$ds' WHERE (id=$identifiant) and (cm='$cm')";
    $res=mysqli_query($conn,$sql);
    }
    if(verif($exam)and !empty($exam)){
    $sql="UPDATE notes SET exam='$exam' WHERE (id=$identifiant) and (cm='$cm')";
    $res=mysqli_query($conn,$sql);
    
    }    
    if(!verif($ds)or!verif($exam)or!verif($tp))
    {echo '<script type="text/javascript">alert("Les notes doivent être comprises entre 0 et 20");</script>'; }
    }
   
else {echo '<script type="text/javascript">alert("L\'identifiant ou le module insérés ne coresspond à aucun étudiant ou déjà inséré");</script>';}
}
}

function verif($data){
if($data<0 or $data>20)
return(0);
return(1);
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
<legend> <h2> Gestion notes - Rectifier</h2></legend>
<fieldset>
<legend>Notes</legend>
Identifiant étudiant: <br> <input type="text" name="identifiant"><span class="error">* <?php echo $idErr;?></span> <br>
Code module: <br> <input type="text" name="module">  <span class="error">* </span> <br>
DS: <br> <input type="text" name="ds"> <br>
EXAMEN: <br> <input type="text" name="exam">  <br>
TP:<input type="text" name="tp">   <br>
<input type="submit" name="valide" value="Valider">
<input type="reset" value="Effacer">
</form>
</script> 
</body>
</html>