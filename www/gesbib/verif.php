<?php

if(isset($_POST['rech'])){
if(!empty($cote=$_POST['cote'])){
$cote=$_POST['cote'];
$conn=mysqli_connect("localhost","root","", "scolarite") or die ("could not connect to mysql");
$liv=mysqli_query($conn,"SELECT ncopies FROM livres WHERE cote=$cote");
$row=mysqli_fetch_row($liv);
if($row[0]=="0"){
 echo '<script type="text/javascript">alert("Livre indisponible");</script>';
}
else{ echo '<script type="text/javascript">alert("Livre disponible");</script>';}
}
}
?>

<html>
<head>
    <meta charset="utf-8">
    <style>
    .zonerech {
    position: relative;
    top:200px;
    height:50px;
    border-radius: 25px;
    border: 2px solid RGB(0,34,85);
    text-align:center;
    }
  
    
    </style>
</head>
<body>
 <?php include("../entete.php") ?>    
<div class="zonerech">
    Vérification Disponiblité<br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 Cote livre: <input type="search" name="cote">
 <input type="submit" name="rech" value="Rechercher"><br>


</div>
</form>

    
</body>
</html>