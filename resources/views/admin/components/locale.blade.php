@if(isset($tab))

    <div class="tab-language-buttons">
        <div class="tab-language-button active-tabs-locale" data-localetab ="es" data-tab="{{$tab}}">
            <p> Español <p>
        </div>
        <div class="tab-language-button" data-localetab ="en" data-tab="{{$tab}}" >
            <p> Inglés <p>
        </div>

    </div>

    {{ $slot }}

@endif    