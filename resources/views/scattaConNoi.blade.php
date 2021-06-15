<html>
        <head>
            <title>Polo Foto - Scatta con noi</title>
            <link rel="stylesheet" href="{{url('css/ScattaConNoi.css')}}">
            <meta name="viewport" content="width=device-width,initial-scale=1.0">
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
            <script src="{{url('js/ScattaConNoi.js')}}" defer></script>
            <script src='http://www.bing.com/api/maps/mapcontrol' async defer></script>
        </head>


    <body>
        <header>
            @include('layouts.nav')
            <span id="intestazione">
                programma le tue foto
            </span>
            <p>Polo Foto > Home > Scatta con noi</p> 
        </header>

        <section>
            <span class="introduzione">
                Miriam Monti e Salvo Storti sono due dei fotografi che lavorano qui in Polo Foto offrendoci 
                una vasta gamma di foto, disponibili nella sezione "Products" del nostro sito. <br>
                I loro generi preferiti sono rispettivamente paesaggistica e astrofotografia e, entrambe le categorie,
                sono tuttavia caratterizzate da un attento studio delle condizioni ambientali e dei fattori esterni,
                fondamentali per raggiungere e riprodurre gli obiettivi prefissati. È per questo motivo che hanno deciso
                di offire la loro esperienza e le loro conoscenze per fornire delle linee guida su come comportarsi sul campo,
                le decisioni da prendere in base alle condizioni esterne, dispensando ottimi consigli.
            </span>
            <div id="player"></div>
            <span class="introduzione">
                Questa sezione permette di ottenere informazioni utili per programmare una sessione fotografica in un dato giorno a una data ora.  
            </span>
            <form>
                <input type="text" id="citta" placeholder="Torino">
                <input type="date" id="data">
                <input type="submit" id="submit" value="find">
            </form>


            <article>
            </article>
        </section>

        @include('layouts.footer')
    </body>
</html>