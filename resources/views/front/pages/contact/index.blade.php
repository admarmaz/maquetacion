@extends('front.layout.master')

@section("content")

    @if($agent->isDesktop())
        <div class="page-section">
            @include("front.pages.contact.desktop.contact")
        </div>
    @endif

    @if($agent->isMobile())
        <div class="page-section">
            @include("front.pages.contact.mobile.contact")
        </div>
    @endif
@endsection
        
        