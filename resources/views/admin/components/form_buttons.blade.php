
@extends('admin.faqs.index')

@section('forms-buttons')

    <div class="forms-buttons">
        
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

@endsection