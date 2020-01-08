<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once __DIR__ . '/../../Controllers/PostsController.php';

use App\Controllers\PostsController;

// Get all posts
$postsController = new PostsController();
echo $postsController->getPosts();
