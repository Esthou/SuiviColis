<?php
date_default_timezone_set('Africa/Douala');

session_start();

// if(!isset($_SESSION['user'])) {
//     header('location: index.php');
//   }

  include('../3includes/bdconnec.php');

if(isset($_POST['cform'])) {

    $nat = $_POST['nat'];  //recuperation des valeurs entré dans le formulaire

    $exp = $_POST['expediteur'];

    $dest = $_POST['destinataire'];

    $destination = $_POST['destination'];

    $date = $_POST['date'];

   // $id_user = $_SESSION['user']['idutilisateur'];

    // $dajout = date('y-m-d H:i:s');

    // $selectMaxId = $connexion->query('SELECT MAX(id_colis) as maxId FROM `colis`');

    // $MaxId = $selectMaxId->fetch();

    // $newId = $MaxId['maxId'] + 1;

//requete dinsertion d'un stagiaire
    $sql = "INSERT INTO `colis`(`nature`, `nom_expediteur`, `nom_destinataire`, `destination`, `dateenreg`) VALUES (?,?,?,?,?)";
//preparation de la requete
    $result = $connexion->prepare($sql);
    //liaison des variables
    $result->bindParam(1, $nat, PDO:: PARAM_STR);
    $result->bindParam(2, $exp, PDO:: PARAM_STR);
    $result->bindParam(3, $dest, PDO:: PARAM_STR);
    $result->bindParam(4, $destination, PDO:: PARAM_STR);
    $result->bindParam(5, $date, PDO:: PARAM_STR);
    // $result->bindParam(6, $id_user, PDO:: PARAM_INT);
    // $result->bindParam(7, $phone, PDO:: PARAM_INT);
    // $result->bindParam(8, $mail, PDO:: PARAM_STR);
    // $result->bindParam(9, $sex, PDO:: PARAM_STR);
    // $result->bindParam(10, $dajout, PDO:: PARAM_STR);
    // $result->bindParam(11, $newId, PDO:: PARAM_INT);
    //execution de la requete
    $result->execute();

    if($result){ 
        echo "<script> 
		alert('Enregistrement réussi');
		document.location.href=\"../1admin/colis.php\"
		</script>";
    }else{
        echo "<script> 
		alert('Echec de l\'enregistrement.Veuillez reessayer !');
		document.location.href=\"../1admin/colis.php\"
		</script>";
    }
}


