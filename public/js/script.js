// Get the modal for MESSAGE
var modalMsg = document.getElementById('messageModal');
var closeBtt = document.querySelector("#closeMsg");

closeBtt.addEventListener("click", function () {
    modalMsg.style.display = "none";
});

// Get the modal for DELETE CONFIRMATION
function openDeleteModal(delID, delTable, delName) {
    document.querySelector('#delConfModal').setAttribute("style", "display: block");
    document.getElementById('delID').innerText = delID;
    document.getElementById('delTable').innerText = delTable;
    document.getElementById('delTitle').innerHTML = "<strong>"+ delName +"</strong>";
}

function delCloseDelete() {
    document.querySelector('#delConfModal').setAttribute("style", "display: none");
}

function delConfirm() {
    var delID = document.getElementById('delID').innerText;
    var delTable = document.getElementById('delTable').innerText;
    
    window.location = "?ctrl="+  delTable.toLowerCase() +"&action=delete"+ delTable +"&id=" + delID;
}
