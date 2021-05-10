@if(isset($tab))

    <div class="tab-language-buttons">

        @foreach ($localizations as $localization)
            <div class="tab-language-button {{ $loop->first ? 'active-tabs-locale':'' }} " data-tab="{{$tab}}" data-localetab="{{$localization->alias}}">
               <p>{{$localization->name}}</p>
            </div>
        @endforeach

    </div>

    {{ $slot }}

@endif    