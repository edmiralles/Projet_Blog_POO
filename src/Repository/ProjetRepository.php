<?php

namespace App\Repository;

use App\Entity\Projet;
use Core\Database;

class ProjetRepository extends Database{

    private \PDO $instance;

    public function __construct(){
        $this->instance = self::getInstance();
    }

    //Insertion en base de donées
    public function add(Projet $projet): Projet{
        $query = $this->instance->prepare("
        INSERT INTO projets(title, description, preview, created_at, updated_at)
        VALUES (:title, :description, :preview, :created_at, :updated_at)
        ");

        $query->bindValue(':title', $projet->getTitle());
        $query->bindValue(':description', $projet->getDescription());
        $query->bindValue(':preview', $projet->getPreview());
        $query->bindValue(':created_at', $projet->getCreatedAt()->format('Y-m-d H:i:s'));
        $query->bindValue(':updated_at', $projet->getUpdatedAt());
        $query->execute();

        //recupere l'ID nouvellement créé
        $id = $this->instance->lastInsertId();

        //Ajoute l'ID à mon objet
        $projet->setId($id);

        //retourne notre objet muni d'un ID
        return $projet;
    }

     /**
     * Supprime en base de données
     */
    public function delete(Projet $projet): Projet
    {
        $query = $this->instance->prepare("DELETE FROM projets WHERE id = :id");
        $query->bindValue(':id', $projet->getId());
        $query->execute();

        return $projet;
    }

    /**
     * Edition en base de données
     */
    public function edit(Projet $projet): Projet
    {
        $query = $this->instance->prepare("
            UPDATE projets SET 
                title = :title, description = :description, preview = :preview,
                created_at = :created_at, updated_at = :updated_at
            WHERE id = :id
        ");

        $query->bindValue(':title', $projet->getTitle());
        $query->bindValue(':description', $projet->getDescription());
        $query->bindValue(':preview', $projet->getPreview());
        $query->bindValue(':created_at', $projet->getCreatedAt()->format('Y-m-d H:i:s'));
        $query->bindValue(':updated_at', $projet->getUpdatedAt());
        $query->bindValue(':id', $projet->getId());
        $query->execute();

        // Retourne notre objet
        return $projet;
    }


    public function findAll(): array
    {
        $objectsProjects = [];
        $query = $this->instance->query("SELECT * FROM projets ORDER BY created_at DESC");
        $projects = $query->fetchAll();

        foreach ($projects as $project) {
            $item = new Projet();
            $item->setId($project->id);
            $item->setTitle($project->title);
            $item->setDescription($project->description);
            $item->setPreview($project->preview);
            $item->setCreatedAt($project->created_at);
            $item->setUpdatedAt($project->updated_at);

            $objectsProjects[] = $item;
        }

        return $objectsProjects;
    }

    public function findOne(int $id): Projet|bool
    {
        $oneArticle = false;
        $query = $this->instance->prepare("SELECT * FROM projets WHERE projets.id =:id");
        $query->bindValue(':id', $id);
        $query->execute();

        $article = $query->fetch();

        if($article){            
            $oneArticle = new Projet();
            $oneArticle->setId($article->id);
            $oneArticle->setTitle($article->title);
            $oneArticle->setDescription($article->description);
            $oneArticle->setPreview($article->preview);
            $oneArticle->setCreatedAt($article->created_at);
            $oneArticle->setUpdatedAt($article->updated_at);
        }

          
            return $oneArticle;
    }

}
