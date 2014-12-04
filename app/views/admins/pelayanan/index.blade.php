<?php $title = "Kelola Pelayanan"; ?>
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
                    class="btn btn-default" href="{{ route('admins.pelayanan.create') }}"><i class="fa fa-plus"></i> Tambah Pelayanan</a>
		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body tooltip-demo">
		    <div class="table-responsive">
		    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
		        <thead>
		            <tr>
		                <th>No.</th>
		                <th>Nama </th>
		                <th>Content</th>
		                <th>Tanggal</th>
		                <th>Gambar</th>
		                <th>Hapus</th>
		            </tr>
		        </thead>
		        <tbody>
		        <?php $i=0; ?>
		        @foreach($pelayanans as $pelayanan)
		        <?php $i++; ?>
		        <tr>
                    <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah informasi pelayanan ini"
                            href="{{route('admins.pelayanan.edit', array($pelayanan->id))}}"
                            >{{ $i; }}</a></td>

				    @if(!empty($pelayanan->name))
						<td><a data-toggle="tooltip" data-placement="top"
				                title="Tekan untuk mengubah informasi pelayanan ini"
				                href="{{route('admins.pelayanan.edit', array($pelayanan->id))}}"
				                >{{ str_limit($pelayanan->name,50) }}</a></td>
				    @else
				    	<td><a data-toggle="tooltip" data-placement="top"
				                title="Tekan untuk mengubah informasi pelayanan ini"
				                href="{{route('admins.pelayanan.edit', array($pelayanan->id))}}"
				                >-</a></td>
				    @endif

					@if(!empty($pelayanan->content))
			        	<td><a data-toggle="tooltip" data-placement="top"
                                title="Tekan untuk mengubah informasi pelayanan ini"
                                href="{{route('admins.pelayanan.edit', array($pelayanan->id))}}"
                                >{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $pelayanan->content),200) }}</a></td>
			        @else
						<td><a data-toggle="tooltip" data-placement="top"
                               title="Tekan untuk mengubah informasi pelayanan ini"
                               href="{{route('admins.pelayanan.edit', array($pelayanan->id))}}"
                               >-</a></td>
			        @endif

                    @if(!empty($pelayanan->created_at ))
                        <td>{{ $pelayanan->created_at }}</td>
                    @else
                        <td>-</td>
                    @endif

			        @if(!empty($pelayanan->gambar) && is_file("images_artikel/{$pelayanan->gambar}"))
			        	<td>{{ HTML::image('images_artikel/'.$pelayanan->gambar, 'a picture', array('class' => 'img-responsive',
			        	'id' => 'tampilgambar', 'width' => '50')) }}</td>
			        @else
			        	<td>{{ HTML::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive',
			        	'id' => 'tampilgambar', 'width' => '50')) }}</td>
			        @endif

			        @if(!empty($pelayanan->id))
			            <td><button class="btn btn-default modal2"
		                    name="{{ $pelayanan->id }}"
		                    data-toggle="tooltip" data-placement="top"
		                    title="Tekan untuk menghapus pelayanan ini" ><span
		                    class="glyphicon glyphicon-trash"></span></button></td>
		            @else
		                <td><button class="btn btn-default modal2"
                            name="{{ $pelayanan->id }}"
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
   {{ Form::open(array('route' => array('admins.pelayanan.destroy'), 'method' => 'delete')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Hapus Pelayanan</h4>
        </div>
        <div class="modal-body">
          <strong style="font-size: 16px">Menghapus pelayanan ini?</strong>
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