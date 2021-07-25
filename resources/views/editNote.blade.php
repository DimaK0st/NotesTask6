@extends('headerAndFooter')

@section('main_content')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../css/addNote.css">
    <style>
        .row {
            margin: 0;
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
                    <input type="hidden" id="tempNoteAdd" name="tempNoteAdd" value="">
                    <span class="heading">Добавление новой заметки</span>
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
                    <div id="parentId">
                        <figure>
                            @foreach($allImage as $image)
                                <div style="display: flex; flex-direction:column ">
                                    <div>
                                <span>
                                <!-- thumbnail image wrapped in a link -->
                                <a href="#img{{$loop->iteration}}">
                                    <img src="{{$image}}" width="25%" style="border: 1px solid black; margin: 5px">
                                </a>

                                    <!-- lightbox container hidden with CSS -->
                                <a href="#" class="lightbox" id="img{{$loop->iteration}}">
                                    <span style="background-image: url('{{$image}}')"></span>
                                </a>

                                <div style="display: flex">
                                    <input required type="file" class="form-control pictures" name="image_1" id="myFile" placeholder="Photo"
                                    accept="image/jpeg,image/png,image/gif" value="">
                                    <a style="left: 0" href="#"
                                       onclick="return deleteField(this,'../public/storage/{{$oneNotes['idUser']}}/{{$oneNotes['idNotes']}}')">X</a>
                                </div>

                                </span>
                                    </div>
                                </div>
                            @endforeach
                        </figure>

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
    <script src="https://cdn.tiny.cloud/1/e4gazu3y4f1sclcgct0jz905cbjsk8s508e06qcns6i872oa/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script src="../js/editNote.js"></script>

@endsection
