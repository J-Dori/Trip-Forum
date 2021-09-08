<?php
    $category = $response["data"]["category"];
    $continent = $response["data"]["continent"];
?>

<div id="categories">
    <div id="back-title">
        <a href="index.php" alt="Back" class="nav-links"><i class="fas fa-chevron-circle-left fa-2x nav-links"></i></a>
        <h1><?= $continent->getTitle() ?></h1>
    </div>
    <div id="categoriesList">
        <h2>Choose a destination Country</h2>
        <?php foreach ($category as $cat) { ?>
        <p><a class="link-add" href="?ctrl=subject&action=listSubject&id=<?= $cat->getId() ?>"><?= $cat->getTitle() ?></a></p>
        <?php } ?>
    </div>

</div>