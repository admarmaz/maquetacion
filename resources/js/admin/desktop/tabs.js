
const plusButtons = document.querySelectorAll('.tab-button');
const tabElements = document.querySelectorAll(".tab");

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

            tabElements.forEach(tabElement => {

                if(tabElement.dataset.content == plusButton.dataset.button){
                    tabElement.classList.add("active"); 
                }else{
                }
            });

        }
    });
   
});
