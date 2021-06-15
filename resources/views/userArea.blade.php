<html>
    <head>
        <title>Polo Foto - Personal Area</title>
        <link rel="stylesheet" href="{{url('css/userArea.css')}}">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
        <script src="{{url('js/prova.js')}}" defer></script>
    </head>

    <body>
            <header>
                @include('layouts.nav')
                <span id="intestazione">
                    Ciao {{$user}}
                </span>
                <p>Polo Foto > Area Utente</p> 
            </header>
            <section>
                <div class="dati">
                    <div id='dati'></div>
                    <div id='ordini'></div>
                </div>
                <div class="dati">
                    <div id='preferiti'></div>
                    <div id='carrello'></div>
                </div>
                <div id="recensioni"></div>
            </section>

            @include('layouts.footer')
    </body>
</html>