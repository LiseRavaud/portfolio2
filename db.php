<?php

    //paramètres de connexion en constantes

    define("DBHOST", "localhost");  //soit localhost, soit l'IP du serveur
    define("DBUSER", "Lise");       //utilisateur de la base
    define("DBPASS", "dev20iNfo&web");           //mot de passe
    define("DBNAME", "portfolio");  //nom de la base de données

    try {
        //connexion à la base avec la classe PDO et le dsn
        $pdo = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.';charset=UTF8', DBUSER, DBPASS, array(
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //on récupère nos données en array associatif par défaut
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING         //on affiche les erreurs. À modifier en prod. 
        ));
    } catch (PDOException $e) { //attrape les éventuelles erreurs de connexion
        echo 'Erreur de connexion : ' . $e->getMessage();
    }