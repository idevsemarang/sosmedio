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

    public function postListOld()
    {
        $arrDatas = [
            [
                'id' => 1,
                'image_url' => 'https://media.springernature.com/lw1200/springer-static/image/art%3A10.1038%2Fs41477-019-0374-3/MediaObjects/41477_2019_374_Figa_HTML.jpg',
                'content' => 'Hidup Adalah Perjuangan',
                'post_by_name' => 'Joni',
                'like_total' => 20,
                'comment_total' => 4,
            ],
            [
                'id' => 2,
                'image_url' => 'https://www.timeforkids.com/wp-content/uploads/2019/09/final-cover-forest.jpg',
                'content' => 'They found that functional diversity in forests tends to decrease as environmental conditions become harsher, such as along altitudinal and latitudinal gradients',
                'post_by_name' => 'Viko',
                'like_total' => 40,
                'comment_total' => 23,
            ],
            [
                'id' => 3,
                'image_url' => 'https://onetreeplanted.org/cdn/shop/articles/Forest_Fog_1600x.jpg',
                'content' => 'Sign up for the Nature Briefing newsletter — what matters in science, free to your inbox daily.',
                'post_by_name' => 'Jeni Virginikan',
                'like_total' => 210,
                'comment_total' => 14,
            ],
        ];

        return $arrDatas;
    }


    public function hashtagByPostId($params)
    {
        $postId = $params['post_id'];

        $arrDatas = [
            [
                'id' => 1,
                'post_id' => 1,
                'hashtag_title' => '#nature'
            ],
            [
                'id' => 2,
                'post_id' => 1,
                'hashtag_title' => '#green'
            ],
            [
                'id' => 3,
                'post_id' => 3,
                'hashtag_title' => '#wood'
            ],
            [
                'id' => 4,
                'post_id' => 1,
                'hashtag_title' => '#wood'
            ],
            [
                'id' => 5,
                'post_id' => 3,
                'hashtag_title' => '#forest'
            ],
            [
                'id' => 6,
                'post_id' => 2,
                'hashtag_title' => '#forest'
            ],
            [
                'id' => 7,
                'post_id' => 2,
                'hashtag_title' => '#flora'
            ],
        ];

        return $arrDatas;
    }


    public function hashtags()
    {
        $sql = "SELECT id, title FROM `hashtags` ORDER BY id DESC;";

        $posts = $this->mysqlDb->getRows($sql);

        return $posts;

        return $arrDatas;
    }
}
