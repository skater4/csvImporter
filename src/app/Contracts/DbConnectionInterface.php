<?php
namespace App\Contracts;

use mysqli_stmt;
use PDOStatement;

interface DbConnectionInterface
{
    public function beginTransaction(): bool;
    public function commit(): bool;
    public function rollBack(): bool;
    public function prepare(string $sql): mysqli_stmt|PDOStatement;
}
