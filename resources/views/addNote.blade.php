@extends('headerAndFooter')

@section('main_content')


    <link rel="stylesheet" href="../css/addNote.css">
    <div class="container">
        <div class="row">

            <div class="col-md-offset-3 col-md-6">
                <form name="formsRegister" class="form-horizontal" enctype="multipart/form-data" action='/post/addNote'
                      method="post">
                    {{ csrf_field() }}
                    <span class="heading">Добавление новой заметки</span>
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputNameNote" name="inputNameNote"
                               placeholder="Название заметки" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-text-notes" id="inputTextNote" name="inputTextNote"
                                  placeholder="Содержимое заметки" required></textarea>
                    </div>
                    <div class="response-block">
                        <span id="response"></span></div>
                    <div id="parentId">
                        <input required type="file" class="form-control pictures" name="image_1" id="myFile"
                               placeholder="Photo"
                               accept="image/jpeg,image/png,image/gif">
                    </div>

                    <br>
                    <a class="add" onclick="return addField()" href="#">Добавить ещё картинку</a>

                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Добавить</button>
                    </div>


                </form>
            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->
    <script src="../js/addNote.js"></script>


@endsection
