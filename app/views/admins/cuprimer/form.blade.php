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
	<button type="submit" name="simpan" accesskey="s" class="btn btn-primary" data-toggle ='tooltip' accesskey="s"
	    data-placement='top' title ='Menyimpan informasi CU' value="simpan"><i class="fa fa-save"></i> <u>S</u>impan</button>
    <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary" data-toggle ='tooltip'
    	    data-placement='top' title ='Menyimpan informasi CU dan memulai menambah CU baru' value="simpan"><i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>
	<a href="{{ route('admins.cuprimer.index') }}" name="batal" accesskey="b" class="btn btn-danger" data-toggle ='tooltip'
	    data-placement='top' title ='Batal menyimpan informasi CU dan kembali ke halaman kelola CU' value="batal"><i class="fa fa-times"></i> <u>B</u>atal</a>
</div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="col-lg-6">
            {{ Form::label('Logo') }}
            <div class="thumbnail" >
                @if(!empty($cuprimer->logo))
                    {{ HTML::image('images_cu/'.$cuprimer->logo, 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '100')) }}
                @else
                    {{ HTML::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar2', 'width' => '100')) }}
                @endif
                <div class="caption">
                    {{ Form::file('logo', array('onChange' => 'readURL2(this)')) }}
                </div>
            </div>
            {{ $errors->first('logo', '<p class="text-warning">:message</p>') }}
            {{ $errors->first('gambar', '<p class="text-warning">:message</p>') }}
            <div class="form-group">
                {{ Form::label('Nama') }}
                {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama cu',
                    'required','min-length' => '5','data-error' => 'Nama wajib diisi dan minimal 5 karakter','autocomplete'=>'off',
                    'autofocus'))}}
                <div class="help-block with-errors"></div>
                {{ $errors->first('name', '<p class="text-warning">:message</p>') }}
            </div>
            <div class="form-group">
                {{ Form::label('No. BA') }}
                {{ Form::text('no_ba',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor anggota',
                    'onKeyPress' => 'return isNumberKey(event)','data-error' => 'No. Anggota wajib diisi',
                    'autocomplete'=>'off'))}}
                <div class="help-block with-errors"></div>
                {{ $errors->first('no_ba', '<p class="text-warning">:message</p>') }}
            </div>
            <!--wilayah-->
            <div class="form-group">
                {{ Form::label('Wilayah') }}
                <select class="form-control" onChange="changeFunc(value);" name="wilayah">
                    <option value="" selected disabled>Silahkan pilih Wilayah</option>
                    @foreach($wilayahcuprimers as $wilayahcuprimer)
                        <option value="{{ $wilayahcuprimer->id }}"
                        @if(!empty($cuprimer->wilayah))
                            @if($cuprimer->wilayah == $wilayahcuprimer->id)
                                {{ "selected" }}
                                    @endif
                                @endif
                                >{{ $wilayahcuprimer->name }}</option>
                    @endforeach
                    <option value="tambah" >Tambah Wilayah Baru</option>
                </select>
            </div>
            <!--/wilayah-->
            <!--wilayah baru-->
            <div class="form-group" id="pilihan" style="display:none;">
                {{ Form::label('Wilayah Baru') }}
                {{ Form::text('wilayah_baru',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan wilayah baru',
                    'autocomplete'=>'off'))}}
            </div>
            <!--/wilayah baru-->
            <div class="form-group">
                {{ Form::label('No. Badan Hukum') }}
                {{ Form::text('badan_hukum',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor badan hukum',
                    'autocomplete'=>'off'))}}
            </div>
            <div class="form-group">
                {{ Form::label('No. Telepon') }}
                {{ Form::text('telp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor telepon',
                        'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
            </div>
            <div class="form-group">
                {{ Form::label('No. Handphone') }}
                {{ Form::text('hp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor handphone',
                        'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
            </div>
            <div class="form-group">
                {{ Form::label('Kode Pos') }}
                {{ Form::text('pos',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan kode pos',
                        'onKeyPress' => 'return isNumberKey(event)'))}}
            </div>
            <div class="form-group">
                {{ Form::label('Tempat Pelayanan') }}
                {{ Form::text('tp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah tempat pelayanan',
                        'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
            </div>
            <div class="form-group">
                {{ Form::label('Manajemen/Staf') }}
                {{ Form::text('staf',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah manajemen/staf',
                        'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('Gambar') }}
            <div class="thumbnail" >
                @if(!empty($cuprimer->gambar))
                    {{ HTML::image('images_cu/'.$cuprimer->gambar, 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
                @else
                    {{ HTML::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
                @endif
                <div class="caption">
                    {{ Form::file('gambar', array('onChange' => 'readURL(this)')) }}
                </div>
            </div>
            <!--Tanggal berdiri-->
            <div class="form-group">
                {{ Form::label('Tanggal Berdiri') }}
                <div class="bfh-datepicker" data-name="ultah"
                     data-date="<?php
                     if(!empty($cuprimer)){
                         $timestamp = strtotime($cuprimer->ultah);
                         $tanggal = date('m/d/Y',$timestamp);
                         echo $tanggal;
                     }
                     ?>">
                    <input id="datepickers" type="text" class="datepicker" >
                </div>
            </div>
            <!--/tanggal berdiri-->
            <!--Tanggal bergabung-->
            <div class="form-group">
                {{ Form::label('Tanggal Bergabung') }}
                <div class="bfh-datepicker" data-name="bergabung"
                     data-min="<?php
                     if(!empty($tanggal))
                         echo $tanggal;
                     ?>"
                     data-date="<?php
                     if(!empty($cuprimer)){
                         $timestamp2 = strtotime($cuprimer->bergabung);
                         $tanggal2 = date('m/d/Y',$timestamp2);
                         if($tanggal2 != '01/01/1970' ){
                             echo $tanggal2;
                         }else{
                             echo $tanggal;
                         }
                     }
                     ?>">
                    <input id="datepickers" type="text" class="datepicker" >
                </div>
            </div>
            <!--/tanggal berdiri-->
            <div class="form-group">
                {{ Form::label('Website') }}
                {{ Form::text('website',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan alamat website',
                    'autocomplete'=>'off'))}}
            </div>
            <div class="form-group">
                {{ Form::label('Email') }}
                {{ Form::email('email',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan alamat email',
                    'data-error' => 'Alamat email anda salah','autocomplete'=>'off'))}}
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                {{ Form::label('Aplikasi Komputerisasi') }}
                {{ Form::text('app',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama aplikasi komputerisasi',
                    'autocomplete'=>'off'))}}
            </div>
            <div class="form-group">
                {{ Form::label('Alamat') }}
                {{ Form::textarea('alamat',null,array('class' => 'form-control','rows' => '5', 'placeholder' => 'Silahkan masukkan alamat'))}}
            </div>
        </div>
        <!--deskripsi-->
        <div class="col-lg-12">
            <div class="form-group">
                {{ Form::label('Deskripsi') }}
                {{ Form::textarea('deskripsi',null,array('style' => 'height:300px','id'=>'textarea')) }}
            </div>
            {{ $errors->first('deskripsi', '<p class="text-warning">:message</p>') }}
        </div>
        <!--/deskripsi-->
    </div>
</div>
{{ HTML::script('plugins/ckeditor/ckeditor.js') }}
<script type="text/javascript">
    var roxyFileman = '{{ asset('plugins/fileman/index.html')  }}';

    CKEDITOR.replace( 'deskripsi',{
        filebrowserBrowseUrl:roxyFileman,
        filebrowserImageBrowseUrl:roxyFileman+'?type=image',
        removeDialogTabs: 'link:upload;image:upload'});

</script>