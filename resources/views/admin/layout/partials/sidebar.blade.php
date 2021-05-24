
<div class="sidebar">

    <div class="dropdown" id="menu-show">

        <div class="dropdown-show">
            <div>
                @lang('admin/'.$route.'.parent_section')
            </div>

            <div>
                <svg viewBox="0 0 24 24">
                    <path fill="currentColor" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z" />
                </svg>
            </div>
            
        
        </div>

        <div class="dropdown-hidden">
            <ul >
                <li class="menu-item" data-url="{{route("faqs")}}"> Faqs</li>
                <li class="menu-item" data-url="{{route("faqs_categories")}}"> Categorias Faqs</li>
                <li class="menu-item" data-url="{{route("users")}}"> Usuarios </li>
                <li class="menu-item" data-url="{{route("customers")}}"> Clientes </li>
                <li class="menu-item" data-url="{{route("sliders")}}"> Sliders </li>
                
            </ul>
            
        </div>
        
    </div>

   
    
</div>
