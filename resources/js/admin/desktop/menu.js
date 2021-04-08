import {renderForm, renderTable} from './crudTable' ;

let menuItems = document.querySelectorAll(".menu-item");
const table = document.getElementById("table");
const form = document.getElementById("form");

menuItems.forEach( menuItem => {
    
    menuItem.addEventListener("click", (event) => {

        let url = menuItem.dataset.url;

        let sendEditRequest = async () => {

            try {
                await axios.get(url).then(response => {

                    form.innerHTML = response.data.form;
                    table.innerHTML = response.data.table;
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

