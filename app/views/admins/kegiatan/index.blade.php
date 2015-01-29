<?php $title = "Kelola Kegiatan"; ?>
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
                    title="Tekan untuk menambah kegiatan baru" accesskey="t"
                    class="btn btn-default" href="{{ route('admins.kegiatan.create') }}"><i class="fa fa-plus"></i> <u>T</u>ambah Kegiatan</a>
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
		                <th>Tempat</th>
		                <th>Sasaran</th>
		                <th>Tanggal Dimulai</th>
		                <th>Tanggal Selesai</th>
		                <th>Penulis</th>
		                <th>Hapus</th>
		            </tr>
		        </thead>
		        <tbody>
		        <?php $i=0; ?>
		        @foreach($kegiatans as $kegiatan)
		        <?php $i++; ?>
		        <tr>
                    <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah informasi kegiatan ini"
                            href="{{route('admins.kegiatan.edit', array($kegiatan->id))}}"
                            >{{ $i; }}</a></td>

				    @if(!empty($kegiatan->name))
						<td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi kegiatan ini"
				                href="{{route('admins.kegiatan.edit', array($kegiatan->id))}}"
				                >{{ $kegiatan->name }}</a></td>
				    @else
				    	<td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi kegiatan ini"
				                href="{{route('admins.kegiatan.edit', array($kegiatan->id))}}"
				                >-</a></td>
				    @endif

					@if(!empty($kegiatan->wilayah))
                         <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi kegiatan ini"
                                href="{{route('admins.kegiatan.edit', array($kegiatan->id))}}"
                                >{{ $kegiatan->wilayah }}</a></td>
			        @else
						<td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah informasi kegiatan ini"
                               href="{{route('admins.kegiatan.edit', array($kegiatan->id))}}"
                               >-</a></td>
			        @endif

			        @if(!empty($kegiatan->tempat))
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi kegiatan ini"
                                href="{{route('admins.kegiatan.edit', array($kegiatan->id))}}"
                                >{{ $kegiatan->tempat }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi kegiatan ini"
                               href="{{route('admins.kegiatan.edit', array($kegiatan->id))}}"
                               >-</a></td>
                    @endif

			        @if(!empty($kegiatan->sasaran))
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi kegiatan ini"
                                href="{{route('admins.kegiatan.edit', array($kegiatan->id))}}"
                                >{{ $kegiatan->sasaran }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi kegiatan ini"
                               href="{{route('admins.kegiatan.edit', array($kegiatan->id))}}"
                               >-</a></td>
                    @endif

                    @if(!empty($kegiatan->tanggal))
                        <?php $date = new Date($kegiatan->tanggal); ?>
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah tanggal mulai kegiatan ini"
                               href="#" class="modal3" name={{ $kegiatan->id }}
                                    ><i hidden="true">{{$kegiatan->tanggal}}</i> {{  $date->format('d/n/Y') }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah tanggal berdiri cu ini"
                               href="#" class="modal3" name={{ $cuprimer->id }}
                                    >-</a></td>
                    @endif

                     @if(!empty($kegiatan->tanggal2))
                        <?php $date2 = new Date($kegiatan->tanggal2); ?>
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah tanggal selesai kegiatan ini"
                               href="#" class="modal4" name={{ $kegiatan->id }}
                                    ><i hidden="true">{{$kegiatan->tanggal2}}</i> {{ $date2->format('d/n/Y') }}</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah tanggal bergabung cu ini"
                               href="#" class="modal4" name={{ $cuprimer->id }}
                                    >-</a></td>
                    @endif

                    @if(!empty($kegiatan->admin->name))
                        <td>{{ $kegiatan->admin->name }}</td>
                    @else
                        <td>-</td>
                    @endif


			        @if(!empty($kegiatan->id))
			            <td><button class="btn btn-default modal2"
		                    name="{{ $kegiatan->id }}"
		                    data-toggle="tooltip" data-placement="top"
		                    title="Tekan untuk menghapus kegiatan ini" ><span
		                    class="glyphicon glyphicon-trash"></span></button></td>
		            @else
		                <td><button class="btn btn-default modal2"
                            name="{{ $kegiatan->id }}"
                            data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk menghapus kegiatan ini" disabled><span
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
   {{ Form::open(array('route' => array('admins.kegiatan.destroy'), 'method' => 'delete')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Hapus Kegiatan</h4>
        </div>
        <div class="modal-body">
          <strong style="font-size: 16px">Menghapus kegiatan ini?</strong>
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
<!-- mulai -->
<div class="modal fade" id="modal3show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.kegiatan.update_mulai'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title ">Tanggal Mulai Kegiatan</h4>
            </div>
            <div class="modal-body">
                <strong>Mengubah tanggal mulai kegiatan</strong>
                <br />
                <br />
                <input type="text" name="id" value="" id="modal3id" hidden>
                <div class="bfh-datepicker" data-name="tanggal" data-date="" >
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
<!-- /mulai -->
<!-- selesai -->
<div class="modal fade" id="modal4show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.kegiatan.update_selesai'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title ">Tanggal Selesai Kegiatan</h4>
            </div>
            <div class="modal-body">
                <strong>Mengubah tanggal selesai kegiatan</strong>
                <br />
                <br />
                <input type="text" name="id" value="" id="modal4id" hidden>
                <div class="bfh-datepicker" data-name="tanggal2" data-date="" >
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
<!-- /selesai -->
@stop