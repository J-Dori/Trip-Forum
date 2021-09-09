<?php
    $message = $response["data"]["message"];
    $countries = $response["data"]["countries"];
    $theme = $response["data"]["theme"];
    $subject = $response["data"]["subject"];
    $countryId = $_GET["country"];
    $themeId = $_GET["theme"];
    $subjectId = $_GET["subject"];
?>

<div id="message">
    <div id="back-title">
        <a href="?ctrl=subject&action=listSubject&id=<?= $subjectId ."&country=". $countryId ."&theme=". $themeId ?>" alt="Back" class="nav-links"><i class="fas fa-chevron-circle-left fa-2x nav-links"></i></a>
        <h1><?= $countries->getContinent()->getTitle() ." / ". $countries->getTitle() ." / ". $theme->getTitle() ." / ". $subject->getTitle() ?></h1>
    </div>
    <div id="message-list">
        <h2>Choose a subject</h2>
        <?php foreach ($message as $msg) { ?>
            <div class="message-box boxShaddow">
                <p><?= $msg->getMessage() ?></p>
                <p><?= $msg->getCreatedAt() ?></p>
                <p><?= $msg->getUser()->getUsername() ?></p>
                <p><?= $msg->getSubject()->getTitle() ?></p>
            </div>
        <?php } ?>
    </div>

</div>