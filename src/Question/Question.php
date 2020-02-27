<?php
namespace App\Question;
session_start();
use App\Database\Database;


class Question{


    private $question = "question";
    private $category = "category";
    private $catId;
    private $title;
    private $body;
    private $userId;
    private $username;
    
    /*public function __construct(){
    	date_default_timezone_set(Asia/Dhaka);
    }*/

    
    public function getAllQuestions(){
        $sql = "SELECT * FROM $this->question ORDER BY id DESC ";
        $stmt = Database::Prepare($sql);
        $stmt->execute();
        return $data =  $stmt->fetchAll();
    }
    public function get_myAllQuestions($id=""){
        $sql = "SELECT * FROM $this->question WHERE user_id='$id' ORDER BY id DESC ";
        $stmt = Database::Prepare($sql);
        $stmt->execute();
        return $data =  $stmt->fetchAll();
    }


    public function getCategory(){
        $sql = "SELECT * FROM $this->category";
        $stmt = Database::Prepare($sql);
        $stmt->execute();
        return $data = $stmt->fetchAll();
    }



    public function setData($data){
        $this->catId = $data["cat_id"];
        $this->title = $data["title"];
        $this->body = $data["body"];
        $this->userId = $data["userid"];
        $this->username =$data["username"];
        if (empty($this->catId) || empty($this->title) || empty($this->body)){
            $_SESSION["ErrorMsg"] = "Field must not be empty";
        }
        else{
            $this->QuestionInsert();
        }
    }
    public function QuestionInsert(){
        $sql = "INSERT INTO $this->question(cat_id, title, body, user_id, username) VALUES (:cat_id, :title, :body, :user_id, :username)";
        $stmt = Database::Prepare($sql);
        $data = [
            ':cat_id'=>$this->catId,
            ':title' =>$this->title,
            ':body' =>$this->body,
            ':user_id' =>$this->userId,
            ':username' =>$this->username
        ];
        $status =  $stmt->execute($data);
        if ($status){
            $_SESSION["SuccessMsg"] = "Your Question is successfully submitted";
        }else{
            $_SESSION["ErrorMsg"] = "Your Question is not submitted";
        }
    }
    public function textShorten($text, $limit= 350){
        $text = $text . " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' ') );
        $text = $text . "......";
        return $text;
    }

}