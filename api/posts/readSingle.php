<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once __DIR__ . '/../../Controllers/PostsController.php';

use App\Controllers\PostsController;

// Get post by id
$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die;
$postsController = new PostsController();
echo $postsController->getPost($post_id);
