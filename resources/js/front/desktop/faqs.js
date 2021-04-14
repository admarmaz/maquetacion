<<<<<<< HEAD

const plusButtons = document.querySelectorAll('.faq-button');
const faqElements = document.querySelectorAll(".faq");

plusButtons.forEach(plusButton => { 
  
    plusButton.addEventListener("click", () => {
        
        let activeElements = document.querySelectorAll(".active");
        
        if(plusButton.classList.contains("active")){
           
            plusButton.classList.remove("active");

            activeElements.forEach(activeElement => {
                activeElement.classList.remove("active");
            });
           
      

        }else{

            activeElements.forEach(activeElement => {
                activeElement.classList.remove("active");
            });
            
            plusButton.classList.add("active");

            faqElements.forEach(faqElement => {

                if(faqElement.dataset.content == plusButton.dataset.button){
                    faqElement.classList.add("active"); 
                }else{
                }
            });
            console.log("funciona");
        }
    });
   
=======
const faqsButtons = document.querySelectorAll(".faq-button");

faqsButtons.forEach(faqsButton => {

    faqsButton.addEventListener("click", (event) => {

    });
>>>>>>> a2306b4dd3b72c58597f1b6a40a8f8c48b1c5612
});
