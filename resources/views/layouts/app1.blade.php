@include('include.header')


{{-- Start content --}}

      @yield('contenu')

{{-- End content --}}


    @include('include.footer')

    <script src="frontend/js/jquery.min.js"></script>
    <script src="frontend/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="frontend/js/popper.min.js"></script>
    <script src="frontend/js/bootstrap.min.js"></script>
    <script src="frontend/js/jquery.easing.1.3.js"></script>
    <script src="frontend/js/jquery.waypoints.min.js"></script>
    <script src="frontend/js/jquery.stellar.min.js"></script>
    <script src="frontend/js/owl.carousel.min.js"></script>
    <script src="frontend/js/jquery.magnific-popup.min.js"></script>
    <script src="frontend/js/aos.js"></script>
    <script src="frontend/js/jquery.animateNumber.min.js"></script>
    <script src="frontend/js/bootstrap-datepicker.js"></script>
    <script src="frontend/js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="frontend/js/google-map.js"></script>
    <script src="frontend/js/main.js"></script>


  @yield('scripts')
    
  </body>
</html>