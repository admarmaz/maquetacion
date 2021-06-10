<header class="header-fixed fixed">

    <div class="header-container">
        <div class="header-logo">
            @isset($logo->path)
                <a href="/"><img src="{{Storage::url($logo->path)}}" alt="{{$logo->alt}}" title="{{$logo->title}}"></a>
            @endisset
        </div>
  
        <div class="header-menu">

            <div class= "header-element">
                {{display_menu('principal','horizontal')}}
            </div>

            <div class="header-element">
                @lang('front/header.premium')
            </div>
            <div class>
                <svg style="width:30px;height:30px" viewBox="0 0 24 24">
                    <path fill="white" d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M9.75,7.82C8.21,7.82 7,9.03 7,10.57C7,12.46 8.7,14 11.28,16.34L12,17L12.72,16.34C15.3,14 17,12.46 17,10.57C17,9.03 15.79,7.82 14.25,7.82C13.38,7.82 12.55,8.23 12,8.87C11.45,8.23 10.62,7.82 9.75,7.82Z" />
                </svg>
            </div>

        </div>
    </div>

</header>

<div class="header-checkpoint"></div>
