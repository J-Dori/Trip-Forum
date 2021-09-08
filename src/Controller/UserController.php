<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Model\Manager\UserManager;

class UserController extends AbstractController
{
    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function index(): array
    {
        return $this->render("home/home.php"); 
    }

    public function checkUserId() {
        if (isset($_SESSION["user"])) {
            $id = $_SESSION["user"]["id"];
        } else {
            $msg = "Profile not found. Log in, please!";
            return [
                "view" => "home/home.php",
                "message" => $msg
            ];
        }
        return (int)$id;
    }

    public function profile() {
        //$user =
        return $this->render("user/profile.php"); 
        $id = $this->checkUserId();
        if ($this->userManager->getUserProfile($id) != null) {            
            if (is_int($id)) {
                $user = $this->userManager->getUserProfile($id);
                $address = $this->userManager->getUserAddress($id);
                $cc = $this->userManager->getUserCC($id);

            return [
                    "view"    => "user/profile.php",
                    
                    "title"   => "Profile",
                    "data"    => [
                        "user"      => $user,
                        "address"   => $address,
                        "cc"        => $cc
                    ],
                ];
            }
        } else
            return $id;
    }

    public function formChangePassword() {
        return [
                "view" => "user/formChangePassword.php",
                "title" => "Change password"
            ];
    }

    public function changeAvatarImg() {
        if (!isset($_FILES)) {
            $msg = "An error has occured.<br>Please try again!";
            unset($_FILES);
        }

        $id = $this->checkUserId();
        if (is_int($id)) {
            $msg = "";
            $uploadOk = 1;
            if (isset($_FILES["fileToUpload"])) {
                $tmpname = $_FILES["fileToUpload"]["tmp_name"];
                $name = $_FILES["fileToUpload"]["name"];
                $size = $_FILES["fileToUpload"]["size"];
                $error = $_FILES["fileToUpload"]["error"];
                unset($_FILES);

                $tabExtension = explode(".",$name);
                $extension = strtolower(end($tabExtension));
                $extensionsAllowed = ["jpg", "png", "jpeg", "gif"];
                $maxSize = 2048512;
                
                if(!in_array($extension, $extensionsAllowed)) {
                    $msg = "Sorry, only JPG, JPEG, PNG and GIF files are allowed.";
                    $uploadOk = 0;
                }

                if ($size > $maxSize) {
                    $msg = "The file size is too big (max: 2Mb)";
                    $uploadOk = 0;
                }

                
                if ($uploadOk == 1 && $error == 0) {
                    $uniqueName = uniqid("", true);
                    $file = str_replace(".", "_", $uniqueName).".".$extension;
                    if (!move_uploaded_file($tmpname, "./public/images/avatar/".$file)) {
                        $msg = "Sorry, there was an error uploading your file.";
                        $uploadOk = 0;
                    }
                    $msg = "Image uploaded successfully!";
                    
                    $this->userManager->updateAvatarImg($id, $file);
                }
            }
        }
        return $this->profile($msg);
    }




}