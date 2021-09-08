<?php
    $continent = $response["data"]["continent"];
?>

<div id="categories">
    <div id="categoriesList">
        <h2>Choose a destination</h2>
        <?php foreach ($continent as $list) { ?>
            <p><a class="link-add" href="?ctrl=category&action=listCategory&id=<?= $list->getId() ?>"><?= $list->getTitle() ?></a></p>
        <?php } ?>
    </div>
</div>
