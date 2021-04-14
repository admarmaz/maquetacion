import {renderForm, renderTable} from './crudTable' ;

let menuItems = document.querySelectorAll(".menu-item");
const table = document.getElementById("table");
const form = document.getElementById("form");
const menuShow = document.getElementById("menu-show");


menuItems.forEach( menuItem => {
    
    menuItem.addEventListener("click", (event) => {

        let url = menuItem.dataset.url;

        let sendEditRequest = async () => {

            try {
                await axios.get(url).then(response => {

                    form.innerHTML = response.data.form;
                    table.innerHTML = response.data.table;

                    window.history.pushState('', '', ulr); //cambio de url cuando navegamos con el menu
                    renderForm();
                    renderTable();
                });
                
            } catch (error) {
                console.error(error);
            }
        };

        sendEditRequest();

    });
});

menuShow.addEventListener("click", () => {

    menuShow.classList.toggle("show");

});


