<?php
require_once "../app/ApiConfig.php";
require_once "../app/UserController.php";

$apiConfig = new ApiConfig();
$apiConfig->methodHandler('POST');

$userController = new UserController();
$result = $userController->register($_POST);
echo json_encode($result, JSON_PRETTY_PRINT);

die();