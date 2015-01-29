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
	    data-placement='top' title ='Menyimpan informasi kegiatan' value="simpan"><i
                class="fa fa-save"></i> <u>S</u>impan</button>
    <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary" data-toggle ='tooltip'
    	    data-placement='top' title ='Menyimpan informasi kegiatan dan memulai menambah kegiatan baru'
            value="simpan"><i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>
	<a href="{{ route('admins.kegiatan.index') }}" name="batal" accesskey="b" class="btn btn-danger" data-toggle ='tooltip'
	    data-placement='top' title ='Batal menyimpan informasi kegiatan dan kembali ke halaman kelola kegiatan'
        value="batal"><i class="fa fa-times"></i> <u>B</u>atal</a>
</div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="col-lg-10">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Nama Kegiatan</div>
              {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama kegiatan',
                'required','min-length' => '5','data-error' => 'Nama kegiatan wajib diisi dan minimal 5 karakter','autofocus'))}}
            </div>
            <div class="help-block with-errors"></div>
            {{ $errors->first('name', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <div class="col-sm-10">
        <div class="form-group">
          {{ Form::label('Tanggal Kegiatan Dimulai') }}
          <div class="bfh-datepicker" data-name="tanggal"data-min="today"
               data-date="<?php
                              if(!empty($kegiatan->tanggal)){
                                  $timestamp = strtotime($kegiatan->tanggal);
                                  $tanggal = date('m/d/Y',$timestamp);
                                  echo $tanggal;
                              }
                           ?>">
            <input id="datepickers" type="text" class="datepicker" >
          </div>
          {{ $errors->first('tanggal', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <div class="col-sm-10">
        <div class="form-group">
          {{ Form::label('Tanggal Kegiatan Selesai') }}
          <div class="bfh-datepicker" data-name="tanggal2"data-min="today"
               data-date="<?php
                              if(!empty($kegiatan->tanggal2)){
                                  $timestamp2 = strtotime($kegiatan->tanggal2);
                                  $tanggal2 = date('m/d/Y',$timestamp2);
                                  echo $tanggal2;
                              }
                           ?>">
            <input id="datepickers" type="text" class="datepicker">
          </div>
          {{ $errors->first('tanggal2', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <div class="col-lg-8">
        <div class="form-group">
            <div class="input-group">
            <div class="input-group-addon">Wilayah</div>
            <select class="form-control" name="wilayah" required data-error="Wilayah wajib dipilih">
                <option value="" selected disabled>Silahkan pilih wilayah pelatihan</option>
                <option value="Barat"
                @if(!empty($kegiatan))
                    @if($kegiatan->wilayah == "Barat")
                        {{ "selected" }}
                            @endif
                        @endif
                        >Barat</option>
                <option value="Tengah"
                @if(!empty($kegiatan))
                    @if($kegiatan->wilayah == "Tengah")
                        {{ "selected" }}
                            @endif
                        @endif
                        >Tengah</option>
                <option value="Timur"
                @if(!empty($kegiatan))
                    @if($kegiatan->wilayah == "Timur")
                        {{ "selected" }}
                            @endif
                        @endif
                        >Timur</option>
                <option value="Timur"
                @if(!empty($kegiatan))
                    @if($kegiatan->wilayah == "Bersama")
                        {{ "selected" }}
                            @endif
                        @endif
                        >Bersama</option>
            </select>
            </div>
            <div class="help-block with-errors"></div>
            {{ $errors->first('wilayah', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <div class="col-lg-10">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Tempat</div>
              {{ Form::text('tempat',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan tempat kegiatan',
                'required','data-error' => 'Tempat wajib diisi','autocomplete'=>'off'))}}
            </div>
            <div class="help-block with-errors"></div>
            {{ $errors->first('tempat', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <div class="col-lg-10">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Sasaran</div>
              {{ Form::text('sasaran',null,array('class' => 'form-control','placeholder' => 'Silahkan masukkan sasaran kegiatan',
                'required','data-error' => 'Sasaran wajib diisi','autocomplete'=>'off'))}}
            </div>
            <div class="help-block with-errors"></div>
            {{ $errors->first('sasaran', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <div class="col-lg-10">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Fasilitator</div>
              {{ Form::text('fasilitator',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama fasilitator',
                'autocomplete'=>'off'))}}
            </div>
            {{ $errors->first('fasilitator', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        </div>
    </div>