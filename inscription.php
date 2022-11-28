<?php
if (isset($_POST['submit'])){                           //  verifier que l'utilisateur a valider le formulaire.
    $login = strip_tags(trim($_POST['login']));         //  Securiser les information 
    $prenom = strip_tags(trim($_POST['prenom']));
    $nom = strip_tags(trim($_POST['nom']));
    $password = strip_tags(trim($_POST['password']));
    $co_password = strip_tags(trim($_POST['co_password']));
    if ($login && $prenom && $nom && $password && $co_password){    //  Vérification que tous les champs sont bien remplie
        if ($password === $co_password){
            $servername = 'localhost';
            $username = 'root';
            $password_b = '';
            $database = 'moduleconnexion';

            $password = md5($password);     // Cryptage du mot de passe.
            
            // Ce connecter a la base de données "utilisateurs"
            $connection = new mysqli($servername, $username, $password_b, $database) or die('Erreur');
            
            //  Verification que le 'login' n'est pas attribuer.
            $requ_verif = $connection->query("SELECT * FROM `utilisateurs` WHERE login='$login';");
            $login_verif = mysqli_num_rows($requ_verif);
           if($login_verif === 0){

            //  ajouter l'utilisateur à la base de données
            $requ_inser = $connection->query("INSERT INTO `utilisateurs`(`login`, `prenom`, `nom`, `password`) VALUES ('$login', '$prenom', '$nom', '$password')");
            //  La fonction 'header pour la redirection au lieu de '<a href='
            header("location: connexion.php");
            // die("Inscription terminé, <a href=\"utilisateurs.php\">connecter vous</a>");

           } else die('Le login n\'est pas disponible, Veuillez le changer.');
            //  Géré le cas de confirmation de mot de passe est défirent que le mot de passe.
            } else echo 'Veiller rentrer le meme password';
            
            // Géré le cas où l'utilisateur ne remplit pas toutes les cases.
    } else echo 'Veiller remplir tous les champs';
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
    <title>Inscription</title>
</head>
<body>
<?php include 'includes/header.php'; ?>
<main>
    <div class="connect">
        <h1>Création de compte</h1>
        <form action="#" method="POST">
            <label for="login">login</label>
            <input type="text" name="login">

            <label for="prenom">Prénom</label>
            <input type="text" name="prenom">

            <label for="nom">Nom</label>
            <input type="text" name="nom">

            <label for="password">Password</label>
            <input type="password" name="password">

            <label for="co_password">Confirme Password</label>
            <input type="password" name="co_password">

            <input id="submit" type="submit" value="Valider" name="submit">
        </form>
    </div>
</main> 
<?php include 'includes/footer.php' ?>
</body>
</html>