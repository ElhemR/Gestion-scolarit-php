
<?php
 $et=$idErr=$nomErr=$addErr=$prenomErr=$dateErr=$cycErr=$nivErr=$filErr="";
$add=0;

if(isset($_POST['valide'])){
    
if(empty($_POST['identifiant'])) {
 $idErr = "Identifiant obligatoire";
} elseif(!is_numeric($_POST['identifiant'])){ $idErr="Identifiant ne doit pas contenir des caracatères autre que chiffres";}
else {$identifiant=$_POST['identifiant'];}
    
if(empty($_POST['nom'])) {
 $nomErr = "Nom obligatoire";
} elseif(!ctype_alpha($_POST['nom'])){ $nomErr="Le nom ne doit pas contenir des chiffres";}
else {$nom=$_POST['nom'];}
    
if(empty($_POST['prenom'])) {
 $prenomErr = "Prenom obligatoire";
} elseif(!ctype_alpha($_POST['prenom'])){ $prenomErr="Le prénom ne doit pas contenir des chiffres";}
else {$prenom=$_POST['prenom'];}   
if(empty($_POST['adresse'])) {
 $addErr = "Adresse obligatoire";
} 
else {$adresse=$_POST['adresse'];}
    
if(empty($_POST['date'])) {
 $dateErr = "Date obligatoire";
} 
else {$date=$_POST['date'];}

if(empty($_POST['cycle'])) {
 $cycErr = "Cycle obligatoire";
} 
else {$cycle=$_POST['cycle'];}  

if(empty($_POST['filiere'])) {
 $filErr = "Filiere obligatoire";
} 
else {$filiere=$_POST['filiere'];};   


if(empty($_POST['niveau'])) {
 $nivErr = "Niveau obligatoire";
} elseif($cycle=='cyprep'&&$_POST['niveau']==3){$nivErr="Le cycle préparatoire est un cycle de deux ans";}
elseif($cycle=='master'&&$_POST['niveau']==3){$nivErr="Le mastère est un cycle de deux ans";}
else {$niveau=$_POST['niveau'];}  

    
if(!empty($identifiant)&&!empty($nom)&&!empty($prenom)&&!empty($date)&&!empty($adresse)&&!empty($filiere)&&!empty($cycle)&&!empty($niveau)){

$conn= mysqli_connect("localhost","root","", "scolarite") or die ("could not connect to mysql");
$sql="INSERT INTO etudiant VALUES ('$identifiant','$nom','$prenom','$date','$adresse','$cycle','$niveau','$filiere')";
mysqli_query($conn,$sql); 
$add=$identifiant;
mysqli_close($conn);
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
<legend> <h2> Gestion étudiants - Ajouter </h2></legend>
<fieldset>
<legend>Informations personnelles</legend>
Identifiant: <br> <input type="text" name="identifiant"><span class="error">* <?php echo $idErr;?></span> <br>
Nom: <br> <input type="text" name="nom">  <span class="error">* <?php echo $nomErr;?></span> <br>
Prénom: <br> <input type="text" name="prenom"> <span class="error">* <?php echo $prenomErr;?></span>  <br>
Date de naissance: <br> <input type="date" name="date"> <span class="error">* <?php echo $dateErr;?></span><br>
Adresse: <br>
<input type="text" name="adresse"><span class="error">* <?php echo $addErr;?></span>
</fieldset>
<fieldset>   
<legend>Etudes</legend>
Cycle:  <select name="cycle" > 
    <option value="licence">Licence</option>
    <option value="master">Master</option>
    <option value="doctorat">Doctorat </option>
    <option value="cying">Cycle d'ingénieur</option>
    <option value="cyprep">Cycle Préparatoire</option>
    </select>  <span class="error">* <?php echo $cycErr;?></span> <br> Niveau:  <input type="radio" name="niveau" value="1" checked> 1
  <input type="radio" name="niveau" value="2">2
  <input type="radio" name="niveau" value="3"> 3 
     <span class="error">* <?php echo $nivErr;?></span>
    <br>
   Filiere:<br> <select name="filiere" id="filiere"  size=10> 
     </select>
      <span class="error">* <?php echo $filErr;?></span>
</fieldset> 
   
    <input type="submit" name="valide" value="Valider">
    <input type="reset" value="Effacer"> 
     <div class="info"> <?php if(isset($_POST['valide'])){echo 'Dernier ajout: '.$add;} ?> </div>
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