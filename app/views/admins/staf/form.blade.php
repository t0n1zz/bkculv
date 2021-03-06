<?php
$imagepath ='images_staf';
$kelas ='staf';
$file_max = ini_get('upload_max_filesize');
$file_max_str_leng = strlen($file_max);
$file_max_meassure_unit = substr($file_max,$file_max_str_leng - 1,1);
$file_max_meassure_unit = $file_max_meassure_unit == 'K' ? 'kb' : ($file_max_meassure_unit == 'M' ? 'mb' : ($file_max_meassure_unit == 'G' ? 'gb' : 'unidades'));
$file_max = substr($file_max,0,$file_max_str_leng - 1);
$file_max = intval($file_max);
?>
<!-- Alert -->
@include('admins._layouts.alert')
<!-- /Alert -->
<!-- content -->
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="form-group">
            <button type="submit" name="simpan" accesskey="s" class="btn btn-primary">
                <i class="fa fa-save"></i> <u>S</u>impan</button>
            <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary">
                <i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>
            <a href="{{ route('admins.'.$kelas.'.index') }}" name="batal" accesskey="b" class="btn btn-danger">
                <i class="fa fa-times"></i> <u>B</u>atal</a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <!--nama-->
            <div class="col-lg-6">
                <div class="form-group">
                    {{ Form::label('Nama') }}
                    {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama staff',
                        'required','data-error' => 'Nama staf wajib diisi',
                        'autocomplete'=>'off'))}}
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
                        @if(!empty($data))
                            @if($data->tingkat == "1")
                                {{ "selected" }}
                                    @endif
                                @endif
                                >Pengurus</option>
                        <option value="2"
                        @if(!empty($data))
                            @if($data->tingkat == "2")
                                {{ "selected" }}
                                    @endif
                                @endif
                                >Pengawas</option>
                        <option value="3"
                        @if(!empty($data))
                            @if($data->tingkat == "3")
                                {{ "selected" }}
                                    @endif
                                @endif
                                >Manajemen</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group" id="pilihan"
                @if(empty($data->tingkat))
                    {{ "style='display:none;'" }}
                        @else
                    @if($data->tingkat == "3")
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
                        @if(!empty($data))
                            @if($data->cu == "0")
                                {{ "selected" }}
                                    @endif
                                @endif
                                >Puskopdit BKCU Kalimantan</option>
                        @foreach($datas2 as $data2)
                            <option value="{{ $data2->id }}"
                            @if(!empty($data))
                                @if($data->cu == $data2->id)
                                    {{ "selected" }}
                                        @endif
                                    @endif
                                    >{{ $data2->name }}</option>
                        @endforeach
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    {{ Form::label('Kelamin') }}
                    <select class="form-control" name="kelamin">
                        <option selected disabled>Silahkan pilih jenis kelamin</option>
                        <option value="Pria"
                        @if(!empty($data))
                            @if($data->kelamin == "Pria")
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
                        @if(!empty($data->gambar))
                            {{ HTML::image($imagepath.$data->gambar, 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
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
                        @if(!empty($data))
                            @if($data->agama == "Khatolik")
                                {{ "selected" }}
                                    @endif
                                @endif
                                >Khatolik</option>
                        <option value="Protestan"
                        @if(!empty($data))
                            @if($data->agama == "Protestan")
                                {{ "selected" }}
                                    @endif
                                @endif
                                >Protestan</option>
                        <option value="Kong Hu Cu"
                        @if(!empty($data))
                            @if($data->agama == "Kong Hu Cu")
                                {{ "selected" }}
                                    @endif
                                @endif
                                >Kong Hu Cu</option>
                        <option value="Buddha"
                        @if(!empty($data))
                            @if($data->agama == "Buddha")
                                {{ "selected" }}
                                    @endif
                                @endif
                                >Buddha</option>
                        <option value="Hindu"
                        @if(!empty($data))
                            @if($data->agama == "Hindu")
                                {{ "selected" }}
                                    @endif
                                @endif
                                >Hindu</option>
                        <option value="Islam"
                        @if(!empty($data))
                            @if($data->agama == "Islam")
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
                        @if(!empty($data))
                            @if($data->status == "Menikah")
                                {{ "selected" }}
                                    @endif
                                @endif
                                >Menikah</option>
                        <option value="Belum Menikah"
                        @if(!empty($data))
                            @if($data->status == "Belum Menikah")
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
</div>