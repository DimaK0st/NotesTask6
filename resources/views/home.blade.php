@extends('headerAndFooter')

@section('main_first_block')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Сайт для хранения закладок</h1>
            <p>
                <a href="/addNote" class="btn btn-primary my-2">Добавить закладку</a>
            </p>
        </div>
    </section>
@endsection


@section('main_content')

    @isset($path)
        <img src="{{asset('storage/'. (string)$path)}}" alt="">
    @endisset


    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">

                @foreach ($allNotes as $oneNote)

                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img class="card-img-top"
                                 data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                                 alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"
                                 src="{{$oneNote['path']}}"
                                 data-holder-rendered="true">
                            <div class="card-body">
                                <span>Тема: {{$oneNote['nameNotes']}} </span>
                                <br><br>
                                <div id="block">
                                    <p class="card-text">Содержимое: {{$oneNote['textNotes']}}</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a type="button" href="getNote/{{$oneNote['idNotes']}}" class="btn btn-sm btn-outline-secondary">
                                            View </a>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
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
