<?php
    $country = $response["data"]["country"];
    $continent = $response["data"]["continent"];
?>

<div id="categories">
    <div id="back-title">
        <a href="index.php" alt="Back" class="nav-links"><i class="fas fa-chevron-circle-left fa-2x nav-links"></i></a>
        <h1><?= $continent->getTitle() ?></h1>
    </div>
    <div id="categoriesList">
        <h2>Choose a destination Country</h2>
        <?php foreach ($country as $list) { ?>
        <p><a href="?ctrl=theme&action=listTheme&id=<?= $list->getId() ?>"><?= $list->getTitle() ?></a></p>
        <?php } ?>
    </div>

</div>