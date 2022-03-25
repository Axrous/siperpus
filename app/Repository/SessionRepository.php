<?php

namespace axrous\siperpus\Repository;

use axrous\siperpus\Config\Database;
use axrous\siperpus\Domain\Sessions;
use PDO;

class SessionRepository {

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection =$connection;
    }

    public function save(Sessions $session): Sessions {
        $statement = $this->connection->prepare("INSERT INTO sessions(id, user_id) VALUES(?,?)");
        $statement->execute([$session->id, $session->userId]);
        return $session;
    }

    public function findById(string $id): ?Sessions {
        $statement = $this->connection->prepare("SELECT id, user_id FROM sessions WHERE id = ?");
        $statement->execute([$id]);

        try {
            if($row = $statement->fetch()) {
                $session = new Sessions();
                $session->id = $row['id'];
                $session->userId = $row['user_id'];
                return $session;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id):void {

        $statement = $this->connection->prepare("DELETE FROM sessions WHERE id = ?");
        $statement->execute([$id]);

    }

    public function deleteAll():void {
        $this->connection->exec("DELETE FROM sessions");
    }
}