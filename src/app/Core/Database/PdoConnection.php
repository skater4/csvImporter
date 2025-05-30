<?php
namespace App\Core\Database;

use App\Contracts\DbConnectionInterface;
use PDO;
use PDOStatement;

class PdoConnection implements DbConnectionInterface
{
    private PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";

        $this->pdo = new PDO($dsn, $config['user'], $config['pass'], [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public function beginTransaction(): bool {
        return $this->pdo->beginTransaction();
    }

    public function commit(): bool {
        return $this->pdo->commit();
    }

    public function rollBack(): bool {
        return $this->pdo->rollBack();
    }

    public function prepare(string $sql): PDOStatement
    {
        return $this->pdo->prepare($sql);
    }
}
