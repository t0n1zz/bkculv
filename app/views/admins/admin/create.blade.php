<?php $title="Tambah Admin"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-plus"></i> {{$title}}</h1>
    </div>
</div>
<div class="row">
    <div class=" col-lg-12">

	{{ Form::open(array('route' => array('admins.admin.store'))) }}
		@include('admins.admin.form')
	{{ Form::close() }}

	</div>
</div>
@stop