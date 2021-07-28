@extends('headerAndFooter')

@section('main_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/addNote.css">
    <style>
        .row {
            margin: 0;
        }

        img {
            border: 1px solid black;
        }

        main {
            height: auto;
        }
    </style>
    <div class="contain">
        <div class="row">

            <div class="col-md-offset-3 col-md-6">
                <form name="formsRegister" class="form-horizontal" enctype="multipart/form-data" action='/post/editNote'
                      method="post">
                    {{ csrf_field() }}
                    <input type="hidden" id="tempNoteDelete" name="tempNoteDelete" value="">
                    <input type="hidden" id="idNotes" name="idNotes" value="{{$oneNotes['idNotes']}}">
                    <span class="heading">Редактирование заметки</span>
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputNameNote" name="inputNameNote"
                               placeholder="Название заметки" required value="{{$oneNotes['nameNotes']}}">
                    </div>
                    <div class="form-group">
                        <textarea class="form-text-notes inputTextNote" id="inputTextNote" name="inputTextNote"
                                  placeholder="Содержимое заметки" required>{{$oneNotes['textNotes']}}</textarea>
                    </div>
                    <div style="margin-bottom: 10px">
                        <span id="response" style="width: 100px; height: 100px;"></span></div>
                    <figure>
                        @foreach($allImage as $image)

                            @if($loop->index==0)
                                <input type="hidden" id="tempNoteAdd" name="tempNoteAdd" value="{{$loop->count}}">
                            @endif
                            <span>
                                <!-- thumbnail image wrapped in a link -->
                                <a href="#img{{$loop->iteration}}">
                                    <img class="figure-delete" src="{{$image}}" width="25%" style=" margin: 5px"
                                         onclick="return deleteField(this,'{{$image}}')">
                                </a>
                                </span>
                        @endforeach
                    </figure>
                    <div id="parentId">

                    </div>

                    <br>
                    <button class="add  btn-warning" style="margin-bottom: 10px" onclick="return addField()">Добавить ещё картинку
                    </button>

                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Сохранить</button>
                    </div>


                </form>
            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->
    <script src="https://cdn.tiny.cloud/1/e4gazu3y4f1sclcgct0jz905cbjsk8s508e06qcns6i872oa/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script src="../js/editNote.js"></script>

@endsection
