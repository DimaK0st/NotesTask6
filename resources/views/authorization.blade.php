@extends('headerAndFooter')

@section('main_content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="../css/authorization.css" rel="stylesheet">
    <div class="container">
        <div class="row">

            <div class="col-md-offset-3 col-md-6">
                <form name="formsLogin" class="form-horizontal">
                    {{ csrf_field() }}
                    <span class="heading">АВТОРИЗАЦИЯ</span>
                    <div class="form-group">
                        <input class="form-control" id="inputLogin" name="inputLogin" placeholder="Login/Email">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="form-group help">
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    <div style="margin-bottom: 10px">
                        <span id="response" style="width: 100px; height: 100px;"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Вход</button>
                    </div>
                    <div class="form-group">
                        <a  onclick="window.location.href = '/register'" style="cursor: pointer;text-decoration: none;" class="btn2 btn-default">Зарегистрироваться</a>
                    </div>
                </form>
            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->
    <script src="../js/authorization.js"></script>



@endsection
