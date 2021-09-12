<?php 
    $msg = "";
    if (isset($_SESSION["messages"]["msg"]))
        $msg = $_SESSION["messages"]["msg"];
    unset($_SESSION["messages"]);
?>

<div class="modalWindow">
    <div id="messageModal" class="modal" style="<?= $msgDisplay ?>">
        <form class="modal-content" action="#">
            <div id="titleMsg" class="modal-container">
                <h1><i class="fas fa-thumbs-up fa-2x" style="color:rgb(45, 158, 0);"></i></h1>
                <p><?= $msg ?></p>
                <div class="clearfix">
                    <button id="closeMsg" type="button" class="closeMsg" name="closeMsg">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>