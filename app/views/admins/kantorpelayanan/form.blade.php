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
	    data-placement='top' title ='Menyimpan informasi kantor pelayanan' value="simpan"><i class="fa fa-save"></i> Simpan</button>
    <button type="submit" name="simpan2" class="btn btn-primary" data-toggle ='tooltip'
    	    data-placement='top' title ='Menyimpan informasi kantor pelayanan dan memulai menambah kantor pelayanan baru' value="simpan"><i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Simpan dan buat baru</button>
	<button type="submit" name="batal" class="btn btn-danger" data-toggle ='tooltip'
	    data-placement='top' title ='Batal menyimpan informasi kantor pelayanan dan kembali ke halaman kelola kantor pelayanan' value="batal"><i class="fa fa-times"></i> Batal</button>
</div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="col-lg-12">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Nama</div>
              {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama kantor pelayanan'))}}
            </div>
            {{ $errors->first('name', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        </div>
        <div class="col-lg-12">
        <div class="form-group">
           {{ Form::label('Alamat') }}
           {{ Form::textarea('alamat',null,array('class' => 'form-control','style' => 'height:200px')) }}
           {{ $errors->first('alamat', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        </div>
        <div class="col-lg-12">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Kota/Kecamatan/Kelurahan</div>
              {{ Form::text('alamat2',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan informasi kota/kecamatan/kelurahan kantor pelayanan'))}}
            </div>
            {{ $errors->first('alamat2', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        </div>
        <hr />
        <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Alamat Kode Pos</div>
              {{ Form::text('alamat3',null,array('class' => 'form-control',
                            'placeholder' => 'Silahkan masukkan alamat kode pos'))}}
            </div>
            {{ $errors->first('alamat3', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        </div>
        <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Kode Pos</div>
              {{ Form::text('pos',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan kode pos',
                            'onKeyPress' => 'return isNumberKey(event)'))}}
            </div>
            {{ $errors->first('pos', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        </div>
        <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Telepon</div>
              {{ Form::text('telp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan Masukkan nomor telepon'))}}
            </div>
            {{ $errors->first('telp', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        </div>
        <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Fax</div>
              {{ Form::text('fax',null,array('class' => 'form-control', 'placeholder' => 'Silahkan Masukkan nomor fax'))}}
            </div>
            {{ $errors->first('fax', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        </div>
        <hr />
        <div class="col-lg-12">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Email</div>
              {{ Form::text('email',null,array('class' => 'form-control', 'placeholder' => 'Masukkan alamat email'))}}
            </div>
            {{ $errors->first('email', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        </div>
    </div>