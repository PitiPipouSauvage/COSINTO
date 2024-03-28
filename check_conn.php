<?php
include 'connect_db.php';

/* Checks if the user's credentials are correct */

if (!isset($_COOKIE["username"]) or !isset($_COOKIE["password"])) {

} else {
    $query = $connection->prepare("SELECT user_id FROM ? WHERE username=? AND password=?");
    $password = $_COOKIE["password"];
    $username = $_COOKIE["username"];
    $query->bind_param("sss", $config["users_table"], $username, $password);
    $is_connected = $query->execute();

    if (!$is_connected) {
        die(-1);
    }
}
