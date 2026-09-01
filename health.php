<?php
/**
 * Minimal container/load-balancer health check.
 * It deliberately returns no credentials or database error details.
 */
header("Content-Type: application/json; charset=utf-8");

try {
    require __DIR__ . "/config/connection.php";
    $dsn = $dbDriver === "pgsql"
        ? "pgsql:host=$servername;port=$port;dbname=$dbname"
        : "mysql:host=$servername;port=$port;dbname=$dbname;charset=utf8mb4";
    $database = new PDO($dsn, $username, $password, array(PDO::ATTR_TIMEOUT => 3));
    $database->query("SELECT 1");
    http_response_code(200);
    echo json_encode(array("status" => "ok", "database" => $dbDriver));
} catch (Throwable $error) {
    http_response_code(503);
    echo json_encode(array("status" => "unavailable"));
    exit(1);
}
?>
