<?php
    $message = $response["data"]["message"];
    $countries = $response["data"]["countries"]; //category
    $subject = $response["data"]["subject"];
    
?>

<div id="subject">
    <div id="back-title">
        <a href="?ctrl=category&action=listSubject&id=<?= $subject->getCategory()->getId() ?>" alt="Back" class="nav-links"><i class="fas fa-chevron-circle-left fa-2x nav-links"></i></a>
        <h1><?= $countries->getContinent()->getTitle() ." / ". $subject->getCategory()->getTitle() ." / ". $subject->getTitle() ?></h1>
    </div>
    <div id="subjectList">
        <h2>Choose a subject</h2>
        <ul>
        <?php foreach ($message as $msg) { ?>
            <li><a class="link-add" href="?ctrl=message&action=listMessage&id=<?= $msg->getId() ?>"><?= $msg->getMessage() ?></a></li>
        <?php } ?>
        </ul>
    </div>

</div>