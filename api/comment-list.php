<?php
require_once "../app/ApiConfig.php";
require_once "../app/CommentController.php";

$apiConfig = new ApiConfig();
$apiConfig->methodHandler('GET');

$commentController = new CommentController();
$result = $commentController->commentList($_GET);
echo json_encode($result, JSON_PRETTY_PRINT);

die();