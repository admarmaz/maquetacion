@extends('front.layout.master')

@section('content')
    
    <div class="section-title">
        <h1>FAQ's</h1>
    </div>

    <div class="faqs">

        @foreach ($faqs as $faq)
            <div class="faq" data-content="{{$loop->iteration}}">
                <div class="faq-header">
                    <div class="faq-title">
                        <h3>{{isset($faq->locale['title']) ? $faq->locale['title'] : ""}}</h3>
                    </div>

                    <div class="faq-button" data-button="{{$loop->iteration}}">
                        <svg viewBox="0 0 24 24">
                            <path d="M18 11H15V14H13V11H10V9H13V6H15V9H18M20 4V16H8V4H20M20 2H8C6.9 2 6 2.9 6 4V16C6 17.11 6.9 18 8 18H20C21.11 18 22 17.11 22 16V4C22 2.9 21.11 2 20 2M4 6H2V20C2 21.11 2.9 22 4 22H18V20H4V6Z" />
                        </svg>
                    </div>
                </div>

                <div class="faq-description">
                    <p>{!!isset($faq->locale['description']) ? $faq->locale['description'] : "" !!}</p>
                
                    @isset($faq->image_featured_desktop->path)
                        <div class="faq-description-image">
                            <img src="{{Storage::url($faq->image_featured_desktop->path)}}" alt="{{$faq->image_featured_desktop->alt}}" title="{{$faq->image_featured_desktop->title}}" />
                        </div>
                    @endif
                
                </div>
                
            </div>
            
        @endforeach
    </div>

@endsection