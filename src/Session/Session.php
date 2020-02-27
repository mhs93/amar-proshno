<?php
namespace App\Session;
ob_start();
class Session{
    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }
    public static function get($key){
        if (isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return false;
        }
    }

    public static function checkSession(){
        if (self::get("login") == false){
            $_SESSION["ErrorMsgbyjava"] = "<script>window.alert('Please login or sign up for asking question');</script> ";
            //header('Location: ../index.php');
        }
    }

    public static function destroy_session(){
        session_destroy();
        //header('Location:index.php');
    }
    public static function destroy_sessionFor_other(){
        session_destroy();
        //header('Location:../index.php');
    }

    public static function checkLogin(){
        if (self::get("login") == true){
           // header("Location:../index.php");
        }
    }


    public static function SuccessMsg(){
        if(isset ($_SESSION["SuccessMsg"])){
            $output = "<span style='color: green'>";
            $output .= htmlentities($_SESSION["SuccessMsg"]);
            $output .= "</span>";

            $_SESSION["SuccessMsg"] = NULL;
            return $output;
        }
    }
    public static function ErrorMsg(){
        if(isset ($_SESSION["ErrorMsg"])){
            $output = "<span style='color: #ac2925'>";
            $output .= htmlentities($_SESSION["ErrorMsg"]);
            $output .= "</span>";

            unset($_SESSION["ErrorMsg"]);
            return $output;
        }
    }
    public static function ErrorMsgByJava(){
        if(isset ($_SESSION["ErrorMsgbyjava"])){
            $output = $_SESSION["ErrorMsgbyjava"];
             unset($_SESSION["ErrorMsgbyjava"]);
            return $output;
        }
    }
}
ob_end_flush();
?>