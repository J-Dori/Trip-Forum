<?php
    use App\Service\Session;
    $backPath = Session::getCurrentPath();
    
    $message = $response["data"]["message"];
    $countries = $response["data"]["countries"];
    $theme = $response["data"]["theme"];
    $subject = $response["data"]["subject"];
    $countryId = $_GET["country"];
    $themeId = $_GET["theme"];
    $forumPath = $countries->getContinent()->getTitle() ." / ".  $countries->getTitle() ." / ". $theme->getTitle() ." / ". $subject->getTitle();
?>

<div id="message">
    <div id="back-title">
        <h1><?= $forumPath ?></h1>
    </div>
<div>

<h2><i>Original message</i></h2>
<div class="message-list boxShaddow">
    <div class="message-user">
        <img src="public/images/avatar/<?= $message->getUser()->getAvatar() ?>"></img>
        <p>
            <span><b>Wrote by:</b></span><br>
            <span><?= $message->getUser()->getUsername() ?></span><br>
            <span style="color:gray"><?= $message->getUser()->getRoleText() ?></span><br>
            <span><?= $message->getCreatedAt() ?></span><br>
        </p>
    </div>
    <div class="message-text">
        <i><?= $message->getMessage() ?></i>
    </div>
</div>


<div>
    <form class="" id="formEdit" method="POST" action="?ctrl=message&action=editMessage&id=<?= $_GET["id"]; ?>">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <div class="">
            <h1>EDIT MESSAGE</h1>
            <p>
                <textarea type="text" name="message" id="message" style="width: 100%; height:100px;"><?= str_replace("<br>", " ", $message->getMessage()) ?></textarea>
            </p>
            <div class="clearfix txtC">
                <a href="<?= $backPath ?>"><button id="editClose" type="button" class="closeBtt">Cancel</button></a>
                <button id="editOK" type="submit" class="saveBtt">Save changes</button>
            </div>
        </div>
    </form>
</div>
