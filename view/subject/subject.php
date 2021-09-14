<?php
    $subject = $response["data"]["subject"];
    $msgCount = $response["data"]["msgCount"];

    $countries = $response["data"]["countries"];
    $theme = $response["data"]["theme"];
    $countryId = $_GET["country"];
    $themeId = $_GET["theme"];
    $subjectId = $_GET["id"];

    use App\Service\Session;
    $display = "display:block";
    $hide = "display:none";
    $userAdmin = false;
    $userOwner = false;
    $userId = false;

    if (!Session::isAnonymous()) {
        $userId = Session::getUser()->getId();
        if (Session::isRoleUser(Session::getUser()->getRole() == "ROLE_ADMIN") || Session::isRoleUser(Session::getUser()->getRole() == "ROLE_ADMIN")) 
            $userAdmin = true;
    }

    Session::setCurrentPath();

            $closedTheme = 1;
    var_dump($response["data"]);
?>

<div id="subject">
    <div id="back-title">
        <a href="?ctrl=theme&action=listTheme&id=<?= $countryId ?>" alt="Back" class="nav-links"><i class="fas fa-chevron-circle-left fa-2x nav-links"></i></a>
        <h1><?= $countries->getContinent()->getTitle() ." / ". $countries->getTitle() ." / ". $theme->getTitle() ?></h1>
    </div>
    
    <div id="navUsersBtt" style="<?= ($closedTheme != 0 && $userId != false) ? $display : $hide; ?>">
        <a class="add-btt boxShaddow" href="#subjectForm">Add new Subject</a>
    </div>

    <div>
        <h2>Select a topic</h2>
        <?php 
            foreach ($subject as $list) { 
                $jsParams = $list->getId() .", 'Subject', '". $list->getTitle() ."'";
                $closed = $list->getClosed();
                $userNull = is_null($list->getUser());
                $qtt = "";
        ?>
            <div class="subject-list boxShaddow">
                <div class="subject-user">
                    <img src="public/images/avatar/<?= ($userNull) ? "noimage.jpg" : $list->getUser()->getAvatar() ?>"></img>
                    <p>
                        <span><?= ($userNull) ? "User deleted" : $list->getUser()->getUsername() ?></span><br>
                        <span style="color:gray"><?= ($userNull) ? "" : $list->getUser()->getRoleText() ?></span><br>
                        <span><?= $list->getCreatedAt() ?></span><br>
                    </p>
                </div>

                <a class="subject-list-title" href="?ctrl=message&action=listMessage&id=<?= $list->getId() ."&country=". $countryId ."&theme=". $themeId ?>">
                    <?= $list->getTitle() ?>
                    <span style="<?= ($closed == 0) ? "visibility:visible" : "visibility:hidden" ?>"><i class="fas fa-lock lockClosed"></i></span><br>
                    <span>
                    <?php $array = count($msgCount);
                        for ($i=0; $i=$array; $i++) {
                        if ($msgCount[$i] == $list->getId())
                            $qtt = ($count[$i]["countMessages"] == null) ? "0" : $count["countMessages"];
                    } ?><?= ($qtt == 1) ? "$qtt message" : "$qtt messages"; ?></span>
                </a>

                <div class="subject-user-btt" style="<?php 
                    $finalDisplay = $hide;
                    if ($userId != false) {
                        if ($closed == 0) //Closed Subject
                            $finalDisplay = $hide;
                        else { 
                            if (!$userNull) {
                                if ($list->getUser()->getId() == $userId)
                                    $finalDisplay = $display; //User
                                if (Session::getUser()->getRole() != "USER") 
                                    $finalDisplay = $display;//Admin or Mod
                            }
                        }   
                    }
                    else
                        $finalDisplay = $hide;
                    echo $finalDisplay;    
                ?>">
                    <a class="link-edit" onclick="openEditModal(<?= $jsParams ?>)"><i class="far fa-edit"></i></a>&emsp;
                    <a class="link-del" onclick="openDeleteModal(<?= $jsParams ?>)"><i class="far fa-trash-alt"></i></a>
                </div>
            </div>
        <?php } ?>
    </div>

</div>

<div id="subjectForm" style="<?= ($closedTheme != 0 && $userId != false) ? $display : $hide; ?>">
    <h3>Create a new subject</h3>
    <form action="?ctrl=subject&action=postSubject&id=<?= $themeId ."&country=". $countryId ."&theme=". $themeId ?>" method="post">
        <input type="text" name="subject" id="subject">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <input type="submit" value="Save" class="add-form">
    </form>
</div>

<div id="modalPopup" class="modal">
    <?php include "view/popup/edit.php"; ?>
    <?php include "view/popup/delete.php"; ?>
</div>