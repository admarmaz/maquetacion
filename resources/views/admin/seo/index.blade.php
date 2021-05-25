@php
    $route = 'seo';
@endphp

@extends('admin.layout.table_form')

@section('table')

    @isset($seos)

        <div id="table-container">
            @foreach($seos as $seo_element)
                <div class="swipe-element">
                    <div class="swipe-front promote-layer">
                        <div class="table-field"><p><span>Clave:</span> {{$seo_element->key}}</p></div>
                    </div>

                    <div class="table-icons-container swipe-back">
                        <div class="table-icons boton-editar right-swipe" data-url="{{route('seo_edit', ['key' => $seo_element->key])}}">
                            <svg viewBox="0 0 24 24">
                                <path fill='' d="M20 2H4C2.89 2 2 2.89 2 4V16C2 17.11 2.9 18 4 18H8V21C8 21.55 8.45 22 9 22H9.5C9.75 22 10 21.9 10.2 21.71L13.9 18H20C21.1 18 22 17.1 22 16V4C22 2.89 21.1 2 20 2M9.08 15H7V12.91L13.17 6.72L15.24 8.8L9.08 15M16.84 7.2L15.83 8.21L13.76 6.18L14.77 5.16C14.97 4.95 15.31 4.94 15.55 5.16L16.84 6.41C17.05 6.62 17.06 6.96 16.84 7.2Z" />
                            </svg>
                        </div> 
                    </div>
                </div>
            @endforeach
        </div>

        @include('admin.components.table_pagination', ['items' => $seos])
        
    @endisset

@endsection

@section('form')

    @isset($seo)

        <div class="form-container">

            <form class="admin-formulario" id="tags-form" action="{{route("seo_store")}}" autocomplete="off">
            
                {{ csrf_field() }}
        
                <input autocomplete="false" name="hidden" type="text" style="display:none;">

                <div class="tabs-buttons">
                    <div class="tab-button active-tabs" data-button="content">
                        <p> Contenido <p>
                    </div>

                    <div class="formulario-enviar">
                        <a href="" class="boton-guardar">
                            <div id="guardar-cambios">
                                <svg viewBox="0 0 24 24">
                                    <path fill="" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                                </svg>
                            </div>
                        </a>
                    </div>
                    
                    
                </div>
                
                <div class="tab active-tabs" data-tab="content">

                    @component('admin.components.locale', ['tab' => 'content'])

                        @foreach ($localizations as $localization)

                            <input type="hidden" name="seo[key.{{$localization->alias}}]" value="{{$seo["key.$localization->alias"]}}">
                            <input type="hidden" name="seo[group.{{$localization->alias}}]" value="{{$seo["group.$localization->alias"]}}">
                            <input type="hidden" name="seo[old_url.{{$localization->alias}}]" value="{{isset($seo["url.$localization->alias"]) ? $seo["url.$localization->alias"] : ''}}" class="input-highlight block-parameters"  data-regex="/\{.*?\}/g" > 

                            <div class="tab-language {{ $loop->first ? 'active-tabs-locale':'' }}" data-tab="content" data-localetab="{{$localization->alias}}">

                                <div class="one-column">
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="seo[url.{{$localization->alias}}]" class="label-highlight">Url</label>
                                        </div>
                                        <div class="form-input">
                                            <input class="slug" type="text" name="seo[url.{{$localization->alias}}]" value="{{isset($seo["url.$localization->alias"]) ? $seo["url.$localization->alias"] : ''}}" class="input-highlight block-parameters">
                                        </div>
                                    </div>
                                </div>

                                <div class="one-column">
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="seo[title.{{$localization->alias}}]" class="label-highlight">Título</label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="seo[title.{{$localization->alias}}]" value="{{isset($seo["title.$localization->alias"]) ? $seo["title.$localization->alias"] : ''}}" class="input-highlight">
                                        </div>
                                    </div>
                                </div>

                                <div class="one-column">
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="seo[description.{{$localization->alias}}]" class="label-highlight">Descripción</label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="seo[description.{{$localization->alias}}]" value="{{isset($seo["description.$localization->alias"]) ? $seo["description.$localization->alias"] : ''}}" class="input-highlight">
                                        </div>
                                    </div>
                                </div>

                                <div class="one-column">
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="name" class="label-highlight">Keywords</label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="seo[keywords.{{$localization->alias}}]" value="{{isset($seo["keywords.$localization->alias"]) ? $seo["keywords.$localization->alias"] : ''}}" class="input-highlight">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        @endforeach
                
                    @endcomponent
                    
                </div>

            </form>

        </div>
    
    @else

        <div class="formulario-contenedor">
            <div class="tabs-buttons">
                <div class="tab-button active-tabs" data-button="content">
                    <p> Contenido <p>
                </div>
            </div>

            <div class="tab active-tabs" data-tab="content">
                <div class="one-column">
                    <div class="form-group">
                        <div class="form-label">
                            <label>
                                Pulse <span id="import-seo" data-url="{{route('seo_import')}}">aquí</span> para importar todos los enlaces.
                            </label>
                        </div>
                    </div>
                </div>

                <div class="one-column">
                    <div class="form-group">
                        <div class="form-label">
                            <label>
                                Pulse <span id="ping-google" data-url="{{route('ping_google')}}">aquí</span> para llamar al robot de Google.
                            </label>
                        </div>
                    </div>
                </div>

                <div class="one-column">
                    <div class="form-group">
                        <div class="form-label">
                            <label>
                                Pulse <span id="create-sitemap" data-url="{{route('create_sitemap')}}">aquí</span> para generar el sitemap.
                            </label>
                            <div class="form-input">
                                <textarea id="sitemap" class="simple"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

@endsection