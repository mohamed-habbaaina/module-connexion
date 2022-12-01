<?php
session_start();
if (!isset($_SESSION['login'])){
    header("location: index.php");
    exit;
}
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
    <title>Profile</title>
</head>
<header>
        <div class="nav">
            <div class="logo"><a href=""></a></div>
            <div class="nav_bar">
                <a href="index.php">Accueil</a>
                <button type="submit" name="deconnecter" ><a href="index.php">Se déconnecter</a></button>
                <button type="submit" name="modif" ><a href="modif.php">Modifier vous information</a></button>
            </div>
        </div>
    </header>
<body>
    <p><?php echo 'Bienvenue ' . $_SESSION['login'] ; ?></p>

</body>
</html>