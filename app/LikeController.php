<?php
require_once "DbConfig.php";


class LikeController
{

    private $mysqlDb;

    public function __construct()
    {
        $this->mysqlDb = new DbConfig();
    }


    public function myLike($params)
    {
        $userId = $params['user_id'];

        $sql = "SELECT post_id FROM likes WHERE user_id = '".$userId."'";

        $likes = $this->mysqlDb->getRows($sql);

        return $likes;
    }


    public function handleLike($bodyRequest)
    {
        $userId = $bodyRequest['user_id'];
        $postId = $bodyRequest['post_id'];

        // Check if the user has already liked the post
        $sqlCheck = "SELECT post_id FROM likes WHERE user_id = '".$userId."' AND post_id = '".$postId."'";
        $existingLike = $this->mysqlDb->getRows($sqlCheck);

        if (!empty($existingLike)) {
            // If a like exists, delete it (unlike)
            $sqlDelete = "DELETE FROM likes WHERE user_id = '".$userId."' AND post_id = '".$postId."'";
            $this->mysqlDb->setStatement($sqlDelete);

            return ['status' => 'unliked', 'message' => 'Post unliked successfully.'];
        } else {
            // If no like exists, create a new one (like)
            $sqlInsert = "INSERT INTO likes (user_id, post_id) VALUES ('".$userId."', '".$postId."')";
            $this->mysqlDb->setStatement($sqlInsert);

            return ['status' => 'liked', 'message' => 'Post liked successfully.'];
        }
    }
}
