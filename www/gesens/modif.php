
<?php
 if(isset($_POST['valide'])){
$ens=$_POST['cin'];
$conn=mysqli_connect("localhost","root","", "scolarite") or die ("could not connect to mysql");
$result=mysqli_query($conn,"SELECT cin FROM enseignant WHERE cin=$ens")or die(mysqli_error($conn));
    if (!$result) {
    die(mysqli_error($conn));
}
$lign_rs = mysqli_num_rows($result);
    
if($lign_rs==1){ 
    if(!empty($_POST['nom'])) {
    $val=$_POST['nom'];
    mysqli_query($conn,"UPDATE enseignant SET nom='$val' WHERE cin=$ens");     
}     
    
if(!empty($_POST['prenom'])) {
    $val=$_POST['prenom'];
    mysqli_query($conn,"UPDATE enseignant SET prenom='$val' WHERE cin=$ens"); 
}  
    
if(!empty($_POST['adresse'])) {
    $val=$_POST['adresse'];
    mysqli_query($conn,"UPDATE enseignant SET adresse='$val' WHERE cin=$ens"); 
} 

if(!empty($_POST['email'])) {
    $val=$_POST['email'];
    mysqli_query($conn,"UPDATE enseignant SET email='$val' WHERE cin=$ens"); 
    
} 
    
if(!empty($_POST['telephone'])) {
    $val=$_POST['telephone'];
    mysqli_query($conn,"UPDATE enseignant SET telephone='$val' WHERE cin=$ens"); 
    
} 


if(!empty($_POST['specialite'])) {
    $val=$_POST['specialite'];
    mysqli_query($conn,"UPDATE enseignant SET specialite='$val' WHERE cin=$ens"); 
} 

if(!empty($_POST['grade'])) {
     $val=$_POST['grade'];
    mysqli_query($conn,"UPDATE enseignant SET grade='$val' WHERE cin=$ens"); 
} 
$mod1=$_POST['mod1'];
if(!empty($mod1)){
foreach($_POST["mod11"] as $md)
{
  $query = "INSERT INTO assure VALUES('$ens','$mod1','$md')";
  mysqli_query($conn,$query);
}   
}
$mod2=$_POST['mod2'];    
if(!empty($mod2)){
foreach($_POST["mod22"] as $md)
{
  $query1 = "INSERT INTO assure VALUES('$ens','$mod2','$md')";
  mysqli_query($conn,$query1);
}  
}

$mod3=$_POST['mod3']; 
if(!empty($mod3)){
foreach($_POST["mod33"] as $md)
{
  $query2 = "INSERT INTO assure VALUES('$ens','$mod3','$md')";
  mysqli_query($conn,$query2);
} 
}
  echo '<script type="text/javascript">alert("Etudiant modifié");</script>';
   }

else {echo '<script type="text/javascript">alert("L\'identifiant inséré ne coresspond à aucun étudiant");</script>';}

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
<legend> <h2> Gestion enseignants - Modifier </h2></legend>
<fieldset>
<legend>Informations personnelles</legend>
CIN: <br> <input type="text" name="cin"> <br>
Nom: <br> <input type="text" name="nom">   <br>
Prénom: <br> <input type="text" name="prenom">   <br>
Adresse: <br>
<input type="text" name="adresse"><br>
Email: <br> <input type="text" name="email"><br> 
Téléphone: <br> <input type="text" name="telephone"></span> 
</fieldset>
<fieldset>   
<legend>Informations professionnelles</legend>
    Specialité: <br> <input type="text" name="specialite"> <br>
     Grade: <br>  <input type="radio" name="grade" value="prof" checked> Professeur 
    <input type="radio" name="grade" value="mconf"> Maître de conférences
    <input type="radio" name="grade" value="mass"> Maître assistant
    <input type="radio" name="grade" value="ass"> Assistant<br> 
    Module(s) Enseigné(s): 
    <br> <input type="text" name="mod1"> <br>
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
    <div class="info"> <?php if(isset($_POST['valide'])){echo 'Dernier ajout: '.$_POST['cin'];} ?> </div>
</form>
</script> 
</body>
</html>