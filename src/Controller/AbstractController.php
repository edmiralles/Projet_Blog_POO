<?php

namespace App\Controller;
use App\Entity\Users;

abstract class AbstractController{

    //verifie si l'utilisateur est connecté
    protected function isUserLoggedIn(){
        //je verifies que la session nommé "user existe bien et que celle-ci a été instancié
        return isset($_SESSION['user']) && $_SESSION['user'] instanceof Users;
    }

    protected function view(string $path, array $vars = []): void{
       
        $vars['isLoggedIn'] = $this->isUserLoggedIn();

        //extrait les clés comme des variables et leur affectent comme valeur, la valeur de la clé du tableau
        extract($vars);

        //si le template existe, on l'affiche
        if (file_exists("../templates/$path")){
            require_once "../templates/$path";
            return;
        }
        throw new \Exception("Le template \"$path\" n'existe pas");
    }
}