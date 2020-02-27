<?php
namespace App\Users;
use App\Session\Session;
use App\Database\Database;


class Users{
    private $first_name;
    private $last_name;
    private $username;
    private $email;
    private $password;
    private $userId;



    public function setUsers_info($usersInfo){

        $this->first_name = $usersInfo["first_name"];
        $this->last_name = $usersInfo["last_name"];
        $this->username = $usersInfo["username"];
        $this->email = $usersInfo["email"];
        $this->password = md5(trim($usersInfo["pass"]));
        $_SESSION["ErrorMsg"] = "";

        $query = "INSERT INTO users(first_name, last_name, username, email, password) VALUES (:first_name, :last_name, :username, :email, :password)";
        $stmt = Database::Prepare($query);
        $data = [
            ':first_name'=>$this->first_name,
            ':last_name' =>$this->last_name,
            ':username' =>$this->username,
            ':email' =>$this->email,
            ':password' =>$this->password
        ];
        $inserted_rows =  $stmt->execute($data);
        if ($inserted_rows) {
            $_SESSION["SuccessMsg"] = "Your registration is successful.Please login now";
        } else {
            $_SESSION["ErrorMsg"] = "Registration failed! ";
        }

}

public function updateName($userName){
        $this->first_name = $userName["first_name"];
        $this->last_name = $userName["last_name"];
        $this->userId = Session::get("userid");


    $sql = "UPDATE users SET first_name=:first_name, last_name=:last_name WHERE id=:id";
    $stmt = Database::Prepare($sql);
    $stmt->bindParam(':first_name', $this->first_name);
    $stmt->bindParam(':last_name', $this->last_name);
    $stmt->bindParam(':id', $this->userId);
    $status = $stmt->execute();
    if ($status){
        $_SESSION["SuccessMsg"] = "Your Name Updated Successfully";
        echo "<script>window.location = 'profile.php';</script>";
    }else{
        $_SESSION["ErrorMsg"] = "Update failed! ";
    }

}

public function updatePassword($pass){
    $this->password = md5(trim($pass));
    $this->userId = Session::get("userid");



    $sql = "UPDATE users SET password=:password WHERE id=:id";
    $stmt = Database::Prepare($sql);
    $stmt->bindParam(':password', $this->password);
    $stmt->bindParam(':id', $this->userId);
    $status = $stmt->execute();
    if ($status){
        $_SESSION["SuccessMsg"] = "Your password updated Successfully";
        echo "<script>window.location = 'change_password.php';</script>";
    }else{
        $_SESSION["ErrorMsg"] = "Update failed! ";
    }

}



    public function login($loginInfo){
        $this->username = $loginInfo["user_name"];
        $this->password = trim($loginInfo["password"]);

        $_SESSION["ErrorMsg"] = "";
        if (empty($this->username)){
            $_SESSION["ErrorMsg"] = "Username must not be empty!";
        }elseif (empty($this->password)){
            $_SESSION["ErrorMsg"] = "Password must not be empty!";
        }else{
            $userName = $this->username;
            $pass = md5($this->password);

            $query = "SELECT * FROM users WHERE email='$userName' OR username='$userName' AND password='$pass'";
            $stmt = Database::Prepare($query);
            $stmt->execute();
            $data = $stmt->fetch();
            if ($data) {
                Session::set("login", true);
                Session::set("userid", $data["id"]);
                Session::set("username", $data["username"]);
                Session::set("userRole", $data["is_admin"]);
                echo "<script>window.location = '../index.php';</script>";
            }else{
                $_SESSION["ErrorMsg"] = "Password or Username don't match!";
            }
        }
    }

public function loginFrom_index($loginInfo){
    $this->username = $loginInfo["user_name"];
    $this->password = trim($loginInfo["password"]);

        $_SESSION["ErrorMsg"] = "";
        if (empty($this->username)){
            $_SESSION["ErrorMsg"] = "Username must not be empty!";
        }elseif (empty($this->password)){
            $_SESSION["ErrorMsg"] = "Password must not be empty!";
        }else{
            $userName = $this->username;
            $pass = md5($this->password);

            $query = "SELECT * FROM users WHERE email='$userName' OR username='$userName' AND password='$pass'";
            $stmt = Database::Prepare($query);
            $stmt->execute();
            $data = $stmt->fetch();
            if ($data) {
                Session::set("login", true);
                Session::set("userid", $data["id"]);
                Session::set("username", $data["username"]);
                Session::set("userRole", $data["is_admin"]);
                header("Location: index.php");
            }else{
                $_SESSION["ErrorMsg"] = "Password or Username don't match!";
            }
        }
    }

}