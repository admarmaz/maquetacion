@php
    $route = 'tags';
@endphp

@extends('admin.layout.table_form')

@section('table')
    
    <div id="table-container" class="table-elements">
        @foreach ($locale_tags as $locale_tag_element)
            <div class="swipe-element">
                <div class="swipe-front promote-layer">
                    <div class="table-content">
                        <p><span> Grupo:</span> {{$locale_tag_element->group}}</p>
                        <p><span> Clave:</span> {{$locale_tag_element->key}}</p>
                    </div>
                </div>

                <div class="swipe-back table-icons" >
                    <div class="boton-editar right-swipe" data-url="{{route('edit_tag')}}"> 
                        <svg viewBox="0 0 24 24">
                            <path fill='' d="M20 2H4C2.89 2 2 2.89 2 4V16C2 17.11 2.9 18 4 18H8V21C8 21.55 8.45 22 9 22H9.5C9.75 22 10 21.9 10.2 21.71L13.9 18H20C21.1 18 22 17.1 22 16V4C22 2.89 21.1 2 20 2M9.08 15H7V12.91L13.17 6.72L15.24 8.8L9.08 15M16.84 7.2L15.83 8.21L13.76 6.18L14.77 5.16C14.97 4.95 15.31 4.94 15.55 5.16L16.84 6.41C17.05 6.62 17.06 6.96 16.84 7.2Z" />
                        </svg>
                    </div> 
                </div>
                
            </div>          
        @endforeach 
    </div>
       

@endsection

@section('form')

<div class="option-buttons">
    <div class="formulario-enviar">
        <a href="" class="boton-guardar">
            <div id="guardar-cambios">
                <svg viewBox="0 0 24 24">
                    <path fill="" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                </svg>
            </div>
        </a>
    </div>
    
    <div class="empty-form-button" id="create-button" data-url= "{{route("translations_create")}}">
        
    </div>

    <div class="locale-tag-container">

        <div class="formulario-grupo">
            <div class="formulario-label">
                <label for="title" class="label-highlight">Clave
                </label>
            </div>
            <div class="formulario-input">
                <input type="text" name="" required >
            </div>
        </div>
    
        <div class="formulario-grupo">
            <div class="formulario-label">
                <label for="">Traducción</label>
            </div>
            <div class="formulario-input">
                <textarea class="ckeditor input-highlight" name=""></textarea>
            </div>
        </div>



    </div>
    

</div>

@endsection



