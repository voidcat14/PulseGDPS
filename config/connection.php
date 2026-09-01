<?php
/**
 * Select the database backend used by this GDPS.
 * Change only this value; put credentials in the matching config file.
 */
$dbDriver = "mysql"; // "mysql" or "pgsql"

if ($dbDriver === "mysql") {
    require __DIR__ . "/mysql_connection.php";
    $localConfig = __DIR__ . "/mysql_connection.local.php";
} elseif ($dbDriver === "pgsql") {
    require __DIR__ . "/postgresql_connection.php";
    $localConfig = __DIR__ . "/postgresql_connection.local.php";
} else {
    throw new RuntimeException('Set $dbDriver to mysql or pgsql in config/connection.php');
}

// Local credential overrides stay outside version control (see .dockerignore).
if (is_file($localConfig)) {
    require $localConfig;
}
?>
