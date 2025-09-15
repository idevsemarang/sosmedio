<?php
require_once "../app/ApiConfig.php";
require_once "../app/CommentController.php";

$apiConfig = new ApiConfig();
$apiConfig->methodHandler('POST');

$commentController = new CommentController();
$result = $commentController->commentCreate($_POST);
echo json_encode($result, JSON_PRETTY_PRINT);

die();