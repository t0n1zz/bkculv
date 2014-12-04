<?php $title = "Kelola Artikel"; ?>

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
                    title="Tekan untuk menambah artikel baru"
                    class="btn btn-default" href="{{ route('admins.artikel.create') }}"><i class="fa fa-plus"></i> Tambah Artikel</a>
                @if($is_kategori)
                    <a type="button" data-toggle="tooltip" data-placement="top"
                       title="Tekan untuk menampilkan semua artikel"
                       class="btn btn-default" href="{{ route('admins.artikel.index') }}"><i class="fa fa-refresh"></i> Semua Artikel</a>
                @endif
		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body tooltip-demo">
		    <div class="table-responsive">
		    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
		        <thead>
		            <tr>
		                <th>No.</th>
		                <th>Judul </th>
		                <th>Kategori</th>
		                <th>Penulis</th>
		                <th>Tanggal</th>
		                <th>Status</th>
		                <th>Artikel Pilihan</th>
		                <th>Gambar Utama</th>
		                <th>Hapus</th>
		            </tr>
		        </thead>
		        <tbody>
		        <?php $i=0; ?>
		        @foreach($artikels as $artikel)
		        <?php $i++; ?>
		        <tr>
                    <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah informasi artikel ini"
                            href="{{route('admins.artikel.edit', array($artikel->id))}}"
                            >{{ $i; }}</a></td>

				    @if(!empty($artikel->judul))
						<td><a data-toggle="tooltip" data-placement="top"
				                title="Tekan untuk mengubah informasi artikel ini"
				                href="{{route('admins.artikel.edit', array($artikel->id))}}"
				                >{{ str_limit($artikel->judul,50) }}</a></td>
				    @else
				    	<td><a data-toggle="tooltip" data-placement="top"
				                title="Tekan untuk mengubah informasi artikel ini"
				                href="{{route('admins.artikel.edit', array($artikel->id))}}"
				                >-</a></td>
				    @endif

					@if(!empty($artikel->kategoriartikel))
			        	<td><a data-toggle="tooltip" data-placement="top"
			                title="Tekan untuk mengubah kategori artikel ini"
			                href="#" class="modal3" name={{ $artikel->id }}
			                >{{ $artikel->kategoriartikel->name }}</a></td>
			        @else
						<td><a data-toggle="tooltip" data-placement="top"
			                title="Tekan untuk mengubah kategori artikel ini"
			                href="#" class="modal3" name={{ $artikel->id }}
			                >Tak Terkategori</a></td>
			        @endif

			        @if(!empty($artikel->admin->name ))
                        <td>{{ $artikel->admin->name }}</td>
                    @else
                        <td>-</td>
                    @endif

                    @if(!empty($artikel->created_at ))
                        <td>{{ $artikel->created_at }}</td>
                    @else
                        <td>-</td>
                    @endif

                    @if($artikel->status == 0)
                        <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah status penerbitan artikel ini"
                            href="#" class="modal1" name={{ $artikel->id }}
                            >Tidak terbit</a></td>
                    @elseif($artikel->status == 1)
                        <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah status penerbitan artikel ini"
                            href="#" class="modal1" name={{ $artikel->id }}
                            >Terbit</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah status penerbitan artikel ini"
                            href="#" class="modal1" name={{ $artikel->id }}
                            >-</a></td>
                    @endif

                    @if($artikel->pilihan == 0)
                        <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah artikel ini menjadi artikel pilihan"
                            href="#" class="modal4" name={{ $artikel->id }}
                            >Tidak</a></td>
                    @elseif($artikel->pilihan == 1)
                        <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah artikel ini menjadi artikel pilihan"
                            href="#" class="modal4" name={{ $artikel->id }}
                            >Iya</a></td>
                    @else
                        <td><a data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk mengubah artikel ini menjadi artikel pilihan"
                            href="#" class="modal4" name={{ $artikel->id }}
                            >-</a></td>
                    @endif

			        @if(!empty($artikel->gambar) && is_file("images_artikel/{$artikel->gambar}"))
			        	<td>{{ HTML::image('images_artikel/'.$artikel->gambar, 'a picture', array('class' => 'img-responsive',
			        	'id' => 'tampilgambar', 'width' => '50')) }}</td>
			        @else
			        	<td>{{ HTML::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive',
			        	'id' => 'tampilgambar', 'width' => '50')) }}</td>
			        @endif

			        @if(!empty($artikel->id))
			            <td><button class="btn btn-default modal2"
		                    name="{{ $artikel->id }}" 
		                    data-toggle="tooltip" data-placement="top" 
		                    title="Tekan untuk menghapus artikel ini" ><span
		                    class="glyphicon glyphicon-trash"></span></button></td>
		            @else
		                <td><button class="btn btn-default modal2"
                            name="{{ $artikel->id }}"
                            data-toggle="tooltip" data-placement="top"
                            title="Tekan untuk menghapus artikel ini" disabled><span
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
    <!-- status -->
    <div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       {{ Form::model($artikel, array('route' => array('admins.artikel.update_status'), 'method' => 'post')) }}
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title ">Status Artikel</h4>
            </div>
            <div class="modal-body">
              <strong>Mengubah status artikel</strong> 
              <br />
              <br />
                    <input type="text" name="id" value="" id="modal1id" hidden>
                    <select class="form-control" name="status">
                        <option >Pilih Status Publikasi Artikel</option>
                        <option >Tidak diterbitkan</option>
                        <option value="1" >Terbitkan</option>
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
    <!-- Hapus -->
    <div class="modal fade" id="modal2show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       {{ Form::model($artikel, array('route' => array('admins.artikel.destroy'), 'method' => 'delete')) }}
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Hapus Artikel</h4>
            </div>
            <div class="modal-body">
              <strong style="font-size: 16px">Menghapus artikel ini?</strong>
              <blockquote>
                <p class="text-warning" style="font-size: 16px">
                    <span class="fa fa-warning"
                    ></span> Peringatan : artikel yang sudah dihapus tidak bisa di kembalikan lagi
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
    <!-- kategori -->
    <div class="modal fade" id="modal3show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       {{ Form::model($artikel, array('route' => array('admins.artikel.update_kategori'), 'method' => 'post')) }}
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title ">Kategori Artikel</h4>
            </div>
            <div class="modal-body">
              <strong>Mengubah kategori artikel</strong> 
              <br />
              <br />
                    <input type="text" name="id" value="" id="modal3id" hidden>
                    <select class="form-control" name="kategori">
                        <option >Pilih Kategori Artikel</option>
                        @foreach($kategoriartikels as $kategoriartikel)
                            <option value="{{ $kategoriartikel->id }}">{{ $kategoriartikel->name }}</option>
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
    <!-- /kategori -->
    <!-- pilihan -->
    <div class="modal fade" id="modal4show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       {{ Form::model($artikel, array('route' => array('admins.artikel.update_pilihan'), 'method' => 'post')) }}
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title ">Artikel Pilihan</h4>
            </div>
            <div class="modal-body">
              <strong>Jadikan artikel ini artikel pilihan</strong>
              <br />
              <br />
                    <input type="text" name="id" value="" id="modal4id" hidden>
                    <select class="form-control" name="pilihan">
                        <option >Artikel pilihan?</option>
                        <option >Tidak</option>
                        <option value="1" >Iya</option>
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
    <!-- /pilihan -->
    <!-- /.modal -->

@stop