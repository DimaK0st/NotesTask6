
<html lang="ru"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <title>Album example for Bootstrap</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
<body>

<header>
    <div class="wrapper">
        <a href="#" class="text-logo">Notes</a>
        <a href="#" class="hamburger"></a>
        <nav>
            <a href="#" class="login_btn">Login</a>
        </nav>
    </div>
</header><!--  end header section  -->

<main role="main">

                @yield('main_first_block')

    <div class="album py-5 bg-light">
        <div class="container">


                @yield('main_content')
        </div>
    </div>

</main>

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
</footer>
<!-- CDN подключение иконок fontawesome -->
<script src="https://use.fontawesome.com/df966d76e1.js"></script>

</body>
</html>
