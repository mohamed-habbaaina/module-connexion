<?php
if (isset($_POST['submit'])){                          //  verifier que l'utilisateur a valider le formulaire.
    $login = strip_tags(trim($_POST['login']));         //  Securiser les information 
    $co_password = strip_tags(trim($_POST['co_password']));
    if ($login && $password){    //  Vérification que tous les champs sont bien remplie
        if ($password === $co_password){
            $servername = 'localhost';
            $username = 'root';
            $password_b = '';
            $database = 'moduleconnexion';

            $password = md5($password);     // Cryptage du mot de passe.
            
            // Ce connecter a la base de données "utilisateurs"
            $connection = new mysqli($servername, $username, $password_b, $database) or die('Erreur');

            //  Verification que le 'login' n'est pas attribuer.
            $requ_verif = $connection->query("SELECT * FROM `utilisateurs` WHERE login='$login' AND password='$password';");
            $login_verif = mysqli_num_rows($requ_verif);
           if($login_verif > 0){
            header("location: utilisateurs.php");
           } else die("Ce compte n\'existe pas, Veuille vous inscrire <a href=\"utilisateurs.php\">ICI</a>.");
        }
    }
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
    <title>Connexion</title>
</head>
<body>
<?php include 'includes/header.php'; ?>
<main>
    <div class="">
        <h1>Se connecter</h1>
        <form action="utilisateurs.php" method="POST">

            <label for="login">login</label>
            <input type="text" name="login">

            <label for="password">Password</label>
            <input type="password" name="password">

            <input id="submit" type="submit" value="Valider" name="submit">
        </form>
    </div>
</main> 
<?php include 'includes/footer.php' ?>
    
</body>
</html>