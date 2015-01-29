<?php $title = "Kelola File"; ?>

@extends('admins._layouts.layout')

@section('content')
<!-- header -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><span class="fa fa-archive"></span> {{$title}}</h1>
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
		<div class="panel panel-default">
		    <div class="panel-heading tooltip-demo">
                <a type="button" data-toggle="tooltip" data-placement="top"
                    title="Tekan untuk menambah file baru" accesskey="t"
                    class="btn btn-default" href="{{ route('admins.download.create') }}"><i class="fa fa-plus"></i> <u>T</u>ambah File</a>
		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body tooltip-demo">
		    <div class="table-responsive">
		    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
		        <thead>
		            <tr>
		                <th>No.</th>
		                <th>Nama </th>
		                <th>Tanggal</th>
		                <th>Hapus</th>
		            </tr>
		        </thead>
		        <tbody>
		        <?php $i=0; ?>
		        @foreach($downloads as $download)
		        <?php $i++; ?>
		        <tr>
                    <td><a data-toggle="tooltip" data-placement="top"
                           title="Tekan untuk mengubah nama file ini"
                           href="#" class="modal3" name={{ $download->id }}
                           >{{ $i; }}</a></td>

				    @if(!empty($download->name))
						<td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah nama file ini"
                               href="#" class="modal3" name={{ $download->id }}
                               >{{ $download->name }}</a></td>
				    @else
				    	<td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah nama file ini"
                               href="#" class="modal3" name={{ $download->id }}
                               >-</a></td>
				    @endif

                    @if(!empty($download->created_at))
                        <?php $date = new Date($download->created_at); ?>
                        <td><i hidden="true">{{$download->created_at}}</i> {{  $date->format('d/n/Y') }}</td>
                    @else
                        <td>-</td>
                    @endif

			        @if(!empty($download->id))
			            <td><button class="btn btn-default modal2"
		                    name="{{ $download->id }}"
		                    data-toggle="tooltip" data-placement="top" 
		                    title="Tekan untuk menghapus file ini" ><span
		                    class="glyphicon glyphicon-trash"></span></button></td>
		            @else
		                <td><button class="btn btn-default modal2"
                            name="{{ $download->id }}"
                            data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk menghapus file ini" disabled><span
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

<!-- modal -->
<!-- ubah -->
<div class="modal fade" id="modal3show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
{{ Form::open(array('route' => array('admins.download.update'), 'method' => 'put')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title ">Ubah Nama File</h4>
        </div>
        <div class="modal-body">
          <strong>Mengubah nama file?</strong>
          <br />
          <br />
                <input type="text" name="id" value="" id="modal3id" hidden>
                {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan informasi pengumuman baru'))}}
           <br />
           <br />
        </div>
        <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-check"></i> Ok</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
   {{ Form::close() }}
</div>
<!-- /ubah -->
<!-- Hapus -->
<div class="modal fade" id="modal2show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   {{ Form::open(array('route' => array('admins.download.destroy'), 'method' => 'delete')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Hapus File</h4>
        </div>
        <div class="modal-body">
          <strong style="font-size: 16px">Menghapus file ini?</strong>
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
<!-- /.modal -->

@stop