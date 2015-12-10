@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Hasil pencarian <i>{{ $key }}</i></h1>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
@include('_layouts.event')
<!-- Posts List -->
<div class="section blog-posts-wrapper">
    <div class="container">
        <div class="row">
             @include('_components.artikel')
        </div>
    </div>
</div>
<!-- /Posts List -->
@stop