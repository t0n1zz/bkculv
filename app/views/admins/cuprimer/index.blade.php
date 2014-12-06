<?php $title = "Kelola CU"; ?>

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
                    title="Tekan untuk menambah CU baru"
                    class="btn btn-default" href="{{ route('admins.cuprimer.create') }}"><i class="fa fa-plus"></i> Tambah CU</a>
                @if($is_wilayah)
                    <a type="button" data-toggle="tooltip" data-placement="top"
                       title="Tekan untuk menampilkan semua CU"
                       class="btn btn-default" href="{{ route('admins.cuprimer.index') }}"><i class="fa fa-refresh"></i> Semua CU</a>
                @endif
		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body tooltip-demo">
		    <div class="table-responsive">
		    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
		        <thead>
		            <tr>
		                <th>No.</th>
		                <th>Nama </th>
		                <th>Wilayah</th>
		                <th>Info CU</th>
		                <th>Tanggal Berdiri</th>
		                <th>Hapus</th>
		            </tr>
		        </thead>
		        <tbody>
		        <?php $i=0; ?>
		        @foreach($cuprimers as $cuprimer)
		        <?php $i++; ?>
		        <tr>
                    <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah informasi cu ini"
                            href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
                            >{{ $i; }}</a></td>

				    @if(!empty($cuprimer->name))
						<td><a data-toggle="tooltip" data-placement="top"
				                title="Tekan untuk mengubah informasi cu ini"
				                href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
				                >{{ $cuprimer->name }}</a></td>
				    @else
				    	<td><a data-toggle="tooltip" data-placement="top"
				                title="Tekan untuk mengubah informasi cu ini"
				                href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
				                >-</a></td>
				    @endif

					@if(!empty($cuprimer->wilayahcuprimer->name))
			        	<td><a data-toggle="tooltip" data-placement="top"
			                title="Tekan untuk mengubah wilayah cu ini"
			                href="#" class="modal1" name={{ $cuprimer->id }}
			                >{{ $cuprimer->wilayahcuprimer->name }}</a></td>
			        @else
						<td><a data-toggle="tooltip" data-placement="top"
			                title="Tekan untuk mengubah wilayah cu ini"
			                href="#" class="modal1" name={{ $cuprimer->id }}
			                >-</a></td>
			        @endif

			        @if(!empty($cuprimer->content))
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi cu ini"
                                href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
                                >{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $cuprimer->content),100) }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi cu ini"
                                href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
                                >-</a></td>
                    @endif

                    @if(!empty($cuprimer->ultah))
                        <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah tanggal berdiri cu ini"
                            href="#" class="modal3" name={{ $cuprimer->id }}
                            >{{ $cuprimer->ultah }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah tanggal berdiri cu ini"
                            href="#" class="modal3" name={{ $cuprimer->id }}
                            >-</a></td>
                    @endif

			        @if(!empty($cuprimer->id))
			            <td><button class="btn btn-default modal2"
		                    name="{{ $cuprimer->id }}"
		                    data-toggle="tooltip" data-placement="top" 
		                    title="Tekan untuk menghapus informasi cu ini" ><span
		                    class="glyphicon glyphicon-trash"></span></button></td>
		            @else
		                <td><button class="btn btn-default modal2"
                            name="{{ $cuprimer->id }}"
                            data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk menghapus informasi cu ini" disabled><span
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
                    <select class="form-control" name="wilayah">
                        <option >Pilih Wilayah Cu</option>
                        @foreach($wilayahcuprimers as $wilayahcuprimer)
                            <option value="{{ $wilayahcuprimer->id }}">{{ $wilayahcuprimer->name }}</option>
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
    <!-- /wilayah -->
    <!-- Hapus -->
    <div class="modal fade" id="modal2show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       {{ Form::open(array('route' => array('admins.cuprimer.destroy'), 'method' => 'delete')) }}
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Hapus CU</h4>
            </div>
            <div class="modal-body">
              <strong style="font-size: 16px">Menghapus informasi cu ini?</strong>
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
    <!-- ultah -->
    <div class="modal fade" id="modal3show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       {{ Form::open(array('route' => array('admins.cuprimer.update_berdiri'))) }}
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title ">Tanggal Berdiri CU</h4>
            </div>
            <div class="modal-body">
              <strong>Mengubah tanggal berdiri CU</strong>
              <br />
              <br />
                    <input type="text" name="id" value="" id="modal3id" hidden>
                    <div class="bfh-datepicker" data-name="ultah" data-date="" >
                        <input id="datepickers" type="text" class="datepicker" >
                    </div>
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
    <!-- /ultah -->
    <!-- /.modal -->

@stop