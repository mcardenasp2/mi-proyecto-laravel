<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{asset("css/app.css")}}">

    
    <title>M Admin</title>
</head>
<body>

    <div id="app">
        @include('web.partials.nav-header-main')

        <div class="container mb-3 mt-3" > 

            @yield('content')
        </div>


        @include('web.partials.footer-main')
    </div>

<script src="{{asset("js/app.js")}}"></script>
</body>
</html>