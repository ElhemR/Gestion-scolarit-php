<?php
if(isset($_POST['rech'])&&!empty($_POST['etud'])){
    
    $id=$_POST['etud'];
    $conn=mysqli_connect("localhost","root","", "scolarite") or die ("could not connect to mysql");
    $result=mysqli_query($conn,"SELECT identifiant FROM etudiant WHERE identifiant=$id")or die(mysqli_error($conn));
    if (!$result) {  die(mysqli_error($conn));}
    $lign_rs = mysqli_num_rows($result); 
    if($lign_rs==1){
    $bil="SELECT cm,ds,exam,tp FROM notes WHERE id=$id";
    $res=mysqli_query($conn,$bil);  
    if(isset($_POST['recup'])){
    $nomfich="notes".$id.".txt";
    $myfile = fopen($nomfich, "w");
    $sep="_________________________________________________________________";
    $date=date("Y-m-d H:i:s");
    fwrite($myfile,"Bilan des notes de: ".$id.PHP_EOL.$date.PHP_EOL);
    fwrite($myfile,$sep.PHP_EOL);
    $sql="SELECT nom,prenom,cycle,filiere,niveau FROM etudiant,notes WHERE identifiant=$id";
    $inf=mysqli_query($conn,$sql);
    $info=mysqli_fetch_array($inf,MYSQLI_NUM);
    fwrite($myfile,"L'étudiant(e):"." ".$info[0]." ".$info[1].PHP_EOL);
    fwrite($myfile,"*Cycle: ".$info[2].PHP_EOL."*Filière: ".$info[3].PHP_EOL."*Niveau: ".$info[4].PHP_EOL.$sep.PHP_EOL);
    fwrite($myfile,"CODE MODULE------------DS----------EXAMEN---------TP".PHP_EOL.$sep.PHP_EOL);    
    }
    echo'<div style="position:relative;top:450px;">';
    while($row=mysqli_fetch_array($res,MYSQLI_NUM)){
    $rows[]=$row;
    }
    echo "L'etudiant(e) ".$id." a pour notes: ";
    echo '<hr>'; 
    echo "CODE MODULE------------DS----------EXAMEN---------TP";
    echo'<hr>';
    foreach($rows as $row){
    echo $row[0]."----------------------------".$row[1]."-------------".$row[2]."------------".$row[3];
    if(isset($_POST['recup'])){fwrite($myfile,$row[0]."----------------------".$row[1]."------------".$row[2]."----------".$row[3].PHP_EOL);}
    echo'<br>';
    }
    if(isset($_POST['recup']))
    {
    echo "<a href='".$nomfich."' download>TELECHARGER</a>";
    }
    echo '</div>';
    }
    else {echo '<script type="text/javascript">alert("L\'identifiant inséré ne coresspond à aucun étudiant");</script>';}
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
 Consulter les notes de : <input type="search" name="etud">
 <input type="submit" name="rech" value="Rechercher"><br>
 <input type="radio" name="recup" >Récuperer dans un fichier<br>

</div>
</form>

    
</body>
</html>