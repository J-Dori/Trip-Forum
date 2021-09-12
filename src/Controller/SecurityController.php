<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Service\Session;
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
        $user = Session::getUser();
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
                $email = Session::getUser()->getEmail();

                if($email && $password) {
                    $user = Session::getUser();

                    if($user) {
                        $oldPassword = $this->userManager->findPasswordByEmail($email);
                        if (password_verify($password, $oldPassword )) {
                            if ($password_new !== $password_repeat) {
                                $this->addFlash("error", "The fields <b>New password</b> and <b>Repeat new password</b><br>must be the same. Please try again!...");
                                return $this->render("user/formChangePassword.php");
                            }
                            else {
                                //upd password
                                $hash = password_hash($password_new, PASSWORD_ARGON2I);
                                $this->userManager->updatePassword($email, $hash);
                                $this->addFlash("success", "Password changed succesfully!<br>Please Login again...");
                                $this->logoutUser();
                                return $this->render("security/login.php");
                            }

                        } else
                            $this->addFlash("error", "Your <b>Actual password</b> is not correct.<br>Please try again!");
                            return $this->render("user/formChangePassword.php");
                    }
                }
            } else
                $this->addFlash("error", "All fields are required");
                return $this->render("user/formChangePassword.php");
        }
    }


    public function login(): array
    {
        if(!empty($_POST)){
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/^[A-Za-z]{4,}/"
                ]
            ]);

            if($email && $password){
                $user = $this->userManager->findUserByEmail($email);
                if($user) {
                    if (password_verify ($password, 
                            $this->userManager->findPasswordByEmail($email)
                        ))
                    {
                        Session::setUser($user);
                        $this->addFlash("success", "Welcome back <b>". $user->getUsername()."</b> !");
                        $this->redirectTo("index.php");
                    }
                }
                else $this->addFlash("error", "Your E-mail or Password are incorrect");
            }
            else $this->addFlash("error", "All fields are required");
        }

        return $this->render("security/login.php"); 
    }



    public function register()
    {
        if(!empty($_POST)){
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/^[A-Za-z]{4,}/"
                ]
            ]);
            $password_r = filter_input(INPUT_POST, "password_repeat", FILTER_DEFAULT);
            $avatar = filter_input(INPUT_POST, "avatar", FILTER_SANITIZE_STRING);

            if($username && $email && $password && $password_r){
                
                if($password === $password_r){
                   
                    if(!$this->userManager->verifyUser($email, $username)){
                        $hash = password_hash($password, PASSWORD_ARGON2I);

                        if($this->userManager->insertUser($email, $username, $hash, $avatar)){
                            $this->addFlash("success", "Hello <b>$username</b><br>Welcome to our Forum!");
                            $this->redirectTo("?ctrl=security&action=login");
                        }
                        else $this->addFlash("error", "Error 500, please try again later !");
                    }
                    else $this->addFlash("error", "This E-mail or Username are already in use!<br>Please choose another...");
                }
                else $this->addFlash("error", "Passwords do not match !");
            }
            else $this->addFlash("error", "All fields are required");
        }
        return $this->render("security/register.php"); 
    }

    public function logout()
    {
        $this->logoutUser();
        $this->addFlash("success", "You've been logged out!<br>See you soon...");
        $this->redirectTo('index.php');
    }

}