<?php
    $message = $response["data"]["message"];
    $countries = $response["data"]["countries"];
    $theme = $response["data"]["theme"];
    $subject = $response["data"]["subject"];
    $countryId = $_GET["country"];
    $themeId = $_GET["theme"];
    $forumPath = $countries->getTitle() ." / ". $theme->getTitle() ." / ". $subject->getTitle();

    use App\Service\Session;
    $display = "";
    $userRight = false;
    if (Session::isAnonymous()) 
        $display = "display:none";
    elseif ( Session::isRoleUser("ROLE_ADMIN") || Session::isRoleUser("ROLE_MOD") ||Session::isRoleUser("USER") ) {
        $display = "display:initial";
        $userRight = true;
    }

    if (!Session::isAnonymous()) {
        $userId = Session::getUser()->getId();
    }

    Session::setCurrentPath();
    
?>

<div id="message">
    <div id="back-title">
        <a href="?ctrl=subject&action=listSubject&id=<?= $themeId ."&country=". $countryId ."&theme=". $themeId ?>" alt="Back" class="nav-links"><i class="fas fa-chevron-circle-left fa-2x nav-links"></i></a>
        <h1><?= $countries->getContinent()->getTitle() ." / ". $forumPath ?></h1>
    </div>
    <div>
        <?php foreach ($message as $list) { 
            $jsParams = $list->getId() .", 'Message', 'Message created at:<br>". $list->getCreatedAt() ."'";
        ?>
            <div class="message-list boxShaddow">
                <div class="message-user">
                    <img src="public/images/avatar/<?= $list->getUser()->getAvatar() ?>"></img>
                    <p>
                        <span><b>Wrote by:</b></span><br>
                        <span><?= $list->getUser()->getUsername() ?></span><br>
                        <span style="color:gray"><?= $list->getUser()->getRoleText() ?></span><br>
                        <span><?= $list->getCreatedAt() ?></span><br>
                    </p>
                </div>
                <div class="message-text"><?= $list->getMessage() ?></div>
                <div class="message-user-btt" style="<?php if ($list->getUser()->getId() != $userId) echo "display:none"; if ($userRight) echo $display; ?>">
                    <a class="link-edit" href="?ctrl=message&action=editMessage&id=<?= $list->getId() ?>"><i class="far fa-edit"></i></a>&emsp;
                    <a class="link-del" onclick="openDeleteModal(<?= $jsParams ?>)"><i class="far fa-trash-alt"></i></a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div id="messageForm" style="<?= $display ?>">
    <h3>Post a new message</h3>
    <form action="?ctrl=message&action=postMessage&id=<?= $_GET["id"] ."&country=". $countryId ."&theme=". $themeId ?>" method="post">
        <textarea name="message" id="message" cols="50" rows="5"></textarea>
        <input type="hidden" name="forumPath" value="<?= $forumPath ?>">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <p><input type="submit" value="Send" class="add-form"></p>
    </form>
</div>

<div id="delConfModal" class="modal" style="display: none;">
    <?php include "view/popup/delete.php"; ?>
</div>