<?php
require_once("config.php");
require_once("class/db/database_connection.php");
require_once("class/db/database_model.php");
require_once("class/device/device.php");
require_once("class/crypt/crypt.php");
require_once("class/crypt/crypt_aes.php");
require_once("class/crypt/crypt_cesar.php");
require_once("class/crypt/crypt_tripledes.php");
require_once("class/hash/hash.php");
require_once("class/hash/hash_md5.php");
require_once("class/hash/hash_sha512.php");
require_once("class/hash/hash_hmac.php");



require_once("views.php");



session_start();

$DEFAULT_VIEW="index";
$view = $DEFAULT_VIEW;

if ( array_key_exists("view", $_GET)  ) {
	$view = $_GET["view"];
}

if ( ! array_key_exists($view, $VIEWS) ) {
	$view = "NOT_FOUND";
}

$view_class = $VIEWS[$view];

$view_obj = new $view_class();
$view_obj->process($_GET, $_POST, $_SESSION);
$view_obj->display();

?>