@php
    $route = 'clientes';
 
@endphp

@extends('admin.layout.table_form')



@section('table')

    @isset($customers)

        <div class="tabla-titulo">
            <h2>@lang('admin/clientes.parent_section')</h2>
        </div>

        <div class="tabla-contenedor">
            <table>
                <tr class="tabla-cabecera">
                    <th>Nombre</th>
                    <th>Apellidos</th> 
                    <th>Email</th>
                </tr>

                @foreach ($customers as $customer_element)
                    <tr>
                        <td>{{$customer_element->name}}</td>
                        <td>{{$customer_element->surname}}</td>
                        <td>{{$customer_element->email}}</td>
                        <td>{{$customer_element->direction}}</td>
                        <td>{{$customer_element->cp}}</td>
                        <td>{{$customer_element->country_id}}</td>
                        <td>{{$customer_element->location}}</td>
                        <td>{{$customer_element->phone}}</td>
                        <td>
                            <button class="boton-editar" data-url="{{route("customers_show", ['customer' => $customer_element->id])}}" > 
                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71,7.04C20.37,7.38 20.04,7.71 20.03,8.04C20,8.36 20.34,8.69 20.66,9C21.14,9.5 21.61,9.95 21.59,10.44C21.57,10.93 21.06,11.44 20.55,11.94L16.42,16.08L15,14.66L19.25,10.42L18.29,9.46L16.87,10.87L13.12,7.12L16.96,3.29C17.35,2.9 18,2.9 18.37,3.29L20.71,5.63C21.1,6 21.1,6.65 20.71,7.04M3,17.25L12.56,7.68L16.31,11.43L6.75,21H3V17.25Z" />
                                </svg>
                            </button>
                            
                            <button class="boton-borrar borrar-dato" data-url="{{route("customers_destroy", ['customer' => $customer_element->id])}}"> 
                                <svg viewBox="0 0 24 24">
                                    <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach             
            </table>
        </div>
    @endif

@endsection

@section('form')
    
    <div class="formulario-contenedor">

        <div class="formulario-titulo">

            <h2> @lang('admin/clientes.parent_form') </h2>

            <div id="create-button" class= "empty-form-button" data-url= "{{route("customers_create")}}">
                <svg style="width:30px;height:30px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12,6V9L16,5L12,1V4A8,8 0 0,0 4,12C4,13.57 4.46,15.03 5.24,16.26L6.7,14.8C6.25,13.97 6,13 6,12A6,6 0 0,1 12,6M18.76,7.74L17.3,9.2C17.74,10.04 18,11 18,12A6,6 0 0,1 12,18V15L8,19L12,23V20A8,8 0 0,0 20,12C20,10.43 19.54,8.97 18.76,7.74Z" />
                </svg>
            </div>

        </div>

        

        <form id="faqs-form" class="admin-formulario" action="{{route("customers_store")}}" autocomplete="off">

            {{ csrf_field() }}

            <input autocomplete="false" name="hidden" type="text" style="display:none;">
            <input type="hidden" name="id" value="{{isset($customer->id) ? $customer->id : ''}}">

                <div class="tabs-buttons">
                    <div class="tab-button" data-button="2">
                        <p> Imagenes <p>
                    </div>
                    <div class="tab-button" data-button="1">
                        <p>Datos personales<p>
                    </div>

                    

                </div>

                <div class="tabs">
                    
                    <div class="tab" data-content="1">
                        <div class="tab-content" >

                                <div class="formulario-grupo">
                                    <div class="formulario-label">
                                        <label for="name" class="label-highlight">Nombre
                                        </label>
                                    </div>
                                    <div class="formulario-input">
                                        <input type="text" name="name" value="{{isset($customer->name) ? $customer->name : ''}}" class="input-highlight" required >
                                    </div>
                                </div>

                                <div class="formulario-grupo">
                                    <div class="formulario-label">
                                        <label for="surname" class="label-highlight">Apellidos
                                        </label>
                                    </div>
                                    <div class="formulario-input">
                                        <input type="text" name="surname" value="{{isset($customer->surname) ? $customer->surname : ''}}" class="input-highlight" required >
                                    </div>
                                </div>

                                <div class="formulario-grupo">
                                    <div class="formulario-label">
                                        <label for="email" class="label-highlight">Email
                                        </label>
                                    </div>
                                    <div class="formulario-input">
                                        <input type="text" name="email" value="{{isset($customer->email) ? $customer->email : ''}}" class="input-highlight" required >
                                    </div>
                                </div>

                                <div class="formulario-grupo">
                                    <div class="formulario-label">
                                        <label for="cp" class="label-highlight">Direccion
                                        </label>
                                    </div>
                                    <div class="formulario-input">
                                        <input type="text" name="direction" value="{{isset($customer->direction) ? $customer->direction : ''}}" class="input-highlight" required >
                                    </div>
                                </div>

                                <div class="formulario-grupo">
                                    <div class="formulario-label">
                                        <label for="cp" class="label-highlight">CP
                                        </label>
                                    </div>
                                    <div class="formulario-input">
                                        <input type="text" name="cp" value="{{isset($customer->cp) ? $customer->cp : ''}}" class="input-highlight" required >
                                    </div>
                                </div>

                                <div class="formulario-grupo">
                                    <div class="formulario-label">
                                        <label for="location" class="label-highlight">Poblacion
                                        </label>
                                    </div>
                                    <div class="formulario-input">
                                        <input type="text" name="location" value="{{isset($customer->location) ? $customer->location : ''}}" class="input-highlight" required >
                                    </div>
                                </div>

                                <div class="formulario-grupo">
                                    <div class="formulario-label">
                                        <label for="phone" class="label-highlight">Teléfono
                                        </label>
                                    </div>
                                    <div class="formulario-input">
                                        <input type="text" name="phone" value="{{isset($customer->phone) ? $customer->phone : ''}}" class="input-highlight" required >
                                    </div>
                                </div>

                                <div class="formulario-grupo">
                                    <div class="formulario-label">
                                        <label for="phone" class="label-highlight">Pais
                                        </label>
                                    </div>
                                    <select name="country_id" data-placeholder="Seleccione una categoría" class="input-highlight">
                                        <option></option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}" {{$customer->country_id == $country->id ? 'selected':''}} class="country_id">{{ $country->name }}</option>
                                        @endforeach
                                    </select>  
                                </div>

                                <div class="formulario-enviar">
                                    <a href="" class="boton-guardar">
                                        <button id= "store-button">
                                            <svg viewBox="0 0 24 24">
                                                <path fill="" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                                            </svg>
                                        </button>
                                    </a>
                                </div>

                        </div>
                    </div>

                    <div class="tab" data-content="2">
                        <div class="tab-content">
                            <p> Pics <p>
                        </div>
                    </div>
                    
                </div>
        </form>

    </div>
@endsection

