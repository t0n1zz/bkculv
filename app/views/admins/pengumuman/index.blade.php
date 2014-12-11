<?php $title = "Kelola Pengumuman"; ?>
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
		    <div class="panel-heading tooltip-demo">
                <a type="button" data-toggle="tooltip" data-placement="top"
                    title="Tekan untuk menambah pengumuman baru"
                    class="btn btn-default modal1" href="#"><i class="fa fa-plus"></i> Tambah Pengumuman</a>
		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body tooltip-demo">
		    <div class="table-responsive">
		    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
		        <thead>
		            <tr>
		                <th>No.</th>
		                <th>Pengumuman </th>
		                <th>Penulis</th>
		                <th>Urutan</th>
		                <th>Tanggal</th>
		                <th>Hapus</th>
		            </tr>
		        </thead>
		        <tbody>
		        <?php $i=0; ?>
		        @foreach($pengumumans as $pengumuman)
		        <?php $i++ ?>
		        <tr>
		        	<td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah informasi pengumuman ini"
                            href="#" class="modal3" name={{ $pengumuman->id }}
                            >{{ $i }}</a></td>

				    @if(!empty($pengumuman->name))
                        <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah informasi pengumuman ini"
                            href="#" class="modal3" name={{ $pengumuman->id }}
                            >{{ $pengumuman->name }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah informasi pengumuman ini"
                            href="#" class="modal3" name={{ $pengumuman->id }}
                            >-</a></td>
                    @endif

                    @if(!empty($pengumuman->admin->name))
                        <td>{{ $pengumuman->admin->name }}</td>
                    @else
                        <td>-</td>
                    @endif

                    @if(!empty($pengumuman->urutan))
                        <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah urutan pengumuman ini"
                            href="#" class="modal4" name={{ $pengumuman->id }}
                            >{{ $pengumuman->urutan }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah urutan pengumuman ini"
                            href="#" class="modal4" name={{ $pengumuman->id }}
                            >-</a></td>
                    @endif

                    @if(!empty($pengumuman->created_at ))
                        <?php $date = new Date($pengumuman->created_at); ?>
                        <td>{{  $date->format('d/n/Y') }}</td>
                    @else
                        <td>-</td>
                    @endif

			        @if(!empty($pengumuman->id))
			            <td><button class="btn btn-default modal2"
		                    name="{{ $pengumuman->id }}"
		                    data-toggle="tooltip" data-placement="top"
		                    title="Tekan untuk menghapus pengumuman ini" ><span
		                    class="glyphicon glyphicon-trash"></span></button></td>
		            @else
		                <td><button class="btn btn-default modal2"
                            name="{{ $pengumuman->id }}"
                            data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk menghapus pengumuman ini" disabled><span
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
<!-- tambah -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   {{ Form::open(array('route' => array('admins.pengumuman.store'))) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title ">Tambah Pengumuman</h4>
        </div>
        <div class="modal-body">
          <strong>Menambah pengumuman baru</strong>
          <br />
          <br />
              <?php
                if(Auth::check()) { $id = Auth::user()->getId();}
                $urutan = Pengumuman::count();
              ?>
              <input type="text" name="penulis" value="{{ $id }}" hidden>
              <input type="text" name="urutan" value="{{$urutan + 1}}"  hidden>
              <input type="text" name="id" value="" id="modal1id" hidden>
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
<!-- /tambah -->
<!-- Hapus -->
<div class="modal fade" id="modal2show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   {{ Form::open(array('route' => array('admins.pengumuman.destroy'), 'method' => 'delete')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Hapus Pengumuman</h4>
        </div>
        <div class="modal-body">
          <strong style="font-size: 16px">Menghapus pengumuman ini?</strong>
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
<!-- ubah -->
<div class="modal fade" id="modal3show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
{{ Form::open(array('route' => array('admins.pengumuman.update'), 'method' => 'put')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title ">Ubah Pengumuman</h4>
        </div>
        <div class="modal-body">
          <strong>Mengubah pengumuman?</strong>
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
<!-- ubah urutan -->
<div class="modal fade" id="modal4show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
{{ Form::open(array('route' => array('admins.pengumuman.update_urutan'))) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title ">Ubah Urutan Pengumuman</h4>
        </div>
        <div class="modal-body">
          <strong>Mengubah urutan pengumuman?</strong>
          <br />
          <br />
                <input type="text" name="id" value="" id="modal4id" hidden>
                <select class="form-control" name="urutan">
                    <option >Pilih Urutan </option>
                    <?php $i=0; ?>
                    @foreach($pengumumans as $pengumuman)
                        <?php $i++; ?>
                        <option value="{{ $i}}">{{ $i }}</option>
                    @endforeach
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
<!-- /ubah urutan -->
<!-- /.modal -->
@stop