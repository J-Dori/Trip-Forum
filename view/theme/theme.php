<?php
    $theme = $response["data"]["theme"]; //Themes by Country
    $countSubject = $response["data"]["countSubject"];
    $countries = $response["data"]["countries"];
    $countryId = $_GET["country"];
?>

<div id="theme">
    <div id="back-title">
        <a href="?ctrl=country&action=listCountry&id=<?= $countries->getContinent()->getId() ?>" alt="Back" class="nav-links"><i class="fas fa-chevron-circle-left fa-2x nav-links"></i></a>
        <h1><?= $countries->getContinent()->getTitle() ." / ". $countries->getTitle() ?></h1>
    </div>
    <div id="themeList">
        <h2>Choose a theme</h2>
        <?php foreach ($theme as $list) { ?>
            <div class="theme-list boxShaddow">
                <a href="?ctrl=subject&action=listSubject&id=<?= $list->getId() ."&country=". $countries->getId() ."&theme=". $_GET["id"] ?>">
                    <?= $list->getTitle() ?>
                    <?= " (". $countSubject->getCountThemes($list->getId()) .")" ?>
                </a>
                            
            </div>
        <?php } ?>
    </div>

</div>
