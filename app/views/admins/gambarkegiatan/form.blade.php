@if($errors->has())
    <div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span
                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <p>Oops terjadi kesalahan!</p>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

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
<!--button-->
<div class="panel-heading tooltip-demo">
	<button type="submit" name="simpan" class="btn btn-primary" data-toggle ='tooltip'
	    data-placement='top' title ='Menyimpan gambar kegiatan' value="simpan"><i class="fa fa-save"></i> Simpan</button>
    <button type="submit" name="simpan2" class="btn btn-primary" data-toggle ='tooltip'
    	    data-placement='top' title ='Menyimpan gambar kegiatan dan memulai menambah gambar baru' value="simpan"><i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Simpan dan buat baru</button>
	<button type="submit" name="batal" class="btn btn-danger" data-toggle ='tooltip'
	    data-placement='top' title ='Batal menyimpan gambar kegiatan dan kembali ke halaman kelola gambar kegiatan' value="batal"><i class="fa fa-times"></i> Batal</button>
</div>
<!--/button-->
<div class="panel-body">
    <!--nama-->
    <div class="col-lg-10">
    <div class="form-group">
        {{ Form::label('Nama Gambar Kegiatan') }}
        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama gambar kegiatan'))}}
        {{ $errors->first('name', '<p class="text-warning"><i>:message</i></p>') }}
    </div>
    </div>
    <!--/nama-->
    <!--gambar-->
    <div class="col-lg-5">
    <div>
        {{ Form::label('Upload Gambar') }}
        <div class="thumbnail" >
        @if(!empty($gambarkegiatan->gambar))
        	{{ HTML::image('images_kegiatan/'.$gambarkegiatan->gambar, 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar')) }}
        @else 
        	{{ HTML::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar')) }}
        @endif
             <div class="caption">
                {{ Form::file('gambar', array('onChange' => 'readURL(this)')) }}
             </div>
        </div>
        {{ $errors->first('gambar', '<p class="text-warning"><i>:message</i></p>') }}
    </div>
    </div>
    <!--/gambar-->
</div>
</div>