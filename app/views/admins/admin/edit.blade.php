<?php $title="Ubah Admin"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-pencil"></i> {{$title}}</h1>
    </div>
</div>
<div class="row">
    <div class=" col-lg-12">

	{{ Form::model($admin,array('route' => array('admins.admin.update',$admin->id),'method' => 'put')) }}
		@include('admins.admin.form')
	{{ Form::close() }}

	</div>
</div>
@stop