<?php

namespace Testing\Config;

use App\Config\Database;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    public function testGetConnection()
    {
        $connection = Database::connect();
        self::assertNotNull($connection);
    }

    public function testGetConnectionSingleton()
    {
        $connection1 = Database::connect();
        $connection2 = Database::connect();
        self::assertSame($connection1, $connection2);
    }
}
