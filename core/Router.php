<?php

use App\Controller;

/**
 * Permet de rediriger l'utilisateur selon une adress personalisée
 */

class Router{

    private array $routes = [];

    public function dispatch(string $uri = '/'): void{
        //dump($uri);
        //on enregistre la position du "?" dans l'URI s'il existe
        $position = strpos($uri, '?');

        //si $position est égal à true on nettoie l'URI en retirant tout ce qui se trouve après le "?"
        if($position){
            $uri = substr($uri, 0, $position);
        }

        //si l'URI est différent d'un simple slash, on continue le nettoyage
        if($uri !== '/'){
            //on recupere le dernier caractere de mon URI
            $lastChar = substr($uri, -1);
            //si le dernier caractere est un slash, on le retire
            if($lastChar === '/'){
                //retourne la chaine sans le dernier caractere
                $uri = substr($uri, 0, -1);
            }
        }
        //si le tableau des routes n'est pas vide, alors on effectue une recherche
        if(!empty($this->routes)){
            //si la route existe dans la configuration, on charge le controller
            if(isset($this->routes[$uri])){
                // versione plus récente - [$controller, $method] = $this->routes[$uri]; -
                list($controller, $method) = $this->routes[$uri]; 

                //Ajout de l'espace de com à mon controller
                $controller = "App\\Controller\\$controller";

                //vérifie si la classe $controller existe
                if(class_exists($controller)){

                    //instanciation de la classe controller
                    $controllerInstance = new $controller();

                    //si la méthode existe, on charge celle-ci
                    if(method_exists($controllerInstance, $method)){
                        $controllerInstance->$method();
                        return;
                    }
                }
            }
        }
        //on affiche une erreur 404 si besoin

        
        //force le code retour à 404
        http_response_code(404);

        $errorInstance = new App\Controller\ErrorController();
        $errorInstance->error404();
    }

    //permet d'ajouter une route personnalisée
    public function add(string $route, string $controller, string $method): void{

        $this->routes[$route] = [$controller, $method];
        //dump($this->routes);
    }

}