<?php

namespace App\Controller;
use App\Repository\ProjetRepository;
use App\Entity\Projet;
use App\Service\UploadService;

class AdminController extends AbstractController{
    

    public function __construct(){
        if(!$this->isUserLoggedIn()){
            header('Location: /PHP/portfolio/login');
            exit;
        }
    }


    public function index(): void{

        $projetRepository = new ProjetRepository();

        $this->view('admin/index.php', ['projects' => $projetRepository->findAll()]);

    }

    public function addNewArticle(): void{

        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            $title = htmlspecialchars(strip_tags($_POST['title']));
            $description = htmlspecialchars(strip_tags($_POST['description']));

            $title = trim($title);
            $description = trim($description);

            if (!empty($title) && !empty($description) && $_FILES['preview']['error'] === UPLOAD_ERR_OK){

                    //upload de l'image preview
                    $uploadService = new UploadService();
                    $preview = $uploadService->upload($_FILES['preview']);

                    if ($preview) {
                    //date du jour
                    $date = new \DateTime();

                    //créer un objet avec l'entité projet
                    $projet= new Projet();
                    $projet->setTitle($title);
                    $projet->setDescription($description);
                    $projet->setPreview($preview);
                    $projet->setCreatedAt($date->format('Y-m-d H:i:s'));
                    $projet->setUpdatedAt($date->format('Y-m-d H:i:s'));
            
                    $projetRepository = new ProjetRepository();
                    $projetRepository->add($projet);

                    $success = 'Votre artciel a bien été ajouté';

                } else {
                    $error = 'Le fichier est invalide';
                }
            }else{
                $error ="Veuillez remplir tous les champs";
            }
        }
        $this->view('admin/add.php', [
            'error' => $error,
            'success' => $success
        ]);
    }


     /**
     * Edition d'un article
     */
    public function edit(): void
    {
        // Si l'ID n'existe pas ou est vide, redirection vers l'accueil de l'administration
        if (empty($_GET['id'])) {
            header('Location: /PHP/portfolio/admin');
            exit;
        }

        $projetRepository = new ProjetRepository();
        $projet = $projetRepository->findOne($_GET['id']);

        // Si aucun projet avec cet ID
        if (!$projet) {
            header('Location: /PHP/portfolio/admin');
            exit;
        }

        // Si le formulaire est soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Nettoyage des données
            $title = htmlspecialchars(strip_tags($_POST['title']));
            $description = htmlspecialchars(strip_tags($_POST['description']));

            // Vérifie si tous est bien rempli
            if (
                !empty($title) &&
                !empty($description)
            ) {
                // Sauvegarde le nom actuel de l'image de preview
                $preview = $projet->getPreview();

                // Si une image est fournie, on l'upload
                if ($_FILES['preview']['error'] === UPLOAD_ERR_OK) {
                    // Upload de l'image de preview
                    $uploadService = new UploadService();
                    $preview = $uploadService->upload($_FILES['preview'], $preview);
                }

                if ($preview) {
                    // Date du jour
                    $date = new \DateTime();

                    // Modifie l'entité Projet
                    $projet->setTitle($title);
                    $projet->setDescription($description);
                    $projet->setPreview($preview);
                    $projet->setUpdatedAt($date->format('d.m.Y'));

                    $projetRepository = new ProjetRepository();
                    $projetRepository->edit($projet);

                    $success = 'Votre nouveau projet est enregistré';
                } else {
                    $error = 'Le fichier est invalide';
                }
            } else {
                $error = 'Tous les champs sont obligatoires';
            }
        }

        $this->view('admin/edit.php', [
            'projet' => $projet,
            'error' => $error ?? null, // $error !== null ? $error : null
            'success' => $success ?? null // Coalescence des nuls (Nullish coalescing operator)
        ]);
    }

    /**
     * Suppression
     */
    public function delete(): void
    {
        // Si l'ID n'existe pas ou est vide, redirection vers l'accueil de l'administration
        if (empty($_GET['id'])) {
            header('Location: /PHP/portfolio/admin');
            exit;
        }

        $projetRepository = new ProjetRepository();
        $projet = $projetRepository->findOne($_GET['id']);

        // Si aucun projet avec cet ID
        if (!$projet) {
            header('Location: /PHP/portfolio/admin');
            exit;
        }

        // Suppression de l'ID en base de données
        $projetRepository = new ProjetRepository();
        $projetRepository->delete($projet);

        // Supprime l'image du projet
        unlink($projet->getFolderPreview());

        header('Location: /PHP/portfolio/admin?success=Votre projet a bien été supprimé');
    }
}