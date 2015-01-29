@if($errors->has())
    <div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span
                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Oops terjadi kesalahan!</strong>
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
	    data-placement='top' title ='Menyimpan file' value="simpan"><i class="fa fa-save"></i> <u>S</u>impan</button>
    <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary" data-toggle ='tooltip'
    	    data-placement='top' title ='Menyimpan file dan memulai menambah file baru' value="simpan"><i
                class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>
	<a href="{{ route('admins.download.index') }}" name="batal" accesskey="b" class="btn btn-danger" data-toggle ='tooltip'
	    data-placement='top' title ='Batal menyimpan file dan kembali ke halaman kelola download' value="batal"><i
                class="fa fa-times"></i> <u>B</u>atal</a>
</div>
<!--/button-->
<div class="panel-body">
    <!--nama-->
    <div class="col-lg-10">
    <div class="form-group">
        {{ Form::label('Nama File') }}
        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama file',
            'required','min-length' => '5','max-length' => '100',
            'data-error' => 'Nama wajib diisi dan minimal 5 karakter dengan maksimal 100 karakter',
            'autocomplete'=>'off','autofocus'))}}
        <div class="help-block with-errors"></div>
        {{ $errors->first('name', '<p class="text-warning">:message</p>') }}
    </div>
    </div>
    <!--/nama-->
    <!--upload-->
    <div class="col-lg-5">
        {{ Form::label('Upload File') }}
        {{ Form::file('upload') }}
    </div>
    <!--/upload-->
</div>
</div>

