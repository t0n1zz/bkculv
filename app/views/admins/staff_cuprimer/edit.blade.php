<?php $title="Ubah Staff"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-pencil"></i> {{$title}}</h1>
    </div>
</div>
<div class="row">
    <div class=" col-lg-12">

	{{ Form::model($staff,array('route' => array('admins.staff_cuprimer.update',$staff->id),'method' => 'put', 'files' => true)) }}
		@include('admins.staff_cuprimer.form')
	{{ Form::close() }}

	</div>
</div>
@stop