<?php
    $user = $response["data"]["user"];
    $last10msg = $response["data"]["last10msg"];
?>

<h1>PROFILE</h1>
<div id="profileContent">

    <div id="profileInfo">
        <h2>AVATAR</h2>
            <div class="profileAvatar boxShaddow">
                <img src="public/images/avatar/<?= $user->getAvatar() ?>" alt="Avatar">
                <span id="profileAvatarChangeImg" href="">Edit</span>
            </div>
            <p><strong>Username :&ensp;</strong><?= $user->getUsername() ?></p>
            <p><strong>E-mail :&ensp;</strong><?= $user->getEmail() ?></p>
            <p><a class="link-add" href="?ctrl=user&action=formChangePassword">Change Password</a></p>

        <p id="profileLogoutBtt" class="boxShaddow"><a href="?ctrl=security&action=logout">Log Out</a></p>
        <p><a class="link-del" href="?ctrl=user&action=deleteUserAccount">Delete account</a></p>
        
    </div>


    <div id="profileLastMessages">
        <h2>List of Messages (last 10)</h2>
        <?php foreach ($last10msg as $msg) { ?>
            <div class="profileMsg boxShaddow">
                <h3 class="profileMsg-Path"><?= $msg->getForumPath() ?></h3>
                <p class="profileMsg-Date"><?= $msg->getCreatedAt() ?></p>
                <p class="profileMsg-Msg"><?= $msg->getMessage() ?></p>
            </div>
        <?php } ?>
    </div>

</div>

<div class="modalWindow">
    <?php include "view/user/formUserAvatar.php" ?>
</div>

<script src="public/js/scriptProfile.js"></script>
