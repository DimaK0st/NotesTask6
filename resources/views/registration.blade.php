@extends('headerAndFooter')

@section('main_content')


    <link href="../css/registration.css" rel="stylesheet">
    <div class="container">
        <div class="row">

            <div class="col-md-offset-3 col-md-6">
                <form name="formsRegister" class="form-horizontal">
                    {{ csrf_field() }}
                    <span class="heading">Регистрация</span>
                    <div class="form-group">
                        <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="E-mail">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputLogin" name="inputLogin" placeholder="Login">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="form-group help">
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword"
                               placeholder="Password">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>
                    <div class="form-group help">
                        <input type="password" class="form-control" id="inputRePassword" name="inputRePassword"
                               placeholder="Re-password">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>
                    <div class="response-block">
                        <span id="response"></span></div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Зарегистрироваться</button>
                    </div>
                    <div class="form-group">
                        <a onclick="window.location.href = '/auth'"
                           class="btn2 btn-default btn-auth">Авторизоваться</a>
                    </div>
                </form>
            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->
    <script src="../js/registration.js"></script>


@endsection
