<?php $title="Tambah Artikel"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-plus"></i> {{$title}}</h1>
    </div>
</div>
<div class="row">
    <div class=" col-lg-12">

	{{ Form::open(array('route' => array('admins.artikel.store'), 'files' => true)) }}
	    <?php if(Auth::check()) { $id = Auth::user()->getId();} ?>
        <input type="text" name="penulis" value="{{ $id }}" hidden>
		@include('admins.artikel.form')
	{{ Form::close() }}

	</div>
</div>

@stop