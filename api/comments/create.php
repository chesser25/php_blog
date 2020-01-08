<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Access-Control-Allow-Methods, X-Requested-With');

include_once __DIR__ . '/../../Controllers/CommentsController.php';

use App\Controllers\CommentsController;

//Get data from request
$data = json_decode(file_get_contents("php://input"), true);

// Create post
$commentsController = new CommentsController();
echo $commentsController->createComment($data);