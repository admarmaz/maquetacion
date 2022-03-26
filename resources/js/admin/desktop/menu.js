
import {renderForm, renderTable} from './crudTable' ;


const sidebar = document.getElementById("sidebar");
const table = document.getElementById("table");
const form = document.getElementById("form");


export let renderMenu = () => {

    
    let menuItems = document.querySelectorAll(".menu-item");

    menuItems.forEach( menuItem => {
        menuItem.addEventListener("click", (event) => {
            
            let url = menuItem.dataset.url;
            
            let sendEditRequest = async () => {

                try {
                    await axios.get(url).then(response => {
                        
                        console.log(response);
                        form.innerHTML = response.data.form;
                        table.innerHTML = response.data.table;
                        sidebar.innerHTML = response.data.sidebar;
                        
                        window.history.pushState(null, null, url);
                        
                    });

                    
                } catch (error) {
                    console.error(error);
                }

                renderMenu();
                renderTable();
                renderForm();
                showMenu();
            };

            sendEditRequest();
            
        });

    });
    
}

let showMenu = () => {

    const menuShow = document.getElementById("menu-show");

    menuShow.addEventListener("click", () => {

        menuShow.classList.toggle("show");
        console.log("Don't overthink")
    });
}

showMenu();
renderMenu();


