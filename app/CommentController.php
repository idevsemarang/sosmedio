<?php
require_once "DbConfig.php";


class CommentController
{

    private $mysqlDb;

    public function __construct()
    {
        $this->mysqlDb = new DbConfig();
    }



    public function commentList($params)
    {
        $postId = $params['post_id'];

        $sql = "SELECT 
                    c.id, 
                    u.name AS comment_by_name, 
                    c.content,
                    c.created_at
                FROM comments c
                LEFT JOIN users u ON u.id = c.user_id
                WHERE c.post_id = '".$postId."'
                ORDER BY c.id DESC";

        $posts = $this->mysqlDb->getRows($sql);

        return $posts;
    }


    public function commentCreate($bodyRequest)
    {
        $userId = $bodyRequest['user_id'];
        $content = $bodyRequest['content'];
        $postId = $bodyRequest['post_id'];

        try {
            $sql = "INSERT INTO comments (post_id, user_id, content, created_at) 
                    VALUES ('" . $postId . "', '" . $userId . "', '" . $content . "', now())";
                    
            $this->mysqlDb->setStatement($sql);

            return [
                'success' => true,
                'alert' => 'success',
                'message' => 'success create new data',
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'alert' => 'danger',
                'message' => $th->getMessage(),
            ];
        }
    }


    
}
