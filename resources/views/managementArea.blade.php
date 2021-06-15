<html>
    <head>
        <title>Polo Foto - Management Area</title>
        <link rel="stylesheet" href="{{url('css/homeProprietario.css')}}">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
        <script src="{{url('js/homeProprietario.js')}}" defer></script>
    </head>


<body>
    <header>
        @include('layouts.nav')
        <span id="intestazione">
            Management Area
        </span>
        <p>Polo Foto > Management Area</p> 
    </header>
        
    <section>
        <ul>
        <li><a href="#fotografi">Fotografi</a></li>
        <li><a href="#foto">Foto</a></li>
        <li><a href="#stampe">Stampe</a></li>
        </ul>
        <article data-type="fotografi">
        <div id='form1' class="hidden">
        <form name='caricaFotografo' method='post' enctype="multipart/form-data" action="managementArea/addFotografo">
            <input type="hidden" name='_token' value='".csrf_toke()"'>
                <input type="text" name="nome" placeholder="Nome">
                <input type="text" name="cognome" placeholder="Cognome">
                <input type="text" name="citta" placeholder="Città di nascita">
                <input type="date" name="datan" placeholder="Data di nascita">
                <input type="text" name="cf" placeholder="Codice fiscale">
                <input type="date" name="datai" placeholder="Data inizio">
                <input type="text" name="fb" placeholder="Facebook">
                <input type="text" name="ig" placeholder="Instagram">
                <input type="text" name="sp" placeholder="Spotify">
                <input type="file" name="propic" id="propic">
                <input type="submit" id="button1" class="submit" value="Invia">
            </form>
            @if(session('err'))
            @foreach (session('err') as $err)
                    <span class="errore">{{$err}}</br></span>
                @endforeach
            @endif
            </div>
        </article>
        <article data-type="foto">
            <div id='form2'class="hidden">
                <form name='caricaFoto' method='post' enctype="multipart/form-data" action="managementArea/addFoto">
                <input type="hidden" name='_token' value='".csrf_toke()"'>
                <input type="date" name="data" placeholder="Data scatto">
                <input type="text" name="descrizione" placeholder="Descrizione">
                <select id="cfFotografo" name="cfFotografo" placeholder="Fotografo"></select>
                <input type="text" name="genere" placeholder="Genere">
                <input type="text" name="titolo" placeholder="Titolo">
                <input type="file" name="foto" id="printFoto">
                <input type="submit" id="button2" class="submit" value="Invia">
                </form>
                @if(session('errFoto'))
                    @foreach (session('errFoto') as $err)
                        <span class="errore">{{$err}}</br></span>
                    @endforeach
            @endif
        </div>
        </article>
        <article data-type="stampe">
            <div id='form3' class="hidden">
                <input type="number" name="altezza" step="0.01" min="0" placeholder="Altezza">
                <input type="number" name="larghezza" step="0.01" min="0" placeholder="Larghezza">
                <input type="text" name="materiale" placeholder="Materiale">
                <input type="number" name="prezzo" step="0.01" min="0" placeholder="Prezzo">
                <select id="idFoto" name="idFoto" placeholder="Foto"></select>
                <button id="button3">Invia</button>
            </div>
        </article>
    </section>

    @include('layouts.footer')
</body>
</html>