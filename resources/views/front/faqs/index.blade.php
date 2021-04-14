@extends('front.layout.master')

@section('content')
    
    <div class="section-title">
<<<<<<< HEAD
        <h1>Usuario</h1>
=======
        <h1>FAQS</h1>
>>>>>>> a2306b4dd3b72c58597f1b6a40a8f8c48b1c5612
    </div>

    <div class="faqs">

        @foreach ($faqs as $faq)
<<<<<<< HEAD
            <div class="faq" data-content="{{$loop->iteration}}">
=======
            <div class="faq">
>>>>>>> a2306b4dd3b72c58597f1b6a40a8f8c48b1c5612
                <div class="faq-header">
                    <div class="faq-title">
                        <h2>{{$faq->title}}<h2>
                    </div>

<<<<<<< HEAD
                    <div class="faq-button" data-button="{{$loop->iteration}}">
=======
                    <div class="faq-button">
>>>>>>> a2306b4dd3b72c58597f1b6a40a8f8c48b1c5612
                        <svg viewBox="0 0 24 24">
                            <path d="M18 11H15V14H13V11H10V9H13V6H15V9H18M20 4V16H8V4H20M20 2H8C6.9 2 6 2.9 6 4V16C6 17.11 6.9 18 8 18H20C21.11 18 22 17.11 22 16V4C22 2.9 21.11 2 20 2M4 6H2V20C2 21.11 2.9 22 4 22H18V20H4V6Z" />
                        </svg>
                    </div>
                </div>
<<<<<<< HEAD
=======
                
>>>>>>> a2306b4dd3b72c58597f1b6a40a8f8c48b1c5612

                <div class="faq-description">
                    <p>{{$faq->description}} </p>
                </div>
            </div>
        @endforeach
<<<<<<< HEAD
    </div>

=======

    </div>
>>>>>>> a2306b4dd3b72c58597f1b6a40a8f8c48b1c5612
@endsection