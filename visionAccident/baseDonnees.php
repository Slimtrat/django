<?php
include_once '../dbconfig.php';
//Check le user
if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
//ajoute les possibles evenements
$accidentsObject= new ACCIDENT($DB_con);
$accidents= $accidentsObject->show(); 


if (isset($_GET['sort']))
{
    $functionToUse=$_GET['sort'];
    echo $functionToUse;
    switch ($functionToUse)
    {
    case 'sort_id' : 
        $accidents= $accidentsObject->showbyId("DESC"); 
        break;
    case 'sort_date' : 
        $accidents= $accidentsObject->showByDate("ASC"); 
        break;
    case 'sort_position' : 
        $accidents= $accidentsObject->showByLieu("ASC"); 
        break;
    case 'sort_ope' : 
        $accidents= $accidentsObject->showByOpe("ASC"); 
        break;
 
    case 'sort_idkart' : 
        $accidents= $accidentsObject->showByKart("ASC"); 
        break;    
    default :
        if (preg_match("/kartN_.*/",$functionToUse))
            {
                $accidents=$accidentsObject->showKart(preg_replace("/kartN_/","",$functionToUse)); 
            }
        break;
    }
}


?>
<!DOCTYPE html PUBLIC >
<html  lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../style.css" type="text/css"  />
<title>Consultation</title>
</head>

<body>
<!-- Afficher la bdd -->
<table >
<caption>L'ensemble des accidents</caption>
<th scope="row" justify ="true">Liste des accidents</th>
<tr >
    <td><form method="GET"><input  class="form-group" hidden value="sort_id" name="sort"></input><div class="form-group">
             <button type="submit" class="btn btn-block btn-secondary">
                &nbsp;<Strong>id</Strong>
                </button>
            </div> </form> </td>
    <td><Strong> description</Strong></td>
    <td> <form method="GET"><input  class="form-group" hidden value="sort_date" name="sort"></input><div class="form-group">
             <button type="submit" class="btn btn-block btn-secondary">
                &nbsp;<Strong>instant</Strong>
                </button>
            </div> </form></td>
    <td> <form method="GET"><input  class="form-group" hidden value="sort_position" name="sort"></input><div class="form-group">
             <button type="submit" class="btn btn-block btn-secondary">
                &nbsp;<Strong>position</Strong>
                </button>
            </div> </form></td>
    <td> <form method="GET"><input  class="form-group" hidden value="sort_ope" name="sort"></input><div class="form-group">
             <button type="submit" class="btn btn-block btn-secondary">
                &nbsp;<Strong>idOperateur</Strong>
                </button>
            </div> </form></td>
    <td><form method="GET"><input  class="form-group" hidden value="sort_kart" name="sort"></input><div class="form-group">
             <button type="submit" class="btn btn-block btn-secondary">
                &nbsp;<Strong>idKart</Strong>
                </button>
            </div> </form></td>
    <td>Trier par kart</td>
        </tr>
<?php
if (isset($accidents))
{
    foreach ($accidents as $accident){
        if ($accident != null){
            ?>
        <tr>
        <td>  <?php  print($accident["idaccident"]); ?></td>
        <td>  <?php  print($accident["description"]); ?></td>
        <td>  <?php  print($accident["moment"]); ?></td>
        <td>  <?php  print($accident["position"]); ?></td>
        <td>  <?php  print($accident["idoperateur"]); ?></td>
        <td>  <?php  print($accident["idkart"]); ?></td>
        <td><form method="GET"><input  class="form-group" hidden value="kartN_<?php  print($accident["idkart"]); ?>" name="sort"></input><div class="form-group">
                 <button type="submit" class="btn btn-block btn-primary">
                    &nbsp;Choisir ce kart
                    </button>
                </div> </form> </td>
            <?php
        }
       }
}

?>
</table>
</div>

</body>
</html>