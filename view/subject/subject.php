<?php
    $subject = $response["data"]["subject"];
    $countries = $response["data"]["countries"];
    $theme = $response["data"]["theme"];
    $countryId = $_GET["country"];
    $themeId = $_GET["theme"];
    $subjectId = $_GET["id"];

    use App\Service\Session;
    $display = "";
    $userRight = false;
    if (Session::isAnonymous()) 
        $display = "display:none";
    elseif (Session::isRoleUser("ROLE_ADMIN") || (Session::isRoleUser("ROLE_MOD"))) {
        $display = "display:initial";
        $userRight = true;
    }

    if (!Session::isAnonymous()) {
        $userId = Session::getUser()->getId();
    }

    Session::setCurrentPath();
?>


<div id="subject">

    <div id="back-title">
        <a href="?ctrl=theme&action=listTheme&id=<?= $countryId ?>" alt="Back" class="nav-links"><i class="fas fa-chevron-circle-left fa-2x nav-links"></i></a>
        <h1><?= $countries->getContinent()->getTitle() ." / ". $countries->getTitle() ." / ". $theme->getTitle() ?></h1>
    </div>

    <div id="navUsersBtt" style="<?= $display ?>">
        <a class="add-btt boxShaddow" href="#subjectForm">Add new Subject</a>
    </div>

    <div>
        <h2>Select a topic</h2>
        <?php 
            foreach ($subject as $list) { 
                $jsParams = $list->getId() .", 'Subject', '". $list->getTitle() ."'";
        ?>
            <div class="subject-list boxShaddow">
                <div class="subject-user">
                    <img src="public/images/avatar/<?= $list->getUser()->getAvatar() ?>"></img>
                    <p>
                        <span>Created by: </span><br>
                        <span><?= $list->getUser()->getUsername() ?></span><br>
                        <span style="color:gray"><?= $list->getUser()->getRoleText() ?></span><br>
                        <span><?= $list->getCreatedAt() ?></span><br>
                    </p>
                </div>
                <a class="subject-list-title" href="?ctrl=message&action=listMessage&id=<?= $list->getId() ."&country=". $countryId ."&theme=". $themeId ?>">
                    <?= $list->getTitle() ?>
                </a>
                <div class="subject-user-btt" style="<?php if ($list->getUser()->getId() != $userId) echo "display:none"; if ($userRight) echo $display; ?>">
                    <a class="link-edit" href="?ctrl=subject&action=editSubject&id=<?= $list->getId() ?>"><i class="far fa-edit"></i></a>&emsp;
                    <a class="link-del" onclick="openDeleteModal(<?= $jsParams ?>)"><i class="far fa-trash-alt"></i></a>
                </div>
            </div>
        <?php } ?>
    </div>

</div>

<div id="subjectForm" style="<?= $display ?>">
    <h3>Create a new subject</h3>
    <form action="?ctrl=subject&action=postSubject&id=<?= $themeId ."&country=". $countryId ."&theme=". $themeId ?>" method="post">
        <input type="text" name="subject" id="subject">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <input type="submit" value="Save" class="add-form">
    </form>
</div>

<div id="delConfModal" class="modal" style="display: none;">
    <?php include "view/popup/delete.php"; ?>
</div>