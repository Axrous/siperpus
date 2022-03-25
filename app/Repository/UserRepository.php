<?php

namespace axrous\siperpus\Repository;

use axrous\siperpus\Domain\User;
use PDO;

class UserRepository {

    private PDO $connection;

    public function __construct(PDO $connection)
    {   
        $this->connection = $connection; 
    }


    public function save(User $user): User {
        
        $statement = $this->connection->prepare("INSERT INTO users(id, name, gender, password, email, role) VALUES (?, ?, ?, ?, ?, ?)");

        $statement->execute([
            $user->id, $user->name, $user->gender, $user->password, $user->email, $user->role
        ]);

        return $user;
    }

    public function findById(string $id): ?User {

        $statement = $this->connection->prepare("SELECT id, name, gender, password, email, role FROM users WHERE id = ?");
        $statement->execute([$id]);

        try{
            if($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id'];
                $user->name = $row['name'];
                $user->gender = $row['gender'];
                $user->password = $row['password'];
                $user->email = $row['email'];
                $user->role = $row['role'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteAll():void {
        $this->connection->exec("DELETE FROM users");
    }


}