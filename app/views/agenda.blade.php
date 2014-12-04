@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Agenda Kegiatan</h1>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->

<div class="section blog-posts-wrapper">
    <div class="container">
        <div class="row">
            @include('_components.agenda')
       </div>
    </div>
</div>

@stop