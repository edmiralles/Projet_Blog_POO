<?php
namespace App\Controller;

use Faker;
use App\Entity\Projet;
use App\Entity\Users;
use App\Repository\ProjetRepository;
use App\Repository\UsersRepository;
/**
 * genere des fausses données pour le developpement
 */

 class FixtureController extends AbstractController{
    public function index():void{
        $faker = Faker\Factory::create();
        $projetRepository = new ProjetRepository();
        $usersRepository = new UsersRepository();

        for ($i = 0; $i < 10; $i++){
            //créer un objet avec l'entité "Projet"
            $projet= new Projet();
            $projet->setTitle($faker->sentence);
            $projet->setDescription($faker->realText);
            $projet->setPreview('test.png');
            $projet->setCreatedAt($faker->dateTimeBetween('-2 years')->format('Y-m-d'));
            $projet->setUpdatedAt($faker->dateTimeBetween('-1 years')->format('Y-m-d'));

            //Insérer en base de données
            $projetRepository->add($projet);
        }

        for ($i = 0; $i < 4; $i++){
            $users= new Users();
            $users->setUsername($faker->userName());
            $users->setPassword(password_hash('secret', PASSWORD_DEFAULT));

            $usersRepository->add($users);
        }
        $success = "Votre demande a bien été prise en compte.";
        
        $this->view('fixture/users.php', 
        [
            'success' =>$success
        ]);
    }
 }