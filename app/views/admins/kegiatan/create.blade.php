<?php $title="Tambah Kegiatan"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-plus"></i> {{$title}}</h1>
    </div>
</div>
<div class="row">
    <div class=" col-lg-12">

	{{ Form::open(array('route' => array('admins.kegiatan.store'), 'files' => true)) }}
        <?php if(Auth::check()) { $id = Auth::user()->getId();} ?>
        <input type="text" name="penulis" value="{{ $id }}" hidden>
		@include('admins.kegiatan.form')
	{{ Form::close() }}

	</div>
</div>
@stop