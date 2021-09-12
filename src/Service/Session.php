<?php
namespace App\Service;

class Session
{
    public static function setUser($user)
    {
        $_SESSION["user"] = $user;
    }

    public static function getUser()
    {
        if(isset($_SESSION["user"])){
            return $_SESSION["user"];
        }
        else return null;
    }

    public static function removeUser()
    {
        unset($_SESSION["user"]);
    }

    public static function isRoleUser($role)
    {
        if(!self::getUser()){
            return false;
        }
        elseif(self::getUser()->getRole() !== $role){
            return false;
        }
        return true;
    }

    public static function isAnonymous()
    {
        if(self::getUser()){
            return false;
        }
        return true;
    }

/*     public static function getMessages($type)
    {
        if(isset($_SESSION["messages"]) && isset($_SESSION["messages"][$type])){
            $messages = $_SESSION["messages"][$type];
            unset($_SESSION["messages"][$type]);
            return $messages;
        }
        return [];
    } */

    public static function setMessage(string $type, string $text) :void
    {
        unset($_SESSION["messages"]);
        $_SESSION['messages'] = ["type" => $type, "msg" => $text];
    }

    public static function getCurrentPath()
    {
        if (isset($_SESSION["path"])) {
            $path = $_SESSION["path"];
            unset($_SESSION["path"]);
            return $path;
        }
        return null;
    }

    public static function setCurrentPath() :void
    {
        unset($_SESSION["path"]);
        $string = $_SERVER["REQUEST_URI"];
        $prefix = "index.php";
        $index = strpos($string, $prefix) + strlen($prefix);
        $curPage = substr($string, $index);

        if ($curPage == "") 
            $curPage = "index.php";

        $_SESSION['path'] = $curPage;
    }

}