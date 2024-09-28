<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body> 
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
    
    if(isset($_POST['uform'])) {

        $fname = $_POST['fname'];  //recuperation des valeurs entré dans le formulaire
    
        $lname = $_POST['lname'];
    
        $tel = $_POST['tel'];

        $town = $_POST['town'];

        $email = $_POST['email'];

        $passw = $_POST['passw'];
    
    //    $id_user = $_SESSION['user']['idutilisateur'];
    
       // $dajout = date('y-m-d H:i:s');
    
        //$selectMaxId = $dbh->query('SELECT MAX(idstagiaire) as maxId FROM `stagiaire`');
    
        //$MaxId = $selectMaxId->fetch();
    
        //$newId = $MaxId['maxId'] + 1;
    
    //requete dinsertion d'un stagiaire
        $sql = "INSERT INTO `clients`(`nom`, `prenom`, `telephone`, `ville`, `email`, `motpasse`) VALUES (?,?,?,?,?,?)";
    //preparation de la requete
        $result = $connexion->prepare($sql);
        //liaison des variables
        $result->bindParam(1, $fname, PDO:: PARAM_STR);
        $result->bindParam(2, $lname, PDO:: PARAM_STR);
        $result->bindParam(3, $tel, PDO:: PARAM_INT);
        $result->bindParam(4, $town, PDO:: PARAM_STR);
        $result->bindParam(5, $email, PDO:: PARAM_STR);
        $result->bindParam(6, $passw, PDO:: PARAM_STR);
        //execution de la requete
        $result->execute();
    
        if($result){ 
            echo "<script> 
            alert('Enregistrement réussi');
            document.location.href=\"Applight/index.html\"
            </script>";
        }else{
            echo "<script> 
            alert('Echec de l\'enregistrement.Veuillez reessayer !');
            document.location.href=\"../inscription.php\"
            </script>";
        }
    }
    ?>
        <!-- <div class="bg-gradient-to-r from-blue-500 to-purple-500 w-full mx-80 space-y-8 sm:p-2 rounded-lg shadow-2xl dark:bg-gray-800"> -->
        <div class="bg-gray-50 dark:bg-gray-900">
            <div class="px-4 mx-auto max-w-screen-xl lg:py-8 grid lg:grid-cols-2 gap-8 lg:gap-16">
                <div class="bg-gradient-to-r from-[#d53369] to-[#daae51] w-full mx-80 space-y-4 sm:p-2 rounded-lg shadow-2xl dark:bg-gray-800">
                    <div class="bg-white p-4 py-16">
                        <form method="POST" action="#" class="flex flex-col max-w-md mx-auto px-5 pt-8 border-2 rounded shadow-xl bg-white">
                        <h2 class="mb-6 py-2 mx-17 text-center text-2xl font-bold text-gray-100 border-1 rounded-xl border-solid bg-[#d88259] dark:text-white">INSCRIPTION</h2>
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="fname" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nom</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="lname" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Prénom</label>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-5 group ">
                                <input type="tel" name="tel" id="floating_phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Téléphone</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="town" id="floating_company" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_company" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Ville</label>
                            </div>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="email" name="email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="password" name="passw" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Mot de passe</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="password" name="repeat_password" id="floating_repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirmer le mot de passe</label>
                        </div>
                        <div class="my-8">
                            <button type="submit" name="uform" class="bg-gradient-to-r from-[#d88259] to-[#d88259] shadow-lg mt-6 p-2 text-white 
                            rounded-lg w-full hover:scale-105 hover:from-[#daae51] hover:to-[#d53369]  transition duration-300 
                            ease-in-out">Submit</button>
                        </div>
                        <div class="pb-4 text-sm font-medium text-gray-900 dark:text-white">
                            Vous avez deja un compte ?<a  href="connexion.php" class="ml-2 text-pink-600 hover:underline dark:text-blue-500">Se connecter</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>    
</html>