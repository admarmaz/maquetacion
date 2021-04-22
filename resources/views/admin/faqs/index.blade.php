@php
    $route = 'faqs';
    $filters = ['category' => $faqs_categories, 'search' => true, 'created_at' => true]; 
    $order = [ 'Nombre' => 't.faqs.name', 'Fecha' => 't.faqs.created_at', 'Categoria' , 't.faqs_categories.name']
@endphp

@extends('admin.layout.table_form')

@section('table')

    <div class="tabla-titulo">
        <h2>@lang('admin/faqs.parent_section')</h2>
    </div>

    <div class="order-by-title" data-url="{{route("faqs_order")}}">
        <p>Ordenar por </p>
    </div>

    <div class="table-header">
        <p> Título </p>
        <p> Descripcion </p>
        <p> Categoria</p>
    </div>

    <div id="table-container">
        @foreach ($faqs as $faq_element)
            <div class="swipe-element">
                <div class="swipe-front promote-layer">
                    <div class="table-content">
                        <p> {{$faq_element->title}} </p>
                        <p> {{$faq_element->description}} </p>
                        <p> {{$faq_element->category->name}} </p>
                    </div>

                    <div class="swipe-back">
                        <div class="boton-editar right-swipe" data-url="{{route("faqs_show", ['faq' => $faq_element->id])}}" > 
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
            </div>          
        @endforeach 
    </div>

@endsection

@section('form')

    @isset($faq)
    
        <div class="formulario-contenedor">

            <div class="formulario-titulo">
                <h2>Introducir FAQ</h2>
            </div>

            <div >
        
                <form id="faqs-form" class="admin-formulario" action="{{route("faqs_store")}}" autocomplete="off">

                {{ csrf_field() }}

                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                <input type="hidden" name="id" value="{{isset($faq->id) ? $faq->id : ''}}">

                <div class="formulario-grupo">
                        <div class="formulario-label">
                            <label for="category_id" class="label-highlight">
                                Categoría 
                            </label>
                        </div>
                        <div class="form-input">
                            <select name="category_id" data-placeholder="Seleccione una categoría" class="input-highlight">
                                <option></option>
                                @foreach($faqs_categories as $faq_category)
                                    <option value="{{$faq_category->id}}" {{$faq->category_id == $faq_category->id ? 'selected':''}} class="category_id">{{ $faq_category->name }}</option>
                                @endforeach
                            </select>                   
                        </div>
                    </div>

                    <div class="formulario-grupo">
                        <div class="formulario-label">
                            <label for="title" class="label-highlight">Pregunta
                            </label>
                        </div>
                        <div class="formulario-input">
                            <input type="text" name="title" value="{{isset($faq->title) ? $faq->title : ''}}" class="input-highlight" required >
                        </div>
                    </div>

                    <div class="formulario-grupo">
                        <div class="formulario-label">
                            <label for="">Respuesta</label>
                        </div>
                        <div class="formulario-input">
                            <textarea name="description" value="{{isset($faq->description) ? $faq->description : ''}}" class="ckeditor input-highlight" required>{{isset($faq->description) ? $faq->description : ''}}</textarea>
                        </div>
                    </div>

                    <div class="formulario-enviar">
                        <a href="" class="boton-guardar">
                            <button id="guardar-cambios">
                                <svg viewBox="0 0 24 24">
                                    <path fill="" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                                </svg>
                            </button>
                        </a>
                    </div>
                </form>    
            </div>
        </div>
    @endif 

@endsection
