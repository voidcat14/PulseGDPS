<?php
/**
 * Select the database backend used by this GDPS.
 * Change only this value; put credentials in the matching config file.
 */
$dbDriver = "mysql"; // "mysql" or "pgsql"

if ($dbDriver === "mysql") {
    require __DIR__ . "/mysql_connection.php";
} elseif ($dbDriver === "pgsql") {
    require __DIR__ . "/postgresql_connection.php";
} else {
    throw new RuntimeException('Set $dbDriver to mysql or pgsql in config/connection.php');
}
?>
