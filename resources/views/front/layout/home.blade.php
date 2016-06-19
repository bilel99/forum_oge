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

    @yield('footer')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- jQuery 2.1.3 -->
    <script src="{{ asset('admin/AdminLTE-2.3.0/plugins/jQuery/jQuery2.1.3.min.js') }}"></script>
    <!-- jQueryUI 1.11.4 -->
    <script src="{{ asset('admin/AdminLTE-2.3.0/plugins/jQueryUI/jQueryUi1.11.4.min.js') }}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery 2.1.3 -->
    <script src="{{ asset('admin/AdminLTE-2.3.0/plugins/jQuery/jQuery2.1.3.min.js') }}"></script>
    <!-- jQueryUI 1.11.4 -->
    <script src="{{ asset('admin/AdminLTE-2.3.0/plugins/jQueryUI/jQueryUi1.11.4.min.js') }}"></script>

</html>