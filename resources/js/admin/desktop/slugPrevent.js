export let renderSlugPrevent = () => {

    let preventSlugs = document.querySelectorAll('.slug');

    if(preventSlugs){

        preventSlugs.forEach(preventSlug => {

            preventSlug.addEventListener('keydown', () => {

                let slug = preventSlug.value.match(/\{.*?\}/g);
                console.log(slug);

            })

            preventSlug.addEventListener('keyup', () =>{

                let slug = preventSlug.value.match(/\{.*?\}/g);
                console.log(slug);

            })
        })
    }
}

