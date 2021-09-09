<?php
    $continent = $response["data"]["continent"];
?>

<div id="continent">
    <div id="continentList">
        <h2>Choose a destination</h2>
        <?php foreach ($continent as $list) { ?>
            <p><a href="?ctrl=country&action=listCountry&id=<?= $list->getId() ?>"><?= $list->getTitle() ?></a></p>
        <?php } ?>
    </div>
</div>
