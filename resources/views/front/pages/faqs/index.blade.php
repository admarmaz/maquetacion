@extends('front.layout.master')

@section('content')
    
    <div class="section-title">
        <h1>FAQ's</h1>
    </div>

    <div class="faqs">

        @foreach ($faqs as $faq)
            <div class="faq faq-button" data-button="{{$loop->iteration}}" data-content="{{$loop->iteration}}">
                <div class="faq-header">
                    <div class="faq-title">
                        <h3>{{isset($faq->locale['title']) ? $faq->locale['title'] : ""}}</h3>
                    </div>
                    <div class="faq-icon">
                        <svg viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,17L7,12H10V8H14V12H17L12,17M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4Z" />
                        </svg>
                    </div>
                    
                </div>

                <div class="faq-description">
                    <div class="desktop-featured">
                        @isset($faq->image_featured_desktop->path)
                            <div class="faq-description-image">
                                <img src="{{Storage::url($faq->image_featured_desktop->path)}}" alt="{{$faq->image_featured_desktop->alt}}" title="{{$faq->image_featured_desktop->title}}" />
                            </div>
                        @endif

                        <p>{!!isset($faq->locale['description']) ? $faq->locale['description'] : "" !!}</p>
                        
                    </div>
                    <p> GALERIA </p>
                    <div class="desktop-gallery">
                        
                        @isset($faq->image_grid_desktop)
                            @foreach($faq->image_grid_desktop as $faq->image_grid_desktop)
                                <div class="faq-description-image">
                                    <img src="{{Storage::url($faq->image_grid_desktop->path)}}" alt="{{$faq->image_grid_desktop->alt}}" title="{{$faq->image_grid_desktop->title}}" />
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                
            </div>
            
        @endforeach
    </div>

@endsection