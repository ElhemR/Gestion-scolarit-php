<meta charset="utf-8">
<style>
* { 
    font-family: calibri;
}
.header{
    position: absolute;
    top:0px;
    left: 0px;
    width:100%;
    height:118px;
    background-color: RGB(0,34,85);
    color:white;
    text-align: center;
    z-index: 2;
}

.menu{
    position: absolute;
    z-index: 1;
    width:100%;
    top:115px;
    left:0px;
    background-color: RGB(247,204,255);
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: RGB(247,204,255);
}

li {
    float: left;
}

li a {
    display: block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: RGB(254,251,218);
}

li.dropdown {
    display: inline-block;
}

.sousliste {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

.sousliste a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.sousliste a:hover {background-color: #f1f1f1}

.dropdown:hover .sousliste {
    display: block;
}
</style>


<div class="header" > <img src="FSTLOGO.svg.svg.png" align="right" > <br> <b> <h1> Gestion scolarité</h1></b></div>    
<div class="menu">
    <ul>
<li class="dropdown">
  <a class="bouton">Etudiants</a>
  <div class="sousliste">
    <a href="/gesetud/ajout.php">Ajouter </a>  
    <a href="/gesetud/modif.php">Modifier </a>
    <a href="/gesetud/supp.php">Supprimer </a>
  </div>  
</li>
<li class="dropdown">
  <a class="bouton">Enseignants</a>
  <div class="sousliste">
    <a href="/gesens/ajout.php">Ajouter </a>  
    <a href="/gesens/modif.php">Modifier </a>
    <a href="/gesens/supp.php">Supprimer </a>
  </div>
</li>
<li class="dropdown">
  <a class="bouton">Cadre Administratif</a>
  <div class="sousliste">
    <a href="/gesadmin/ajout.php">Ajouter </a>  
    <a href="/gesadmin/modif.php">Modifier </a>
    <a href="/gesadmin/supp.php">Supprimer </a>
  </div>
</li> 
<li class="dropdown">
  <a class="bouton">Notes</a>
  <div class="sousliste">
    <a href="/gesnote/ajout.php">Saisie </a>  
    <a href="/gesnote/modif.php">Rectification </a>
    <a href="/gesnote/cons.php">Consultation </a>
    <a href="/gesnote/dc.php">Double correction </a>
  </div>
</li> 
<li class="dropdown">
  <a class="bouton">Bibliothèque</a>
  <div class="sousliste">
    <a href="/gesbib/emprunt.php">Emprunt </a>  
    <a href="/gesbib/remise.php">Remise </a>
    <a href="/gesbib/consult.php">Consulter les emprunts </a>
    <a href="/gesbib/verif.php">Vérifier disponibilité d'un livre </a>
   
  </div>
</li> 
  <li><a href="/index.php">Accueil</a></li>
</ul>
</div> 
    
