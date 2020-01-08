<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once __DIR__ . '/../../Controllers/PostStatusController.php';

use App\Controllers\PostStatusController;

// Get all posts
$postStatusController = new PostStatusController();
echo $postStatusController->getPostStatuses();
