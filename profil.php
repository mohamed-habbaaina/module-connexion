<?php
session_start();
if (!isset($_SESSION['login'])){    // Verifier que l'utilisateur est bien connecter.
    header("location: index.php");
    exit;
}
$login = $_SESSION['login'];
if ($_SESSION['login'] != $login){  // Sécuriser l'accès à la page profil.
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

    <nav class="navbar">
        <a href="index.php" class="logo">LOGO</a>
            <ul class="nav-links">
                <li><a href="index.php">Accueil</a></li>
                <li type="submit" name="deconnecter"><a href="index.php">Se déconnecter</a></button></li>
                <li type="submit" name="modif"><a href="modif.php">Modifier vous information</a></button></li>
            </ul>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
    </nav>
</header>
<body>
    <div class="bienvenue"><?php echo 'Bienvenue ' . $login ; ?></div>

</body>
</html>