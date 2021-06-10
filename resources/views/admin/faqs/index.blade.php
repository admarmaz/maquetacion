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
                                    <path fill='' d="M20 2H4C2.89 2 2 2.89 2 4V16C2 17.11 2.9 18 4 18H8V21C8 21.55 8.45 22 9 22H9.5C9.75 22 10 21.9 10.2 21.71L13.9 18H20C21.1 18 22 17.1 22 16V4C22 2.89 21.1 2 20 2M9.08 15H7V12.91L13.17 6.72L15.24 8.8L9.08 15M16.84 7.2L15.83 8.21L13.76 6.18L14.77 5.16C14.97 4.95 15.31 4.94 15.55 5.16L16.84 6.41C17.05 6.62 17.06 6.96 16.84 7.2Z" />
                                </svg>
                            </div>
                            
                            <div class="boton-borrar borrar-dato left-swipe" data-url="{{route("faqs_destroy", ['faq' => $faq_element->id])}}"> 
                                <svg viewBox="0 0 24 24">
                                    <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
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
                                    <path fill="" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                                </svg>
                            </div>
                        </a>
                    </div>
                    
                    <div class="empty-form-button" id="create-button" data-url= "{{route("faqs_create")}}">
                        <svg style="width:30px;height:30px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,6V9L16,5L12,1V4A8,8 0 0,0 4,12C4,13.57 4.46,15.03 5.24,16.26L6.7,14.8C6.25,13.97 6,13 6,12A6,6 0 0,1 12,6M18.76,7.74L17.3,9.2C17.74,10.04 18,11 18,12A6,6 0 0,1 12,18V15L8,19L12,23V20A8,8 0 0,0 20,12C20,10.43 19.54,8.97 18.76,7.74Z" />
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
