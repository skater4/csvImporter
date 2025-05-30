<?php
namespace App\Core\Database;

use App\Contracts\DbConnectionInterface;
use Exception;

class Database
{
    private static ?DbConnectionInterface $instance = null;

    public static function getInstance(array $config): DbConnectionInterface
    {
        if (self::$instance === null) {
            self::$instance = match ($config['driver']) {
                'mysql' => new PdoConnection($config),
                default  => throw new Exception("Unsupported driver: {$config['driver']}"),
            };
        }

        return self::$instance;
    }
}
