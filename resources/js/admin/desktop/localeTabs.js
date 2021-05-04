export let renderLanguageTabs = () => {

    let plusButtons = document.querySelectorAll('.tab-language-button');
    let tabElements = document.querySelectorAll(".tab-language");
    
    plusButtons.forEach(plusButton => { 
      
        plusButton.addEventListener("click", () => {
            
            let activeElements = document.querySelectorAll(".active-tabs-locale");
            
            if(plusButton.classList.contains("active-tabs-locale")){
               
                plusButton.classList.remove("active-tabs-locale");
    
                activeElements.forEach(activeElement => {
                    activeElement.classList.remove("active-tabs-locale");
                });
               
    
            }else{
    
                activeElements.forEach(activeElement => {
                    activeElement.classList.remove("active-tabs-locale");
                });
                
                plusButton.classList.add("active-tabs-locale");
    
                tabElements.forEach(tabElement => {
    
                    if(tabElement.dataset.content == plusButton.dataset.button){
                        tabElement.classList.add("active-tabs-locale"); 
                    }else{
                    }
                });
    
            }
        });
       
    });
    
}