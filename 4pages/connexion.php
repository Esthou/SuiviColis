<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
   
    <title>Document</title>
</head>
<body class="bg-no-repeat bg-auto bg-right-top bg-scroll">
<?php
  session_start();

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

    if(isset($_POST['email'],$_POST['password'])) 
    {

      $umail = $_POST['email'];
    
      $upass = ($_POST['password']);   /*we put sha1 after the '=' only if we crypted the password with that in phpmyadmin*/
    
      $sql = "SELECT * FROM utilisateur WHERE email = ? AND passw = ?";
    
      $stm = $connexion->prepare($sql);
    
      $stm->execute([$umail,$upass]);
    
      $nbr = $stm->rowCount();
    
      if($nbr != 0){
    
        $users = $stm->fetchAll();
    
        foreach($users as $user){
          $_SESSION['email'] = $user;
        }
    
    
        echo "<script> 
        alert('Connexion effectuer avec succès');
        document.location.href=\"Applight/index.html\"
        </script>";
      }else{
        echo "<script> alert('Connexion echouée. Veuillez reessayer');
        document.location.href=\"connexion.php\"
        </script>";
      }
    }
    
  ?>

  <section class="bg-none">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-24 grid lg:grid-cols-2 gap-8 lg:gap-16">
      <div class="bg-gradient-to-r from-[#d53369] to-[#daae51] w-full mx-80 space-y-8 sm:p-2 rounded-lg shadow-2xl dark:bg-gray-800">
        <div class="bg-gray-200 p-8 py-16">
          <h2 class="text-2xl border-2 rounded-2xl py-2 mx-16 border-solid bg-[#d88259] font-bold text-gray-100 text-center dark:text-white">
            IDENTIFICATION 
          </h2>
          <form class="mt-8 space-y-6" action="#" method="POST">
            <div>
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email ou Identifiant</label>
              <input type="email" name="email" id="email" class="bg-gray-50 border-2 border-[#daa852] text-gray-900 text-sm rounded-lg focus:blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required />
            </div>
            <div>
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mot de passe</label>
              <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border-2 border-[#daa852] text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>
            <div class="flex items-start">
              <div class="flex items-center h-5">
                <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" required />
              </div>
              <div class="ms-3 text-sm">
                <label for="remember" class="font-medium text-gray-500 dark:text-gray-400">Se souvenir de moi</label>
              </div>
              <a href="#" class="ms-auto text-sm font-medium text-pink-600 hover:underline dark:text-blue-500">Mot de passe oublié?</a>
            </div>
            <button type="submit" class="bg-gradient-to-r from-[#d88259] to-[#d88259] shadow-lg mt-6 p-2 text-white 
            rounded-lg w-full hover:scale-105 hover:from-[#daae51] hover:to-[#d53369]  transition duration-300 
            ease-in-out">Se connecter</button>
            <!-- <button class="w-full px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg 
            hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 
            dark:focus:ring-blue-800">HI</button> -->
            <div class="text-sm font-medium text-gray-900 dark:text-white">
              Pas encore inscrit?<a  href="inscription.php" class="ml-2 text-pink-600 hover:underline dark:text-blue-500">Créer un compte</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  

</body>
</html>