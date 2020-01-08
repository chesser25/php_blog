<?php

namespace App\Controllers;

include_once __DIR__ . '/../Repository/PostStatusRepository.php';
include_once __DIR__ . '/../Models/PostStatus.php';

use App\Models\PostStatus;
use App\Repository\PostStatusRepository;
use \PDO;

class PostStatusController
{
    private $repository = null;

    public function __construct(){
        $this->repository = new PostStatusRepository();
    }
    function getPostStatuses(){
        // Get all post statuses
        $result = $this->repository->getPostStatuses();

        // Get comments count
        $postStatusCount = $result->rowCount();

        // Check if any comments
        if($postStatusCount > 0){
            // Comments array
            $postStatusArray = array();
            $postStatusArray['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                
                // Create new comment object
                $postStatus = new PostStatus();
                $postStatus->setId($id);
                $postStatus->setStatus($status);

                // Add post to a list of comments
                array_push($postStatusArray['data'], $postStatus);
            }

            // Turn to Json & output
            return json_encode($postStatusArray); 
        } else{
            // No posts
            return json_encode(array('message' => 'No Statuses Found'));
        }
    }
}