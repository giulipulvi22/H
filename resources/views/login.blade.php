<html>
    <head>
    <title>Login</title>
    <link rel="stylesheet" href="{{url('css/login.css')}}">
    
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
</head>
<body>
    <div id="singUp">
        <div id="logo">
            <img src="immagini/logo.png">
        </div>
        <div id="info">
            <h1>Bentornato su Polo Foto</h1>
            <span>Non sei registrato? <a href="registrazione"> Registrati!</a></span>
        </div>
    </div>
    <div id="space">
    <form action="login" name="registrazione" id="login" method="POST">
    <input type="hidden" name='_token' value='".csrf_toke()"'>
    <div><input type="text" name="username" placeholder="username o email"></div>
    <div><input type="password" name="password" placeholder="password"></div>
        <div id="invio">
        <span>
        @if($errors!="[]")
        {{$errors}}
        @endif
        </span>
        <input type="submit" value="Accedi" id="submit">
        </div>
    </form>

    <div id="foto"></div>

    </div>
</body>

</html>