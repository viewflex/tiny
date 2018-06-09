<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! $title !!}</title>

    <link href="https://f001.backblazeb2.com/file/tinyurl/css/app.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>


<div class="container">
    <div class="row">

        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">


                <div class="panel-heading">

                    &nbsp;&nbsp;
                    {{--@if ($prompt) {!! $prompt !!} @endif &nbsp;&nbsp; @if ($message) {!! $message !!}  @endif--}}
                    @if ($message) {!! $message !!} @else {!! $prompt !!} @endif

                </div>

                @if ($errors->any())
                    <div class="panel-heading">

                        <h3>Errors:</h3>
                        <ul  class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif


                <div class="panel-body">

                    <form class="form-horizontal" method="post" action="{{ $form_action }}" name="UrlEncoderForm">
                        {{ csrf_field() }}

                        {{ method_field('POST') }}

                        <div class="form-group">
                            <label for="url" class="col-sm-2 control-label">URL</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="url" name="url" value="" placeholder="Enter a new URL to shorten..." tabindex="1">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" name="action" value="save" tabindex="2" class="btn btn-primary">Save</button>
                            </div>
                        </div>

                    </form>

                </div>


            </div>
        </div>


    </div>
</div>


<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
