<?php
include_once '../dbconfig.php';
//Check le user
if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
?>
<!DOCTYPE html PUBLIC >
<html  lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../style.css" type="text/css"  />
<title>Consultation</title>
</head>

<body>

<div class="header">
 <div class="left">
Consultation de la bdd
    </div>
    <div class="right">
     <label><a href="../home.php"> Retour</a></label>
    </div>
</div>

<?php include_once "baseDonnees.php" ?>

<div>
<a href="../declarationAccident/choixKart.php"> ajouter un evenement</a>
</div>
</body>
</html>