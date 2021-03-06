import {renderTable} from './crudTable';

const table = document.getElementById("table");
const tableFilter = document.getElementById("table-filter");
const filterForm = document.getElementById("filter-form");

export let renderFilterTable = () => {

    let openFilter = document.getElementById("open-filter");
    let applyFilter = document.getElementById("apply-filter");

    if(openFilter != null){
    
        openFilter.addEventListener( 'click', () => {
            openFilter.classList.remove('button-active');
            tableFilter.classList.add('filter-active')
            applyFilter.classList.add('button-active');
        });
        
        applyFilter.addEventListener( 'click', () => {      
    
            let data = new FormData(filterForm);
            let filters = {};

            data.forEach(function(value, key){
                filters[key] = value;
            });
            
            let json = JSON.stringify(filters);

            let url = filterForm.action;
    
            let sendPostRequest = async () => {
    
                try {
                    axios.get(url, {
                        params: {
                          filters: json
                        }
                    }).then(response => {
                        table.innerHTML = response.data.table;
                        renderTable();
                        tableFilter.classList.remove('filter-active')
                        applyFilter.classList.remove('button-active');
                        openFilter.classList.add('button-active');
                    });
                    
                } catch (error) {
    
                }
            };
    
            sendPostRequest();
            
        });
    }
 
};

export let hideFilterTable = () => {

    tableFilter.classList.remove('filter-active')

    let buttons = document.querySelectorAll(".button-active");  
    
    buttons.forEach(button => {
        button.classList.remove('button-active');
    });

}

export let showFilterTable = () => {

    let openFilter = document.getElementById("open-filter");

    openFilter.classList.add('button-active');
}

renderFilterTable();