<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Service\Session;
use App\Service\Router;
use App\Model\Manager\UserManager;

class SecurityController extends AbstractController
{

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->session = new Session();
    }
 
    public function index(): array
    {
        return $this->render("home/home.php"); 
    }

    public function changePassword() {
        $user = $_SESSION["user"];
        if(!empty($_POST)){
            $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/^[A-Za-z]{4,}/"
                ]
            ]);
            $password_new = filter_input(INPUT_POST, "password_new", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/^[A-Za-z]{4,}/"
                ]
            ]);
            $password_repeat = filter_input(INPUT_POST, "password_repeat", FILTER_DEFAULT);
            
            if($password && $password_new && $password_repeat){
                $email = $_SESSION["user"]["email"];

                if($email && $password){
                    $user = $this->userManager->getUserByEmail($email);

                    if($user != false && password_verify($password, $user['password'])){
                        if ($password_new !== $password_repeat)
                            return [
                                "view" => "user/formChangePassword.php",
                                "message" => "The fields <b>New password</b> and <b>Repeat new password</b><br>must be the same. Please try again!"
                            ];
                        else {
                            //upd password
                            $hash = password_hash($password_new, PASSWORD_ARGON2I);
                            $this->userManager->updatePassword($email, $hash);
                            return $this->userController->profile("Password changed succesfully!<br>Please Log Out and Login again...");
                        }

                    } else
                        return [
                                "view" => "user/formChangePassword.php",
                                "message" => "Your <b>Actual password</b> is not correct.<br>Please try again!"
                        ];
                }
            } else
                return [
                        "view" => "user/formChangePassword.php",
                        "message" => "All fields are required"
                ];
        }
    }

    public function login(): array
    { 
        $msg = "";
        if(!empty($_POST)){
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/^[A-Za-z]{4,}/"
                ]
            ]);

            if($email && $password){
                $user = $this->userManager->findUserByEmail(strtolower($email));
                if($user != false && 
                    password_verify(
                        $password, 
                        $this->userManager->findPasswordById($user->getId())
                    )){
                    Session::setUser($user);
                    //GoTo 'Profile' page with ($msg) or
                    //$msg = "Hello ". $user["username"]);
                    return $this->render("user/profile.php", $user);
                }
                else $msg =  "Mauvais email ou mot de passe";
            }
            else $msg =  "Tous les champs sont obligatoires";
        }

        return $this->render("security/login.php");
    }


    public function register(): array
    {
        $msg = "";
        if(!empty($_POST)){
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/^[A-Za-z]{4,}/"
                ]
            ]);
            $password_r = filter_input(INPUT_POST, "password_repeat", FILTER_DEFAULT);

            if($username && $email && $password && $password_r){
                
                if($password === $password_r){

                    if($this->userManager->verifyUser($email, $username) == false){
                        $hash = password_hash($password, PASSWORD_ARGON2I);
                        if($this->userManager->insertUser($email, $username, $hash)){
                            $msg = "Inscription réussie !";
                        }
                        else $msg = "Erreur 500, réessayez ultérieurement !";
                    }
                    else $msg = "Cet email ou ce pseudo sont déjà utilisés,<br>choisissez en un autre";
                }
                else $msg = "Les mots de passe ne correspondent pas !";
            }
            else $msg = "Tous les champs sont obligatoires";
        }

        return [
            "view" => "security/register.php",
            "message" => $msg
        ];
    }

    public function logout()
    {
        unset($_SESSION["user"]);
        return Router::redirect('index.php');
    }

}