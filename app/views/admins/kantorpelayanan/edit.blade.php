<?php $title="Ubah Informasi Kantor Pelayanan"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-pencil"></i> {{$title}}</h1>
    </div>
</div>
<div class="row">
    <div class=" col-lg-12">

	{{ Form::model($kantor_pelayanan,array('route' => array('admins.kantorpelayanan.update',$kantor_pelayanan->id),'method' => 'put',
	    'data-toggle' => 'validator','role' => 'form')) }}
		@include('admins.kantorpelayanan.form')
	{{ Form::close() }}

	</div>
</div>
@stop