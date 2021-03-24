const saveButton = document.getElementById('guardar-cambios');

saveButton.addEventListener("click", (event) => {

    event.preventDefault();

    const formularios = document.querySelectorAll(".admin-formulario");

    formularios.forEach(formulario => {
        
        const datosFormulario = new FormData(document.getElementById(formulario.id));

        for (var entrada of datosFormulario.entries()){
            console.log(entrada[0] + ": " + entrada[1]);
        }

    });

});