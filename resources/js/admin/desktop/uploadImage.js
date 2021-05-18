import {openImageModal} from './modalImage';


export let renderUploadImage = () => {

    /** inputElements se trata de todos los inputs, que se almacena. Busca todos los file inputs. */
    let inputElements = document.querySelectorAll(".upload-image-input");
    let uploadImages = document.querySelectorAll(".upload-image");

    /** A input se le dan los eventos de click, drop y change. El eventos change cambia de valor,
     * este es el elemento que se carga.
      */

    inputElements.forEach(inputElement => {

        /** Para evitar que se renderize dos veces los eventos, separamos los eventos. */
    
        uploadImage(inputElement);
    });

    function uploadImage(inputElement){

        /** .closest busca al padre */

        let uploadElement = inputElement.closest(".upload-image-add");


        uploadElement.addEventListener("click", (event) => {

            /** Cuando haga click en el padre, sera equivalente a darle click al hijo */
            inputElement.click();
        });
      
        inputElement.addEventListener("change", (e) => {
            if (inputElement.files.length) {
                updateThumbnail(uploadElement, inputElement.files[0]);
            }
        });
      
        uploadElement.addEventListener("dragover", (e) => {
            e.preventDefault();
            uploadElement.classList.add("upload-image-over");
        });
      
        ["dragleave", "dragend"].forEach((type) => {
            uploadElement.addEventListener(type, (e) => {
                uploadElement.classList.remove("upload-image-over");
            });
        });
      
        uploadElement.addEventListener("drop", (e) => {
            e.preventDefault();
        
            if (e.dataTransfer.files.length) {
                inputElement.files = e.dataTransfer.files;
                updateThumbnail(uploadElement, e.dataTransfer.files[0]);
            }
        
            uploadElement.classList.remove("upload-image-over");
        });
    }
      
    function updateThumbnail(uploadElement, file) {
    
        let thumbnailElement = uploadElement.querySelector(".upload-image-thumb");

        if(uploadElement.classList.contains('collection')){

            if(thumbnailElement == null){

                let cloneUploadElement = uploadElement.cloneNode(true);
                let cloneInput = cloneUploadElement.querySelector('.upload-image-input');

                uploadImage(cloneInput);
                uploadElement.parentElement.appendChild(cloneUploadElement);
            }
        }
    
        if (uploadElement.querySelector(".upload-image-prompt")) {
            uploadElement.querySelector(".upload-image-prompt").remove();
        }
        
        if (!thumbnailElement) {
            thumbnailElement = document.createElement("div");
            thumbnailElement.classList.add("upload-image-thumb");
            uploadElement.appendChild(thumbnailElement);
        }
                
        if (file.type.startsWith("image/")) {

            /** FileReader es un objeto nativo del navegador. En este caso, se encarga de tratar/manipular
             * el value de un file input o tratar archivos. 
             */
            let reader = new FileReader();
        
            /** Le metemos al reader el archivo de la imagen, para después metérselo al thumbnailElement.
             * A un input file NO LE PUEDES DAR UN VALUE ya que puede ser un agujero de seguridad. 
             * Los inputs file son entradas para ataques.
             */
            reader.readAsDataURL(file);
    
            
            reader.onload = () => {
                thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
            };
            /** Una vez insertada la foto, debemos generar un name para esa foto. Cuando se clicka, se clona
             * un input file, que va sin nombre. Esto es asi, porque cuando generamos el input, cada uno tiene que tener un nombre
             * diferente, ya que sino, se pisarian unos con otros.
             */
            if(uploadElement.classList.contains('collection')){

                /** */

                let content = uploadElement.dataset.content;
                let alias = uploadElement.dataset.alias;
                let inputElement = uploadElement.getElementsByClassName("upload-image-input")[0];
        
                /** Damos un nombre aleatorio a la imágen para distinguirla de las demás y evitar solapamiento. */

                inputElement.name = "images[" + content + "-" + Math.floor((Math.random() * 99999) + 1) + "." + alias  + "]"; 
            }
            
        } else {
            thumbnailElement.style.backgroundImage = null;
        }
    }

    uploadImages.forEach(uploadImage => {
    
        uploadImage.addEventListener("click", (e) => {
            
            let url = uploadImage.dataset.url;
    
            let sendImageRequest = async () => {
    
                try {
                    axios.get(url).then(response => {

                        openImageModal(response.data);
                      
                    });
                    
                } catch (error) {
    
                }
            };
    
            sendImageRequest();

        });
    });
}
