<?php $title="Ubah Informasi CU"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-pencil"></i> {{$title}}</h1>
    </div>
</div>
<div class="row">
    <div class=" col-lg-12">

	{{ Form::model($cuprimer,array('route' => array('admins.cuprimer.update',$cuprimer->id),'method' => 'put',
	    'data-toggle' => 'validator','role' => 'form')) }}
		@include('admins.cuprimer.form')
	{{ Form::close() }}

	</div>
</div>
@stop