<?php
require_once "../app/ApiConfig.php";
require_once "../app/LikeController.php";

$apiConfig = new ApiConfig();
$apiConfig->methodHandler('GET');

$likeController = new LikeController();
$result = $likeController->myLike($_GET);
echo json_encode($result, JSON_PRETTY_PRINT);

die();