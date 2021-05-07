export let renderTabs = () => {

    let plusButtons = document.querySelectorAll('.tab-button');
    let tabElements = document.querySelectorAll(".tab");
    
    plusButtons.forEach(plusButton => { 
      
        plusButton.addEventListener("click", () => {
            
            let activeElements = document.querySelectorAll(".active-tabs");
            
            if(plusButton.classList.contains("active-tabs")){
               
                plusButton.classList.remove("active-tabs");
    
                activeElements.forEach(activeElement => {
                    activeElement.classList.remove("active-tabs");
                });
               
    
            }else{
    
                activeElements.forEach(activeElement => {
                    activeElement.classList.remove("active-tabs");
                });
                
                plusButton.classList.add("active-tabs");
    
                tabElements.forEach(tabElement => {
    
                    if(tabElement.dataset.content == plusButton.dataset.button){
                        tabElement.classList.add("active-tabs"); 
                    }else{
                    }
                });
    
            }
        });
       
    });
    
}
