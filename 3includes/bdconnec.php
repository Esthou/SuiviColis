<?php
    $serveur = "localhost";
    $login = "root";
    $pass = "";
//Pour verifier la connexion a la BD avec PDO/ Pour se connecter a mysql par l'intermediaire du php
    try{
      $connexion = new PDO("mysql:host=$serveur;dbname=estract_db", $login, $pass);
      $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo 'Connexion à la base de données réussie';
      
    }
    catch(PDOException $e){
      echo 'La connexionn a echouée : ' .$e->getMessage();
    }





// <?php

// try{
//     $dbh = new PDO('mysql:host=localhost;charset=utf8;dbname=gestion_stagiaire', 'root', '');
// } catch (PDOException $e) {
//     echo $e->getMessage();
// }