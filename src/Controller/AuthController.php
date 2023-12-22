<?php

namespace App\Controller;

use App\Repository\UsersRepository;

/**
 * Gestion de l'authentification
 */
class AuthController extends AbstractController
{
    /**
     * Connexion à l'administration
     */
    public function login()
    {
        $error = null;

        // Connexion
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Nettoyage
            $username = htmlspecialchars(strip_tags($_POST['username']));
            $password = htmlspecialchars(strip_tags($_POST['password']));

            // Vérifier si le formulaire est rempli, sinon erreur
            if (!empty($username) && !empty($password)) {
                // Vérifie si un utilisateur existe via l'adresse email en BDD, sinon erreur
                $userRepository = new UsersRepository();
                $user = $userRepository->findByUsername($username);

                // Vérifie si l'utilisateur existe et si mot de passe est correct, sinon erreur
                if ($user && password_verify($password, $user->getPassword())) {
                    // Création de la session de connexion
                    $_SESSION['user'] = $user;

                    // Redirection vers l'administration
                    header('Location: /PHP/portfolio/admin');
                    exit;
                } else {
                    $error = 'Identifiants invalides';
                }
            } else {
                $error = 'Identifiants invalides';
            }
        }

        $this->view('auth/login.php', [
            'error' => $error
        ]);
    }

    //deconnexion
    public function logout(){

        unset($_SESSION['user']);
        header('Location: /PHP/portfolio');
        exit;

    }

}
