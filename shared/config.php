<?php
// db connection data
session_start();

$db_config = new stdClass();
$db_config->servername = "localhost";
$db_config->username = "root";
$db_config->password = "1313";
$db_config->db = "labsphp";

function is_loged_in() {
    return isset($_SESSION['username']);
}

function admin_check(){
    return $_SESSION['username'] == 'admin';
}

function connect_to_db(){
    global $db_config;
    return new mysqli($db_config->servername, $db_config->username, $db_config->password, $db_config->db);
}