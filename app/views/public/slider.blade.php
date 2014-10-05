@section('styles')
{{ HTML::style('assets/lib/fractionslider/css/fractionslider.css'); }}
@stop
<section class="slider-wrapper">
    <div class="responisve-container">
        <div class="slider">
            <div class="fs_loader"></div>
            <div class="slide light">
                <img src="{{{ asset('assets/img/slide1.jpg') }}}" alt="" height="440" data-position="0,-460" data-in="bottom" data-delay="200" data-out="top">
                <img src="{{{ asset('assets/img/human.png') }}}" alt="" data-position="20, 500" data-in="bottom" data-delay="400" data-out="bottom">

                <p class="claim bg-primary" data-position="70,0" data-in="top" data-step="1" data-out="bottom" data-time="1000" data-delay="100">
                    Create Invoices in Seconds
                </p>
                <p class=" claim bg-secondary" data-position="120,0" data-in="top" data-step="1" data-out="bottom" data-time="3500" data-delay="250">
                    Check out the those great features
                </p>		

                <p class="teaser bg-gray-dark small" data-position="180,0" data-in="left" data-step="2" data-time="1500" data-delay="100">
                    New colors available
                </p>		
                <p class="teaser bg-gray-dark small" data-position="180,0" data-in="left" data-step="2" data-special="cycle" data-time="3100" data-delay="1600">
                    45+ pages models
                </p>
                <p class="teaser bg-gray-dark small" data-position="180,0" data-in="left" data-step="2" data-special="cycle" data-time="5000" data-delay="3000">
                    Enhanced shopping style
                </p>	
                <p class="teaser bg-gray-dark small" data-position="180,0" data-in="left" data-step="2" data-special="cycle" data-time="7000" data-delay="5000">
                    Optional sidebar menu
                </p>
                <p class="teaser bg-gray-dark small" data-position="180,0" data-in="left" data-step="2" data-special="cycle" data-time="9000" data-delay="7500">
                    Optional header style
                </p>
            </div>
            <div class="slide">
                <img src="{{{ asset('assets/img/slide2.jpg') }}}" alt="" height="440" data-position="0,-460" data-in="left" data-delay="200" data-out="right">
                <img src="{{{ asset('assets/img/ipad.png') }}}" alt="" data-step="1" data-position="40, 600" data-in="bottom" data-delay="300" data-out="fade">
                <img src="{{{ asset('assets/img/iphone.png') }}}" alt="" data-step="1" data-position="40,900" data-in="left" data-delay="500" data-out="fade">
                <p class="claim bg-secondary" data-position="70,0" data-in="top" data-step="2" data-out="top" data-delay="100">
                    Now. Faster. Stronger
                </p>
                <p class="teaser bg-gray-dark small" data-position="130,0" data-in="bottom" data-step="2" data-delay="300">
                    Fresh and adaptive design
                </p>		
                <p class="teaser bg-gray-dark small" data-position="175,0" data-in="bottom" data-step="2" data-delay="600">
                    Complete features
                </p>
                <p class="teaser bg-gray-dark small" data-position="225,0" data-in="bottom" data-step="2" data-delay="1100">
                    Easy to customize
                </p>	
                <p class="teaser bg-gray-dark small" data-position="275,0" data-in="bottom" data-step="2" data-delay="1600">
                    Easier to achieve your goals
                </p>
                <p class="teaser bg-gray-dark small" data-position="325,0" data-in="bottom" data-step="2" data-delay="2100">
                    Fully UPDATED
                </p>
            </div>
            <!-- and so on -->
        </div>
    </div>
</section>
@section('scripts')
{{ HTML::script('assets/lib/fractionslider/jquery.fractionslider.min.js'); }}			
<script type="text/javascript">
    $(window).load(function () {
        $('.slider').fractionSlider({
            'fullWidth': true,
            'controls': true,
            'pager': false,
            'responsive': true,
            'dimensions': "1000,440",
            'increase': false,
            'pauseOnHover': true,
            'slideTransitionSpeed': 800,
            'delay': 0
        });
    });
</script>
@stop