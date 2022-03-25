<?php

namespace axrous\siperpus\Config;

use PDO;

class Database {
    
    private static ?PDO $pdo = null;

    public static function getConnection(string $env = "test"): PDO {
        if(self::$pdo != null) {
            return self::$pdo;
        }

        require_once __DIR__ . '/../../config/database.php';
        $config = getDatabaseConfig();
        return self::$pdo = new PDO(
            $config['database'][$env]['url'],
            $config['database'][$env]['username'],
            $config['database'][$env]['password']
        );
    }

    public static function beginTranscation() {
        self::$pdo->beginTransaction();
    }

    public static function commitTranscation() {
        self::$pdo->commit();
    }

    public static function rollbackTranscation() {
        self::$pdo->rollBack();
    }
}