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
	    data-placement='top' title ='Menyimpan informasi CU' value="simpan"><i class="fa fa-save"></i> Simpan</button>
    <button type="submit" name="simpan2" class="btn btn-primary" data-toggle ='tooltip'
    	    data-placement='top' title ='Menyimpan informasi CU dan memulai menambah CU baru' value="simpan"><i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Simpan dan buat baru</button>
	<button type="submit" name="batal" class="btn btn-danger" data-toggle ='tooltip'
	    data-placement='top' title ='Batal menyimpan informasi CU dan kembali ke halaman kelola CU' value="batal"><i class="fa fa-times"></i> Batal</button>
</div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <!--name-->
        <div class="col-lg-10">
        <div class="form-group">
            {{ Form::label('Nama') }}
            {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama cu'))}}
            {{ $errors->first('name', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        </div>
        <!--/name-->
        <!--wilayah-->
        <div class="col-lg-4">
        <div class="form-group">
            {{ Form::label('Wilayah') }}
            <select class="form-control" onChange="changeFunc(value);" name="wilayah">
                <option >Pilih Wilayah</option>
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
        </div>
        <!--/wilayah-->
        <!--wilayah baru-->
        <div class="col-lg-4"  id="pilihan" style="display:none;">
        <div class="form-group">
            {{ Form::label('Wilayah Baru') }}
            {{ Form::text('wilayah_baru',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan wilayah baru',
               'maxlength' => '30'))}}
        </div>
        </div>
        <!--/wilayah baru-->
         <!--Tanggal berdiri-->
        <div class="col-sm-4">
        <div class="form-group">
          {{ Form::label('Tanggal Berdiri') }}
          <div class="bfh-datepicker" data-name="ultah"
               data-date="<?php
                              if(!empty($cuprimer->ultah)){
                                  $timestamp = strtotime($cuprimer->ultah);
                                  $tanggal = date('m/d/Y',$timestamp);
                                  echo $tanggal;
                              }
                           ?>">
            <input id="datepickers" type="text" class="datepicker" >
          </div>
          {{ $errors->first('ultah', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        </div>
         <!--/tanggal berdiri-->
        <!--content-->
        <div class="col-lg-12">
            {{ Form::label('Info') }}
            {{ Form::textarea('content',null,array('style' => 'height:300px')) }}
            {{ $errors->first('content', '<p class="text-warning"><i>:message</i></p>') }}
        </div>
        <!--/content-->
    </div>
</div>