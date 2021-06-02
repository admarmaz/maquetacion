@extends('front.layout.master')

@section("content")
    @if($agent->isDesktop())
        <div class="page-section">
            @include("front.pages.fodders.desktop.fodders")
        </div>
    @endif

    @if($agent->isMobile())
        <div class="page-section">
            @include("front.pages.fodders.mobile.fodders")
        </div>
    @endif
@endsection
        
        