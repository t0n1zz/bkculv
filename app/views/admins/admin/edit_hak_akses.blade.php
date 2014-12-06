<?php $title="Ubah Hak Akses Admin"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-pencil"></i> {{$title}}</h1>
    </div>
</div>
<div class="row">
    <div class=" col-lg-12">

	{{ Form::model($admin,array('route' => array('admins.admin.update_hak_akses'))) }}
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
        	    data-placement='top' title ='Menyimpan hak akses' value="simpan"><i class="fa fa-save"></i> Simpan</button>
        	<button type="submit" name="batal" class="btn btn-danger" data-toggle ='tooltip'
        	    data-placement='top' title ='Batal mengubah hak akses dan kembali ke halaman kelola admin' value="batal"><i class="fa fa-times"></i> Batal</button>
        	<!--<a href="{{ URL::previous() }}" class="btn btn-default">Batal</a>-->
        </div>
        <!--/button-->
        <div class="panel-body">
            {{ Form::text('id',null,array('hidden'))}}
            @include('admins.admin.hak_akses')
        </div>
        </div>
	{{ Form::close() }}

	</div>
</div>
@stop