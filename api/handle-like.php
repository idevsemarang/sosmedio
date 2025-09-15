<?php
require_once "../app/ApiConfig.php";
require_once "../app/LikeController.php";

$apiConfig = new ApiConfig();
$apiConfig->methodHandler('POST');

$likeController = new LikeController();
$result = $likeController->handleLike($_POST);
echo json_encode($result, JSON_PRETTY_PRINT);

die();