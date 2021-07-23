@extends('headerAndFooter')

@section('main_content')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../css/addNote.css">
    <div class="contain">
        <div class="row">

            <div class="col-md-offset-3 col-md-6">
                <form name="formsRegister" class="form-horizontal" enctype="multipart/form-data" action='/post/addNote'
                      method="post">
                    {{ csrf_field() }}
                    <span class="heading">{{$oneNotes['nameNotes']}}</span>

                    <div class="form-group">
                        <p class="form-text-notes" style="height: auto" id="inputTextNote" name="inputTextNote">{{$oneNotes['textNotes']}}
                            asdasdasdasdasdasdasdasda sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das d sdas das das dasd asdasdasdasdasdasdasdasdasdas
                            dasdasdasdasdas dasdasdasdasdasdasdasd asdasdasdasdasd</p>
                    </div>
                    <div style="margin-bottom: 10px">
                        <span id="response" style="width: 100px; height: 100px;"></span></div>

                    <figure>
                        @foreach($allImage as $image)
                            <span style="width:25%;">
                                <!-- thumbnail image wrapped in a link -->
                                <a href="#img{{$loop->iteration}}">
                                    <img src="{{$image}}" width="25%" style="border: 1px solid black; margin: 5px">
                                </a>

                                <!-- lightbox container hidden with CSS -->
                                <a href="#" class="lightbox" id="img{{$loop->iteration}}">
                                    <span style="background-image: url('{{$image}}')"></span>
                                </a>
                            </span>
                        @endforeach
                    </figure>
                </form>
            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->
    <script src="../js/addNote.js"></script>


@endsection