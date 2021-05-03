@extends('admin.layout.table_form')


@section('table')

    @isset($users)

        <div class="tabla-titulo">
            <h2>@lang('admin/faqs.parent_section')</h2>
        </div>

        <div class="tabla-contenedor">
            <table>
                <tr class="tabla-cabecera">
                    <th>Id</th>
                    <th>Nombre</th> 
                    <th>Email</th>
                    <th></th>
                </tr>

                @foreach ($users as $user_element)
                    <tr>
                        <td>{{$user_element->id}}</td>
                        <td>{{$user_element->name}}</td> 
                        <td>{{$user_element->email}}</td>
        
                        <td>
                            <button class="boton-editar" data-url="{{route("users_show", ['user' => $user_element->id])}}" > 
                                <svg viewBox="0 0 24 24">
                                    <path fill='' d="M20 2H4C2.89 2 2 2.89 2 4V16C2 17.11 2.9 18 4 18H8V21C8 21.55 8.45 22 9 22H9.5C9.75 22 10 21.9 10.2 21.71L13.9 18H20C21.1 18 22 17.1 22 16V4C22 2.89 21.1 2 20 2M9.08 15H7V12.91L13.17 6.72L15.24 8.8L9.08 15M16.84 7.2L15.83 8.21L13.76 6.18L14.77 5.16C14.97 4.95 15.31 4.94 15.55 5.16L16.84 6.41C17.05 6.62 17.06 6.96 16.84 7.2Z" />
                                </svg>
                            </button>
                            
                            <button class="boton-borrar borrar-dato" data-url="{{route("users_destroy", ['user' => $user_element->id])}}"> 
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

            <div class="">
                <h2>Introducir usuario</h2>
            </div>
    
            <div id="create-button" data-url= "{{route("users_create")}}">
                <svg style="width:30px;height:30px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12,6V9L16,5L12,1V4A8,8 0 0,0 4,12C4,13.57 4.46,15.03 5.24,16.26L6.7,14.8C6.25,13.97 6,13 6,12A6,6 0 0,1 12,6M18.76,7.74L17.3,9.2C17.74,10.04 18,11 18,12A6,6 0 0,1 12,18V15L8,19L12,23V20A8,8 0 0,0 20,12C20,10.43 19.54,8.97 18.76,7.74Z" />
                </svg>
            </div>
        </div>

        <div >
     
            <form id="faqs-form" class="admin-formulario" action="{{route("users_store")}}" autocomplete="off">

               {{ csrf_field() }}

               <input autocomplete="false" name="hidden" type="text" style="display:none;">
               <input type="hidden" name="id" value="{{isset($users->id) ? $users->id : ''}}">


                <div class="formulario-grupo">
                    <div class="formulario-label">
                        <label for="name" class="label-highlight">Nombre
                        </label>
                    </div>
                    <div class="formulario-input">
                        <input type="text" name="name" value="{{isset($user->name) ? $user->name : ''}}" class="input-highlight" required >
                    </div>
                </div>

                <div class="formulario-grupo">
                    <div class="formulario-label">
                        <label for="email" class="label-highlight">Email</label>
                    </div>
                    <div class="formulario-input">
                        <textarea name='email' type="text" value="{{isset($user->email) ? $user->email : ''}}" class="input-highlight" required></textarea>
                    </div>
                </div>

                <div class="formulario-grupo">
                    <div class="formulario-label">
                        <label for="password" class="label-highlight">Contraseña
                        </label>
                    </div>
                    <div class="formulario-input">
                        <input type="password" name="password" value="{{isset($user->password) ? $user->password : ''}}" class="input-highlight" required >
                    </div>
                </div>

                <div class="formulario-grupo">
                    <div class="formulario-label">
                        <label for="password_confirmation" class="label-highlight">Confirmar contraseña
                        </label>
                    </div>
                    <div class="formulario-input">
                        <input type="password" name="password_confirmation" value="" class="input-highlight" required >
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