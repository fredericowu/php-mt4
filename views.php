<?php
// Base 
require_once("class/view/basic_view.php");
require_once("class/view/api_basic_view.php");

// Views
require_once("view/index_view.php");
require_once("view/device_view.php");
require_once("view/crypt_view.php");
require_once("view/hash_view.php");

// JSON API
require_once("view/api_auth_view.php");
require_once("view/api_device_view.php");
require_once("view/api_crypt_view.php");
require_once("view/api_hash_view.php");

// 404
require_once("view/not_found_view.php");


$VIEWS = Array(
	// HTML
	"index" => "IndexView",
	"device"=> "DeviceView",
	"crypt" => "CryptView",
	"hash" => "HashView",		

	// JSON API
	"api_auth"=> "API_AuthView",
	"api_device"=> "API_DeviceView",
	"api_crypt"=> "API_CryptView",
	"api_hash"=> "API_HashView",
				
	// 404
	"NOT_FOUND" => "NotFoundView",		

);

?>