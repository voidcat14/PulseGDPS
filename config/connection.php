<?php
/** Database settings. Set GDPS_DB_DRIVER to mysql or pgsql. */
$dbDriver = getenv("GDPS_DB_DRIVER") ?: "mysql";
$servername = getenv("GDPS_DB_HOST") ?: "127.0.0.1";
$port = (int) (getenv("GDPS_DB_PORT") ?: ($dbDriver === "pgsql" ? 5432 : 3306));
$username = getenv("GDPS_DB_USER") ?: "root";
$password = getenv("GDPS_DB_PASSWORD") ?: "";
$dbname = getenv("GDPS_DB_NAME") ?: "geometrydash";

if (!in_array($dbDriver, array("mysql", "pgsql"), true)) {
    throw new RuntimeException("GDPS_DB_DRIVER must be mysql or pgsql");
}
?>
