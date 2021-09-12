//Get DEVICE TYPE
var deviceType;
window.addEventListener('load', function() { 
    avatarEditBtt.style.visibility = "visible";
    const ua = navigator.userAgent;
    if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
        return deviceType = "tablet";
    }
    if (/Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(
        ua)) {
        return deviceType = "mobile";
    }
    avatarEditBtt.style.visibility = "hidden";
    return deviceType = "";
});


// PROFILE » span button to CHANGE AVATAR image
var avatarEditImg = document.querySelector('.profileAvatar');
var avatarEditBtt = document.querySelector('#profileAvatarChangeImg');

avatarEditImg.addEventListener("mouseout", function(event){
    if (deviceType == "")
        avatarEditBtt.style.visibility = "hidden";
});

avatarEditImg.addEventListener("mouseover", function(event){
    avatarEditBtt.style.visibility = "visible";
});

//Modal FormAvatar
var avatarModal = document.querySelector('#formUserAvatar');
var closeFormAvatar = document.querySelector("#closeFormAvatar");
avatarEditBtt.addEventListener("click", function(event){
    avatarModal.style.display = "block";
});

closeFormAvatar.addEventListener("click", function () {
    avatarModal.style.display = "none";
});