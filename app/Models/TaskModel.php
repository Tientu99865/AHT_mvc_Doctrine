<?php
namespace App\Models;
use App\Core\Model;

class TaskModel extends Model {
    private $title = null;
    private $description = null;

    public function getTitle(){
        return $this->title;
        }

    public function setTitle($title){
            $this->title = $title;
    }
    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
            $this->description = $description;
    }
}

?>