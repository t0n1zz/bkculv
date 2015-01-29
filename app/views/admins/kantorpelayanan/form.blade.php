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
	<button type="submit" name="simpan" accesskey="s" class="btn btn-primary" data-toggle ='tooltip'
	    data-placement='top' title ='Menyimpan informasi kantor pelayanan' value="simpan"><i
                class="fa fa-save"></i> <u>S</u>impan</button>
    <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary" data-toggle ='tooltip'
    	    data-placement='top' title ='Menyimpan informasi kantor pelayanan dan memulai menambah kantor pelayanan baru'
            value="simpan"><i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>
	<a href="{{ route('admins.kantorpelayanan.index') }}" name="batal" accesskey="b" class="btn btn-danger" data-toggle ='tooltip'
	    data-placement='top' title ='Batal menyimpan informasi kantor pelayanan dan kembali ke halaman kelola kantor pelayanan'
        value="batal"><i class="fa fa-times"></i> <u>B</u>atal</a>
</div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="col-lg-12">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Nama</div>
              {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama kantor pelayanan',
              'required','min-length' => '5','data-error' => 'Nama wajib diisi dan minimal 5 karakter',
              'autocomplete'=>'off','autofocus'))}}
            </div>
            <div class="help-block with-errors"></div>
            {{ $errors->first('name', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <div class="col-lg-12">
        <div class="form-group">
           {{ Form::label('Alamat') }}
           {{ Form::textarea('alamat',null,array('class' => 'form-control','style' => 'height:200px',
           'required','min-length' => '10','data-error' => 'Alamat wajib diisi dan minimal 5 karakter')) }}
            <div class="help-block with-errors"></div>
           {{ $errors->first('alamat', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <div class="col-lg-12">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Kota/Kecamatan/Kelurahan</div>
              {{ Form::text('alamat2',null,array('class' => 'form-control',
                'placeholder' => 'Silahkan masukkan informasi kota/kecamatan/kelurahan kantor pelayanan',
                'autocomplete'=>'off'))}}
            </div>
            {{ $errors->first('alamat2', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <hr />
        <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Alamat Kode Pos</div>
              {{ Form::text('alamat3',null,array('class' => 'form-control',
              'placeholder' => 'Silahkan masukkan alamat kode pos','autocomplete'=>'off'))}}
            </div>
            {{ $errors->first('alamat3', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Kode Pos</div>
              {{ Form::text('pos',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan kode pos',
                'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
            </div>
            {{ $errors->first('pos', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Telepon</div>
              {{ Form::text('telp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan Masukkan nomor telepon',
                 'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
            </div>
            {{ $errors->first('telp', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Fax</div>
              {{ Form::text('fax',null,array('class' => 'form-control', 'placeholder' => 'Silahkan Masukkan nomor fax',
                'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
            </div>
            {{ $errors->first('fax', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <hr />
        <div class="col-lg-12">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Email</div>
              {{ Form::email('email',null,array('class' => 'form-control', 'placeholder' => 'Masukkan alamat email',
                            'data-error' => 'Alamat email anda salah','autocomplete'=>'off'))}}
            </div>
            <div class="help-block with-errors"></div>
            {{ $errors->first('email', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
    </div>