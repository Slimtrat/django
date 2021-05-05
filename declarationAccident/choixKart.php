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

if(isset($_POST['btn-kart']))
{
    $_SESSION['btn-kart']=$_POST['btn-kart'];
 
$user->redirect('choixLieu.php');

}

?>
<!DOCTYPE html PUBLIC >
<html  lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../style.css" type="text/css"  />
<title>Choix kart></title>
</head>

<body>

<div class="header">
 <div class="left">
Veuillez choisir un kart
    </div>
    <div class="right">
     <label><a href="../home.php"> home</a></label>
    </div>
</div>

<div>
<!-- choix du kart -->
<table>
<caption>Listes des karts possiblement touchés</caption>

<?php 
$tousLesKarts=$karts->show();

for ($i=0;$i<count($tousLesKarts);$i+=11){
    ?> <tr> <?php 
    for ($j=0;$j<11;$j++)
    {

$kartactuel=$tousLesKarts[$i+$j];
  if ($kartactuel==null){break;}
    ?>
<td value="<?php print($kartactuel["idkart"]) ?>"> <form method="POST"><input name="btn-kart" class="btn btn-block btn-primary" type="submit" value="<?php print( $kartactuel["idkart"]) ?>"> </input> </form> </td>

<?php
} ?> </tr> <?php 
}
?>
</table>




</div>



</body>
</html>