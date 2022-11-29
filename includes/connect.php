<?php
            $servername = 'localhost';
            $username = 'root';
            $password_b = '';
            $database = 'moduleconnexion';

            $password = md5($password);     // Cryptage du mot de passe.
            
            // Ce connecter a la base de données "utilisateurs"
            $connection = new mysqli($servername, $username, $password_b, $database) or die('Erreur');
?>