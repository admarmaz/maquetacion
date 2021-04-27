
export let messages = () => {

    let saveShow = document.getElementById("save-show");

    saveShow.classList.toggle("show");

    setTimeout(function() {
        saveShow.classList.toggle("show");
        }, 3000);   
};

