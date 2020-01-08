<?php

namespace App\Models;

// Comment entity
class Comment
{
    public $id;
    public $email;
    public $content;
    public $post_id;

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }

    public function getContent(){
        return $this->content;
    }
    public function setContent($content){
        $this->content = $content;
    }

    public function getPostId(){
        return $this->post_id;
    }
    public function setPostId($post_id){
        $this->post_id = $post_id;
    }
}