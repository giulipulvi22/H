<html>
        <head>
            <title>Polo Foto - Dove Siamo</title>
            <link rel="stylesheet" href="{{url('css/doveSiamo.css')}}">
            <meta name="viewport" content="width=device-width,initial-scale=1.0">
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
            <script src="{{url('js/doveSiamo.js')}}" defer></script>
            <script src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap' async defer></script>
        </head>


    <body>
        <header>
            @include('layouts.nav')
            <span id="intestazione">
                vieni a trovarci
            </span>
            <p>Polo Foto > Dove siamo</p> 
        </header>

        <section>
            <h4>Noi siamo qui!</h4>
            <div id="info">
                <div id="map"></div>
            </div>  
        </section>

        @include('layouts.footer')
    </body>
</html>