<?php
    $subject = $response["data"]["subject"];
    $countries = $response["data"]["countries"];
    $theme = $response["data"]["theme"];
    $countryId = $_GET["country"];
    $themeId = $_GET["theme"];
?>

<div id="subject">
    <div id="back-title">
        <a href="?ctrl=theme&action=listTheme&id=<?= $themeId ."&country=". $countryId ?>" alt="Back" class="nav-links"><i class="fas fa-chevron-circle-left fa-2x nav-links"></i></a>
        <h1><?= $countries->getContinent()->getTitle() ." / ". $countries->getTitle() ." / ". $theme->getTitle() ?></h1>
    </div>
    <div id="subject-list">
        <h2>Select a topic</h2>
        <?php foreach ($subject as $list) { ?>
            <div class="subject-list boxShaddow">
                <a href="?ctrl=message&action=listMessage&id=<?= $list->getId() ?>&country=<?= $countries->getId() ."&theme=". $theme->getId() ."&subject=". $_GET["id"] ?>">
                    <?= $list->getTitle() ?>
                </a>
                <div class="subject-user" style="float:right">
                    <p>Created by: <?= $list->getUser()->getUsername() ?></p>
                </div>
            </div>
        <?php } ?>
    </div>

</div>