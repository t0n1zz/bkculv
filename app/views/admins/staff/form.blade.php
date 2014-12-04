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
	    data-placement='top' title ='Menyimpan informasi staff' value="simpan"><i class="fa fa-save"></i> Simpan</button>
    <button type="submit" name="simpan2" class="btn btn-primary" data-toggle ='tooltip'
    	    data-placement='top' title ='Menyimpan informasi staff dan memulai menambah staff baru' value="simpan"><i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Simpan dan buat baru</button>
	<button type="submit" name="batal" class="btn btn-danger" data-toggle ='tooltip'
	    data-placement='top' title ='Batal menyimpan informasi staff dan kembali ke halaman kelola staff' value="batal"><i class="fa fa-times"></i> Batal</button>
</div>
<!--/button-->
<div class="panel-body">
    <!--nama-->
    <div class="col-lg-10">
    <div class="form-group">
        {{ Form::label('Nama Staff') }}
        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama staff'))}}
        {{ $errors->first('name', '<p class="text-warning"><i>:message</i></p>') }}
    </div>
    </div>
    <!--/nama-->
    <!--jabatan-->
    <div class="col-lg-10">
    <div class="form-group">
        {{ Form::label('Jabatan') }}
        {{ Form::text('jabatan',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jabatan'))}}
        {{ $errors->first('jabatan', '<p class="text-warning"><i>:message</i></p>') }}
    </div>
    </div>
    <!--/jabatan-->
    <!--gambar-->
    <div class="col-lg-5">
    <div>
        {{ Form::label('Upload Gambar') }}
        <div class="thumbnail" >
        @if(!empty($staff->gambar))
        	{{ HTML::image('images_staff/'.$staff->gambar, 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar')) }}
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
    <!--tingkatan-->
    <div class="col-lg-4">
    <div class="form-group">
        {{ Form::label('Tingkatan') }}
        {{ Form::select('tingkat',array('0' => 'Pilih tingkatan staff', '1' => 'Pengurus', '2' => 'Pengawas', '3' => 'Manajemen'),null, array('class' => 'form-control')) }}
    </div>
    </div>
    <!--/tingkatan-->
</div>
</div>