<?php
include_once '../dbconfig.php';
//Check le user
if(!$user->is_loggedin())
{
 $user->redirect('../index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM operateur WHERE idOperateur=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$ulieu="null part";
$uaction="rien";
$uidkart=$_SESSION["btn-kart"];

$lieuDispo=array("Lieu 1","Lieu 2","Lieu 3","Lieu 4","Lieu 5");
$actiondispo=array("action 1","action 2","action 3","action 4","action 5");
if(isset($_POST['txt-action']) && isset($_POST['txt-lieu']))
{
    $uaction=$_POST['txt-action'];
 $ulieu = $_POST['txt-lieu'];
 $accidentsObject= new ACCIDENT($DB_con);
 $accidentsObject->add($ulieu,Date("Y-m-d H:i:s"),$user_id,$uidkart ,$uaction);
//  $user->redirect('choixKart.php');
$user->redirect('../home.php');
}

//ajoute les possibles evenements

//création des objets de class


?>
<!DOCTYPE html >
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="../style.css" type="text/css"  />
<title>Choix lieux accident></title>
</head>

<body>

<div class="header">
 <div class="left">
Veuillez choisir l'evenement qui s'est déroulé pour le kart n°<?php print($uidkart)  ?>
    </div>
    <div class="right">
     <label><a href="choixKart.php"> Retour</a></label>
    </div>
</div>

<div>
<form method="post">

<input type="hidden"  name = "btn-kart" value="<?php print($uidkart)?>" />
<div class="form-group"> <!-- choix du lieu -->
<h2>Lieu de l'accident : </h2>
<?php 
    foreach ($lieuDispo as $lieu) {
        ?>
        <input type="radio" class="form-control" name="txt-lieu" required value="<?php print($lieu) ?>"> <?php print($lieu) ?></input>
        <?php
    }
?>
</div>

<div class="form-group"> <!-- choix des actions possibles -->
<h2>Description de l'accident : </h2>
<h5>Il faut choisir un seul évènement</h5>

<?php 
    foreach ($actiondispo as $action) {
        ?>
        <input type="radio" class="form-control" name="txt-action" required value="<?php print($action) ?>"> <?php print($action) ?></input>
        <?php
    }
?>
<br>
<input type='radio' name='txt-action' required='required' onclick='document.getElementById("txt-action").disabled = false'> 
Description personnalisée
<input type='text' name='txt-action' id='txt-action' disabled>
           
            
</div>

<div class="form-group">
             <button type="submit" class="btn btn-block btn-primary">
                &nbsp;Ajouter l'évènement
                </button>
            </div>



</form>
</div>



</body>
</html>