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

    public static function isRoleAdminMod()
    {
        if(!self::getUser()){
            return false;
        }
        elseif(self::getUser()->getRole() == "ROLE_ADMIN") {
            return true;
        }
        elseif(self::getUser()->getRole() == "ROLE_MOD") {
            return true;
        }
        return false;
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
            return $_SESSION["path"];
        }
        return null;
    }

    public static function setCurrentPath() :void
    {
        unset($_SESSION["path"]);
        $string = $_SERVER["REQUEST_URI"];
        if (strpos($string, "#")) 
            $cleanPath= strstr($string, "#", true);
        else $cleanPath = $string;
        $prefix = "?ctrl";
        $index = strpos($cleanPath, $prefix) + strlen($prefix);
        $curPage = substr($cleanPath, $index);

        if ($curPage == "") 
            $curPage = "index.php";

        $_SESSION['path'] = "?ctrl$curPage";
    }

    public static function getBetween($string, $start = "", $end = ""){
    if (strpos($string, $start)) { // required if $start not exist in $string
        $startCharCount = strpos($string, $start) + strlen($start);
        $firstSubStr = substr($string, $startCharCount, strlen($string));
        $endCharCount = strpos($firstSubStr, $end);
        if ($endCharCount == 0) {
            $endCharCount = strlen($firstSubStr);
        }
        return substr($firstSubStr, 0, $endCharCount);
    } else {
        return "";
    }
}

}