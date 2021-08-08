@extends('headerAndFooter')

@section('main_content')

    <link rel="stylesheet" href="../css/addNote.css">
    <link rel="stylesheet" href="../css/getNote.css">
    <div class="contain">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div name="formsRegister" class="form-horizontal" >
                    {{ csrf_field() }}
                    <span class="heading">{{$oneNotes['name']}}</span>

                    <div class="form-group">
                        <div class="form-text-notes" id="inputTextNote" name="inputTextNote">{!!$oneNotes['text']!!}</div>
                    </div>
                    <div class="response-block">
                        <span id="response" ></span></div>

                    <figure>

                        @foreach($oneNotes->images as $image)
                            <span class="span-image">
                                <!-- thumbnail image wrapped in a link -->
                                <a href="#img{{$loop->iteration}}">
                                    <img src="{{Request::root()."/storage/".$image['path']}}" width="25%" height="auto" class="span-image-image">
                                </a>

                                <!-- lightbox container hidden with CSS -->
                                <a href="#" class="lightbox" id="img{{$loop->iteration}}">
                                    <span style="background-image: url('{{Request::root()."/storage/".$image['path']}}')"></span>
                                </a>
                            </span>
                        @endforeach
                    </figure>
                </div>
            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->


@endsection
