
<?php
$idErr=$modErr=$examErr=$dsErr=$tpErr="";

if(isset($_POST['valide'])){
    if(empty($_POST['identifiant'])) {
    $idErr = "Identifiant obligatoire";
    } elseif(!is_numeric($_POST['identifiant'])){ $idErr="Identifiant ne doit pas contenir des caracatères autre que chiffres";}
    else {$identifiant=$_POST['identifiant'];
    $conn=mysqli_connect("localhost","root","", "scolarite") or die ("could not connect to mysql");
    $id=$_POST['identifiant'];
    $cm=$_POST['module'];
    $result=mysqli_query($conn,"SELECT identifiant FROM etudiant WHERE identifiant=$id")or die(mysqli_error($conn));
    if (!$result) {  die(mysqli_error($conn));}
    $lign_rs = mysqli_num_rows($result); 
    if($lign_rs==1 or!$resultt){ 
    $ds=$_POST['ds'];
    $exam=$_POST['exam'];
    $tp=$_POST['tp'];
    if(verif($tp)&&verif($exam)&&verif($ds)){
    $sql="INSERT INTO notes VALUES('$id','$cm','$ds','$exam','$tp')";
    $res=mysqli_query($conn,$sql);
     if(!$res){echo '<script type="text/javascript">alert("Déjà inséré");</script>';   }
    }
    else{echo '<script type="text/javascript">alert("Les notes doivent être comprises entre 0 et 20");</script>'; }
    }
   
else {echo '<script type="text/javascript">alert("L\'identifiant inséré ne coresspond à aucun étudiant ou déjà inséré");</script>';}
          mysqli_close($conn);
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
<legend> <h2> Gestion notes - Ajouter </h2></legend>
<fieldset>
<legend>Notes</legend>
Identifiant étudiant: <br> <input type="text" name="identifiant"><span class="error">* <?php echo $idErr;?></span> <br>
Code module: <br> <input type="text" name="module">  <span class="error">* <?php echo $modErr;?></span> <br>
DS: <br> <input type="text" name="ds"> <span class="error"> <?php echo $examErr;?></span>  <br>
EXAMEN: <br> <input type="text" name="exam"> <span class="error"><?php echo $dsErr;?></span>  <br>
TP:<input type="text" name="tp"> <span class="error"> <?php echo $tpErr;?></span>  <br>
<input type="submit" name="valide" value="Valider">
<input type="reset" value="Effacer"> 
    <div class="info"> <?php if(isset($_POST['valide'])){echo 'Dernier ajout: '.$_POST['identifiant'];} ?> </div>
</form>
</script> 
</body>
</html>