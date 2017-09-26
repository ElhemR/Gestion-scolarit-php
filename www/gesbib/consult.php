<?php
if(isset($_POST['rech'])&&!empty($_POST['etud'])){
    
    $id=$_POST['etud'];
    $conn=mysqli_connect("localhost","root","", "scolarite") or die ("could not connect to mysql");
    $result=mysqli_query($conn,"SELECT identifiant FROM etudiant WHERE identifiant=$id")or die(mysqli_error($conn));
    if (!$result) {  die(mysqli_error($conn));}
    $lign_rs = mysqli_num_rows($result); 
    if($lign_rs==1){
    $bil="SELECT cote FROM emprunt WHERE id=$id";
    $res=mysqli_query($conn,$bil);  
    echo'<div style="position:relative;top:450px;">';
    while($row=mysqli_fetch_array($res,MYSQLI_NUM)){
    $rows[]=$row;
    }
    echo "Les livres empruntés par l'étudiant ".$id." sont: ";
    echo '<hr>'; 
    echo 'Cote--Titre';
    echo '<hr>'; 
    foreach($rows as $row){
    $nom=mysqli_query($conn,"SELECT titre FROM livres where cote=$row[0]");
    $noml=mysqli_fetch_row($nom);
    echo $row[0]." ".$noml[0];
    echo'<br>';
    }
   
    echo '</div>';
    }
    else {echo '<script type="text/javascript">alert("L\'identifiant inséré ne coresspond à aucun étudiant");</script>';}
    mysqli_close($conn);
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
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 Consulter les emprunts de : <input type="search" name="etud">
 <input type="submit" name="rech" value="Rechercher"><br>

</div>
</form>

    
</body>
</html>