<?php

namespace App\Repository;

include_once __DIR__ . '/../config/Database.php';
include_once __DIR__ . '/../Models/Comment.php';

use App\Config\Database;
use App\Models\Comment;

class CommentsRepository
{
    private $conn;
    private const COMMENT_TABLE_NAME = 'blog.comments';

    public function __construct(){
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getComments($post_id){
        $query = 'SELECT * FROM ' . self::COMMENT_TABLE_NAME .
        ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind id
        $stmt->bindParam(":id", $post_id);

        // Execute statement
        $stmt->execute();

        return $stmt;
    }

    public function createComment(Comment $comment){
        $query = 'INSERT INTO ' . self::COMMENT_TABLE_NAME .
        ' SET 
            email = :email,
            content = :content,
            post_id = :post_id
        ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':email', $comment->getEmail());
        $stmt->bindParam(':content', $comment->getContent());
        $stmt->bindParam(':post_id', $comment->getPostId());

        // Execute statement
        if($stmt->execute()){
            return true;
        }

        // Print error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}