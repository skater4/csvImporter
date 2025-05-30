<?php

namespace App\Repositories;

use App\Contracts\DbConnectionInterface;
use App\Core\Database\Database;
use App\Models\BaseModel;
use PDOStatement;

abstract class BaseRepository
{
    protected DbConnectionInterface $db;
    protected string $table;
    protected string $modelClass;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';
        $this->db = Database::getInstance($config);
    }

    public function getAll(): array
    {
        $sql  = "SELECT * FROM `{$this->table}`";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        /** @var array<array<string,mixed>> $rows */
        $rows = $stmt instanceof PDOStatement
            ? $stmt->fetchAll()
            : [];

        return array_map(
            fn(array $row) => $this->hydrate($row),
            $rows
        );
    }

    protected function hydrate(array $row): object
    {
        if (method_exists($this->modelClass, 'fromArray')) {
            return call_user_func([$this->modelClass, 'fromArray'], $row);
        }

        $model = new $this->modelClass();
        foreach ($row as $k => $v) {
            $k = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $k))));
            if (property_exists($model, $k)) {
                $model->$k = $v;
            }
        }
        return $model;
    }

    public function save(BaseModel $entity): bool
    {
        // 1) Получаем все публичные свойства модели
        $props = get_object_vars($entity);

        // 2) Переводим camelCase-свойства в snake_case-колонки и приводим булевы к 0/1
        $data = [];
        foreach ($props as $prop => $val) {
            // camelCase → snake_case
            $col = strtolower(
                preg_replace('/([a-z0-9])([A-Z])/', '$1_$2', lcfirst($prop))
            );
            // булевы явно в int
            if (is_bool($val)) {
                $val = $val ? 1 : 0;
            }
            $data[$col] = $val;
        }

        // 3) Формируем списки колонок и плейсхолдеров
        $cols         = array_keys($data);
        $fields       = implode('`,`', $cols);
        $placeholders = implode(', ', array_map(fn($c) => ":{$c}", $cols));

        // 4) Генерируем часть для UPDATE: col = VALUES(col)
        $updates = implode(', ', array_map(
            fn($c) => "`{$c}` = VALUES(`{$c}`)",
            $cols
        ));

        // 5) Собираем окончательный SQL с ON DUPLICATE KEY UPDATE
        $sql = "
        INSERT INTO `{$this->table}` (`{$fields}`)
        VALUES ({$placeholders})
        ON DUPLICATE KEY UPDATE {$updates}
    ";

        // 6) Подготовка и выполнение
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

}