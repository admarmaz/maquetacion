import {renderCkeditor} from './ckeditor';
import {swipeRevealItem} from './swipe';
import {scrollWindowElement} from './verticalScroll'
import {renderFilterTable} from './filterTable';
import { showForm } from './bottombarMenu';

const table = document.getElementById("table");
const form = document.getElementById("form");

export let renderForm = () => {

    let forms = document.querySelectorAll(".admin-formulario");
    let labels = document.querySelectorAll('.label-highlight');
    let inputs = document.querySelectorAll('.input-highlight');
    let sendButton = document.getElementById("guardar-cambios");
    let createButton = document.querySelectorAll("create-button");

    inputs.forEach(input => {

        input.addEventListener('focusin', () => {
    
            for( var i = 0; i < labels.length; i++ ) {
                if (labels[i].htmlFor == input.name){
                    labels[i].classList.add("active");
                }
            }
        }); 
        
        input.addEventListener('blur', () => {
    
            for( var i = 0; i < labels.length; i++ ) {
                labels[i].classList.remove("active");
            }
        });
    });
    
    sendButton.addEventListener("click", (event) => {

        event.preventDefault();
    
        forms.forEach(form => { 


            
            let data = new FormData(form);

            if( ckeditors != 'null'){

            // si ckeditor NO está vacio, 
                Object.entries(ckeditors).forEach(([key, value]) => {
                    data.append(key, value.getData());
                });
            }

            let url = form.action;
    
            let sendPostRequest = async () => {
    
                try {
                    await axios.post(url, data).then(response => {
                        form.id.value = response.data.id;
                        table.innerHTML = response.data.table;
                        renderTable();
                    });
                    
                } catch (error) {
    
                    if(error.response.status == '422'){
    
                        let errors = error.response.data.errors;      
                        let errorMessage = '';
    
                        Object.keys(errors).forEach(function(key) {
                            errorMessage += '<li>' + errors[key] + '</li>';
                        })
        
                        document.getElementById('error-container').classList.add('active');
                        document.getElementById('errors').innerHTML = errorMessage;
                    }
                }
            };
    
            sendPostRequest();
        });
    });


    renderCkeditor();
};


export let renderTable = () => {

    let editButtons = document.querySelectorAll(".boton-editar");
    let deleteButtons = document.querySelectorAll(".borrar-dato");
    let swipeRevealItemElements = document.querySelectorAll('.swipe-element');

    editButtons.forEach(editButton => {

        editButton.addEventListener("click", () => {

            

            let url = editButton.dataset.url;

            let sendEditRequest = async () => {

                try {
                    await axios.get(url).then(response => {
                        form.innerHTML = response.data.form;
                        renderForm();
                    });
                    
                } catch (error) {
                    console.error(error);
                }
            };

            sendEditRequest();
        });
    });

    deleteButtons.forEach(deleteButton => {

        deleteButton.addEventListener("click", () => {

            let url = deleteButton.dataset.url;

            let sendDeleteRequest = async () => {

                try {
                    await axios.delete(url).then(response => {
                        table.innerHTML = response.data.table;
                        renderTable();
                    });
                    
                } catch (error) {
                    console.error(error);
                }
            };

            sendDeleteRequest();
        });
    });

    swipeRevealItemElements.forEach(swipeRevealItemElement => {

        let swipeRevealItemElements = document.querySelectorAll('.swipe-element');

        swipeRevealItemElements.forEach(swipeRevealItemElement => {
    
            new swipeRevealItem(swipeRevealItemElement);
    
        });
    
        new scrollWindowElement(table);

    });
};

export let editElement = (url) => {
    

    let sendEditRequest = async () => {

        try {
            await axios.get(url).then(response => {
                form.innerHTML = response.data.form;
                // showForm();
                renderForm();
            });
            
        } catch (error) {
            console.error(error);
        }
    };

    sendEditRequest();
}

export let deleteElement = (url) => {

    let deleteRequest = async () => {

        try {
            await axios.delete(url).then(response => {
                table.innerHTML = response.data.table;
                renderTable();
            });
        console.log("Hola");
        } catch (error) {
            console.error(error);
        }
    };

    deleteRequest();
}

renderForm();
renderTable();


