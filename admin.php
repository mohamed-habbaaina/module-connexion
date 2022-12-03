<?php
session_start();
if ($_SESSION['login'] != 'admin'){     //  Sécuriser l'accès à la page Admin.
    header("location: index.php");
    exit;
}
require 'includes/connect.php';
// requete pour recupérer les données
$requ = $connection->query("SELECT `id`, `login`, `prenom`, `nom` FROM `utilisateurs`;");

//
$num_rows = mysqli_num_rows($requ); // Calculer le nombre de lignes 'utilisateurs'.
// echo $num_rows;

// requete pour pour "fetch" les données
$result_fetch_all = $requ->fetch_all();
// echo 'bbb <pre>';
// var_dump($result_fetch_all);
// echo '</pre>';
if (isset($_GET['submit']) && !empty($_get['deconnecter'])){
    $_SESSION = array();//Ecraser le tableau de session 
    session_unset(); //Detruit toutes les variables de la session en cours
    session_destroy();//Destruit la session en cours
    header("location:index.php"); // redirige l'utilisateur
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/connect.css">
    <title>Admin</title>
</head>
<body>
<header>

    <nav class="navbar">
        <a href="index.php" class="logo">LOGO</a>
            <ul class="nav-links">
                <li><a href="index.php">Accueil</a></li>
                <li type="submit" name="deconnecter"><a href="index.php">Se déconnecter</a></button></li>
            </ul>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
    </nav>
</header>
    <div class="admin_tabl">    
        <table >
            <div><h3>Liste des utilisateurs</h3></div>
            <div>
                <thead>
                    <th>id</th>
                    <th>Login</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                </thead>
                <tbody>
                <?php
                    // On va utiliser une boucle pour remplire le tableau.
                 $i = 0;
                 for($i = 0; $i < $num_rows ; $i++){         // Pour parcurire les colonnes.
                    echo '<tr>';                     // crée une nouvelle ligne.
                    for($j = 0; $j < 4; $j++){       // pour parcurire les linges
                       echo '<td>';
                       print_r($result_fetch_all[$i][$j]);
                       echo '</td>';
                    }
                 }
                ?>
                </tbody>
            </div>
        </table>

    </div>
</body>
</html>