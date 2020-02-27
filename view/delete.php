<?php
include "../vendor/autoload.php";
use App\Database\Database;
use App\Question\Question;
use App\Session\Session;
use App\Answers\Answers;
$question = new Question();
?>


<?php
if (isset($_GET['deleteid'])){
    $deleteId = $_GET['deleteid'];
    $page = $_GET['page'];

    $sql = "DELETE FROM question WHERE id='$deleteId'";
    $stmt = Database::Prepare($sql);
    $status = $stmt->execute();
    
    $sql = "DELETE FROM answers WHERE question_id='$deleteId'";
    $stmt = Database::Prepare($sql);
    $result = $stmt->execute();
    
    
    if ($page == 'index.php'){
    	echo "<script>window.location = '../index.php';</script>";
    }else{
    	echo "<script>window.location = 'my_all_question.php';</script>";
    }


}
if (isset($_GET['delete_ans'])){
    $deleteId = $_GET['delete_ans'];
    $page = $_GET['page'];

    $sql = "DELETE FROM answers WHERE id='$deleteId'";
    $stmt = Database::Prepare($sql);
    $status = $stmt->execute();
    if ($status){
        $_SESSION["SuccessMsg"] = "Deleted Successfully";
    }else{
        $_SESSION["ErrorMsg"] = "Question not deleted";
    }
    
    echo "<script>window.location = 'my_all_Answers.php';</script>";
    


}
?>