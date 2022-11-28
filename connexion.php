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