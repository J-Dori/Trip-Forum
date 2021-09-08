<?php
    if (isset($_SESSION["user"]))
        $user = $response["data"];
    var_dump($user);
?>

<h1>PROFILE</h1>
<div id="profile">

    <div id="profileInfo">
        <h2>AVATAR</h2>
        <?php foreach ($user as $profile) { ?>
            <div class="profileAvatar boxShaddow">
                <img src="public/images/avatar/<?= $profile->getAvatar() ?>" alt="Avatar">
                <span id="userAvatarChangeImg" href="">Edit</span>
            </div>
            <p><strong>Username :&ensp;</strong><?= $profile->getUsername() ?></p>
            <p><strong>E-mail :&ensp;</strong><?= $profile->getEmail() ?></p>
            <p><a class="link-add" href="?ctrl=user&action=formChangePassword">Change Password</a></p>
            
        <?php } ?>
        <p id="profileLogoutBtt" class="boxShaddow"><a href="?ctrl=security&action=logout">Log Out</a></p>
    </div>

</div>
