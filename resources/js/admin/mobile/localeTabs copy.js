export let renderLanguageTabs = () => {

    let plusButtons = document.querySelectorAll('.tab-language-button');
    let tabElements = document.querySelectorAll(".tab-language");
    
    plusButtons.forEach(plusButton => { 
      
        plusButton.addEventListener("click", () => {
            
            let activeElements = document.querySelectorAll(".active-tabs-locale");
            let activeTab = plusButton.dataset.tab;

            activeElements.forEach(activeElement => {

                if(activeElement.dataset.tab == activeTab){
                    activeElement.classList.remove("active-tabs-locale");
                }
            });

            plusButton.classList.add("active-tabs-locale");

            tabElements.forEach(tabElement => {
                if(tabElement.dataset.tab == activeTab){
                    if(tabElement.dataset.localetab == plusButton.dataset.localetab)
                        tabElement.classList.add("active-tabs-locale")
                }
                    
            
            });

        });

    });

}


