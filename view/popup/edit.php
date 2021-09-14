<!-- Edit confirmation Modal -->
<div id="editConfModal" class="modal" style="display: none;">
    <form class="modal-content" id="formEdit" method="POST" action="?ctrl=<?= strtolower($_GET["ctrl"]); ?>&action=edit<?= ucfirst($_GET["ctrl"]); ?>&id=<?= $_GET["id"]; ?>">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <div class="modal-container">
            <h1>EDIT <?= strtoupper($_GET["ctrl"]); ?></h1>
            <h3 id="editTitle"></h3>
            <p>
                <input type="text" name="title" id="title" style="width: 90%;">
                <input type="hidden" name="id" id="id" value="<?= $_GET["id"]; ?>">
                <input type="hidden" name="table" id="table" value="<?= strtolower($_GET["ctrl"]); ?>">
            </p>
            <p id="editID" style="display:none"></p>
            <p id="editTable" style="display:none"></p>

            <div class="clearfix">
                <button id="editClose" type="button" class="closeBtt" onclick="editCloseModal()">Cancel</button>
                <button id="editOK" type="submit" class="saveBtt">Save changes</button>
            </div>
        </div>
    </form>
</div>