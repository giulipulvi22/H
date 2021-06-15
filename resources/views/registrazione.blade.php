<!DOCTYPE html>
<html>
    <head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="{{url('css/login.css')}}">
    <script src="{{url('js/login.js')}}" defer></script>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
</head>
<body>
    <div id="singUp">
        <div id="logo">
            <img src="immagini/logo.png">
        </div>
        <div id="info">
            <h1>Benvenuto su Polo Foto</h1>
            <span>Sei già registrato? <a href="login"> Accedi!</a></span>
        </div>
    </div>
    <form action="registrazione" name="registrazione" id="registrazione" method="POST">
    <input type="hidden" name='_token' value='".csrf_toke()"'>
        <div>
            <input type="text" name="nome" placeholder="nome" value="{{ old('nome')}}">
            <span></span>
        </div>

        <div>
        <input type="text" name="cognome" placeholder="cognome" value="{{ old('cognome')}}"> <span>
        </span> </div>
        <div>
        <input type="data" name="data" placeholder="data di nascita" onfocus="(this.type='date')" onblur="(this.type='text')" value="{{ old('data')}}">
        <span></span>
        </div>
        <div>
        <input type="text" name="citta" placeholder="città di nascita" value="{{ old('citta')}}">
        <span></span>
        </div>
        <div>
        <input type="text" name="email" placeholder="email"> <span>
        </span>
        </div>
        <div>
            <input type="text" name="username" placeholder="username">
            <span> </span>
        </div>
        <div>
        <input type="password" name="password" placeholder="password">
        <span> </span>    
    </div>
    <div>
        <input type="password" name="confpassword" placeholder="conferma password">
        <span></span>    
    </div>
    <div id="invio">
        <span>
        @if($errors!="[]")

        {{$errors}}

        @endif
        </span><input type="submit" value="Registrati" id="submit">
    </div>
    </form>
</body>
</html>