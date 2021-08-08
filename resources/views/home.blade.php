@extends('headerAndFooter')

@section('main_first_block')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Сайт для хранения заметок</h1>
            @if(isset($firstLogin))
                <p>
                    <a href="/register" class="btn btn-primary my-2">Зарегистрировать аккаунт</a>
                </p>
            @else
                <p>
                    <a href="{{route('notes.create')}}" class="btn btn-primary my-2">Добавить заметку</a>
                </p>
                <p>
                    <a href="notes/getCsv" class="btn btn-primary my-2">Экспортировать заметки</a>
                    <a href="notes/importCsv" class="btn btn-primary my-2">Импортировать заметки</a>
                </p>
            @endif
        </div>
    </section>
@endsection


@section('main_content')



    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">

                @foreach ($allNotes as $oneNote)

                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img class="card-img-top"
                                 data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                                 alt="Thumbnail [100%x225]"

                                 @if(count($oneNote->images)>0)
                                 src="{{Request::root()."/storage/".$oneNote->images[0]['path']}}"
                                 @else

                                 src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22208%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20208%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17aab92a0d9%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A11pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17aab92a0d9%22%3E%3Crect%20width%3D%22208%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2266.9453125%22%20y%3D%22117.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"

                                 @endif
                                 data-holder-rendered="true">
                            <div class="card-body">
                                <a type="button" class="themeNote"
                                   href="/notes/{{$oneNote['id']}}">Тема: {{$oneNote['name']}} </a>
                                <br><br>
                                <div id="block">
                                    <p class="card-text">Содержимое: {!!$oneNote['text']!!}...</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <form name="formsDeleteNote" class="form-horizontal" action='/notes/{{$oneNote['id']}}'
                                              method="post">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <input type="hidden" id="deleteNote" name="deleteNote" value="{{$oneNote['id']}}">
                                            <a type="button" href="/notes/{{$oneNote['id']}}"
                                               class="btn btn-sm btn-outline-secondary">View</a>
                                            <a type="button" href="/notes/{{$oneNote['id']}}/edit "
                                               class="btn btn-sm btn-outline-secondary">Edit</a>
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                Delete</button>
                                        </form>
                                    </div>
                                    <small class="text-muted">9 mins</small>
                                </div>
                            </div>
                        </div>
                    </div>


                @endforeach
            </div>
        </div>
    </div>

@endsection
