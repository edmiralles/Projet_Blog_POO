<?php

namespace Core;

use PDO;

//Permet de gérer la connexion avec PDO (PHP Data Object)
abstract class Database{

    private static $_instance = null;
    
    //se connecter à la base de données
    public static function getInstance(): PDO{
        /**
         * Design pattern (patron de conception)
         * singleton
         */
        try{
            if(self::$_instance === null){
                self::$_instance = new PDO(
                    $_ENV['BDD_DSN'],
                    $_ENV['BDD_USER'],
                    $_ENV['BDD_PASS'],
                    [
                        //destion des erreurs
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                        // Gestion du jeu de caractères
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                        //Retour des résultats
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                    ]
                );
            }
        }catch(\Exception $exception){
            throw new \PDOException ("Erreur sur la BDD: {$exception->getMessage()}");
        }
        return self::$_instance;
    }
}