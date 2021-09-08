<?php
    $subject = $response["data"]["subject"];
    $countries = $response["data"]["countries"]; //category
?>

<div id="subject">
    <div id="back-title">
        <a href="?ctrl=category&action=listCategory&id=<?= $countries->getContinent()->getId() ?>" alt="Back" class="nav-links"><i class="fas fa-chevron-circle-left fa-2x nav-links"></i></a>
        <h1><?= $countries->getContinent()->getTitle() ." / ". $countries->getTitle() ?></h1>
    </div>
    <div id="subjectList">
        <h2>Choose a subject</h2>
        <ul>
        <?php foreach ($subject as $sub) { ?>
            <li><a class="link-add" href="?ctrl=message&action=listMessage&id=<?= $sub->getId() ?>"><?= $sub->getTitle() ?></a></li>
        <?php } ?>
        </ul>
    </div>

</div>
