<html>
    <head>
        <title>Polo Foto - About us</title>
        <link rel="stylesheet" href="{{url('css/AboutUs.css')}}">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <script src="{{url('js/AboutUs.js')}}" defer></script>
    </head>
    <body>
        <header>
        @include('layouts.nav')
            <span id="intestazione">
                chi siamo
            </span>
            <p>Polo Foto > About us</p> 
        </header>

        <section>
            <h1>Proprietario</h1>
            <div class="proprietario">
                <div class="info1">
                    <p class="nome">Elia Episcopo<br></p>
                    <p class="citta">Venezia - 15/03/1994 <br></p>
                </div>
                <img class="foto" src="immagini/Elia.jpg">
            </div>
            <button>Scopri i fotografi</button>

            <div id="player"></div>
        </section>
    @include('layouts.footer')
    </body>
</html>