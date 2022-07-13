@include('layouts.frontend.header')

<body data-spy="scroll" data-target="#navbar-example">
    <div class="main-container">
        <div id="preloader"></div>

        @include('layouts.frontend.navbar')
        
        @include('layouts.frontend.banner')

        @yield('content')

        @include('layouts.frontend.footer')

    </div>
</body>

@include('layouts.frontend.js')

@yield('javascript');

</html>
