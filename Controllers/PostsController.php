<?php

namespace App\Controllers;

include_once __DIR__ . '/../Repository/PostsRepository.php';
include_once __DIR__ . '/../Models/Post.php';
include_once __DIR__ . '/../Validators/Validator.php';

use App\Models\Post;
use App\Repository\PostsRepository;
use \PDO;
use App\Validators\Validator;

class PostsController
{
    private $repository = null;

    public function __construct(){
        $this->repository = new PostsRepository();
    }
    function getPosts(){
        // Get posts
        $result = $this->repository->getPosts();

        // Get posts count
        $postsCount = $result->rowCount();

        // Check if any posts
        if($postsCount > 0){
            // Post array
            $postsArray = array();
            $postsArray['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                
                // Create new post object
                $post = new Post();
                $post->setId($id);
                $post->setTitle($title);
                $post->setContent($content);
                $post->setStatus($status);
                $post->setTags($tags);

                // Add post to a list of posts
                array_push($postsArray['data'], $post);
            }

            // Turn to Json & output
            return json_encode($postsArray); 
        } else{
            // No posts
            return json_encode(array('message' => 'No Posts Found'));
        }
    }

    function getPost($id){
        // Get posts
        $result = $this->repository->getPost($id);

        // Get posts count
        $postsCount = $result->rowCount();

        // Check if any posts
        if($postsCount === 1){
            // Post array
            $postsArray = array();
            $postsArray['data'] = array();

            $row = $result->fetch(PDO::FETCH_ASSOC);
            extract($row);
            
            // Create new post object
            $post = new Post();
            $post->setId($id);
            $post->setTitle($title);
            $post->setContent($content);
            $post->setStatus($status);
            $post->setTags($tags);

            // Add post to a list of posts
            array_push($postsArray['data'], $post);

            // Turn to Json & output
            return json_encode($postsArray); 
        } else{
            // No posts
            return json_encode(array('message' => 'No Posts Found'));
        }
    }

    function createPost($data){
        $post = new Post();
        $post->setTitle(Validator::validate($data['title']));
        $post->setContent(Validator::validate($data['content']));
        $post->setStatus(Validator::validate($data['status']));
        $post->setTags(Validator::validate($data['tags']));

        if($this->repository->createPost($post)){
            return json_encode(array('message' => 'The post has been created'));
        } else{
            return json_encode(array('message' => 'The post has not been created'));
        }
    }

    function updatePost($data){
        $post = new Post();
        $post->setTitle(Validator::validate($data['title']));
        $post->setContent(Validator::validate($data['content']));
        $post->setStatus(Validator::validate($data['status']));
        $post->setTags(Validator::validate($data['tags']));
        $post->setId(Validator::validate($data['id']));

        if($this->repository->updatePost($post)){
            return json_encode(array('message' => 'The post has been updated'));
        } else{
            return json_encode(array('message' => 'The post has not been updated'));
        }
    }

    function deletePost($id){
        if($this->repository->deletePost($id)){
            return json_encode(array('message' => 'The post has been deleted'));
        } else{
            return json_encode(array('message' => 'The post has not been deleted'));
        }
    }
}