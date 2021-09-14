// Get the modal for $_SESSION[MESSAGES]
var modalMsg = document.getElementById('messageModal');
var closeBtt = document.querySelector("#closeMsg");

closeBtt.addEventListener("click", function () {
    modalMsg.style.display = "none";
});

// Get the modal for DELETE CONFIRMATION
function openDeleteModal(delID, delTable, delName) {
    document.querySelector('#modalPopup').setAttribute("style", "display: block");
    document.querySelector('#delConfModal').setAttribute("style", "display: block");
    document.getElementById('delID').innerText = delID;
    document.getElementById('delTable').innerText = delTable;
    document.getElementById('delTitle').innerHTML = "<strong>"+ delName +"</strong>";
}

function delCloseDelete() {
    document.querySelector('#modalPopup').setAttribute("style", "display: none");
    document.querySelector('#delConfModal').setAttribute("style", "display: none");
}

function delConfirm() {
    var delID = document.getElementById('delID').innerText;
    var delTable = document.getElementById('delTable').innerText;
    
    window.location = "?ctrl="+  delTable.toLowerCase() +"&action=delete"+ delTable +"&id=" + delID;
}

// Get the modal for EDIT : all except Message
function openEditModal(editID, editTable, editName) {
    document.querySelector('#modalPopup').setAttribute("style", "display: block");
    document.querySelector('#editConfModal').setAttribute("style", "display: block");
    document.getElementById('editID').innerText = editID;
    document.getElementById('editTable').innerText = editTable;
    document.getElementById('editTitle').innerHTML = "<strong>"+ editName +"</strong>";
}

function editCloseModal() {
    document.querySelector('#modalPopup').setAttribute("style", "display: none");
    document.querySelector('#editConfModal').setAttribute("style", "display: none");
}

function editConfirm() {
    var editID = document.getElementById('editID').innerText;
    var editTable = document.getElementById('editTable').innerText;
    
    window.location = "?ctrl="+  editTable.toLowerCase() +"&action=edit"+ editTable +"&id=" + editID;
}

// Get the modal for EDIT Messages
function openEditModalMsg() {
    document.querySelector('#modalPopup').setAttribute("style", "display: block");
    document.querySelector('#editConfModal').setAttribute("style", "display: block");
}