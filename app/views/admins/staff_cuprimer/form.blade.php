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
    <div class="col-lg-6">
        <div class="form-group">
            {{ Form::label('Nama') }}
            {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama staff'))}}
            {{ $errors->first('name', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        <div class="form-group">
            {{ Form::label('Jabatan') }}
            {{ Form::text('jabatan',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama jabatan'))}}
            {{ $errors->first('jabatan', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        <div class="form-group">
            {{ Form::label('Tingkatan') }}
            <select class="form-control" onchange="changeFunc2(value)" name="tingkat">
                <option >Pilih tingkatan staff</option>
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
        </div>
         <div class="form-group" id="pilihan" style="display:none;">
            {{ Form::label('Periode') }}
            <div class="row">
                <div class="col-sm-6">
                    {{ Form::text('periode1',null,array('class' => 'form-control', 'placeholder' => 'Mulai'))}}
                    {{ $errors->first('periode1', '<p class="text-warning"><i>:message</i></p>') }}
                </div>
                <div class="col-sm-6">
                    {{ Form::text('periode2',null,array('class' => 'form-control', 'placeholder' => 'Selesai'))}}
                    {{ $errors->first('periode2', '<p class="text-warning"><i>:message</i></p>') }}
                </div>
            </div>
            <br/>
        </div>
        <div class="form-group">
            {{ Form::label('Credit Union') }}
            <select class="form-control" name="cu">
                <option >Pilih Credit Union</option>\
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
        </div>
    </div>
    <!--/nama-->
    <!--gambar-->
    <div class="col-lg-6">
        <div>
            {{ Form::label('Foto') }}
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
    <!--jabatan-->
    <div class="col-lg-6">
        <div class="form-group">
            {{ Form::label('Tempat dan tanggal lahir') }}
            <div class="row">
                <div class="col-sm-6">
                    {{ Form::text('tempat_lahir',null,array('class' => 'form-control', 'placeholder' => 'Tempat'))}}
                    {{ $errors->first('tempat_lahir', '<p class="text-warning"><i>:message</i></p>') }}
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
                    {{ $errors->first('tanggal_lahir', '<p class="text-warning"><i>:message</i></p>') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('Kelamin') }}
            {{ Form::select('kelamin',array('0' => 'Pilih jenis kelamin', 'Pria' => 'Pria', 'Wanita' => 'Wanita'),null, array('class' => 'form-control')) }}
            {{ $errors->first('kelamin', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        <div class="form-group">
            {{ Form::label('Asal CU') }}
            {{ Form::text('asal_cu',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama asal cu'))}}
            {{ $errors->first('asal_cu', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        <div class="form-group">
            {{ Form::label('Jabatan Asal CU') }}
            {{ Form::text('jabatan_asal_cu',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jabatan asal cu'))}}
            {{ $errors->first('jabatan_asal_cu', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        <div class="form-group">
            {{ Form::label('Pekerjaan') }}
            {{ Form::text('pekerjaan',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan pekerjaan'))}}
            {{ $errors->first('pekerjaan', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        <div class="form-group">
            {{ Form::label('Email') }}
            {{ Form::text('email',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan alamat email'))}}
            {{ $errors->first('email', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
    </div>
    <!--/jabatan-->
    <!--jabatan-->
    <div class="col-lg-6">
        <div class="form-group">
            {{ Form::label('Agama') }}
            {{ Form::select('agama',array('0' => 'Pilih agama', 'Khatolik' => 'Khatolik', 'Protestan' => 'Protestan','Kong Hu Cu' => 'Kong Hu Cu',
                            'Buddha' => 'Buddha', 'Hindu' => 'Hindu', 'Islam' => 'Islam'
                            ),null, array('class' => 'form-control')) }}
            {{ $errors->first('agama', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        <div class="form-group">
            {{ Form::label('Status') }}
            {{ Form::select('status',array('0' => 'Pilih jenis Status', 'Menikah' => 'Menikah', 'Belum Menikah' => 'Belum Menikah'),null, array('class' => 'form-control')) }}
            {{ $errors->first('status', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        <div class="form-group">
            {{ Form::label('Pendidikan') }}
            {{ Form::text('pendidikan',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan pendidikan terakhir'))}}
            {{ $errors->first('pendidikan', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        <div class="form-group">
            {{ Form::label('No. Telepon') }}
            {{ Form::text('telp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan no telepon'))}}
            {{ $errors->first('pekerjaan', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        <div class="form-group">
            {{ Form::label('No. Handphone') }}
            {{ Form::text('hp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan no handphone'))}}
            {{ $errors->first('hp', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        <div class="form-group">
            {{ Form::label('Kota') }}
            {{ Form::text('jabatan_asal_cu',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jabatan asal cu'))}}
            {{ $errors->first('jabatan_asal_cu', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
    </div>
    <!--/jabatan-->
    <!--jabatan-->
    <div class="col-lg-12">
        <div class="form-group">
            {{ Form::label('Alamat') }}
            {{ Form::textarea('content',null,array('class' => 'form-control')) }}
            {{ $errors->first('pekerjaan', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
    </div>
    <!--/jabatan-->
</div>
</div>