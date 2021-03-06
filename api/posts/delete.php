<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Access-Control-Allow-Methods, X-Requested-With, Content-Type');

include_once __DIR__ . '/../../Controllers/PostsController.php';

use App\Controllers\PostsController;

//Get data from request
$data = json_decode(file_get_contents("php://input"), true);

// Delete post
$postsController = new PostsController();
echo $postsController->deletePost($data['id']);
