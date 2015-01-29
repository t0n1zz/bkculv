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
                <a type="button" accesskey="t" data-toggle="tooltip" data-placement="top"
                    title="Tekan untuk menambah CU baru"
                    class="btn btn-default" href="{{ route('admins.cuprimer.create') }}"><i class="fa fa-plus"></i> <u>T</u>ambah CU</a>
                @if($is_wilayah)
                    <a type="button" data-toggle="tooltip" data-placement="top"
                       title="Tekan untuk menampilkan semua CU" accesskey="e"
                       class="btn btn-default" href="{{ route('admins.cuprimer.index') }}"><i class="fa fa-refresh"></i> S<u>e</u>mua CU</a>
                @endif
		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body tooltip-demo">
		    <div class="table-responsive">
		    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
		        <thead>
		            <tr>
                        <th>No. BA</th>
		                <th>Nama </th>
		                <th>Wilayah</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>TP</th>
                        <th>Staf</th>
                        <th>Aplikasi</th>
		                <th>Tanggal Berdiri</th>
                        <th>Tanggal Bergabung</th>
		                <th>Hapus</th>
		            </tr>
		        </thead>
		        <tbody>
		        @foreach($cuprimers as $cuprimer)
		        <tr>
                    @if(!empty($cuprimer->no_ba))
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah informasi cu ini"
                               href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
                                    >{{ $cuprimer->no_ba }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah informasi cu ini"
                               href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
                                    >0</a></td>
                    @endif

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


                    @if(!empty($cuprimer->email))
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="{{ $cuprimer->email }}"
                               href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
                                    >{{ str_limit($cuprimer->email,20) }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah informasi cu ini"
                               href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
                                    >-</a></td>
                    @endif

                    @if(!empty($cuprimer->website))
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="{{ $cuprimer->website }}"
                               href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
                                    >{{ str_limit($cuprimer->website,15) }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah informasi cu ini"
                               href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
                                    >-</a></td>
                    @endif

                    @if(!empty($cuprimer->tp))
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah informasi cu ini"
                               href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
                                    >{{ $cuprimer->tp }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah informasi cu ini"
                               href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
                                    >0</a></td>
                    @endif

                    @if(!empty($cuprimer->staf))
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah informasi cu ini"
                               href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
                                    >{{ $cuprimer->staf }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah informasi cu ini"
                               href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
                                    >0</a></td>
                    @endif

                    @if(!empty($cuprimer->app))
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah informasi cu ini"
                               href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
                                    >{{ $cuprimer->app }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah informasi cu ini"
                               href="{{route('admins.cuprimer.edit', array($cuprimer->id))}}"
                                    >-</a></td>
                    @endif

                    @if(!empty($cuprimer->ultah))
                        <?php $date = new Date($cuprimer->ultah); ?>
                        <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah tanggal berdiri cu ini"
                            href="#" class="modal3" name={{ $cuprimer->id }}
                            ><i hidden="true">{{$cuprimer->ultah}}</i> {{  $date->format('d/n/Y') }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah tanggal berdiri cu ini"
                            href="#" class="modal3" name={{ $cuprimer->id }}
                            >-</a></td>
                    @endif

                    @if(!empty($cuprimer->bergabung))
                        <?php $date2 = new Date($cuprimer->bergabung); ?>
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah tanggal bergabung cu ini"
                               href="#" class="modal4" name={{ $cuprimer->id }}
                                    ><i hidden="true">{{$cuprimer->bergabung}}</i> {{  $date2->format('d/n/Y') }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah tanggal bergabung cu ini"
                               href="#" class="modal4" name={{ $cuprimer->id }}
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
                        <option disabled selected>Silahkan pilih Wilayah Cu</option>
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
    <!-- bergabung -->
    <div class="modal fade" id="modal4show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        {{ Form::open(array('route' => array('admins.cuprimer.update_bergabung'))) }}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title ">Tanggal Berdiri CU</h4>
                </div>
                <div class="modal-body">
                    <strong>Mengubah tanggal bergabung CU</strong>
                    <br />
                    <br />
                    <input type="text" name="id" value="" id="modal4id" hidden>
                    <div class="bfh-datepicker" data-name="bergabung" data-date="" >
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
    <!-- /bergabung -->
    <!-- /.modal -->

@stop