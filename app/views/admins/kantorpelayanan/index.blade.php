<?php $title = "Kelola Kantor Pelayanan"; ?>
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
                    title="Tekan untuk menambah pelayanan baru"
                    class="btn btn-default" href="{{ route('admins.kantorpelayanan.create') }}"><i class="fa fa-plus"></i> Tambah Kantor Pelayanan</a>
		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body tooltip-demo">
		    <div class="table-responsive">
		    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
		        <thead>
		            <tr>
		                <th>No.</th>
		                <th>Nama </th>
		                <th>Alamat</th>
		                <th>Kode Pos</th>
		                <th>Telepon</th>
		                <th>Fax</th>
		                <th>Email</th>
		                <th>Hapus</th>
		            </tr>
		        </thead>
		        <tbody>
		        <?php $i=0; ?>
		        @foreach($kantor_pelayanans as $kantor_pelayanan)
		        <?php $i++; ?>
		        <tr>
                    <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah informasi kantor pelayanan ini"
                            href="{{route('admins.kantorpelayanan.edit', array($kantor_pelayanan->id))}}"
                            >{{ $i; }}</a></td>

				    @if(!empty($kantor_pelayanan->name))
						<td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi kantor pelayanan ini"
				                href="{{route('admins.kantorpelayanan.edit', array($kantor_pelayanan->id))}}"
				                >{{ str_limit($kantor_pelayanan->name,50) }}</a></td>
				    @else
				    	<td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi kantor pelayanan ini"
				                href="{{route('admins.kantorpelayanan.edit', array($kantor_pelayanan->id))}}"
				                >-</a></td>
				    @endif

					@if(!empty($kantor_pelayanan->alamat))
			        	<td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi kantor pelayanan ini"
                                href="{{route('admins.kantorpelayanan.edit', array($kantor_pelayanan->id))}}"
                                >{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $kantor_pelayanan->alamat),50) }}</a></td>
			        @else
						<td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah informasi kantor pelayanan ini"
                               href="{{route('admins.kantorpelayanan.edit', array($kantor_pelayanan->id))}}"
                               >-</a></td>
			        @endif

			        @if(!empty($kantor_pelayanan->pos))
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi kantor pelayanan ini"
                                href="{{route('admins.kantorpelayanan.edit', array($kantor_pelayanan->id))}}"
                                >{{ $kantor_pelayanan->pos }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi kantor pelayanan ini"
                               href="{{route('admins.kantorpelayanan.edit', array($kantor_pelayanan->id))}}"
                               >-</a></td>
                    @endif

			        @if(!empty($kantor_pelayanan->telp))
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi kantor pelayanan ini"
                                href="{{route('admins.kantorpelayanan.edit', array($kantor_pelayanan->id))}}"
                                >{{ $kantor_pelayanan->telp }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi kantor pelayanan ini"
                               href="{{route('admins.kantorpelayanan.edit', array($kantor_pelayanan->id))}}"
                               >-</a></td>
                    @endif

                    @if(!empty($kantor_pelayanan->fax))
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi kantor pelayanan ini"
                                href="{{route('admins.kantorpelayanan.edit', array($kantor_pelayanan->id))}}"
                                >{{ $kantor_pelayanan->fax }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah informasi kantor pelayanan ini"
                               href="{{route('admins.kantorpelayanan.edit', array($kantor_pelayanan->id))}}"
                               >-</a></td>
                    @endif

                    @if(!empty($kantor_pelayanan->email))
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi kantor pelayanan ini"
                                href="{{route('admins.kantorpelayanan.edit', array($kantor_pelayanan->id))}}"
                                >{{ $kantor_pelayanan->email }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah informasi kantor pelayanan ini"
                               href="{{route('admins.kantorpelayanan.edit', array($kantor_pelayanan->id))}}"
                               >-</a></td>
                    @endif

			        @if(!empty($kantor_pelayanan->id))
			            <td><button class="btn btn-default modal2"
		                    name="{{ $kantor_pelayanan->id }}"
		                    data-toggle="tooltip" data-placement="top"
		                    title="Tekan untuk menghapus pelayanan ini" ><span
		                    class="glyphicon glyphicon-trash"></span></button></td>
		            @else
		                <td><button class="btn btn-default modal2"
                            name="{{ $kantor_pelayanan->id }}"
                            data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk menghapus pelayanan ini" disabled><span
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
   {{ Form::open(array('route' => array('admins.kantorpelayanan.destroy'), 'method' => 'delete')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Hapus Kantor Pelayanan</h4>
        </div>
        <div class="modal-body">
          <strong style="font-size: 16px">Menghapus kantor pelayanan ini?</strong>
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