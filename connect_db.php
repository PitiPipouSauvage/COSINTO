<?php
/* Database connection */

$config = parse_ini_file("db.ini");

$mysqli = mysqli_connect(
    $server=$config["host"],
    $username=$config["username"],
    $password=$config["password"],
    $database=$config["database"]
);
if (!$mysqli) {
    die(-1);
}
