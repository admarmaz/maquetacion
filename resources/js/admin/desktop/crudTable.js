import { orderBy } from 'lodash';
import {renderTabs} from './tabs';
import {renderLanguageTabs} from './localeTabs';
import {renderCkeditor} from '../../ckeditor';
import {messages} from './messages';
import {renderUploadImage} from './uploadImage';
import {renderLocaleTags} from './localeTags';
import {renderLocaleSeo} from './localeSeo';
import {renderGoogleBot} from './googleBot';
import {renderSitemap} from './sitemap';
import {renderSlugPrevent} from './slugPrevent';


const table = document.getElementById("table");
const form = document.getElementById("form");

export let renderForm = () => {

    let forms = document.querySelectorAll(".admin-formulario");
    let labels = document.querySelectorAll('.label-highlight');
    let inputs = document.querySelectorAll('.input-highlight');
    let sendButton = document.getElementById("guardar-cambios");
    let createButton = document.getElementById("create-button");
    let storeButton = document.getElementById('store-button');

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
    
    if(sendButton){

        sendButton.addEventListener("click", (event) => {

            event.preventDefault();
        
            forms.forEach(form => { 
                
                let data = new FormData(form);
                let url = form.action;
    
                if( ckeditors != 'null'){
    
                    Object.entries(ckeditors).forEach(([key, value]) => {
                        data.append(key, value.getData());
                    });
                }
    
        
                let sendPostRequest = async () => {
        
                    try {
                        await axios.post(url, data).then(response => {

                            if(response.data.id){
                            form.id.value = response.data.id;
                            }
                            table.innerHTML = response.data.table;
    
                            messages(response.data.message);
                            renderTable();
                            renderForm();
                        });
                        
                    } catch (error) {
                            
                        if(error.response.status == '422'){
        
                            let errors = error.response.data.errors;      
                            let errorMessage = '';
        
                            Object.keys(errors).forEach(function(key) {
                                errorMessage += '<li>' + errors[key] + '</li>';
                            })
            
                            messages(errorMessage);
                        }
                    }
                };
        
                sendPostRequest();
            });
        });    
    }

    if(createButton){

        createButton.addEventListener("click", () => {

            let url = createButton.dataset.url;

            let createRequest = async () => {

                
                try {
                    await axios.get(url).then(response => {
                        form.innerHTML = response.data.form;
                        renderForm();

                        
                        
                    });
                    
                } catch (error) {
                    console.error(error);
                    
                }
            };

            createRequest();
        });

    }
  
    renderCkeditor();
    renderTabs();
    renderLanguageTabs();
    renderUploadImage();
    renderLocaleTags();
    renderLocaleSeo();
    renderGoogleBot();
    renderSitemap();
    renderSlugPrevent();
};

export let renderTable = () => {

    let editButtons = document.querySelectorAll(".boton-editar");
    let deleteButtons = document.querySelectorAll(".borrar-dato");
    let paginateButtons = document.querySelectorAll(".table-pagination-button");

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

    paginateButtons.forEach(paginateButton => {

        paginateButton.addEventListener("click", () => {

            let url = paginateButton.dataset.pagination;

            let paginate = async () => {

                try {
                    await axios.get(url).then(response => {
                        table.innerHTML = response.data.table;
                        renderTable();
                    });
                    
                } catch (error) {
                    console.error(error);
                }
            };

            paginate();
        });
    }); 

    
};

renderForm();
renderTable();
