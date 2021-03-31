const forms = document.querySelectorAll(".admin-formulario");
const labels = document.getElementsByTagName('label');
const inputs = document.querySelectorAll('.input');
const sendButton = document.getElementById("guardar-cambios");
const table = document.getElementById("table");
const formContainer = document.getElementById("form");
const botonesBorrar = document.querySelectorAll(".borrar-dato");
const botonesEditar = document.querySelectorAll(".boton-editar")


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
        let url = form.action;

        let sendPostRequest = async () => {

            try {
                await axios.post(url, data).then(response => {
                    form.id.value = response.data.id;
                    table.innerHTML = response.data.table;
                });
                    
            } catch (error) {
                console.error(error);
            }
        };

        sendPostRequest();
    });
});
    
botonesBorrar.forEach(botonBorrar => { /* Para cada botón, realizamos esta acción (bucle forEach) */

    botonBorrar.addEventListener("click", (event) => {

        let url = botonBorrar.dataset.url;  /* asignamos a "url" la dirección mediante dataset */

        let sendDeleteRequest = async () => { /** Rev. **/

            try {
                await axios.delete(url).then(response => {
                    table.innerHTML = response.data.table;
                });
                
            } catch (error) {
                console.error(error);
                
            }
        };

        sendDeleteRequest(); /** Rev. **/

    });
});

botonesEditar.forEach(botonEditar => { 

    botonEditar.addEventListener("click", (event) => {

        let url = botonEditar.dataset.url;

        let sendData = async () => {

            try {
                await axios.get(url).then(response => {
                    formContainer.innerHTML = response.data.form;
                    renderForm();
                });
                
            } catch (error) {
                console.error(error);   
            }
        };

        sendData();

    });
});
