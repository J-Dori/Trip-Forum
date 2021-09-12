<!-- Delete confirmation Modal -->
    <form class="modal-content" action="#" id="formDelete">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <div class="modal-container">
            <h1>DELETE</h1>
            <h3 id="delTitle"></h3>
            <p>Are you sure you want to delete this <?= $_GET["ctrl"] ?>?</p>
            <p><?php 
                    if ($_GET["ctrl"] != "message") 
                        echo "<b>NOTE:</b> All the data associated will be deteleted?";
                    else echo "";
                ?>
            </p>
            <p id="delID" style="display:none"></p>
            <p id="delTable" style="display:none"></p>

            <div class="clearfix">
                <button id="delClose" type="button" class="closeBtt" onclick="delCloseDelete()">Cancel</button>
                <button id="delOK" type="button" onclick="delConfirm()" class="delBtt">Delete</button>
            </div>
        </div>
    </form>