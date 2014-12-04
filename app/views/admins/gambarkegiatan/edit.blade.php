<?php $title="Ubah Gambar Kegiatan"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-pencil"></i> {{$title}}</h1>
    </div>
</div>
<div class="row">
    <div class=" col-lg-12">

	{{ Form::model($gambarkegiatan,array('route' => array('admins.gambarkegiatan.update',$gambarkegiatan->id),'method' => 'put', 'files' => true)) }}
		@include('admins.gambarkegiatan.form')
	{{ Form::close() }}

	</div>
</div>
@stop