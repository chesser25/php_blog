<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once __DIR__ . '/../../Controllers/CommentsController.php';

use App\Controllers\CommentsController;

// Get all comments
$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die;
$commentsController = new CommentsController();
echo $commentsController->getComments($post_id);