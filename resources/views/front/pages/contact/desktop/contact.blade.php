<div class="contact">

    <div class="two-columns">
        <div class="sidebar">
            <div class="contact-socials">

                <div class="contact-socials-title pink-title">
                    <h3>@lang('front/contact.title')</h3>
                </div>

                <div class="contact-socials-title">
                    <h3>@lang('front/contact.description')</h3>
                </div>
                
            </div>

            <div class="contact-info">

                @if(\Lang::has('front/information.adress'))
                    <div class="contact-info-element">
                        
                    </div>
                @endif
                
                @if(\Lang::has('front/information.telephone'))
                    <div class="contact-info-element">
                        <div class="contact-info-text">
                            <p>@lang('front/information.telephone')</p>
                        </div>
                    </div>
                @endif
                
                
            </div>
        </div>
        <div class="main">
            @include('front.components.desktop.contact_form')
        </div>
    </div>

    <div class="one-column">
        <div class="contact-map">
            <div class="pink-title">
                <h3>@lang('front/contact.map')</h3>
            </div>
            <div class="contact-map-text">
                <p>@lang('front/contact.map-text')</p>
            </div>
            <div class="contact-map-ubication">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12685.99958668758!2d26.55482108925889!3d37.354346834136265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14bdaf81c973fbbb%3A0x144703439e424fd5!2sKampos%20855%2000%2C%20Grecia!5e0!3m2!1ses!2ses!4v1623241481730!5m2!1ses!2ses" width="800" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>            </div>
        </div>

    </div>
    
</div>
