<?php $title="Ubah Artikel"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-pencil"></i> {{$title}}</h1>
    </div>
</div>
<div class="row">
    <div class=" col-lg-12">

	{{ Form::model($artikel,array('route' => array('admins.artikel.update',$artikel->id),'method' => 'put', 'files' => true)) }}
	    {{ Form::text('penulis',null,array('hidden'))}}
		@include('admins.artikel.form')
	{{ Form::close() }}

	</div>
</div>
@stop