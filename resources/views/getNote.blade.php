@extends('headerAndFooter')

@section('main_content')

    <link rel="stylesheet" href="../css/addNote.css">
    <div class="contain">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div name="formsRegister" class="form-horizontal" >
                    {{ csrf_field() }}
                    <span class="heading">{{$oneNotes['nameNotes']}}</span>

                    <div class="form-group">
                        <div class="form-text-notes" style="text-align: start" id="inputTextNote" name="inputTextNote">{!!$oneNotes['textNotes']!!}</div>
                    </div>
                    <div style="margin-bottom: 10px">
                        <span id="response" style="width: 100px; height: 100px;"></span></div>

                    <figure>

                        @foreach($allImage as $image)
                            <span style="width:25%;">
                                <!-- thumbnail image wrapped in a link -->
                                <a href="#img{{$loop->iteration}}">
                                    <img src="{{$image}}" width="25%" height="auto" style="border: 1px solid black; margin: 5px">
                                </a>

                                <!-- lightbox container hidden with CSS -->
                                <a href="#" class="lightbox" id="img{{$loop->iteration}}">
                                    <span style="background-image: url('{{$image}}')"></span>
                                </a>
                            </span>
                        @endforeach
                    </figure>
                </div>
            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->
    <script src="../js/addNote.js"></script>


@endsection
