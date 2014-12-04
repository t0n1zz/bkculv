<?php $title = "Kelola Admin"; ?>

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
		        <div class="form-group">
		            <a type="button" data-toggle="tooltip" data-placement="top" 
		                title="Tekan untuk menambah CU baru"
		                class="btn btn-default" href="{{ route('admins.admin.create') }}"><i class="fa fa-plus"></i> Tambah Admin</a>
		        </div>
		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body tooltip-demo">
		    <div class="table-responsive">
		    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
		        <thead>
		            <tr>
		                <th>No.</th>
		                <th>Nama </th>
		                <th>Username</th>
		                <th>Hak Akses</th>
		                <th>Hapus</th>
		            </tr>
		        </thead>
		        <tbody>
		        <?php $i=0; ?>
		        @foreach($admins as $admin)
		        <?php $i++; ?>
		        <tr>
                    <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah data admin"
                            href="{{route('admins.admin.edit', array($admin->id))}}"
                            >{{ $i; }}</a></td>

				    @if(!empty($admin->name))
						<td><a data-toggle="tooltip" data-placement="top"
				                title="Tekan untuk mengubah data admin"
				                href="{{route('admins.admin.edit', array($admin->id))}}"
				                >{{ $admin->name }}</a></td>
				    @else
				    	<td><a data-toggle="tooltip" data-placement="top"
				                title="Tekan untuk mengubah data admin"
				                href="{{route('admins.admin.edit', array($admin->id))}}"
				                >-</a></td>
				    @endif

                    @if(!empty($admin->username))
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah data admin"
                                href="{{route('admins.admin.edit', array($admin->id))}}"
                                >{{ $admin->username }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah data admin"
                                href="{{route('admins.admin.edit', array($admin->id))}}"
                                >-</a></td>
                    @endif

                    @if(!empty($admin->id))
                        @if($admin->id == 1)
                            <td><button class="btn btn-default"
                                name="{{ $admin->id }}"
                                data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah hak askses admin ini" disabled><span
                                class="glyphicon glyphicon-eye-open"></span></button></td>
                        @else
                            <td><button class="btn btn-default modal1"
                                name="{{ $admin->id }}"
                                data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah hak askses admin ini" ><span
                                class="glyphicon glyphicon-eye-open"></span></button></td>
                        @endif
                    @else
                        <td><button class="btn btn-default"
                            name="{{ $admin->id }}"
                            data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah hak askses admin ini" disabled><span
                            class="glyphicon glyphicon-eye-open
                            "></span></button></td>
                    @endif


			        @if(!empty($admin->id))
			            @if($admin->id == 1)
			                <td><button class="btn btn-default"
                                name="{{ $admin->id }}"
                                data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk menghapus admin ini" disabled><span
                                class="glyphicon glyphicon-trash"></span></button></td>
			            @else
                            <td><button class="btn btn-default modal2"
                                name="{{ $admin->id }}"
                                data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk menghapus admin ini" ><span
                                class="glyphicon glyphicon-trash"></span></button></td>
                        @endif
		            @else
		                <td><button class="btn btn-default"
                            name="{{ $admin->id }}"
                            data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk menghapus admin ini" disabled><span
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
    <!-- wilayah -->
    <div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       {{ Form::open(array('route' => array('admins.cuprimer.update_wilayah'))) }}
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title ">Wilayah CU</h4>
            </div>
            <div class="modal-body">
              <strong>Mengubah wilayah cu</strong>
              <br />
              <br />
                    <input type="text" name="id" value="" id="modal1id" hidden>
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
    <!-- /wilayah -->
    <!-- Hapus -->
    <div class="modal fade" id="modal2show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       {{ Form::open(array('route' => array('admins.admin.destroy'), 'method' => 'delete')) }}
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Hapus Admin</h4>
            </div>
            <div class="modal-body">
              <strong style="font-size: 16px">Menghapus admin ini?</strong>
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