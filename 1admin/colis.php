<?php
session_start(); 

if(!isset($_SESSION['user'])) {
  header('location: index.php');
}

include('../3includes/bdconnec.php');

// $stm = $dbh->query('SELECT s.*, e.id_encadreur, e.nomenc, e.prenomenc, f.libelle, n.libelleniveau FROM  stagiaire s LEFT JOIN encadreur e ON s.idencadreur = e.id_encadreur JOIN filiere f ON s.idfiliere = f.idfiliere JOIN niveau n ON s.idniveau = n.idniveau');

// $stm = $connexion->query('SELECT c.*, cl.id_clnt, cl.nom, cl.prenom, d.nom_complet FROM colis c LEFT JOIN clients cl ON c.id_exped = cl.id_clnt JOIN destinataire d ON c.id_dest = d.id_destinataire');
$stm = $connexion->query('SELECT * FROM colis');

$stm1 = $connexion->query('SELECT * FROM clients');

$stm2 = $connexion->query('SELECT * FROM destinataire');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="boots.css">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/6.6.0/css/font-awesome.min.css"> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
      body {
    font-family: 'Roboto', sans-serif;
    background-color: #f8f9fa;
  }
  .dashboard-header {
    background-color: #343a40;
    color: white;
    padding: 20px 0;
  }
  .card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    transition: transform 0.3s;
  }
  .card:hover {
    transform: translateY(-5px);
  }
  .card-icon {
    font-size: 2.5rem;
    margin-bottom: 10px;
  }
  .chart-container {
    position: relative;
    height: 300px;
    width: 100%;
  }
</style>
</head>
<body>
<header class="dashboard-header">
<div class="container">
    <h1 class="display-4">Dashboard Responsable</h1>
    <!-- <p class="lead">Suivi des colis AgencExpress</p> -->
</div>
</header>
<div class="container">
  <h1 class="text-center mt-5">Liste des Colis</h1>
  <button type="button" class="btn btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <span class="fa fa-user-plus"></span> Ajouter
  </button>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Formulaire</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="../3includes/insert_colis.php">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                    <label for="destination" class="form-label">Nature</label>
                    <input type="text" name="nat"class="form-control" id="tel" aria-describedby="telephone">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="Field" class="form-label">Nom de l'expediteur</label>
                  <select class= "form-select" name="expediteur" aria-label="Default select example" >
                    <option selected>Choisir un expediteur</option>
                    <?php
                      $allexpeds = $stm1->fetchAll();
                      foreach($allexpeds as $exped) {?>
                      <option value="<?php echo $exped['nom'] . ' ' .$exped['prenom']; ?>"><?php echo $exped['nom'] . ' ' .$exped['prenom']; ?></option>
                    <?php  } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="Field" class="form-label">Destinataire</label>
                  <select class= "form-select"name="destinataire"  aria-label="Default select example">
                    <option selected>Choisir un destinataire</option>
                    <?php
                      $alldests = $stm2->fetchAll();
                      foreach($alldests as $dest) {?>
                    <option value="<?php echo $dest['nom_complet']; ?>"><?php echo $dest['nom_complet']; ?></option>
                    <?php  } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="destination" class="form-label">Destination</label>
                  <input type="text" name="destination"class="form-control" id="tel" aria-describedby="telephone">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="DateOfBirth" class="form-label">Date d'enregistrement </label>
                <input type="date" name="date" class="form-control" id="date" aria-describedby="date">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit"  name="cform"class="btn btn-primary">Enregistrer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <table class="table table-bordered border-primary mt-3">
    <thead>
      <tr>
        <th scope="col">N°</th>
        <th scope="col">Nature</th>
        <!-- <th scope="col">Numero de suivi</th> -->
        <th scope="col">Expediteur</th>
        <th scope="col">Destinataire</th>
        <th scope="col">Destination</th>
        <th scope="col">Date d'enregistrement</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $coliss = $stm->fetchAll();
      $i = 1; 
      foreach($coliss as $colis){?>
      <tr>
        <th scope="col"><?php echo $i; ?></th>
        <th scope="col"><?php echo $colis['nature']; ?></th>
        <th scope="col"><?php echo $colis['nom_expediteur']; ?></th>
        <th scope="col"><?php echo $colis['nom_destinataire']; ?></th>
        <th scope="col"><?php echo $colis['destination']; ?></th>
        <th scope="col"><?php echo $colis['dateenreg']; ?></th>
      </tr>
      <?php $i++; } ?>
    </tbody>

  </table>



</div>  
<script src="bootstrap.bundle.min.js"></script>
</body>
</html>













            