export let renderSlugPrevent = () => {
    
        let blockInputs = document.querySelectorAll(".slug");
    
        blockInputs.forEach(blockInput => {
    
            let originalInput = blockInput.value.match(/\{.*?\}/g)
    
            if (originalInput){
    
                blockInput.addEventListener("keydown", () =>{
                    let setInput = blockInput.value;
    
                    blockInput.addEventListener("keyup", () =>{
                        let finalInput = blockInput.value.match(/\{.*?\}/g)
        
                        if (finalInput){
                            if(originalInput.toString() != finalInput.toString()){
                                blockInput.value = setInput;
                            }
    
                        }else{
                            blockInput.value = setInput;
                        }
                        
                        setInput = blockInput.value
                    })
                });   
            }  
        })
        
}
