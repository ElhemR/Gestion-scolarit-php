
<?php
$add=0;
 $cinErr=$nomErr=$addErr=$prenomErr=$emailErr=$grdErr=$specErr=$modErr=$phoneErr="";

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

if(empty($_POST['mod1'])) {
 $modErr = "Au moins un module est obligatoire";
} 

if(empty($_POST['specialite'])) {
 $specErr = "Specialité obligatoire";
} 
else {$specialite=$_POST['specialite'];}  
    
if(empty($_POST['grade'])) {
 $grdErr = "Grade obligatoire";
} 
else {$grade=$_POST['grade'];}  
    
if(!empty($cin)&&!empty($nom)&&!empty($prenom)&&!empty($grade)&&!empty($specialite)&&!empty($telephone)&&!empty($email)){

$conn= mysqli_connect("localhost","root","", "scolarite") or die ("could not connect to mysql");
$sql="INSERT INTO enseignant VALUES ('$cin','$nom','$prenom','$adresse','$email','$telephone','$specialite','$grade')";
mysqli_query($conn,$sql); 
$add=$cin;


$mod1=$_POST['mod1'];

foreach($_POST["mod11"] as $md)
{
  $query = "INSERT INTO assure VALUES('$cin','$mod1','$md')";
  mysqli_query($conn,$query);
}   
    
$mod2=$_POST['mod2'];   
if(!empty($mod2)){
foreach($_POST["mod22"] as $md)
{
  $query1 = "INSERT INTO assure VALUES('$cin','$mod2','$md')";
  mysqli_query($conn,$query1);
}  
}

$mod3=$_POST['mod3'];  
if(!empty($mod2)){
foreach($_POST["mod33"] as $md)
{
  $query2 = "INSERT INTO assure VALUES('$cin','$mod3','$md')";
  mysqli_query($conn,$query2);
}  
}
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
<legend> <h2> Gestion enseignants - Ajouter </h2></legend>
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
    Specialité: <br> <input type="text" name="specialite">  <span class="error">* <?php echo $specErr;?></span> <br>
     Grade: <br>  <input type="radio" name="grade" value="prof" checked> Professeur 
    <input type="radio" name="grade" value="mconf"> Maître de conférences
    <input type="radio" name="grade" value="mass"> Maître assistant
    <input type="radio" name="grade" value="ass"> Assistant
    
    
    <span class="error">* <?php echo $grdErr;?></span> <br> 
    Module(s) Enseigné(s): 
    <br> <input type="text" name="mod1">   <span class="error">*<?php echo $modErr;?></span> <br>
    <input type="checkbox" name="mod11[]" value="cours" checked>COURS
    <input type="checkbox" name="mod11[]" value="td">TD
    <input type="checkbox" name="mod11[]" value="tp">TP <br>
    <br> <input type="text" name="mod2"> <br>
    <input type="checkbox" name="mod22[]" value="cours" checked>COURS
    <input type="checkbox" name="mod22[]" value="td">TD
    <input type="checkbox" name="mod22[]" value="tp">TP <br>
    <br> <input type="text" name="mod3"> <br> 
    <input type="checkbox" name="mod33[]" value="cours" checked>COURS
    <input type="checkbox" name="mod33[]" value="td">TD
    <input type="checkbox" name="mod33[]" value="tp">TP <br>
    <input type="submit" name="valide" value="Valider">
    <input type="reset" value="Effacer"> 
    <div class="info"> <?php if(isset($_POST['valide'])){echo 'Dernier ajout: '.$add;} ?> </div>
</form>
</script> 
</body>
</html>