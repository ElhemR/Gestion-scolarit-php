
<?php

$cinErr="";
 if(isset($_POST['valide'])){
$ens=$_POST['cin'];
$conn=mysqli_connect("localhost","root","", "scolarite") or die ("could not connect to mysql");
$result=mysqli_query($conn,"SELECT cin FROM admin WHERE cin=$ens")or die(mysqli_error($conn));
    if (!$result) {
    die(mysqli_error($conn));
}
$lign_rs = mysqli_num_rows($result);
    
if($lign_rs==1){ 
    if(!empty($_POST['nom'])) {
    $val=$_POST['nom'];
    mysqli_query($conn,"UPDATE admin SET nom='$val' WHERE cin=$ens");     
}     
    
if(!empty($_POST['prenom'])) {
    $val=$_POST['prenom'];
    mysqli_query($conn,"UPDATE admin SET prenom='$val' WHERE cin=$ens"); 
}  
    
if(!empty($_POST['adresse'])) {
    $val=$_POST['adresse'];
    mysqli_query($conn,"UPDATE admin SET adresse='$val' WHERE cin=$ens"); 
} 

if(!empty($_POST['email'])) {
    $val=$_POST['email'];
    mysqli_query($conn,"UPDATE admin SET email='$val' WHERE cin=$ens"); 
    
} 
    
if(!empty($_POST['telephone'])) {
    $val=$_POST['telephone'];
    mysqli_query($conn,"UPDATE admin SET telephone='$val' WHERE cin=$ens"); 
    
} 


if(!empty($_POST['poste'])) {
    $val=$_POST['specialite'];
    mysqli_query($conn,"UPDATE admin SET poste='$val' WHERE cin=$ens"); 
} 
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
<legend> <h2> Gestion cadre administratif - Modifier </h2></legend>
<fieldset>
<legend>Informations personnelles</legend>
CIN: <br> <input type="text" name="cin"><span class="error">* <?php echo $cinErr;?></span> <br>
Nom: <br> <input type="text" name="nom">  <br>
Prénom: <br> <input type="text" name="prenom"> <br>
Adresse: <br>
<input type="text" name="adresse"><br>
Email: <br> <input type="text" name="email"> <br>
Téléphone: <br> <input type="text" name="telephone"> <br>
</fieldset>
<fieldset>   
<legend>Informations professionnelles</legend>
    Poste: <br> <input type="text" name="poste"><br>
    <input type="submit" name="valide" value="Supprimer">
    <input type="reset" value="Effacer"> 
</fieldset>
</form>
</script> 
</body>
</html>