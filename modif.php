<?php
session_start();
$login= $_SESSION['login'];

// var_dump($_SESSION);
// echo $login;

// 
if (isset($_POST['submit']) && !empty($_POST['submit'])){
    
    //  verifier que le login est bien rempli.
    if (isset($_POST['login']) && !empty($_POST['login'])){
        
        //  verifier les deux mots de passe.
        if (isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['co_password']) && !empty($_POST['co_password'])){
            if ($_POST['password'] === $_POST['co_password']){
            $now_login = $_POST['login'];
            require 'includes/connect.php';     // Se connecter à la base de données.
            $requ = $connection->query("SELECT * FROM `utilisateurs` WHERE (login='$now_login') OR (login='$login');");
            
            //  Verifier que le now login est disponible.
            $login_verif = mysqli_num_rows($requ);
            if ($login_verif === 1){

                //  Securiser les information.
                $nw_login = strip_tags(trim($_POST['login']));
                $nw_password = strip_tags(trim($_POST['password']));

                $nw_password = md5($nw_password);   //  Cryptage du mot de passe.

                //  Requette sql pour changer les données.
                $requ_update = $connection->query("UPDATE `utilisateurs` SET `login`='$nw_login', `password`='$nw_password' WHERE login='$login';");

                $_SESSION['login'] = $nw_login;
                //  die la page actuel aprés avoir detruit les données de la session.
                header("Refresh:5; url=profil.php");
            } else echo 'Le login n\'est pas disponible, Veuillez le changer !';
        
            } echo 'Veiller rentrer le meme password !';
        } else echo 'Veiller remplir tous les champs !';
    } else {
        $ver_log = 'Veuillez rentrez un Login !';
        echo $ver_log;
    }
} else //echo 'sorti';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>changement des informations</title>
</head>
<body>
    
</body>
</html>
        <h4>Changer vos informations</h4>
        <form action="#" method="POST">
            <label for="login">login</label>
            <input type="text" name="login" value="<?= $login ?>">

            <label for="password">Now Password</label>
            <input type="password" name="password" placeholder="Now Password">

            <label for="co_password">Confirme Password</label>
            <input type="password" name="co_password" placeholder="Confirme Password">

            <input id="submit" type="submit" value="Valider" name="submit">
        </form>