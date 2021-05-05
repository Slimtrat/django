<?php
include_once 'dbconfig.php';
//Check le user
if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM operateur WHERE idOperateur=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

//ajoute les possibles evenements
$accidentsObject= new ACCIDENT($DB_con);

//import bdd
$accidents= $accidentsObject->show();


?>
<!DOCTYPE html PUBLIC >
<html  lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>Welcome -  <?php print($userRow['user']); ?></title>
</head>

<body>

<div class="header">
 <div class="left">
Bienvenue dans le centre de déclaration d'accident
    </div>
    <div class="right">
     <label><a href="logout.php?logout=true"> logout</a></label>
    </div>
</div>

<div>
<a href="visionAccident/affichagebdd.php"> Consulter les évenements</a>
</div>

<div>
<a href="declarationAccident/choixKart.php"> ajouter un evenement</a>

</div>
</body>
</html>