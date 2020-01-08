<?php

namespace App\Repository;

include_once __DIR__ . '/../config/Database.php';
include_once __DIR__ . '/../Models/PostStatus.php';

use App\Config\Database;
use App\Models\PostStatus;

class PostStatusRepository
{
    private $conn;
    private const COMMENT_TABLE_NAME = 'blog.post_status';

    public function __construct(){
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getPostStatuses(){
        $query = 'SELECT * FROM ' . self::COMMENT_TABLE_NAME . ';';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute statement
        $stmt->execute();

        return $stmt;
    }
}