@php
    $route = 'faqs';
    $filters = ['category' => $faqs_categories, 'search' => true, 'created_at' => true ]; 
    $order = ['fecha de creación' => 'created_at', 'título' => 'title', 'categoría' => 'category_id'];
@endphp

@extends('admin.layout.table_form')

@section('table')

    <div class="tabla-contenedor">
        @isset($faqs)

            <div class="tabla-titulo">
                <h2>@lang('admin/faqs.faq-saved')</h2>
            </div>

            <div id="table-container" class="table-elements">
                @foreach ($faqs as $faq_element)
                    <div class="swipe-element">
                        <div class="swipe-front promote-layer">
                            <div class="table-content">
                                <p><span> Nombre:</span> {{$faq_element->name}} </p>
                                <p>{{$faq_element->description}}</p>
                            </div>
                        </div>

                        <div class="swipe-back table-icons" >
                            <div class="boton-editar right-swipe" data-url="{{route("faqs_edit", ['faq' => $faq_element->id])}}" > 
                                <svg viewBox="0 0 24 24">
                                    <path d="M20.71,7.04C20.37,7.38 20.04,7.71 20.03,8.04C20,8.36 20.34,8.69 20.66,9C21.14,9.5 21.61,9.95 21.59,10.44C21.57,10.93 21.06,11.44 20.55,11.94L16.42,16.08L15,14.66L19.25,10.42L18.29,9.46L16.87,10.87L13.12,7.12L16.96,3.29C17.35,2.9 18,2.9 18.37,3.29L20.71,5.63C21.1,6 21.1,6.65 20.71,7.04M3,17.25L12.56,7.68L16.31,11.43L6.75,21H3V17.25Z" />
                                </svg>
                            </div>
                            
                            <div class="boton-borrar borrar-dato left-swipe" data-url="{{route("faqs_destroy", ['faq' => $faq_element->id])}}"> 
                                <svg viewBox="0 0 24 24">
                                    <path d="M20.37,8.91L19.37,10.64L7.24,3.64L8.24,1.91L11.28,3.66L12.64,3.29L16.97,5.79L17.34,7.16L20.37,8.91M6,19V7H11.07L18,11V19A2,2 0 0,1 16,21H8A2,2 0 0,1 6,19M8,19H16V12.2L10.46,9H8V19Z" />
                                </svg>
                            </div>
                        </div>
                    </div>          
                @endforeach 
            </div>

            @if($agent->isDesktop())
                @include('admin.components.table_pagination', ['items' => $faqs])
            @endif
            
        @endif 

    </div>

@endsection

@section('form')

    @isset($faq)
    
        <div class="formulario-contenedor">
            <div class="formulario-titulo">

                
                <div class="formulario-tit">
                    <h2>Introducir FAQ</h2>
                </div>
                <div class="option-buttons">
                    <div class="formulario-enviar">
                        <a href="" class="boton-guardar save-show">
                            <div id="store-button">
                                <svg viewBox="0 0 24 24">
                                    <path d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V7L17 3M19 19H5V5H16.17L19 7.83V19M12 12C10.34 12 9 13.34 9 15S10.34 18 12 18 15 16.66 15 15 13.66 12 12 12M6 6H15V10H6V6Z" />
                                </svg>
                            </div>
                        </a>
                    </div>
                    
                    <div class="empty-form-button" id="create-button" data-url= "{{route("faqs_create")}}">
                        <svg viewBox="0 0 24 24">
                            <path d="M16.24,3.56L21.19,8.5C21.97,9.29 21.97,10.55 21.19,11.34L12,20.53C10.44,22.09 7.91,22.09 6.34,20.53L2.81,17C2.03,16.21 2.03,14.95 2.81,14.16L13.41,3.56C14.2,2.78 15.46,2.78 16.24,3.56M4.22,15.58L7.76,19.11C8.54,19.9 9.8,19.9 10.59,19.11L14.12,15.58L9.17,10.63L4.22,15.58Z" />
                        </svg>
                    </div>

                </div>
                
            </div>
        
            <form id="faqs-form" class="admin-formulario" action="{{route("faqs_store")}}" autocomplete="off">

                {{ csrf_field() }}

                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                <input type="hidden" name="id" value="{{isset($faq->id) ? $faq->id : ''}}">

                <div class="tabs-buttons">
                    <div class="tab-button active-tabs" data-button="content">
                        <p> Contenido <p>
                    </div>
                    <div class="tab-button" data-button="images">
                        <p> Imágenes <p>
                    </div>
                    <div class="tab-button" data-button="seo">
                        <p> Seo <p>
                    </div>
                </div>

                <div class="tab active-tabs" data-content="content">

                    <div class="tab-content">
                        <div class="two-columns">
                            <div class="formulario-grupo">
                                <div class="formulario-label">
                                    <label for="category_id">
                                        Categoría 
                                    </label>
                                </div>
                                <div class="form-input">
                                    <select name="category_id" data-placeholder="Seleccione una categoría">
                                        <option></option>
                                        @foreach($faqs_categories as $faq_category)
                                            <option value="{{$faq_category->id}}" {{$faq->category_id == $faq_category->id ? 'selected':''}} class="category_id">{{ $faq_category->name }}</option>
                                        @endforeach
                                    </select>                   
                                </div>
                            </div>
    
                            <div class="formulario-grupo">
                                <div class="formulario-label">
                                    <label for="name" class="label-highlight">Nombre
                                    </label>
                                </div>
                                <div class="formulario-input">
                                    <input type="text" name="name" value="{{isset($faq->name) ? $faq->name : ''}}" class="input-highlight" required >
                                </div>
                            </div>
                        </div>
                    </div>

                    @component('admin/components.locale', ['tab' => 'content'])
                        @foreach ($localizations as $localization)

                            <div class="tab-language {{ $loop->first ? 'active-tabs-locale' :'' }}" data-tab = "content" data-localetab = "{{$localization->alias}}">
                                <div class="formulario-grupo">
                                    <div class="formulario-label">
                                        <label for="title" class="label-highlight">Título
                                        </label>
                                    </div>
                                    <div class="formulario-input">
                                        <input type="text" name="seo[title.{{$localization->alias}}]" value="{{isset($seo["title.$localization->alias"]) ? $seo["title.$localization->alias"] : ''}}" class="input-highlight" required >
                                    </div>
                                </div>

                                <div class="formulario-grupo">
                                    <div class="formulario-label">
                                        <label for="">Descripción</label>
                                    </div>
                                    <div class="formulario-input">
                                        <textarea class="ckeditor input-highlight" name="locale[description.{{$localization->alias}}]"> {{isset($locale["description.$localization->alias"]) ? $locale["description.$localization->alias"] : ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endcomponent

                </div>

                <div class="tab" data-content="images" data-tab = "images">
                    <div class="tab-content">

                        @component('admin/components.locale', ['tab' => 'images'])
                            
                            @foreach ($localizations as $localization)
                                
                                <div class="tab-language {{ $loop->first ? 'active-tabs-locale':'' }}" data-tab="images"  data-localetab="{{$localization->alias}}">
                                    <div class="form-label">
                                        <label for="name" class="label-highlight">Foto destacada</label>
                                    </div>
                                    <div class="form-input grid-column">
                                        @include('admin.components.upload_image', [
                                            'type' => 'single', 
                                            'entity' => 'faqs',
                                            'content' => 'featured', 
                                            'alias' => $localization->alias,
                                            'files' => $faq->images_featured_preview
                                        ])
                                    </div>
                                 

                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="name" class="label-highlight">Galería</label>
                                        </div>
                                        <div class="form-input grid-column">
                                            @include('admin.components.upload_image', [
                                                'type' => 'collection',
                                                'entity' => 'faqs', 
                                                'content' => 'grid', 
                                                'alias' => $localization->alias,
                                                'files' => $faq->images_grid_preview
                                            ])
                                        </div>
                                    </div>
                                </div>
                                
                            @endforeach
                    
                        @endcomponent

                    </div>
                </div>

                <div class="tab" data-content="seo" data-tab = "seo">

                    <div class="tab-content">

                        @component('admin.components.locale', ['tab' => 'seo'])

                            @foreach ($localizations as $localization)

                                <div class="tab-language {{ $loop->first ? 'active-tabs-locale':'' }}" data-tab="seo" data-localetab="{{$localization->alias}}">

                                    <div class="one-column">
                                        <div class="form-group">
                                            <div class="form-label">
                                                <label for="keywords" class="label-highlight">
                                                    Keywords 
                                                </label>
                                            </div>
                                            <div class="form-input">
                                                <input type="text" name="seo[keywords.{{$localization->alias}}]" value='{{isset($seo["keywords.$localization->alias"]) ? $seo["keywords.$localization->alias"] : ''}}' class="input-highlight">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="one-column">
                                        <div class="form-group">
                                            <div class="form-label">
                                                <label for="description" class="label-highlight">
                                                    Descripción. 
                                                </label>
                                            </div>

                                            <div class="form-input">
                                                <textarea maxlength='160' class="input-highlight input-counter" name="seo[description.{{$localization->alias}}]">{{isset($seo["description.$localization->alias"]) ? $seo["description.$localization->alias"] : '' }}</textarea>
                                                <p>Has escrito <span>0</span> caracteres de los 160 recomendados.</p>
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

    @endif 

@endsection
