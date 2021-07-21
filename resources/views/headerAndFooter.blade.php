<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <title>Album example for Bootstrap</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
<body>

<header>
    <div class="wrapper">
        <a href="#" class="text-logo">Notes</a>
        <a href="#" class="hamburger"></a>
        @if (isset($_COOKIE['access']) && $_COOKIE['access'] =="1")
            <nav>
                <a href="#" onclick="deleteAllCookies()" class="login_btn">Выйти</a>
                <a href="#" class="login_btn">Здравствуй: {{$_COOKIE['userName']}}</a>
            </nav>
        @else

            <nav>
                <a href="/authorization" class="login_btn">Вход</a>
            </nav>

        @endif
    </div>
</header><!--  end header section  -->

<main role="main">

    @yield('main_first_block')



    @yield('main_content')

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
<script>
    function deleteAllCookies() {
        var cookies = document.cookie.split(";");

        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i];
            var eqPos = cookie.indexOf("=");
            var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
            // if(name)
            if (name != ' XSRF-TOKEN') {
                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
            }
        }
        location.href = location.href;
    }
</script>
</html>
