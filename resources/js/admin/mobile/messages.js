export let messages = (message) => {

    let saveShow = document.getElementById("save-show");
    let customMessage = document.getElementById('custom-message');

    customMessage.innerHTML = message;
    saveShow.classList.toggle("show");

    setTimeout(function() {
        saveShow.classList.toggle("show");
    }, 3000);   
};

