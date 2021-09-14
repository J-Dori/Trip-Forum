<?php
    $theme = $response["data"]["theme"]; //Themes by Country
    $countries = $response["data"]["countries"];
    $countryId = $_GET["id"];
?>

<div id="theme">
    <div id="back-title">
        <a href="?ctrl=country&action=listCountry&id=<?= $countries->getContinent()->getId() ?>" alt="Back" class="nav-links"><i class="fas fa-chevron-circle-left fa-2x nav-links"></i></a>
        <h1><?= $countries->getContinent()->getTitle() ." / ". $countries->getTitle() ?></h1>
    </div>
    <h2>Choose a theme</h2>
    <div id="themeList">
        <?php foreach ($theme as $list) { ?>
            <div class="themeBox txtC boxShaddow">
                <a href="?ctrl=subject&action=listSubject&id=<?= $list->getId() ."&country=". $countries->getId() ."&theme=". $list->getId() ?>">
                    <h4><?= $list->getTitle() ?></h4>
                    <p>
                        <img class="themeImg" src="<?= IMG_PATH ."theme/". $list->getImage() ?>" alt="<?= $list->getTitle() ?>" >
                    </p>
                </a>            
            </div>
        <?php } ?>
    </div>

</div>
