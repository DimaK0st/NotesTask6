<html lang="ru">
<head>
    <meta charset=UTF-8>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <title>Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
<body>

<header>
    <div class="wrapper">
        <a href="/" class="text-logo">Notes</a>
        <a href="#" class="hamburger"></a>
        @if (session('access') =="1")
            <form action='/post/logout' method="get">
            <nav>

                <button type="submit" id="deleteCookie" class="login_btn">Выйти</button>
                <a href="#" class="login_btn">Здравствуй: {{session('userName')}}</a>
            </nav>
            </form>
        @else
            <nav>
                <a href="/authorization" class="login_btn">Вход</a>
            </nav>
        @endif
    </div>
</header>

<main role="main">

    @yield('main_first_block')


    @yield('main_content')

</main>

</body>

<footer class="py-3">
    <div class="copy-bottom-txt text-center py-3">
        <p>
            © 2021 Notes Site. Developer by <a href="#" target="_blank">Dima Kost</a>
        </p>
    </div>
    <div class="social-icons mt-lg-3 mt-2 text-center">
        <ul>
            <li><a href="#"><span class="fa fa-github"></span></a></li>
            <li><a href="#"><span class="fa fa-telegram"></span></a></li>
        </ul>
    </div>
    <script src="https://use.fontawesome.com/df966d76e1.js"></script>
</footer>
</html>
