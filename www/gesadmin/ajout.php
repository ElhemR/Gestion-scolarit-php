
<?php
 $cinErr=$nomErr=$addErr=$prenomErr=$emailErr=$posteErr=$phoneErr="";

if(isset($_POST['valide'])){   
$adresse=$_POST['adresse'];
if(empty($_POST['cin'])) {
 $cinErr = "CIN obligatoire";
} elseif(!is_numeric($_POST['cin'])){ $cinErr="CIN ne doit pas contenir des caracatères autre que chiffres";}
elseif(strlen(trim(($_POST['cin'])))<>8){ $cinErr="CIN doit contenir exactement 8 chiffres";}
else {$cin=$_POST['cin'];}
    
if(empty($_POST['nom'])) {
 $nomErr = "Nom obligatoire";
} elseif(!ctype_alpha($_POST['nom'])){ $nomErr="Le nom ne doit pas contenir des chiffres";}
else {$nom=$_POST['nom'];}
    
if(empty($_POST['prenom'])) {
 $prenomErr = "Prenom obligatoire";
} elseif(!ctype_alpha($_POST['prenom'])){ $prenomErr="Le prénom ne doit pas contenir des chiffres";}
else {$prenom=$_POST['prenom'];}   

if (empty($_POST["email"])) {
    $emailErr = "Email obligatoire";
  } else {
    $email = test_input($_POST["email"]);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Format Invalide "; 
    }
  }
if(empty($_POST['telephone'])) {
 $phoneErr = "Téléphone obligatoire";
} elseif(!is_numeric($_POST['telephone'])){ $phoneErr="Le numéro téléphone ne doit pas contenir des caracatères autre que chiffres";}
elseif(strlen(trim(($_POST['telephone'])))<>8){ $phoneErr="Le numéro téléphone doit contenir exactement 8 chiffres";}
else {$telephone=$_POST['telephone'];}

    
if(empty($_POST['poste'])) {
 $posteErr = "Poste obligatoire";
} 
else {$poste=$_POST['poste'];}  
    
if(!empty($cin)&&!empty($nom)&&!empty($prenom)&&!empty($poste)&&!empty($telephone)&&!empty($email)){

$conn= mysqli_connect("localhost","root","", "scolarite") or die ("could not connect to mysql");
$sql="INSERT INTO admin VALUES ('$cin','$nom','$prenom','$adresse','$email','$telephone','$poste')";
mysqli_query($conn,$sql); 

}
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
<legend> <h2> Gestion cadre administratif - Ajouter </h2></legend>
<fieldset>
<legend>Informations personnelles</legend>
CIN: <br> <input type="text" name="cin"><span class="error">* <?php echo $cinErr;?></span> <br>
Nom: <br> <input type="text" name="nom">  <span class="error">* <?php echo $nomErr;?></span> <br>
Prénom: <br> <input type="text" name="prenom"> <span class="error">* <?php echo $prenomErr;?></span>  <br>
Adresse: <br>
<input type="text" name="adresse"><br>
Email: <br> <input type="text" name="email"> <span class="error">* <?php echo $emailErr;?></span> <br> 
Téléphone: <br> <input type="text" name="telephone"><span class="error">* <?php echo $phoneErr;?></span> 
</fieldset>
<fieldset>   
<legend>Informations professionnelles</legend>
    Poste: <br> <input type="text" name="poste">  <span class="error">* <?php echo $posteErr;?></span> <br>
    <input type="submit" name="valide" value="Valider">
    <input type="reset" value="Effacer"> 
</fieldset>
</form>
</script> 
</body>
</html>