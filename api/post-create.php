<?php
require_once "../app/ApiConfig.php";
require_once "../app/PostController.php";

$apiConfig = new ApiConfig();
$apiConfig->methodHandler('POST');

$postController = new PostController();
$result = $postController->postCreate($_POST);
echo json_encode($result, JSON_PRETTY_PRINT);

die();