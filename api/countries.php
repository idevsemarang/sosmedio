<?php
require_once "../app/ApiConfig.php";
require_once "../app/UserController.php";

$apiConfig = new ApiConfig();
$apiConfig->methodHandler('GET');

$userController = new UserController();
$result = $userController->countries();
echo json_encode($result, JSON_PRETTY_PRINT);

die();