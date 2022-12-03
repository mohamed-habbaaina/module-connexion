<!-- Mohamed HABBAAINA Le 28/11/2022 -->
<?php
session_start();
if (isset($_POST['submit'])){                           //  verifier que l'utilisateur a valider le formulaire.
    $login = strip_tags(trim($_POST['login']));         //  Securiser les information 
    $prenom = strip_tags(trim($_POST['prenom']));
    $nom = strip_tags(trim($_POST['nom']));
    $password = strip_tags(trim($_POST['password']));
    $co_password = strip_tags(trim($_POST['co_password']));
    if ($login && $prenom && $nom && $password && $co_password){    //  Vérification que tous les champs sont bien remplie
        if ($password === $co_password){
           
            $password = md5($password);     // Cryptage du mot de passe.

            // include la connexion mysql
            include 'includes/connect.php';

            //  Verification que le 'login' n'est pas attribuer.
            $requ_verif = $connection->query("SELECT * FROM `utilisateurs` WHERE login='$login';");
            $login_verif = mysqli_num_rows($requ_verif);
           if($login_verif === 0){

            //  ajouter l'utilisateur à la base de données
            $requ_inser = $connection->query("INSERT INTO `utilisateurs`(`login`, `prenom`, `nom`, `password`) VALUES ('$login', '$prenom', '$nom', '$password')");
            $_SESSION['login'] = $login;
            //  La fonction 'header pour la redirection au lieu de '<a href='
            header("location: connexion.php");
            // die("Inscription terminé, <a href=\"utilisateurs.php\">connecter vous</a>");

           } else {
            $ver_login = 'Le login n\'est pas disponible, Veuillez le changer.';
           }
            //  Géré le cas de confirmation de mot de passe est défirent que le mot de passe.
            } else {
                $ver_pass = 'Veiller rentrer le meme password';
            }
            
            // Géré le cas où l'utilisateur ne remplit pas toutes les cases.
    } else {
        $champs_vide = 'Veiller remplir tous les champs !';
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
    <title>Inscription</title>
</head>
<body>
<?php include 'includes/header.php'; ?>
<main>
    <div class="form_conn">
        
        <h1>Création de compte</h1>
        <p id="erreur"><?php if (isset($champs_vide)){
            echo $champs_vide;
        } elseif (isset($ver_pass)){
            echo $ver_pass;
        }
        elseif (isset($ver_login)){
            echo $ver_login;
        }
        ?></p>
        <form action="#" method="POST">
            <label for="login">login</label>
            <input type="text" name="login" placeholder="login">

            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" placeholder="Prénom">

            <label for="nom">Nom</label>
            <input type="text" name="nom" placeholder="Nom">

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password">

            <label for="co_password">Confirme Password</label>
            <input type="password" name="co_password" placeholder="Confirme Password">

            <input id="submit" type="submit" value="Valider" name="submit">
        </form>
    </div>
</main> 
</body>
</html>