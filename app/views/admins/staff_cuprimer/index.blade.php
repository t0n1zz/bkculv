<?php $title = "Kelola Staff CU"; ?>
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
		                title="Tekan untuk menambah staff baru"
		                class="btn btn-default" href="{{ route('admins.staff_cuprimer.create') }}"><i class="fa fa-plus"></i> Tambah Staff</a>
		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body tooltip-demo">
		    <div class="table-responsive">
		    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
		        <thead>
		            <tr>
		                <th>No.</th>
		                <th>Nama </th>
		                <th>Jabatan</th>
		                <th>CU</th>
		                <th>Tingkat</th>
		                <th>Gambar</th>
		                <th>Hapus</th>
		            </tr>
		        </thead>
		        <tbody>
		        <?php $i=0; ?>
		        @foreach($staffs as $staff)
		        <?php $i++; ?>
		        <tr>
                    <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah informasi staff ini"
                            href="{{route('admins.staff_cuprimer.edit', array($staff->id))}}"
                            >{{ $i; }}</a></td>

				    @if(!empty($staff->name))
						<td><a data-toggle="tooltip" data-placement="top"
				                title="Tekan untuk mengubah informasi staff ini"
				                href="{{route('admins.staff_cuprimer.edit', array($staff->id))}}"
				                >{{ $staff->name}}</a></td>
				    @else
				    	<td><a data-toggle="tooltip" data-placement="top"
				                title="Tekan untuk mengubah informasi staff ini"
				                href="{{route('admins.staff_cuprimer.edit', array($staff->id))}}"
				                >-</a></td>
				    @endif

                    @if(!empty($staff->jabatan))
                         <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi jabatan staff ini"
                                href="#" class="modal3" name={{ $staff->id }}
                                >{{ $staff->jabatan }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi jabatan staff ini"
                                href="#" class="modal3" name={{ $staff->id }}
                                >-</a></td>
                    @endif

                    @if(!empty($staff->cuprimer->name))
                         <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi jabatan staff ini"
                                href="#" class="modal3" name={{ $staff->id }}
                                >{{ $staff->cuprimer->name }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi jabatan staff ini"
                                href="#" class="modal3" name={{ $staff->id }}
                                >-</a></td>
                    @endif

                    @if(!empty($staff->tingkat))
                         <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi jabatan staff ini"
                                href="#" class="modal3" name={{ $staff->id }}
                                >{{ $staff->tingkat }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi jabatan staff ini"
                                href="#" class="modal3" name={{ $staff->id }}
                                >-</a></td>
                    @endif

			        @if(!empty($staff->gambar) && is_file("images_cu/{$staff->gambar}"))
			        	<td>{{ HTML::image('images_cu/'.$staff->gambar, 'a picture', array('class' => 'img-responsive',
			        	'id' => 'tampilgambar', 'width' => '50')) }}</td>
			        @else
			        	<td>{{ HTML::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive',
			        	'id' => 'tampilgambar', 'width' => '50')) }}</td>
			        @endif

			        @if(!empty($staff->id))
			            <td><button class="btn btn-default modal2"
		                    name="{{ $staff->id }}"
		                    data-toggle="tooltip" data-placement="top"
		                    title="Tekan untuk menghapus staff ini" ><span
		                    class="glyphicon glyphicon-trash"></span></button></td>
		            @else
		                <td><button class="btn btn-default modal2"
                            name="{{ $staff->id }}"
                            data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk menghapus staff ini" disabled><span
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
<!-- jabatan -->
<div class="modal fade" id="modal3show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
{{ Form::open(array('route' => array('admins.staff.update_jabatan'), 'method' => 'post')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title ">Ubah Jabatan</h4>
        </div>
        <div class="modal-body">
          <strong>Mengubah jabatan staff</strong>
          <br />
          <br />
                <input type="text" name="id" value="" id="modal3id" hidden>
                {{ Form::text('jabatan',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jabatan staff ini'))}}
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
<!-- /jabatan -->
<!-- Hapus -->
<div class="modal fade" id="modal2show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   {{ Form::open(array('route' => array('admins.staff.destroy'), 'method' => 'delete')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Hapus Staff</h4>
        </div>
        <div class="modal-body">
          <strong style="font-size: 16px">Menghapus staff ini?</strong>
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
    <!-- status -->
    <div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       {{ Form::open( array('route' => array('admins.staff.update_tingkat'), 'method' => 'post')) }}
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title ">Ubah Tingkat</h4>
            </div>
            <div class="modal-body">
              <strong>Mengubah tingkatan</strong>
              <br />
              <br />
                    <input type="text" name="id" value="" id="modal1id" hidden>
                    <select class="form-control" name="tingkat">
                        <option >Pilih Tingkatan</option>
                        <option value="1" >Pengurus</option>
                        <option value="2" >Pengawas</option>
                        <option value="3" >Manajemen</option>
                    </select>
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
    <!-- /status -->
@stop