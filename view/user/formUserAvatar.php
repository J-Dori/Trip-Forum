<?php 
    use App\Service\Session;
?>

<!-- Insert Image Modal -->
<div id="formUserAvatar" class="modal" style="display:none">
    <form class="modal-content" action="?ctrl=user&action=changeAvatarImg&id=<?= Session::getUser()->getId() ?>" method="post" enctype="multipart/form-data">
        <div class="modal-container">
            <h1>Change Avatar image</h1>
            <div id="uploadImage">
                <p><label style="color:black" for="fileToUpload"><strong>Upload image (max: 2Mb)</strong></label></p>
                <p><input type="file" name="fileToUpload" id="fileToUpload" value=""></p>
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            </div>
            <div class="clearfix">
                <button id="closeFormAvatar" type="button" class="closeBtt del-btt boxShaddow">Cancel</button>
                <button id="postFormAvatar" type="submit" class="saveBtt boxShaddow" name="submitAvatar">SAVE</button>
            </div>
        </div>
    </form>
</div>