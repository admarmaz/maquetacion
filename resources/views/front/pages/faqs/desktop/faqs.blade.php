<div class="faqs">

    <div class="faqs-title">
        <h3>@lang('front/faqs.title')</h3>
    </div>
    
    @foreach ($faqs as $faq)
        <div class="faq faq-plus-button" data-content="{{$loop->iteration}}" data-button="{{$loop->iteration}}">
            <div class="faq-title-container">
                <div class="faq-title">
                    <h3>{{isset($faq->seo->title) ? $faq->seo->title : ""}}</h3>
                </div>

                <svg style="width:34px;height:34px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12,17L7,12H10V8H14V12H17L12,17M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4Z" />
                </svg>

            </div>
            <div class="faq-description">
                <div class="faq-description-text">
                    {!!isset($faq->locale['description']) ? $faq->locale['description'] : "" !!}
                </div>

                <div class="faq-description-image">
                    <!-- @isset($faqs->image_featured_desktop->path)
                        <div class="faq-description-image-featured">
                            <img src="{{Storage::url($faqs->image_featured)}}" alt="{{$faq->image_featured_desktop->alt}}" title="{{$faq->image_featured_desktop->title}}" />
                        </div>
                    @endif

                    @isset($faq->image_grid_desktop)
                        <div class="faq-description-image-grid">
                            @foreach ($faq->image_grid_desktop as $image)
                                <div class="faq-description-image-grid-item">
                                    <img src="{{Storage::url($image->path)}}" alt="{{$image->alt}}" title="{{$image->title}}" />
                                </div>
                            @endforeach
                        </div>
                    @endif -->
                </div>                
            </div>
        </div>
    @endforeach
    
</div>
