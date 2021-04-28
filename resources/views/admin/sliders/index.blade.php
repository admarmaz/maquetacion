@php
    $route = 'sliders';
    $filters = ['search' => true, 'created_at' => true ]; 
    $order = ['fecha de creación' => 't_sliders.created_at', 'nombre' => 't_sliders.name'];
@endphp

@extends('admin.layout.table_form')


@section('table')

    <div class="tabla-titulo">
        <h2>@lang('admin/sliders.parent_section')</h2>
    </div>

    <div class="tabla-contenedor">

        @isset($sliders)

                @foreach ($sliders as $slider_element)
                <div class="swipe-element">
                    <div class="swipe-front promote-layer">
                        <div class="table-content">
                            <p><span> Nombre:</span> {{$slider_element->name}} </p>
                            <p><span> Alias:</span> {{$slider_element->entity}} </p>
                        </div>
                    </div>

                    <div class="swipe-back table-icons" >
                        <div class="boton-editar right-swipe" data-url="{{route("sliders_show", ['slider' => $slider_element->id])}}" > 
                            <svg viewBox="0 0 24 24">
                                <path fill='' d="M20 2H4C2.89 2 2 2.89 2 4V16C2 17.11 2.9 18 4 18H8V21C8 21.55 8.45 22 9 22H9.5C9.75 22 10 21.9 10.2 21.71L13.9 18H20C21.1 18 22 17.1 22 16V4C22 2.89 21.1 2 20 2M9.08 15H7V12.91L13.17 6.72L15.24 8.8L9.08 15M16.84 7.2L15.83 8.21L13.76 6.18L14.77 5.16C14.97 4.95 15.31 4.94 15.55 5.16L16.84 6.41C17.05 6.62 17.06 6.96 16.84 7.2Z" />
                            </svg>
                        </div>
                        
                        <div class="boton-borrar borrar-dato left-swipe" data-url="{{route("sliders_destroy", ['slider' => $slider_element->id])}}"> 
                            <svg viewBox="0 0 24 24">
                                <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                            </svg>
                        </div>
                    </div>
                @endforeach             

            {{ $sliders->links() }}

        @endif
    </div>

@endsection

@section('form')
    
    <div class="formulario-contenedor">

        <div class="formulario-titulo">
            <div class="formulario-tit">
                <h2>Introducir slider</h2>
            </div>
    
            <div id="create-button" data-url= "{{route("sliders_create")}}">
                <svg style="width:30px;height:30px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12,6V9L16,5L12,1V4A8,8 0 0,0 4,12C4,13.57 4.46,15.03 5.24,16.26L6.7,14.8C6.25,13.97 6,13 6,12A6,6 0 0,1 12,6M18.76,7.74L17.3,9.2C17.74,10.04 18,11 18,12A6,6 0 0,1 12,18V15L8,19L12,23V20A8,8 0 0,0 20,12C20,10.43 19.54,8.97 18.76,7.74Z" />
                </svg>
            </div>
        </div>
        
        <div >
     
            <form id="faqs-form" class="admin-formulario" action="{{route("sliders_store")}}" autocomplete="off">

               {{ csrf_field() }}

               <input autocomplete="false" name="hidden" type="text" style="display:none;">
               <input type="hidden" name="id" value="{{isset($sliders->id) ? $sliders->id : ''}}">

                <div class="formulario-grupo">
                    <div class="formulario-label">
                        <label for="name" class="label-highlight">Nombre
                        </label>
                    </div>
                    <div class="formulario-input">
                        <input type="text" name="name" value="{{isset($slider->name) ? $slider->name : ''}}" class="input-highlight" required >
                    </div>
                </div>

                <div class="formulario-grupo">
                    <div class="formulario-label">
                        <label for="entity" class="label-highlight">Alias</label>
                    </div>
                    <div class="formulario-input">
                        <textarea name='entity' value="{{isset($slider->entity) ? $slider->entity : ''}}" class="input-highlight" required></textarea>
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
@endsection