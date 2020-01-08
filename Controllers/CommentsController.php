<?php

namespace App\Controllers;

include_once __DIR__ . '/../Repository/CommentsRepository.php';
include_once __DIR__ . '/../Models/Comment.php';
include_once __DIR__ . '/../Validators/Validator.php';

use App\Models\Comment;
use App\Repository\CommentsRepository;
use \PDO;
use App\Validators\Validator;

class CommentsController
{
    private $repository = null;

    public function __construct(){
        $this->repository = new CommentsRepository();
    }
    function getComments($post_id){
        // Get comments
        $result = $this->repository->getComments($post_id);

        // Get comments count
        $commentsCount = $result->rowCount();

        // Check if any comments
        if($commentsCount > 0){
            // Comments array
            $commentsArray = array();
            $commentsArray['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                
                // Create new comment object
                $comments = new Comment();
                $comment->setId($id);
                $comment->setEmail($email);
                $comment->setContent($content);
                $comment->setPostId($post_id);

                // Add post to a list of comments
                array_push($commentsArray['data'], $comment);
            }

            // Turn to Json & output
            return json_encode($commentsArray); 
        } else{
            // No posts
            return json_encode(array('message' => 'No Comments Found'));
        }
    }

    function createComment($data){
        // Create new comment object
        $comment = new Comment();
        $comment->setEmail(Validator::validate($data['email']));
        $comment->setContent(Validator::validate($data['content']));
        $comment->setPostId(Validator::validate($data['post_id']));

        if($this->repository->createComment($comment)){
            return json_encode(array('message' => 'The comment has been created'));
        } else{
            return json_encode(array('message' => 'The comment has not been created'));
        }
    }
}