<?php

//require("configuration.php");

global $wpdb;
$db_host = $wpdb->dbhost;
$db_user = $wpdb->dbuser;
$db_password = $wpdb->dbpassword;
$db_name = $wpdb->dbname;
$con = new mysqli($db_host, $db_user, $db_password, $db_name);
?>