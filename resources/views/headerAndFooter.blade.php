
<html lang="ru"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <title>Album example for Bootstrap</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
<body>

<header>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">Company name</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="#">Features</a>
            <a class="p-2 text-dark" href="#">Enterprise</a>
            <a class="p-2 text-dark" href="#">Support</a>
            <a class="p-2 text-dark" href="#">Pricing</a>
        </nav>
        <a class="btn btn-outline-primary" href="#">Sign up</a>
    </div>
</header>

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
            © 2020 Name Site. All Rights Reserved | Design by <a href="#" target="_blank">StockShablonov</a>
        </p>
    </div>
    <div class="social-icons mt-lg-3 mt-2 text-center">
        <ul>
            <li><a href="#"><span class="fa fa-facebook"></span></a></li>
            <li><a href="#"><span class="fa fa-twitter"></span></a></li>
            <li><a href="#"><span class="fa fa-rss"></span></a></li>
        </ul>
    </div>
</footer>
<!-- CDN подключение иконок fontawesome -->
<script src="https://use.fontawesome.com/df966d76e1.js"></script>

</body>
</html>
