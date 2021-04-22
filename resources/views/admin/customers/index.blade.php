@php
    $route = 'customers';
@endphp

@extends('admin.layout.table_form')

@section('table')

    <div class="tabla-titulo">
        <h2>@lang('admin/customers.parent_section')</h2>
    </div>

    <div class="tabla-contenedor">
        <table>
            <tr class="tabla-cabecera">
                <th>Nombre</th>
                <th>Apellidos</th> 
                <th>Email</th>
                <th>Dirección</th>
                <th>CP</th>
                <th>Pais</th>
                <th>Localidad</th>
                <th>Teléfono</th>
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
                            <svg viewBox="0 0 24 24">
                                <path fill='' d="M20 2H4C2.89 2 2 2.89 2 4V16C2 17.11 2.9 18 4 18H8V21C8 21.55 8.45 22 9 22H9.5C9.75 22 10 21.9 10.2 21.71L13.9 18H20C21.1 18 22 17.1 22 16V4C22 2.89 21.1 2 20 2M9.08 15H7V12.91L13.17 6.72L15.24 8.8L9.08 15M16.84 7.2L15.83 8.21L13.76 6.18L14.77 5.16C14.97 4.95 15.31 4.94 15.55 5.16L16.84 6.41C17.05 6.62 17.06 6.96 16.84 7.2Z" />
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

@endsection

@section('form')
    
    <div class="formulario-contenedor">

        <div class="formulario-titulo">
            <h2> @lang('admin/customers.parent_form') </h2>
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
                    <div class="tab" data-content="2">
                        <div class="tab-content">
                            <p> Pics <p>
                        </div>
                    </div>
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
                                        <button id="guardar-cambios">
                                            <svg viewBox="0 0 24 24">
                                                <path fill="" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                                            </svg>
                                        </button>
                                    </a>
                                </div>

                        </div>
                    </div>
                </div>
        </form>

    </div>
@endsection