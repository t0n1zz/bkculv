<?php $title = "Kelola Wilayah CU"; ?>
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
		    <form class="form-inline" role="form" action="tampil_artikel.php">
		        <div class="form-group">
		            <a type="button" data-toggle="tooltip" data-placement="top"
		                title="Tekan untuk menambah wilayah CU baru"
		                class="btn btn-default modal1" href="#"><i class="fa fa-plus"></i> Tambah Wilayah CU</a>
		        </div>
		    </form>
		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body tooltip-demo">
		    <div class="table-responsive">
		    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
		        <thead>
		            <tr>
		                <th>No.</th>
		                <th>Nama Wilayah </th>
		                <th>Jumlah CU</th>
		                <th>Hapus</th>
		            </tr>
		        </thead>
		        <tbody>
		        <?php $i=0; ?>
		        @foreach($wilayahcuprimers as $wilayah_cuprimer)
		        <?php $i++ ?>
		        <tr>
		        	<td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah nama wilayah CU"
                            href="#" class="modal3" name={{ $wilayah_cuprimer->id }}
                            >{{ $i }}</a></td>

				    @if(!is_null($wilayah_cuprimer->name))
                        <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah nama wilayah CU"
                            href="#" class="modal3" name={{ $wilayah_cuprimer->id }}
                            >{{ $wilayah_cuprimer->name }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah nama wilayah CU"
                            href="#" class="modal3" name={{ $wilayah_cuprimer->id }}
                            >-</a></td>
                    @endif

                    @if($wilayah_cuprimer->jumlah > 0)
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk melihat CU pada wilayah ini"
                                href="{{route('admins.cuprimer.index_wilayah', array($wilayah_cuprimer->id))}}"
                                >{{ $wilayah_cuprimer->jumlah }}</a></td>
                    @else
                        <td>{{ $wilayah_cuprimer->jumlah }}</td>
                    @endif

			        @if(!empty($wilayah_cuprimer->id))
			            <td><button class="btn btn-default modal2"
		                    name="{{ $wilayah_cuprimer->id }}"
		                    data-toggle="tooltip" data-placement="top"
		                    title="Tekan untuk menghapus wilayah CU ini" ><span
		                    class="glyphicon glyphicon-trash"></span></button></td>
		            @else
		                <td><button class="btn btn-default modal2"
                            name="{{ $wilayah_cuprimer->id }}"
                            data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk menghapus wilayah CU ini" disabled><span
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
   {{ Form::open(array('route' => array('admins.wilayahcuprimer.store'))) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title ">Tambah Wilayah CU</h4>
        </div>
        <div class="modal-body">
          <strong>Menambah wilayah CU</strong>
          <br />
          <br />
                <input type="text" name="id" value="" id="modal1id" hidden>
                {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama wilayah CU'))}}
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
   {{ Form::open(array('route' => array('admins.wilayahcuprimer.destroy'), 'method' => 'delete')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Hapus Wilayah CU</h4>
        </div>
        <div class="modal-body">
          <strong style="font-size: 16px">Menghapus wilayah CU ini?</strong>
          <blockquote>
            <p class="text-warning" style="font-size: 16px">
                <span class="fa fa-warning"
                ></span> Peringatan : anda harus memastikan tidak terdapat CU pada wilayah ini.
            </p>
          </blockquote>
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
{{ Form::open(array('route' => array('admins.wilayahcuprimer.update'), 'method' => 'put')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title ">Ubah Wilayah CU</h4>
        </div>
        <div class="modal-body">
          <strong>Mengubah wilayah CU</strong>
          <br />
          <br />
                <input type="text" name="id" value="" id="modal3id" hidden>
                {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama wilayah CU'))}}
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
<!-- /.modal -->
@stop