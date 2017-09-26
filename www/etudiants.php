<meta charset="utf-8">
<?php
$action=$_POST['choix'];
echo $action;
switch($action)
{
  case 'ajout':
     header("Location: gesetud\ajout.php");
  case 'modifier':
    break;
  case 'supprimer':
    break;
}
?>

<html>
<head>
<style>
.content{
position:absolute;
left:0px;
top:200px;
}
</style>
</head>
<body>

<?php include("entete.php") ?> 
  <div class="content">  
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
    <input type=radio name ="choix" value="ajout" selected> Ajouter <br> 
    <input type=radio name ="choix" value="modifier"> Modifier <br> 
    <input type=radio name ="choix" value="suprrimer"> Supprimer <br>
   <input type=submit value="OK">  <br>
      
</form>
    </div>
</body>
</html>