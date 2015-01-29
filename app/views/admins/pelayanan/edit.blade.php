<?php $title="Ubah Pelayanan"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-pencil"></i> {{$title}}</h1>
    </div>
</div>
<div class="row">
    <div class=" col-lg-12">

	{{ Form::model($pelayanan,array('route' => array('admins.pelayanan.update',$pelayanan->id),'method' => 'put', 'files' => true,
	    'data-toggle' => 'validator','role' => 'form')) }}
		@include('admins.pelayanan.form')
	{{ Form::close() }}

	</div>
</div>
@stop