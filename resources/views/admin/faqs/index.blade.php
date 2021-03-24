@extends('admin.layout.master')

@section('content')

    <div class="tabla">

        <div class="tabla-titulo">
            <h2>FAQS</h2>
        </div>

        <div class="tabla-contenedor">

            <table>
                <tr class="tabla-cabecera">
                    <th>Pregunta</td>
                    <th>Respuesta</td> 
                    <th>Ref</td>
                    <th>Accion</td>
                </tr>

                <tr>
                    <td>Pregunta</td>
                    <td>Respuesta</td> 
                    <td>Ref</td>
                    <td>
                        <button> <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M20 2H4C2.89 2 2 2.89 2 4V16C2 17.11 2.9 18 4 18H8V21C8 21.55 8.45 22 9 22H9.5C9.75 22 10 21.9 10.2 21.71L13.9 18H20C21.1 18 22 17.1 22 16V4C22 2.89 21.1 2 20 2M9.08 15H7V12.91L13.17 6.72L15.24 8.8L9.08 15M16.84 7.2L15.83 8.21L13.76 6.18L14.77 5.16C14.97 4.95 15.31 4.94 15.55 5.16L16.84 6.41C17.05 6.62 17.06 6.96 16.84 7.2Z" />
                        </svg><a href=""></a>  </button>
                        <button> <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                        </svg><a href=""></a> </button>
                    </td>
                </td>

                <tr>
                    <td>Pregunta</td>
                    <td>Respuesta</td> 
                    <td>Ref</td>
                    <td>
                        <button> <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M20 2H4C2.89 2 2 2.89 2 4V16C2 17.11 2.9 18 4 18H8V21C8 21.55 8.45 22 9 22H9.5C9.75 22 10 21.9 10.2 21.71L13.9 18H20C21.1 18 22 17.1 22 16V4C22 2.89 21.1 2 20 2M9.08 15H7V12.91L13.17 6.72L15.24 8.8L9.08 15M16.84 7.2L15.83 8.21L13.76 6.18L14.77 5.16C14.97 4.95 15.31 4.94 15.55 5.16L16.84 6.41C17.05 6.62 17.06 6.96 16.84 7.2Z" />
                        </svg><a href=""></a>  </button>
                        <button> <svg> viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                        </svg><a href=""></a> </button>
                    </td>
                </td> 

                <tr>
                    <td class="" >Pregunta</td>
                    <td>Respuesta</td> 
                    <td>Ref</td>
                    <td>
                        <button> <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M20 2H4C2.89 2 2 2.89 2 4V16C2 17.11 2.9 18 4 18H8V21C8 21.55 8.45 22 9 22H9.5C9.75 22 10 21.9 10.2 21.71L13.9 18H20C21.1 18 22 17.1 22 16V4C22 2.89 21.1 2 20 2M9.08 15H7V12.91L13.17 6.72L15.24 8.8L9.08 15M16.84 7.2L15.83 8.21L13.76 6.18L14.77 5.16C14.97 4.95 15.31 4.94 15.55 5.16L16.84 6.41C17.05 6.62 17.06 6.96 16.84 7.2Z" />
                        </svg><a href=""></a>  </button>
                        <button> <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                        </svg><a href=""></a> </button>
                    </td>
                </td> 
            </table>
        </div>
    </div>    

    <div class="formulario">

        <div class="formulario-titulo">
            <h2>Introducir datos</h2>
        </div>

        <div class="formulario-contenedor">
     
            <form id="faqs-form2" class="admin-formulario">

               {{ csrf_field() }}

                <div class="formulario-grupo">
                    <div class="formulario-label">
                        <label for="">Pregunta</label>
                    </div>
                    <div class="formulario-input">
                        <input type="text" name="pregunta" id="" required >
                    </div>
                </div>

                <div class="formulario-grupo">
                    <div class="formulario-label">
                        <label for="">Respuesta</label>
                    </div>
                    <div class="formulario-input">
                        <textarea name="respuesta" name="" id="" cols="30" rows="10" style="width: 100%;" required></textarea>
                    </div>
                </div>

                <div class="formulario-enviar">
                    <button id="guardar-cambios">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                        </svg>
                    </button>
                </div>
            </form>    
        </div>
    </div>

@endsection
