<<<<<<< HEAD
@if($agent->isDesktop())
    <script src="{{mix('front/desktop/js/app.js')}}"></script>
@endif

@if($agent->isMobile())
    <script src="{{mix('front/mobile/js/app.js')}}"></script>
@endif
=======
<script src="{{mix('front/desktop/js/app.js')}}"></script>
<script src="{{mix('front/mobile/js/app.js')}}"></script>
>>>>>>> a2306b4dd3b72c58597f1b6a40a8f8c48b1c5612
