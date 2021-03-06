@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Berita</h1>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
@include('_layouts.event')
<div class="section">
    <div class="container">
        <div class="row">
        @foreach($beritas as $berita)
            <div class="col-md-4 col-sm-6">
                <a href="{{ route('artikel',array($berita->id)) }}">
                <div class="service-wrapper">
                    <i class="fa fa-newspaper-o fa-4x"></i>
                    <h3>{{$berita->name}}</h3>
                </div>
                </a>
            </div>
        @endforeach
        </div>
    </div>
</div>
@stop