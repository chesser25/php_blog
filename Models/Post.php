<?php

namespace App\Models;

// Post entity
class Post
{
    public $id;
    public $title;
    public $content;
    public $status;
    public $tags;

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title){
        $this->title = $title;
    }

    public function getContent(){
        return $this->content;
    }
    public function setContent($content){
        $this->content = $content;
    }

    public function getStatus(){
        return $this->status;
    }
    public function setStatus($status){
        $this->status = $status;
    }

    public function getTags(){
        return $this->tags;
    }
    public function setTags($tags){
        $this->tags = $tags;
    }
}