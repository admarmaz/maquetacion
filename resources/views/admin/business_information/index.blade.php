@php
    $route = 'business_information';
@endphp

@extends('admin.layout.form')

@section('form')

    <div class="formulario-contenedor">
        <div class="formulario-titulo">

            <div class="formulario-tit">
                <h2>Info de empresa</h2>
            </div>
            <div class="option-buttons">
                <div class="formulario-enviar">
                    <a href="" class="boton-guardar save-show">
                        <div id="store-button">
                            <svg viewBox="0 0 24 24">
                                <path fill="" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                            </svg>
                        </div>
                    </a>
                </div>
                
                <div class="empty-form-button" id="create-button" data-url="">
                    <svg style="width:30px;height:30px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12,6V9L16,5L12,1V4A8,8 0 0,0 4,12C4,13.57 4.46,15.03 5.24,16.26L6.7,14.8C6.25,13.97 6,13 6,12A6,6 0 0,1 12,6M18.76,7.74L17.3,9.2C17.74,10.04 18,11 18,12A6,6 0 0,1 12,18V15L8,19L12,23V20A8,8 0 0,0 20,12C20,10.43 19.54,8.97 18.76,7.74Z" />
                    </svg>
                </div>
            </div>
            
        </div>

        <form class="admin-formulario" id="business-information-form" action="{{route("business_information_store")}}" autocomplete="off">
            
            {{ csrf_field() }}

            <input autocomplete="false" name="hidden" type="text" style="display:none;">
            <input type="hidden" name="group" value="front/information">

            <div class="tabs-buttons">
                <div class="tab-button active-tabs" data-button="content">
                    Contacto
                </div>  
                <div class="tab-button" data-button="logo">
                    Logo
                </div>
                <div class="tab-button" data-button="presentacion">
                    Presentación
                </div>  
                <div class="tab-button" data-button="socials">
                    Redes
                </div>       
            </div>
            
            <div class="tab active-tabs" data-content="content" data-tab = "content">
                <div class="tab-content">

                    @component('admin.components.locale', ['tab' => 'content'])

                        @foreach ($localizations as $localization)

                            <div class="tab-language {{ $loop->first ? 'active-tabs-locale':'' }}" data-tab="content" data-localetab="{{$localization->alias}}">

                                <div class="two-columns">
                                    <div class="formulario-grupo">
                                        <div class="form-label">
                                            <label for="business" class="label-highlight">
                                                Teléfono 
                                            </label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="business[telephone.{{$localization->alias}}]" value="{{isset($business["telephone.$localization->alias"]) ? $business["telephone.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                        </div>
                                    </div>
                        
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="business" class="label-highlight">
                                                Email 
                                            </label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="business[email.{{$localization->alias}}]" value="{{isset($business["email.$localization->alias"]) ? $business["email.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="two-columns">
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="business" class="label-highlight">
                                                Provincia 
                                            </label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="business[province.{{$localization->alias}}]" value="{{isset($business["province.$localization->alias"]) ? $business["province.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                        </div>
                                    </div>
                
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="business" class="label-highlight">
                                                Población 
                                            </label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="business[poblation.{{$localization->alias}}]" value="{{isset($business["poblation.$localization->alias"]) ? $business["poblation.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                        </div>
                                    </div>
                                </div>
                
                                <div class="two-columns">
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="business" class="label-highlight">
                                                Código Postal 
                                            </label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="business[postalcode.{{$localization->alias}}]" value="{{isset($business["postalcode.$localization->alias"]) ? $business["postalcode.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                        </div>
                                    </div>
                
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="business" class="label-highlight">
                                                Dirección 
                                            </label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="business[adress.{{$localization->alias}}]" value="{{isset($business["adress.$localization->alias"]) ? $business["adress.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="two-columns">
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="business" class="label-highlight">Horario</label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="business[schedule.{{$localization->alias}}]" value="{{isset($business["schedule.$localization->alias"]) ? $business["schedule.$localization->alias"] : ''}}" class="input-highlight">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        @endforeach
                
                    @endcomponent
                </div>

            </div>

            <div class="tab" data-content="logo" data-tab = "logo">
                <div class="tab-content">

                    @component('admin.components.locale', ['tab' => 'logo'])

                        @foreach ($localizations as $localization)

                            <div class="tab-language {{ $loop->first ? 'active-tabs-locale':'' }}" data-tab="logo" data-localetab="{{$localization->alias}}">
        
                                <div class="">

                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="name" class="label-highlight">Logo</label>
                                        </div>
                                        <div class="form-input grid-column">
                                            @include('admin.components.upload_image', [
                                                'entity' => 'business_information',
                                                'type' => 'single', 
                                                'content' => 'logo', 
                                                'alias' => $localization->alias,
                                                'files' => $business->images_logo_preview
                                            ])
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="name" class="label-highlight">Logo Negativo</label>
                                        </div>
                                        <div class="form-input grid-column">
                                            @include('admin.components.upload_image', [
                                                'entity' => 'business_information',
                                                'type' => 'single', 
                                                'content' => 'logolight', 
                                                'alias' => $localization->alias,
                                                'files' => $business->images_logolight_preview
                                            ])
                                        </div>
                                    </div>

                                </div>

                            </div>

                        @endforeach
                
                    @endcomponent
                </div>
            </div>

            <div class="tab" data-content="socials" data-tab = "socials">
                <div class="tab-content">

                    @component('admin.components.locale', ['tab' => 'socials'])

                        @foreach ($localizations as $localization)

                            <div class="tab-language {{ $loop->first ? 'active-tabs-locale':'' }}" data-tab="socials" data-localetab="{{$localization->alias}}">

                                <div class="four-columns">
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="business" class="label-highlight">
                                                Instagram
                                            </label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="business[instagram.{{$localization->alias}}]" value="{{isset($business["instagram.$localization->alias"]) ? $business["instagram.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="business" class="label-highlight">
                                                Facebook 
                                            </label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="business[facebook.{{$localization->alias}}]" value="{{isset($business["facebook.$localization->alias"]) ? $business["facebook.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="business" class="label-highlight">
                                                Twitter 
                                            </label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="business[twitter.{{$localization->alias}}]" value="{{isset($business["twitter.$localization->alias"]) ? $business["twitter.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="business" class="label-highlight">
                                                Whatsapp
                                            </label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="business[whatsapp.{{$localization->alias}}]" value="{{isset($business["whatsapp.$localization->alias"]) ? $business["whatsapp.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                        </div>
                                    </div>
                                </div>

                            </div>

                        @endforeach
                
                    @endcomponent
                </div>
            </div>

            <div class="tab" data-content="presentacion" data-tab = "presentacion">
                <div class="tab-content">

                    @component('admin.components.locale', ['tab' => 'presentation'])

                        @foreach ($localizations as $localization)

                            <div class="tab-language {{ $loop->first ? 'active-tabs-locale':'' }}" data-tab="presentation" data-localetab="{{$localization->alias}}">

                                <div class="">
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="business" class="label-highlight">Eslogan</label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="business[slogan.{{$localization->alias}}]" value="{{isset($business["slogan.$localization->alias"]) ? $business["slogan.$localization->alias"] : ''}}" class="input-highlight">
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="business" class="label-highlight">
                                                Nuestra compañía
                                            </label>
                                        </div>
                                        <div class="form-input">
                                            <textarea class="ckeditor input-highlight" name="business[ourbusiness.{{$localization->alias}}]">{{isset($business["ourbusiness.$localization->alias"]) ? $business["ourbusiness.$localization->alias"] : ''}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-input">
                                            @include('admin.components.upload_image', [
                                                'entity' => 'business-information',
                                                'type' => 'single', 
                                                'content' => 'ourbusiness', 
                                                'alias' => $localization->alias,
                                                'files' => $business->images_our_business_preview
                                            ])
                                        </div>
                                    </div>
                                </div>

                                <div class="">

                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="business" class="label-highlight">
                                                Nuestra flota
                                            </label>
                                        </div>
                                        <div class="form-input">
                                            <textarea class="ckeditor input-highlight" name="business[ourfleet.{{$localization->alias}}]">{{isset($business["ourfleet.$localization->alias"]) ? $business["ourfleet.$localization->alias"] : ''}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-input">
                                            @include('admin.components.upload_image', [
                                                'entity' => 'business-information',
                                                'type' => 'single', 
                                                'content' => 'ourfleet', 
                                                'alias' => $localization->alias,
                                                'files' => $business->images_our_fleet_preview
                                            ])
                                        </div>
                                    </div>

                                </div>
                            </div>

                        @endforeach
                
                    @endcomponent
                </div>
            </div>


        </form>

    </div>

@endsection


