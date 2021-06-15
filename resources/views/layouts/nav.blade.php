<head>
<link rel="stylesheet" href="{{url('css/nav.css')}}">
</head>
<nav>
    <span id="nome">
        Polo Foto
    </span>

    <div id="link">
        <a href="products">Products</a>
        <a href="scattaConNoi">Scatta con noi</a>
        <a href="AboutUs">About Us</a>
        <a href="doveSiamo">Dove siamo</a>
        @if((!session("usernamelog")))
            <a href="login">Login</a>
            @endif
        @if(session("usernamelog"))
                <a href="login/logout">Logout</a>
                <a href="userArea"><img src="immagini/user.png"></a>                      
        @endif 
    </div>

    <div id="menu">
        <div></div>
        <div></div>
        <div></div>
    </div>
</nav>