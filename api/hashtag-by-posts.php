<?php
require_once "../app/ApiConfig.php";
require_once "../app/PostController.php";

$apiConfig = new ApiConfig();
$apiConfig->methodHandler('GET');

$postController = new PostController();
$result = $postController->hashtagByPostId($_GET);
echo json_encode($result, JSON_PRETTY_PRINT);

die();