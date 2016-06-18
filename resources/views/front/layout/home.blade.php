<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
        <title>{{\Config::get('constante.nom_code')}}</title>

        <!-- Vendor Styles -->
        <link rel="stylesheet" href="{{ asset('front/bootstrap-3.3.6-dist/css/bootstrap.min.css') }}"/>

        <!-- App Styles -->
        <link rel="stylesheet" href="{{ asset('front/css/style.css') }}"/>

        <!-- Vendor JS -->
        <script src="{{ asset('front/js/jquery-1.11.3.min.js') }}"></script>
        <script src="{{ asset('front/bootstrap-3.3.6-dist/js/bootstrap.min.js') }}"></script>
        
        <!-- App JS -->
        <script src="{{ asset('front/js/style.js') }}"></script>
        <script type="text/javascript">
            function init() {
                window.addEventListener('scroll', function(e){
                    var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                        shrinkOn = 300,
                        header = document.querySelector("header");
                    if (distanceY > shrinkOn) {
                        classie.add(header,"smaller");
                    } else {
                        if (classie.has(header,"smaller")) {
                            classie.remove(header,"smaller");
                        }
                    }
                });
            }
            window.onload = init();
        </script>
    </head>
    <body>
        @include('front.layout.nav')
        @yield('content')
        @include('front.layout.footer')
    </body>
</html>