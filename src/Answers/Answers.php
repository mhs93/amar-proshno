<?php
namespace App\Answers;
use App\Database\Database;
class Answers
{
    private $question_id;
    private $user_id;
    private $ans;


    public function getAllAnswers($qId = ""){
        $sql = "SELECT * FROM answers WHERE question_id='$qId' ORDER BY id ASC ";
        $stmt = Database::Prepare($sql);
        $stmt->execute();
        return $data =  $stmt->fetchAll();
    }
    public function get_myAll_answers($userId=""){
        $this->user_id = $userId;
        $id = $this->user_id;
        $sql = "SELECT * FROM answers WHERE users_id='$id'";
        $stmt = Database::Prepare($sql);
        $stmt->execute();
        return $data =  $stmt->fetchAll();
    }
    public function getTotal_of_Answers(){
        $sql = "SELECT * FROM answers ";
        $stmt = Database::Prepare($sql);
        $stmt->execute();
        return $data =  $stmt->fetchAll();
    }


    public function setAnswers($data){

        $this->question_id = $data["questionId"];
        $this->user_id = $data["userId"];
        $this->ans = $data["answer"];
        if (empty($this->ans)){
            $_SESSION["ErrorMsg"] = "Field must not be empty";
        }
        else{
            $sql = "INSERT INTO answers(question_id	, users_id, ans) VALUES (:question_id, :users_id, :ans)";
            $stmt = Database::Prepare($sql);
            $data = [
                ':question_id'=>$this->question_id,
                ':users_id' =>$this->user_id,
                ':ans' =>$this->ans,

            ];
            $status =  $stmt->execute($data);
            if ($status){
                header("Refresh:0");
            }else{
                $_SESSION["ErrorMsg"] = "Your ans is not submitted";
            }
        }
    }

}