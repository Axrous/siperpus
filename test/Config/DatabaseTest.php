<?php

namespace axrous\siperpus\Config;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertNotNull;

class DatabaseTest extends TestCase {

    public function testGetConnection() {
        $connection = Database::getConnection();
        self::assertNotNull($connection);
    }

    public function testGetConnectionSingleton() {
        $connection1 = Database::getConnection();
        $connection2 = Database::getConnection();
        self::assertSame($connection1, $connection2);
    }
}