<?php

namespace App\Repository;

include_once __DIR__ . '/../config/Database.php';
include_once __DIR__ . '/../Models/Post.php';
use App\Config\Database;
use App\Models\Post;

class PostsRepository
{
    private $conn;
    private const POST_TABLE_NAME = 'blog.posts';
    private const STATUS_TABLE_NAME = 'blog.post_status';

    public function __construct(){
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getPosts(){
        $query = 'SELECT p.id, p.title, p.content, s.status, p.tags 
        FROM ' . self::POST_TABLE_NAME .' as p
        INNER JOIN '. self::STATUS_TABLE_NAME .' as s
        ON p.status_id = s.id
        ;';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute statement
        $stmt->execute();

        return $stmt;
    }

    public function getPost($id){
        $query = 'SELECT p.id, p.title, p.content, s.status, p.tags 
        FROM '. self::POST_TABLE_NAME . ' as p
        INNER JOIN '. self::STATUS_TABLE_NAME . ' as s
        ON p.status_id = s.id
        WHERE p.id = ?
        LIMIT 1;';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind id
        $stmt->bindParam(1, $id);

        // Execute statement
        $stmt->execute();

        return $stmt;
    }

    public function createPost(Post $post){
        $query = 'INSERT INTO ' . self::POST_TABLE_NAME .
        '(title, content, status_id, tags) VALUES(:title, :content, :status_id, :tags);'; 

        // Prepare statement
        $stmt = $this->conn->prepare($query);
		
		$title = $post->getTitle();
		$content = $post->getContent();
		$status = $post->getStatus();
		$tags = $post->getTags();

        // Bind id
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':status_id', $status);
        $stmt->bindParam(':tags', $tags);

        // Execute statement
        if($stmt->execute()){
            return true;
        }

        // Print error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function updatePost(Post $post){
        $query = 'UPDATE ' . self::POST_TABLE_NAME .
        ' SET 
            title = :title,
            content = :content,
            status_id = :status_id,
            tags = :tags
          WHERE
            id = :id
        ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind id
        $stmt->bindParam(':title', $post->getTitle());
        $stmt->bindParam(':content', $post->getContent());
        $stmt->bindParam(':status_id', $post->getStatus());
        $stmt->bindParam(':tags', $post->getTags());
        $stmt->bindParam(':id', $post->getId());

        // Execute statement
        if($stmt->execute()){
            return true;
        }

        // Print error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function deletePost($id){
        $query = 'DELETE FROM ' . self::POST_TABLE_NAME . 
        ' WHERE id = :id;';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind id
        $stmt->bindParam(':id', $id);

        // Execute statement
        if($stmt->execute()){
            return true;
        }

        // Print error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}