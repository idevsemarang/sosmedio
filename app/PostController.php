<?php
require_once "DbConfig.php";


class PostController
{

    private $mysqlDb;

    public function __construct()
    {
        $this->mysqlDb = new DbConfig();
    }



    public function postList()
    {
        $sql = "SELECT 
                    p.id, 
                    p.image_url, 
                    u.name AS user_name, 
                    p.content,
                    COUNT(DISTINCT rhp.id) AS total_hashtag,
                    COUNT(DISTINCT lk.id) AS total_like,
                    COUNT(DISTINCT cmn.id) AS total_comment
                FROM posts p
                LEFT JOIN users u ON u.id = p.user_id
                LEFT JOIN rel_hashtag_posts rhp ON rhp.post_id = p.id
                LEFT JOIN likes lk ON lk.post_id = p.id
                LEFT JOIN comments cmn ON cmn.post_id = p.id
                GROUP BY p.id, p.image_url, u.name, p.content;";

        $posts = $this->mysqlDb->getRows($sql);

        return $posts;
    }


    public function postCreate($bodyRequest)
    {
        $userId = $bodyRequest['user_id'];
        $content = $bodyRequest['content'];
        $imageUrl = $bodyRequest['image_url'];
        $hashtagIds = $bodyRequest['hashtag_ids'];

        try {
            $lastId = $this->insertAndFetchPostId($content, $imageUrl, $userId);

            if (sizeof($hashtagIds) > 0) {
                $sql = "INSERT INTO rel_hashtag_posts (post_id, user_id, hashtag_id, created_at) VALUES ";

                $intSequence = 1;
                foreach ($hashtagIds as $key => $hashtagId) {
                    $sql .= "('" . $lastId . "', '" . $userId . "', '" . $hashtagId . "', now())";

                    if ($intSequence == sizeof($hashtagIds)) {
                        $sql .= ";";
                    } else {
                        $sql .= ", ";
                    }

                    $intSequence++;
                }

                $this->mysqlDb->setStatement($sql);
            }

            return [
                'success' => true,
                'alert' => 'success',
                'message' => 'success create new data',
                'datas' => $lastId
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'alert' => 'danger',
                'message' => $th->getMessage(),
            ];
        }
    }


    private function insertAndFetchPostId($content, $imageUrl, $userId)
    {
        $conn = $this->mysqlDb->connection();
        $sql = "INSERT INTO posts (content, image_url, user_id, created_at)
                VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssi", $content, $imageUrl, $userId);
        if (!$stmt->execute()) {
            throw new Exception("Insert failed: " . $stmt->error);
        }

        $lastId = $conn->insert_id;

        return $lastId;
    }



    public function hashtagByPostId($params)
    {
        $postIds = $params['post_ids'];
        $postIds = json_decode($postIds, true);

        // Ensure postIds is an array and not empty
        if (empty($postIds) || !is_array($postIds)) {
            return [];
        }

        // Sanitize each ID to prevent SQL injection
        $sanitizedIds = array_map('intval', $postIds);

        // Convert the array of integers into a comma-separated string
        $idString = implode(',', $sanitizedIds);

        $sql = "SELECT 
                    rel_hashtag_posts.id, 
                    rel_hashtag_posts.post_id,
                    title 
                    FROM `rel_hashtag_posts` 
                LEFT JOIN hashtags ON hashtags.id = rel_hashtag_posts.hashtag_id
                WHERE rel_hashtag_posts.post_id IN ($idString)
                ORDER BY rel_hashtag_posts.id DESC;";

        $rhp = $this->mysqlDb->getRows($sql);

        return $rhp;
    }


    public function hashtags()
    {
        $sql = "SELECT id, title FROM `hashtags` ORDER BY id DESC;";

        $posts = $this->mysqlDb->getRows($sql);

        return $posts;
    }
}
