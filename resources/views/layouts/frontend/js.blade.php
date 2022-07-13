

<!-- JavaScript Libraries -->
<script src="{{ asset('frontend/lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/lib/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/lib/venobox/venobox.min.js') }}"></script>
<script src="{{ asset('frontend/lib/knob/jquery.knob.js') }}"></script>
<script src="{{ asset('frontend/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('frontend/lib/parallax/parallax.js') }}"></script>
<script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('frontend/lib/nivo-slider/js/jquery.nivo.slider.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/lib/appear/jquery.appear.js') }}"></script>
<script src="{{ asset('frontend/lib/isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/lib/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontend/lib/jquery-validation/dist/additional-methods.min.js') }}"></script>
<script src="{{ asset('frontend/lib/jquery-steps/jquery.steps.min.js') }}"></script>
<script src="{{ asset('frontend/lib/jquery.pwstrength/jquery.pwstrength.js') }}"></script>
<script src="{{ asset('frontend/lib/card/dist/card.js') }}"></script>
<script src="{{ asset('frontend/lib/toastr/toastr.min599c.js?v4.0.2') }}"></script>
<script src="{{ asset('frontend/lib/country-picker-flags/js/countrySelect.min.js') }}"></script>
<!-- Datatables-->

<!-- template js file -->
<script src="{{ asset('frontend/js/main.js') }}"></script>
<!-- stick footer to bottom of page when page content is short-->
<script src="{{ asset('frontend/js/footerBottom.js') }}"></script>
<!-- 2Checkout JavaScript library -->
<script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    $(document).ready(function(){
        /* Toastr messages */
        toastr.options.closeButton = true;
        toastr.options.timeOut = 5000;
        @if (session()->has('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (session()->has('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @if (session()->has('info'))
            toastr.info("{{ session('info') }}");
        @endif
    });
</script>

<!-- Contact Form JavaScript File -->
<script src="{{ asset('frontend/contactform/contactform.js') }}"></script>