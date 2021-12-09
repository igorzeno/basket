<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boutique :: Home</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/loader.js') }}"></script>
</head>
<body>
<div class="edica-loader"></div>
<header class="edica-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="index.html"><img src="{{ asset('assets/images/logo.svg') }}" alt="Edica"></a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#edicaMainNav" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="edicaMainNav">
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('main.index') }}">ГЛАВНАЯ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('list.index') }}">КОРЗИНА</a>
                    </li>
                </ul>
            </div>
            <div>
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <input class="btn btn-outline-primary" type="submit" value="Выйти">
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </div>
</header>

@yield('content')

<script src="{{ asset('assets/vendors/popper.js/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/aos/aos.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    AOS.init({
        duration: 1000
    });



    let cartTotal = document.querySelector('.header-icons-noti');
    showTotalCart = async () => {
        let response = await fetch('/cart', {
            method: 'GET',
        });
        let result = await response.json();
        if(result || result === 0) {
            if (cartTotal) {
                cartTotal.innerHTML = result
            }
        }
        else {
            console.log('no');
        }
    };

    changeDisable = (e) => {
        let but = e.target;
        let el = but.closest(".add__line");
        let but_list = el.querySelectorAll(".widget-title");
        let a = but_list[0];
        let b = but_list[1];
        if(a.disabled === true && b.disabled === false){
            a.disabled = false;
            b.disabled = true;
        }
        else {
            a.disabled = true;
            b.disabled = false;
        }
    }

    storeProductCart = async (e) => {
        e.preventDefault();
        let response = await fetch('/cart', {
            method: 'POST',
            body: new FormData(e.target.parentElement),
            context: e
        });
        showTotalCart();
        let result = await response.json();
        if(result.success) {
            changeDisable(e);
        }
        else {
            console.log('Error');
        }
    };

    delProductCart = async (e) => {
        e.preventDefault();
        let response = await fetch('/cart', {
            method: 'POST',
            body: new FormData(e.target.parentElement),
            context: e
        });
        showTotalCart();
        let result = await response.json();
        if(result.success) {
            changeDisable(e);
        }
        else {
            console.log('Error');
        }
    };

    const adds = document.querySelectorAll(".button__add");
    for (let i = 0; i < adds.length; i++) {
        adds[i].addEventListener("click", function(e) {
            storeProductCart(e);
        });
    }

    const dels = document.querySelectorAll(".button__del");
    for (let i = 0; i < dels.length; i++) {
        dels[i].addEventListener("click", function(e) {
            delProductCart(e);
        });
    }
</script>
</body>
</html>
