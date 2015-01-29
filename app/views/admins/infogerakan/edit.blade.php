<?php $title="Informasi Gerakan"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-exclamation-circle" ></i> {{$title}}</h1>
    </div>
</div>
<div class="row">
    <div class=" col-lg-12">
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
	{{ Form::model($infogerakan,array('route' => array('admins.infogerakan.update',$infogerakan->id),'method' => 'put')) }}
	<div class="panel panel-default">
        <div class="panel-heading tooltip-demo">
            <button type="submit" name="simpan" accesskey="s" data-toggle="tooltip" data-placement="top"
                        title="Menyimpan data informasi gerakan" class="btn btn-primary"><span
                        class="fa fa-save"></span> <u>S</u>impan</button>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="col-sm-8">
            <div class="form-group">
              {{ Form::label('Informasi Per Tanggal') }}
              <div class="bfh-datepicker" data-name="tanggal"
                   data-date="<?php
                                  if(!empty($infogerakan->tanggal)){
                                      $timestamp4 = strtotime($infogerakan->tanggal);
                                      $tanggal4 = date('m/d/Y',$timestamp4);
                                      echo $tanggal4;
                                  }
                               ?>">
                <input id="datepickers" type="text" class="datepicker" >
              </div>
              {{ $errors->first('tanggal', '<p class="text-warning">:message</p>') }}
            </div>
            </div>
            <div class="col-lg-12">
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">Jumlah Anggota</div>
                  {{ Form::text('jumlah_anggota',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah anggota',
                                'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                  {{ $errors->first('jumlah_anggota', '<p class="text-warning">:message</p>') }}
                </div>
            </div>
            </div>
            <div class="col-lg-12">
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">Jumlah CU Primer</div>
                  {{ Form::text('jumlah_cu',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah cu primer',
                                'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                  {{ $errors->first('jumlah_cu', '<p class="text-warning">:message</p>') }}
                </div>
            </div>
            </div>
            <div class="col-lg-12">
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">Jumlah Staff CU Primer</div>
                  {{ Form::text('jumlah_staff_cu',null,array('class' => 'form-control',
                                'placeholder' => 'Silahkan masukkan jumlah staff cu primer',
                                'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                  {{ $errors->first('jumlah_staff_cu', '<p class="text-warning">:message</p>') }}
                </div>
            </div>
            </div>
            <div class="col-lg-12">
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">Jumlah Piutang Beredar</div>
                  {{ Form::text('piutang_beredar',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah piutang beredar',
                                'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                  {{ $errors->first('piutang_beredar', '<p class="text-warning">:message</p>') }}
                </div>
            </div>
            </div>
            <div class="col-lg-12">
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">Jumlah Piutang Lalai 1 s.d. 12 Bulan</div>
                  {{ Form::text('piutang_lalai_1',null,array('class' => 'form-control', 'placeholder' => 'Masukkan jumlah piutang lalai 1 s.d. 12 bulan',
                                'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                  {{ $errors->first('piutang_lalai_1', '<p class="text-warning">:message</p>') }}
                </div>
            </div>
            </div>
            <div class="col-lg-12">
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">Jumlah Piutang Bersih</div>
                  {{ Form::text('piutang_bersih',null,array('class' => 'form-control', 'placeholder' => 'Masukkan jumlah piutang bersih',
                                'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                  {{ $errors->first('piutang_bersih', '<p class="text-warning">:message</p>') }}
                </div>
            </div>
            </div>
            <div class="col-lg-12">
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">Asset</div>
                  {{ Form::text('asset',null,array('class' => 'form-control', 'placeholder' => 'Masukkan jumlah asset',
                                'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                  {{ $errors->first('asset', '<p class="text-warning">:message</p>') }}
                </div>
            </div>
            </div>
            <div class="col-lg-12">
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">SHU</div>
                  {{ Form::text('shu',null,array('class' => 'form-control', 'placeholder' => 'Masukkan SHU',
                                'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                  {{ $errors->first('shu', '<p class="text-warning">:message</p>') }}
                </div>
            </div>
            </div>
        </div>
	{{ Form::close() }}

	</div>
</div>
@stop