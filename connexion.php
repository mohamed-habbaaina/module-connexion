<?php
session_start();
if (isset($_POST['submit'])){                          //  verifier que l'utilisateur a valider le formulaire.
    $login = strip_tags(trim($_POST['login']));         //  Securiser les information 
    $password = strip_tags(trim($_POST['password']));
    if ($login && $password){    //  Vérification que tous les champs sont bien remplie

            // include la connexion mysql
            include 'includes/connect.php';

            //  Verification que le 'login' n'est pas attribuer.
            $requ_verif = $connection->query("SELECT * FROM `utilisateurs` WHERE login='$login' AND password='$password';");
            $login_verif = mysqli_num_rows($requ_verif);
            // var_dump($login_verif);
            // echo '<br><br><br>';
            if($login_verif > 0){
                if ($login === 'admin'){            //  Verifier que l'utilisateur est 'Admin'.
                    header("location: admin.php");  //  pour se connecter a la page 'admin.php'.
                } else{
                    $_SESSION['login'] = $login;
                    header("location: utilisateurs.php");      // Redirection vers la page utilisateurs.php.
                    //  header("refresh:2; url=utilisateurs.php");  // Redirection vers la page utilisateurs.php avec un tempt d'arret de 2 sec.
                }

            } else die("Ce compte n\'existe pas, Veuille vous inscrire <a href=\"utilisateurs.php\">ICI</a>.");
        
    } else{
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
    <title>Connexion</title>
</head>
<body>
<?php include 'includes/header.php'; ?>
<main>
    <div class="">
        <p><?php if (isset($champs_vide)){
            echo $champs_vide;
        }
        ?></p>
        <h1>Se connecter</h1>
        <form action="#" method="POST">

            <label for="login">login</label>
            <input type="text" name="login">

            <label for="password">Password</label>
            <input type="password" name="password">

            <input id="submit" type="submit" value="Connexion" name="submit">
        </form>
    </div>
</main> 
<?php include 'includes/footer.php' ?>
    
</body>
</html>