<?php

namespace App\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use App\Repository\ProjetRepository;

class HomeController extends AbstractController{


    //page d'acceuil
    public function index():void{
        
        $projetRepository = new ProjetRepository();

        //require_once '../templates/home/index.php';
        $this->view('home/index.php', ['projects' => $projetRepository->findAll()]);
    }


    //page d'articles
    public function article():void{
        
        $projetRepository = new ProjetRepository();
        $article = $projetRepository->findOne($_GET['id']);

        if(!$article){
            header('Location: /PHP/portfolio/404');
        }
        //require_once '../templates/home/index.php';
        $this->view('home/article.php', ['article' => $article]);
    }


    //page de test
    public function test():void{

        //si le formulaire est envoyé...
        if(!empty($_POST)){
            //vérifier ques les champs ne sont pas vides
            if(!empty($_POST['name']) && !empty($_POST['avis'])){
                //tout fonctionne
            }else{
                $error = 'Tous les champs sont obligatoires';
            }
        }

        //L'appel du template se situe toujours en derniere ligne de la methode
        require_once '../templates/home/test.php';
    }

    public function contact():void{

        $error = null;
        $success = null;

        if(!empty($_POST)){
            if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['content'])){
                $email = htmlspecialchars(strip_tags($_POST['email']));
                $nom = htmlspecialchars(strip_tags($_POST['name']));
                $content = htmlspecialchars(strip_tags($_POST['content']));
        
                $email = trim($email);
                $nom = trim($nom);
                $content = trim($content);

                if (filter_var($email, FILTER_VALIDATE_EMAIL)){

                    //envoi de l'email avec PHPMailer
                    // Connecter au SMTP de MailTrap
                    $phpmailer = new PHPMailer();
                    $phpmailer->isSMTP();
                    $phpmailer->Host = $_ENV['MAIL_SMTP'];
                    $phpmailer->SMTPAuth = true;
                    $phpmailer->Port = $_ENV['MAIL_PORT'];
                    $phpmailer->Username = $_ENV['MAIL_USER'];
                    $phpmailer->Password = $_ENV['MAIL_PASS'];

                    // Envoi du mail
                    $phpmailer->setFrom($email, $nom); // Expéditeur
                    $phpmailer->addAddress($_ENV['USER_EMAIL'], $_ENV['USER_NAME']); // Destinataire
                    $phpmailer->Subject = 'Message du formulaire de contact';
                    $phpmailer->Body = $content;

                    //envoyer le mail
                    if($phpmailer->send()){
                        $success = "Message envoyé. <br> Nous vous répondrons dans les plus brefs délais.";
                    }else{
                        $error = "votre message a rencontré un problème, veuillez réessayer ultérieurement.";
                    }
                }else{
                    $error = 'votre adresse email est invalide';
                }
            }else{
                $error = 'Tous les champs sont obligatoires';
            }
        }

        $this->view('home/contact.php', 
        [
            'error' => $error,
            'success' =>$success
        ]);
        //require_once '../templates/home/contact.php';
    }

}