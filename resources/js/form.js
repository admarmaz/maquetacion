const saveButton = document.getElementById('guardar-cambios');

saveButton.addEventListener("click", (event) => {


    formularios.forEach(form => {
        event.preventDefault();

        let formId = document.getElementById(form.getAttribute("id"));
        let data = new FormData(formId);
        let url = form.action;

        let sendPostRequest = async () => {

            try {
                let response = await axios.post(url, data).then(response => {
                    form.id.value = response.data.id;
                    console.log('2');
                });
                 
            } catch (error) {
                console.error(error);
            }
        };

    });

});