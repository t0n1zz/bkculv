
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Puskopdit BKCU Kalimantan Admin Site -- Login</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
    <!-- Bootstrap Core CSS -->
    {{ HTML::style('admin/css/bootstrap.min.css') }}

    <!-- Custom Fonts -->
    {{ HTML::style('admin/font-awesome-4.1.0/css/font-awesome.min.css') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css"> 
        body{
            background: url(../images/wallpaper-1331538.jpg) no-repeat center center fixed;
            background-image: url(../images/wallpaper-1331538.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            height: 100%;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
            <h1 style="text-align: center; color:#FFFFFF;"><b>Puskopdit BCKU Kalimantan</b></h1>
            </div>  
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-primary" style="margin-top: 0px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Silahkan Login</h3>
                    </div>
                    <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif
                    @if(Session::has('errormessage'))
                        <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <p>{{ Session::get('errormessage') }}</p>
                        </div>
                    @endif
                    @if($errors->has())
                        <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span
                                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <p>Oops terjadi kesalahan!</p>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    {{ Form::open(array('route' => array('admins.login.post'), 'files' => true)) }}
                        <fieldset>
                            <div class="form-group">
                                {{ Form::text('username',null,array('class' => 'form-control', 'placeholder' => 'Username', 'autofocus'))}}
                                {{ $errors->first('username', '<p class="text-warning"><i>:message</i></p>') }}
                            </div>
                            <div class="form-group">
                                {{ Form::password('password',array('class' => 'form-control', 'placeholder' => 'Password'))}}
                                {{ $errors->first('password', '<p class="text-warning"><i>:message</i></p>') }}
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-lg btn-primary btn-block"
                                    name="submit"><i class="fa fa-sign-in fa-fw"></i>Login</button>
                        </fieldset>
                    {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- jQuery Version 1.11.0 -->
    {{ HTML::script('admin/js/jquery-1.11.0.js') }}

    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('admin/js/bootstrap.min.js') }}
</body>

</html>
