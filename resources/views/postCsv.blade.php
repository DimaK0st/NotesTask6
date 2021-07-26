@extends('headerAndFooter')

@section('main_content')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../css/addNote.css">
    <div class="container">
        <div class="row">

            <div class="col-md-offset-3 col-md-6">
                <form name="formsPostCsv" class="form-horizontal" enctype="multipart/form-data" action='/post/csv' method="post">
                    {{ csrf_field() }}
                    <span class="heading">Импорт заметок</span>

                    <div id="parentId">
                        <input required type="file" class="form-control pictures" name="importCsvFile" id="importCsvFile" placeholder="Photo"
                               accept="text/csv">
                    </div>

                    <br>
<br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Импортировать</button>
                    </div>


                </form>
            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->
    <script src="../js/addNote.js"></script>


@endsection
