<?php

namespace App\Models;

// PostStatus entity
class PostStatus
{
    public $id;
    public $status;

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getStatus(){
        return $this->status;
    }
    
    public function setStatus($status){
        $this->status = $status;
    }
}