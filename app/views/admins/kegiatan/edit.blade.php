<?php $title="Ubah Kegiatan"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-pencil"></i> {{$title}}</h1>
    </div>
</div>
<div class="row">
    <div class=" col-lg-12">

	{{ Form::model($kegiatan,array('route' => array('admins.kegiatan.update',$kegiatan->id),'method' => 'put','files' => true)) }}
		@include('admins.kegiatan.form')
	{{ Form::close() }}

	</div>
</div>
@stop