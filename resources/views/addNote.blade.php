@extends('headerAndFooter')

@section('main_content')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/addNote.css">
    <div class="container">
        <div class="row">

            <div class="col-md-offset-3 col-md-6">
                <form name="formsRegister" class="form-horizontal">
                    {{ csrf_field() }}
                    <span class="heading">Добавление новой заметки</span>
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputNameNote" name="inputNameNote" placeholder="Название заметки">
                    </div>
                    <div class="form-group">
                        <textarea class="form-text-notes" id="inputTextNote" name="inputTextNote" placeholder="Содержимое заметки"></textarea>
                    </div>
                    <div class="form-group help">
                        <input type="text" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>
                    <div class="form-group help">
                        <input type="text" class="form-control" id="inputRePassword" name="inputRePassword" placeholder="Re-password">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>
                    <div style="margin-bottom: 10px">
                        <span id="response" style="width: 100px; height: 100px;"></span></div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Зарегистрироваться</button>
                    </div>
                    <div class="form-group">
                        <a  onclick="window.location.href = '/auth'" style="cursor: pointer;text-decoration: none;" class="btn2 btn-default">Авторизоваться</a>
                    </div>
                </form>
            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->
    <script src="../js/registration.js"></script>


@endsection
