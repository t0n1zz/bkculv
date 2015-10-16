<?php $title = "Kelola Saran atau Kritik"; ?>
@extends('admins._layouts.layout')

@section('content')
<!-- header -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-archive"></i> {{$title}}</h1>
    </div>
</div>
<!-- /header -->
<div class="row">
    <div class="col-lg-12 ">
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
                    {{ $error }}
                @endforeach
            </div>
        @endif
		<div class="panel panel-default">
		    <!-- /.panel-heading -->
		    <div class="panel-body tooltip-demo">
		    <div class="table-responsive">
		    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
		        <thead>
		            <tr>
		                <th>No.</th>
		                <th>Nama </th>
		                <th>Saran dan Kritik</th>
		                <th>Tanggal</th>
                        <th>Hapus</th>
		            </tr>
		        </thead>
		        <tbody>
		        <?php $i=0; ?>
		        @foreach($sarans as $saran)
		        <?php $i++ ?>
		        <tr>
		        	<td>{{ $i }}</td>

				    @if(!empty($saran->name))
                        <td>{{ $saran->name }}</td>
                    @else
                        <td>-</td>
                    @endif

                    @if(!empty($saran->content))
                        <td>{{ $saran->content }}</td>
                    @else
                        <td>-</td>
                    @endif

                    @if(!empty($saran->created_at ))
                        <?php $date = new Date($saran->created_at); ?>
                        <td><i hidden="true">{{$saran->created_at}}</i> {{  $date->format('d/n/Y') }}</td>
                    @else
                        <td>-</td>
                    @endif

                    @if(!empty($saran->id))
                        <td><button class="btn btn-default modal2"
                                    name="{{ $saran->id }}"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Tekan untuk menghapus saran atau kritik ini" ><span
                                        class="glyphicon glyphicon-trash"></span></button></td>
                    @else
                        <td><button class="btn btn-default modal2"
                                    name="{{ $saran->id }}"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Tekan untuk menghapus saran atau kritik ini" disabled><span
                                        class="glyphicon glyphicon-trash"></span></button></td>
                    @endif
		        </tr>
				@endforeach

		        </tbody>
		    </table>
		    </div>
		    </div>
		    <!-- /.panel-body -->
		</div>
	</div>
</div>


<!-- Hapus -->
<div class="modal fade" id="modal2show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.saran.destroy'), 'method' => 'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Hapus Saran atau Kritik</h4>
            </div>
            <div class="modal-body">
                <strong style="font-size: 16px">Menghapus saran atau kritik ini?</strong>
                <input type="text" name="id" value="" id="modal2id" hidden>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-check"></i> Ok</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<!-- /Hapus -->
@stop