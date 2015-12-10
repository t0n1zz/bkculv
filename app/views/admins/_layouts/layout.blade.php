<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Puskopdit BKCU Kalimantan Admin Site </title>
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}">
    <!-- Bootstrap Core CSS -->
    {{ HTML::style('plugins/bootstrap/css/bootstrap.min.css') }}

            <!-- DataTables CSS -->
    {{ HTML::style('plugins/dataTables/bootstrap/dataTables.bootstrap.css') }}
    {{ HTML::style('plugins/dataTables/extension/Responsive/css/dataTables.responsive.css') }}
    {{ HTML::style('plugins/dataTables/extension/FixedHeader/css/dataTables.fixedheader.css') }}
    {{ HTML::style('plugins/dataTables/extension/ColVis/css/dataTables.colVis.css') }}
    {{ HTML::style('plugins/dataTables/extension/TableTools/css/dataTables.tableTools.css') }}

            <!-- Custom CSS -->
    {{ HTML::style('admin/AdminLTE.min.css') }}
    {{ HTML::style('admin/skin-blue.min.css') }}

            <!-- Custom Fonts -->
    {{ HTML::style('plugins/font-awesome/css/font-awesome.min.css') }}

            <!-- Bootstrap extended form CSS -->
    {{ HTML::style('plugins/BootstrapFormHelper/css/bootstrap-formhelpers.min.css') }}

    <style>
        td { white-space: nowrap; }
        div.DTTT { margin-bottom: 0.5em; float: right; }
        div.dataTables_wrapper { clear: both; }
    </style>

    {{ HTML::style('admin/mystyle.css') }}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="skin-blue layout-boxed">
<div class="wrapper">
    <!-- Header -->
    @include('admins._layouts.header')
            <!-- /Header -->

    <!-- sidebar -->
    @include('admins._layouts.sidebar')
            <!-- /sidebar -->

    <!-- content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /content -->

    <!-- footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.0
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; <?php echo date("Y") ?> <a href="#">Puskopdit BKCU Kalimantan</a>.</strong> All rights reserved.
    </footer>
    <!-- /footer -->
</div>

<!--modal photos-->
<div class="modal fade" id="modalphotoshow">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img class="pointer img-responsive img-rounded center-block" src="" id="modalimage"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"
                        >Kembali <i class="fa fa-fw fa-chevron-right"></i> </button>
            </div>
        </div>
    </div>
</div>
<!--/modal photos-->

{{ HTML::script('admin/jQuery/jQuery-2.1.3.min.js') }}

        <!-- Bootstrap Core JavaScript -->
{{ HTML::script('plugins/bootstrap/js/bootstrap.min.js') }}

        <!-- Custom Theme JavaScript -->
{{ HTML::script('admin/app.min.js') }}

        <!-- fastclick for touch browser -->
{{ HTML::script('plugins/fastclick/fastclick.min.js') }}


        <!-- DataTables JavaScript -->
{{ HTML::script('plugins/dataTables/jquery.dataTables.js') }}
{{ HTML::script('plugins/dataTables/bootstrap/dataTables.bootstrap.js') }}
{{ HTML::script('plugins/dataTables/extension/Responsive/js/dataTables.responsive.min.js') }}
{{ HTML::script('plugins/dataTables/extension/FixedHeader/js/dataTables.fixedHeader.min.js') }}
{{ HTML::script('plugins/dataTables/extension/ColVis/js/dataTables.ColVis.min.js') }}
{{ HTML::script('plugins/dataTables/extension/TableTools/js/dataTables.tableTools.min.js') }}

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        var table = $('#dataTables-example').dataTable({
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: -1 },
                { responsivePriority: 3, targets: -2 }
            ],
            pagingType : "full_numbers",
            autoWidth: false,
            stateSave : true,
            order : [[ 0, "asc" ]]
        });
    });
</script>

{{ HTML::script('plugins/BootstrapFormHelper/js/bootstrap-formhelpers.min.js') }}
{{ HTML::script('js/validator.min.js') }}
{{ HTML::script('js/myscript.js') }}

</body>
</html>

