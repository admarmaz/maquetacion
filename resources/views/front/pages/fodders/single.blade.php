@extends('front.layout.master')

@section('title')@lang('front/seo.web-name') | {{$fodder->seo->title}} @stop
@section('description'){{$fodder->seo->description != null? $fodder->seo->description : $fodder->seo->locale_seo->description}} @stop
@section('keywords'){{$fodder->seo->keywords != null ? $fodder->seo->keywords : $fodder->seo->locale_seo->keywords}} @stop
@section('facebook-url'){{URL::asset('/fodders/' . $fodder->seo->slug)}} @stop
@section('facebook-title'){{$fodder->seo->title}} @stop
@section('facebook-description'){{$fodder->seo->description != null ? $fodder->seo->description : $fodder->seo->locale_seo->description}} @stop

@section("content")
    @if($agent->isDesktop())
        <div class="page-section">
            @include("front.pages.fodders.desktop.fodder")
        </div>
    @endif

    @if($agent->isMobile())
        <div class="page-section">
            @include("front.pages.fodders.mobile.fodder")
        </div>
    @endif
@endsection
        
        