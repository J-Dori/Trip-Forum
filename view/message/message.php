<?php
    $message = $response["data"]["message"];
    $countries = $response["data"]["countries"];
    $theme = $response["data"]["theme"];
    $subject = $response["data"]["subject"];
    $countryId = $_GET["country"];
    $themeId = $_GET["theme"];
    
    $forumPath = $countries->getTitle() ." / ". $theme->getTitle() ." / ". $subject->getTitle();
    $subjectId = $subject->getId();
    $closed = $subject->getClosed();

     use App\Service\Session;
    $display = "display:block";
    $hide = "display:none";
    $finalDisplay = "";
    $userAdmin = false;
    $userOwner = false;
    $userId = false;

    if (!Session::isAnonymous()) {
        $userId = Session::getUser()->getId();
        if (!is_null($subject->getUser())) {
            $userOwner = ($userId == $subject->getUser()->getId()) ? true : false;    
        }    
    }
    if (Session::isRoleUser("ROLE_ADMIN") || Session::isRoleUser("ROLE_MOD")) 
        $userAdmin = true;

    Session::setCurrentPath(); 

?>

<div id="message">
    <div id="back-title">
        <a href="?ctrl=subject&action=listSubject&id=<?= $themeId ."&country=". $countryId ."&theme=". $themeId ?>" alt="Back" class="nav-links"><i class="fas fa-chevron-circle-left fa-2x nav-links"></i></a>
        <h1><?= $countries->getContinent()->getTitle() ." / ". $forumPath ?></h1>
    </div>


    <div id="closedBar" style="<?= ($closed == 0) ? $display : $hide ?>">
        <h2 class="txtC closedBar boxShaddow" >This subject is Closed</h2>
        <a href="?ctrl=message&action=reopenSubject&id=<?= $subjectId ?>" style="<?= ($userOwner || $userAdmin) ? $display : $hide ?>"><h2 class="txtC reopenBar boxShaddow" ><i class="fas fa-lock-open"></i>&ensp; Reopen this subject</h2></a>
    </div>

    <div id="closeSubject" style="<?= ($closed == 0) ? $hide : $display ?>">
        <a href="?ctrl=message&action=closeSubject&id=<?= $subjectId ?>" style="<?= ($userOwner || $userAdmin) ? $display : $hide ?>"class="txtC closeSubjectBtt boxShaddow">Close this subject</a>
    </div>

    <div>
        <?php foreach ($message as $list) { 
            $jsParams = $list->getId() .", 'Message', 'Message created at:<br>". $list->getCreatedAt() ."'";
            $userNull = is_null($list->getUser());
        ?>
            <div class="message-list boxShaddow">
                <div class="message-user">
                    <img src="public/images/avatar/<?= ($userNull) ? "noimage.jpg" : $list->getUser()->getAvatar() ?>"></img>
                    <p>  
                        <span><?= ($userNull) ? "User deleted" : $list->getUser()->getUsername() ?></span><br>
                        <span style="color:gray"><?= ($userNull) ? "" : $list->getUser()->getRoleText() ?></span><br>
                        <span><?= $list->getCreatedAt() ?></span><br>
                    </p>
                </div>
                <div class="message-text"><?= $list->getMessage() ?></div>
                <div class="message-user-btt" style="<?php 
                    $finalDisplay = $hide;
                    if ($userId != false) {
                        if ($closed == 0) //Closed Subject
                            $finalDisplay = $hide;
                        else { 
                            if (!$userNull) {
                                if ($list->getUser()->getId() == $userId)
                                    $finalDisplay = $display; //User
                                if (Session::getUser()->getRole() != "USER") 
                                    $finalDisplay = $display;//Admin or Mod
                            }
                        }   
                    }
                    else
                        $finalDisplay = $hide;
                    echo $finalDisplay;
                ?>">
                    <a class="link-edit" href="?ctrl=message&action=OpenEditMessage&id=<?= $list->getId() ."&country=". $countryId ."&theme=". $themeId ."&subject=". $_GET["id"] ?>"><i class="far fa-edit"></i></a>&emsp;
                    <a class="link-del" onclick="openDeleteModal(<?= $jsParams ?>)"><i class="far fa-trash-alt"></i></a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div id="messageForm" style="<?= ($closed != 0 && $userId != false) ? $display : $hide; ?>">
    <h3>Post a new message</h3>
    <form action="?ctrl=message&action=postMessage&id=<?= $_GET["id"] ."&country=". $countryId ."&theme=". $themeId ?>" method="post">
        <textarea name="message" id="message" cols="50" rows="5"></textarea>
        <input type="hidden" name="forumPath" value="<?= $forumPath ?>">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <p><input type="submit" value="Send" class="add-form"></p>
    </form>
</div>

<div id="modalPopup" class="modal">
    <?php include "view/popup/delete.php"; ?>
</div>