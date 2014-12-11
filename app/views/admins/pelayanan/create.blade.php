<?php $title="Tambah Pelayanan"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-plus"></i> {{$title}}</h1>
    </div>
</div>
<div class="row">
    <div class=" col-lg-12">

	{{ Form::open(array('route' => array('admins.pelayanan.store'), 'files' => true)) }}
		@include('admins.pelayanan.form')
	{{ Form::close() }}

	</div>
</div>
@stop