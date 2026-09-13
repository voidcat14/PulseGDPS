<?php

declare(strict_types=1);

namespace Pulse\Database;

use PDO;
use PDOStatement;

interface DatabaseInterface
{
    public function connection(): PDO;

    public function query(string $sql, array $params = []): PDOStatement;

    public function fetch(string $sql, array $params = []): ?array;

    public function fetchAll(string $sql, array $params = []): array;

    public function execute(string $sql, array $params = []): int;

    public function beginTransaction(): bool;

    public function commit(): bool;

    public function rollBack(): bool;
}
