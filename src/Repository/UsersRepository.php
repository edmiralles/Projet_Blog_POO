<?php

namespace App\Repository;

use App\Entity\Users;
use Core\Database;

class UsersRepository extends Database{

    private \PDO $instance;

    public function __construct(){
        $this->instance = self::getInstance();
    }

    public function add(Users $users): Users{
        $userQuery = $this->instance->prepare("
        INSERT INTO users(username, password)
        VALUES (:username, :password)
        ");

        $userQuery->bindValue(':username', $users->getUsername());
        $userQuery->bindValue(':password', $users->getPassword());

        $userQuery->execute();

        $userId = $this->instance->lastInsertId();

        $users->setId($userId);

        return $users;
    }

    //selectionne un enregistrement selon un identifiant
    public function findByUsername(string $username): Users|bool
    {
        $query = $this->instance->prepare("SELECT * FROM users WHERE username = :username");

        $query->bindValue(':username', $username);
        $query->execute();

        $user = $query->fetch();

        if ($user) {
            $objectUser = new Users();
            $objectUser->setId($user->id);
            $objectUser->setUsername($user->username);
            $objectUser->setPassword($user->password);

            return $objectUser;
        }

        return false;
    }
}
