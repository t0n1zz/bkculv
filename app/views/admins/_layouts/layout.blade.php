<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Puskopdit BKCU Kalimantan Admin Site </title>
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}">
    <!-- Bootstrap Core CSS -->
    {{ HTML::style('admin/css/bootstrap.min.css') }}

    <!-- MetisMenu CSS -->
    {{ HTML::style('admin/css/plugins/metisMenu/metisMenu.min.css') }}

    <!-- DataTables CSS -->
    {{ HTML::style('admin/css/plugins/dataTables.bootstrap.css') }}

    <!-- Custom CSS -->
    {{ HTML::style('admin/css/sb-admin-2.css') }}

    <!-- Custom Fonts -->
    {{ HTML::style('admin/font-awesome-4.1.0/css/font-awesome.min.css') }}

    <!-- Bootstrap extended form CSS -->
    {{ HTML::style('BootstrapFormHelper/css/bootstrap-formhelpers.min.css') }}



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default  navbar-static-top " role="navigation" style="margin-bottom: 0">
            @include('admins._layouts.header')
			@include('admins._layouts.sidebar')
        </nav>
		<!-- Content -->
        <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">

            @yield('content')

            </div>
        </div>
        </div>
    </div>


    {{ HTML::script('admin/js/jquery-1.11.0.js') }}

    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('admin/js/bootstrap.min.js') }}

    <!-- Metis Menu Plugin JavaScript -->
    {{ HTML::script('admin/js/plugins/metisMenu/metisMenu.min.js') }}

    <!-- DataTables JavaScript -->
    {{ HTML::script('admin/js/plugins/dataTables/jquery.dataTables.js') }}
    {{ HTML::script('admin/js/plugins/dataTables/dataTables.bootstrap.js') }}

    <!-- Custom Theme JavaScript -->
    {{ HTML::script('admin/js/sb-admin-2.js') }}

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script> 

    {{ HTML::script('BootstrapFormHelper/js/bootstrap-formhelpers.min.js') }}
    {{ HTML::script('js/validator.min.js') }}
    {{ HTML::script('js/myscript.js') }}

</body>
</html>

