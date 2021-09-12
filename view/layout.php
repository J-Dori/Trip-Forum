<?php
    use App\Service\Session;
    $userHide = ""; $userConnected = "";
    if (Session::isAnonymous()) $userHide = "display:none";
    if (!Session::isAnonymous()) $userConnected = "display:none";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Normalize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= CSS_PATH ?>style.css" />
    <title>TRIP FORUM</title>
</head>
<body>
    <header>
        <div id="banner" class="boxShaddow">
            <nav class="">
                <a href="index.php" id="logo-link"><img src="<?= IMG_PATH ?>logo.png" alt="Logo"></a>
                <div id="nav-links">
                    <a href="index.php">Accueil</a>
                    <a style="<?= $userConnected ?>" href="?ctrl=security&action=login">Connexion</a>
                    <a style="<?= $userHide ?>" href="?ctrl=user&action=profile">Profile</a>
                    <a style="<?= $userHide ?>" href="?ctrl=management&action=open">Management</a>
                    <a style="<?= $userHide ?>" href="?ctrl=security&action=logout">Log Out</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <?= $content;
            $msgDisplay = "display:none";
            $msgType = "";
            if (isset($_SESSION["messages"])) {
                $msgType = $_SESSION["messages"]["type"];
                $msgDisplay = "display:block";
            } 
            if ($msgType != "") include "view/popup/$msgType.php" ?>
    </main>
    
    <script src="public/js/script.js"></script>

</body>
</html> 