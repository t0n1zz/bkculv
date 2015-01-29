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
                data-placement='top' title ='Menyimpan informasi staf' value="simpan"><i
                    class="fa fa-save"></i> <u>S</u>impan</button>
        <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary" data-toggle ='tooltip'
                data-placement='top' title ='Menyimpan informasi staf dan memulai menambah staf baru'
                value="simpan"><i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>
        <a href="{{ route('admins.staff.index') }}" name="batal" accesskey="b" class="btn btn-danger" data-toggle ='tooltip'
           data-placement='top' title ='Batal menyimpan informasi staf dan kembali ke halaman kelola staf'
           value="batal"><i class="fa fa-times"></i> <u>B</u>atal</a>
    </div>
    <!--/button-->
    <div class="panel-body">
        <!--nama-->
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('Nama') }}
                {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama staff',
                    'required','data-error' => 'Nama staf wajib diisi',
                    'autocomplete'=>'off','autofocus'))}}
                <div class="help-block with-errors"></div>
                {{ $errors->first('name', '<p class="text-warning">:message</p>') }}
            </div>
            <div class="form-group">
                {{ Form::label('Jabatan') }}
                {{ Form::text('jabatan',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama jabatan',
                    'required','data-error' => 'Jabatan wajib diisi'))}}
                <div class="help-block with-errors"></div>
                {{ $errors->first('jabatan', '<p class="text-warning">:message</p>') }}
            </div>
            <div class="form-group">
                {{ Form::label('Tingkatan') }}
                <select class="form-control" onchange="changeFunc2(value)" name="tingkat"
                        required data-error="Tingkatan wajib dipilih">
                    <option selected disabled>Silahkan pilih tingkatan staff</option>
                    <option value="1"
                    @if(!empty($staff))
                        @if($staff->tingkat == "1")
                            {{ "selected" }}
                                @endif
                            @endif
                            >Pengurus</option>
                    <option value="2"
                    @if(!empty($staff))
                        @if($staff->tingkat == "2")
                            {{ "selected" }}
                                @endif
                            @endif
                            >Pengawas</option>
                    <option value="3"
                    @if(!empty($staff))
                        @if($staff->tingkat == "3")
                            {{ "selected" }}
                                @endif
                            @endif
                            >Manajemen</option>
                </select>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group" id="pilihan"
                @if(empty($staff->tingkat))
                    {{ "style='display:none;'" }}
                @else
                    @if($staff->tingkat == "3")
                        {{ "style='display:none;'" }}
                    @endif
                @endif
                    >
                {{ Form::label('Periode') }}
                <div class="row">
                    <div class="col-sm-6">
                        {{ Form::text('periode1',null,array('class' => 'form-control', 'placeholder' => 'Mulai'))}}
                        {{ $errors->first('periode1', '<p class="text-warning">:message</p>') }}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::text('periode2',null,array('class' => 'form-control', 'placeholder' => 'Selesai'))}}
                        {{ $errors->first('periode2', '<p class="text-warning">:message</p>') }}
                    </div>
                </div>
                <br/>
            </div>
            <div class="form-group">
                {{ Form::label('Credit Union') }}
                <select class="form-control" name="cu" required data-error="Credit Union wajib dipilih">
                    <option selected disabled>Silahkan pilih Credit Union</option>
                    <option value="0"
                        @if(!empty($staff))
                            @if($staff->cu == "0")
                                {{ "selected" }}
                            @endif
                         @endif
                    >Puskopdit BKCU Kalimantan</option>
                    @foreach($cuprimers as $cuprimer)
                        <option value="{{ $cuprimer->id }}"
                            @if(!empty($staff))
                                @if($staff->cu == $cuprimer->id)
                                    {{ "selected" }}
                                @endif
                            @endif
                         >{{ $cuprimer->name }}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                {{ Form::label('Kelamin') }}
                <select class="form-control" name="kelamin">
                    <option selected disabled>Silahkan pilih jenis kelamin</option>
                    <option value="Pria"
                    @if(!empty($staff))
                        @if($staff->kelamin == "Pria")
                            {{ "selected" }}
                                @endif
                            @endif
                            >Pria</option>
                    <option value="Wanita"
                    @if(!empty($staff))
                        @if($staff->kelamin == "Wanita")
                            {{ "selected" }}
                                @endif
                            @endif
                            >Wanita</option>
                </select>
                {{ $errors->first('kelamin', '<p class="text-warning">:message</p>') }}
            </div>
            <div class="form-group">
                {{ Form::label('Tempat dan tanggal lahir') }}
                <div class="row">
                    <div class="col-sm-6">
                        {{ Form::text('tempat_lahir',null,array('class' => 'form-control', 'placeholder' => 'Tempat'))}}
                        {{ $errors->first('tempat_lahir', '<p class="text-warning">:message</p>') }}
                    </div>
                    <div class="col-sm-6">
                        <div class="bfh-datepicker" data-name="tanggal_lahir" data-min=""
                             data-date="<?php
                             if(!empty($kegiatan->tanggal)){
                                 $timestamp = strtotime($kegiatan->tanggal);
                                 $tanggal = date('m/d/Y',$timestamp);
                                 echo $tanggal;
                             }
                             ?>">
                            <input id="datepickers" type="text" class="datepicker" >}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('No. Telepon') }}
                {{ Form::text('telp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan no telepon',
                    'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
            </div>
            <div class="form-group">
                {{ Form::label('No. Handphone') }}
                {{ Form::text('hp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan no handphone',
                    'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
            </div>
        </div>
        <!--/nama-->
        <!--gambar-->
        <div class="col-lg-6">
            <div>
                {{ Form::label('Foto') }}
                <div class="thumbnail" >
                    @if(!empty($staff->gambar))
                        {{ HTML::image('images_staff/'.$staff->gambar, 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
                    @else
                        {{ HTML::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
                    @endif
                    <div class="caption">
                        {{ Form::file('gambar', array('onChange' => 'readURL(this)')) }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('Agama') }}
                <select class="form-control" name="agama">
                    <option selected disabled>Silahkan pilih agama</option>
                    <option value="Khatolik"
                    @if(!empty($staff))
                        @if($staff->agama == "Khatolik")
                            {{ "selected" }}
                                @endif
                            @endif
                            >Khatolik</option>
                    <option value="Protestan"
                    @if(!empty($staff))
                        @if($staff->agama == "Protestan")
                            {{ "selected" }}
                                @endif
                            @endif
                            >Protestan</option>
                    <option value="Kong Hu Cu"
                    @if(!empty($staff))
                        @if($staff->agama == "Kong Hu Cu")
                            {{ "selected" }}
                                @endif
                            @endif
                            >Kong Hu Cu</option>
                    <option value="Buddha"
                    @if(!empty($staff))
                        @if($staff->agama == "Buddha")
                            {{ "selected" }}
                                @endif
                            @endif
                            >Buddha</option>
                    <option value="Hindu"
                    @if(!empty($staff))
                        @if($staff->agama == "Hindu")
                            {{ "selected" }}
                                @endif
                            @endif
                            >Hindu</option>
                    <option value="Islam"
                    @if(!empty($staff))
                        @if($staff->agama == "Islam")
                            {{ "selected" }}
                                @endif
                            @endif
                            >Islam</option>
                </select>
            </div>
            <div class="form-group">
                {{ Form::label('Status') }}
                <select class="form-control" name="status">
                    <option selected disabled>Silahkan pilih jenis status</option>
                    <option value="Menikah"
                    @if(!empty($staff))
                        @if($staff->kelamin == "Menikah")
                            {{ "selected" }}
                                @endif
                            @endif
                            >Menikah</option>
                    <option value="Belum Menikah"
                    @if(!empty($staff))
                        @if($staff->tingkat == "Belum Menikah")
                            {{ "selected" }}
                                @endif
                            @endif
                            >Belum Menikah</option>
                </select>
            </div>
            <div class="form-group">
                {{ Form::label('Email') }}
                {{ Form::email('email',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan alamat email',
                    'data-error' => 'Alamat email anda salah,','autocomplete'=>'off'))}}
                <div class="help-block with-errors"></div>
                {{ $errors->first('email', '<p class="text-warning">:message</p>') }}
            </div>
            <div class="form-group">
                {{ Form::label('Pendidikan') }}
                {{ Form::text('pendidikan',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan pendidikan terakhir',
                    'autocomplete'=>'off'))}}
            </div>
            <div class="form-group">
                {{ Form::label('Kota') }}
                {{ Form::text('jabatan_asal_cu',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jabatan asal cu',
                    'autocomplete'=>'off'))}}
            </div>
        </div>
        <!--/gambar-->
        <!--alamat-->
        <div class="col-lg-12">
            <div class="form-group">
                {{ Form::label('Alamat') }}
                {{ Form::textarea('content',null,array('class' => 'form-control')) }}
            </div>
        </div>
        <!--/alamat -->
    </div>
</div>