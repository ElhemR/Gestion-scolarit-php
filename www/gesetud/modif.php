
<?php
if(isset($_POST['valide'])){
$etud=$_POST['identifiant'];
$conn=mysqli_connect("localhost","root","", "scolarite") or die ("could not connect to mysql");
$result=mysqli_query($conn,"SELECT identifiant FROM etudiant WHERE identifiant=$etud")or die(mysqli_error($conn));
    if (!$result) {
    die(mysqli_error($conn));
}
$lign_rs = mysqli_num_rows($result);
    
if($lign_rs==1){ 
    if(!empty($_POST['nom'])) {
    $val=$_POST['nom'];
    mysqli_query($conn,"UPDATE etudiant SET nom='$val' WHERE identifiant=$etud");     
}     
    
if(!empty($_POST['prenom'])) {
    $val=$_POST['prenom'];
    mysqli_query($conn,"UPDATE etudiant SET prenom='$val' WHERE identifiant=$etud"); 
}  
    
if(!empty($_POST['adresse'])) {
    $val=$_POST['adresse'];
    mysqli_query($conn,"UPDATE etudiant SET adresse='$val' WHERE identifiant=$etud"); 
} 

if(!empty($_POST['date'])) {
    $val=$_POST['date'];
    mysqli_query($conn,"UPDATE etudiant SET date='$val' WHERE identifiant=$etud"); 
    
} 
    
if(!empty($_POST['cycle'])) {
    $val=$_POST['cycle'];
    mysqli_query($conn,"UPDATE etudiant SET cycle='$val' WHERE identifiant=$etud"); 
    
} 


if(!empty($_POST['filiere'])) {
    $val=$_POST['filiere'];
    mysqli_query($conn,"UPDATE etudiant SET filiere='$val' WHERE identifiant=$etud"); 
} 

if(!empty($_POST['niveau'])) {
     $val=$_POST['niveau'];
    mysqli_query($conn,"UPDATE etudiant SET niveau='$val' WHERE identifiant=$etud");
    mysqli_close($conn);
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
<legend> <h2> Gestion étudiants - Modifier </h2></legend>
<fieldset>
<legend>Informations personnelles</legend>
Identifiant: <br> <input type="text" name="identifiant"> <br>
Nom: <br> <input type="text" name="nom"> <br>
Prenom: <br> <input type="text" name="prenom"><br>
Date de naissance: <br> <input type="date" name="date"><br>
Adresse: <br>
<input type="text" name="adresse">
</fieldset>
<fieldset>   
<legend>Etudes</legend>
Cycle:  <select name="cycle" > 
    <option value="licence">Licence</option>
    <option value="master">Master</option>
    <option value="doctorat">Doctorat </option>
    <option value="cying">Cycle d'ingénieur</option>
    <option value="cyprep">Cycle Préparatoire</option>
    </select> <br> Niveau:  <input type="radio" name="niveau" value="1" checked> 1
  <input type="radio" name="niveau" value="2">2
  <input type="radio" name="niveau" value="3"> 3 
    <br>
   Filiere:<br> <select name="filiere" id="filiere"  size=10> 
     </select>
      
</fieldset> 
   
    <input type="submit" name="valide" value="Valider">
    <input type="reset" value="Effacer"> 
    <div class="info"> <?php if(isset($_POST['valide'])){echo 'Dernier ajout: '.$_POST['identifiant'];} ?> </div>
</form>
    


   
   
<script type="text/javascript">
    
function removeAllOptions(sel, removeGrp) {
    var len, groups, par;
    if (removeGrp) {
        groups = sel.getElementsByTagName('optgroup');
        len = groups.length;
        for (var i=len; i; i--) {
            sel.removeChild( groups[i-1] );
        }
    }
    
    len = sel.options.length;
    for (var i=len; i; i--) {
        par = sel.options[i-1].parentNode;
        par.removeChild( sel.options[i-1] );
    }
}   
    
function appendDataToSelect(sel, obj) {
    var f = document.createDocumentFragment();
    var labels = [], group, opts;
    
    function addOptions(obj) {
        var f = document.createDocumentFragment();
        var o;
        
        for (var i=0, len=obj.text.length; i<len; i++) {
            o = document.createElement('option');
            o.appendChild( document.createTextNode( obj.text[i] ) );
            
            if ( obj.value ) {
                o.value = obj.value[i];
            }
            
            f.appendChild(o);
        }
        return f;
    }
    
    if ( obj.text ) {
        opts = addOptions(obj);
        f.appendChild(opts);
    } else {
        for ( var prop in obj ) {
            if ( obj.hasOwnProperty(prop) ) {
                labels.push(prop);
            }
        }
        
        for (var i=0, len=labels.length; i<len; i++) {
            group = document.createElement('optgroup');
            group.label = labels[i];
            f.appendChild(group);
            opts = addOptions(obj[ labels[i] ] );
            group.appendChild(opts);
        }
    }
    sel.appendChild(f);
}

document.forms['etudiant'].elements['cycle'].onchange = function(e) {
    var relName = 'filiere';
    var relList = this.form.elements[ relName ];
    var obj = Select_List_Data[ relName ][ this.value ];
    removeAllOptions(relList, true);
    appendDataToSelect(relList, obj);
};

    
    
    
    
    

 var Select_List_Data = {
    'filiere': {
    
        licence: {
            
            'Licence Fondamentale': {
                text: ['Physique','Mathématiques', 'Chimie', 'Physique-chimie','Electronique&Automatique','Informatique','Sciences de la nature','Sciences de la vie','Sciences de la terre'],
                value: ['lfph','lfm','lfch','lfpc','lfeea','lfi','lfsna','lfsv','lfst']
            },
            'Licence Appliquée': {
                text: ['Bilogie analytique et expérimentale','Géomatique Terre et Environnement','Chimie','Protection de l environnement'],
                value: ['labae', 'lagte', 'lach','lape']
            }
        },
        
        master: {
                 'Recherche': {
                text: ['Physique','Mathématiques', 'Chimie', 'Informatique','Electronique','Biologie','Sciences de la terre'],
                value: ['mrph','mmr','mmc','mmi','mme','mmb','mmst']
            },
            'Professionnel': {
                text: ['Physique','Bilogie', 'Sciences de la terre'],
                value: ['mpph','mpb','mpst']
            },
          
        },
        doctorat: {
             text: ['Physique','Mathématiques', 'Chimie', 'Electronique','Informatique'],
            value: ['dph', 'dm', 'dc', 'de', 'di']
        },
        cyprep: {
             text: ['MP','PC', 'BG'],
             value: ['mp', 'pc', 'bg']
        },
        cying: {
             text: ['Informatique','Electronique', 'Chimie analytique','Geologie'],
             value: ['inginfo', 'ingelec', 'ingch','inggeo']
     }
     
    }
    
};
    window.onload = function() {
    var form = document.forms['etudiant'];
    var sel = form.elements['cycle'];
    sel.selectedIndex = 0;
    var relName = 'filiere';
    var rel = form.elements[ relName ];  
    var data = Select_List_Data[ relName ][ sel.value ];
    appendDataToSelect(rel, data);
};

</script> 

</body>
</html>