@extends('headerAndFooter')

@section('main_content')
    <link rel="stylesheet" href="{{ asset('css/addNote.css') }}">
    <link rel="stylesheet" href="{{ asset('css/editNote.css') }}">

    <div class="contain">
        <div class="row">

            <div class="col-md-offset-3 col-md-6">
                <form name="formsRegister" class="form-horizontal" enctype="multipart/form-data" action='/notes/{{$oneNotes['id']}}'
                      method="post">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <input type="hidden" id="tempNoteDelete" name="tempNoteDelete" value="">
                    <input type="hidden" id="idNotes" name="idNotes" value="{{$oneNotes['id']}}">
                    <span class="heading">Редактирование заметки</span>
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputNameNote" name="inputNameNote"
                               placeholder="Название заметки" required value="{{$oneNotes['name']}}">
                    </div>
                    <div class="form-group">
                        <textarea class="form-text-notes inputTextNote" id="inputTextNote" name="inputTextNote"
                                  placeholder="Содержимое заметки" required>{{$oneNotes['text']}}</textarea>
                    </div>
                    <div class="response-block" >
                        <span id="response" ></span></div>
                    <figure>
                        @foreach($allImage as $image)

                            @if($loop->index==0)
                                <input type="hidden" id="tempNoteAdd" name="tempNoteAdd" value="{{$loop->count}}">
                            @endif
                            <span>
                                <!-- thumbnail image wrapped in a link -->
                                <a href="#img{{$loop->iteration}}">
                                    <img id="id-figure-delete-{{$loop->iteration}}" class="figure-delete" src="{{$image}}">
                                </a>
                                </span>
                        @endforeach
                    </figure>
                    <div id="parentId">

                    </div>

                    <br>
                    <button class="add  btn-warning" id="btnAddField">Добавить ещё картинку
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
    <script src="{{ asset('js/editNote.js') }}"></script>

@endsection
