<?php
declare(strict_types=1);

namespace Pulse;

use PDO;
use RuntimeException;

/**
 * Small foundation for the PulseGDPS rewrite.
 * Legacy code can continue to run while new code moves onto this API.
 */
final class Core
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function db(): PDO
    {
        return $this->db;
    }

    public function transaction(callable $callback): mixed
    {
        if ($this->db->inTransaction()) {
            return $callback($this->db);
        }

        $this->db->beginTransaction();
        try {
            $result = $callback($this->db);
            $this->db->commit();
            return $result;
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public static function requireDriver(string $driver): string
    {
        $driver = strtolower(trim($driver));
        if (!in_array($driver, ['mysql', 'pgsql'], true)) {
            throw new RuntimeException('PulseGDPS supports mysql and pgsql database drivers.');
        }
        return $driver;
    }
}
