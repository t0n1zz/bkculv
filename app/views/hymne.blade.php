@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Hymne Credit Union</h1>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
<img class="img-responsive" src="{{ asset('images/top.png') }}" width="100%"  style="vertical-align: top;margin-top: -10px;margin-bottom: -3%;"/>
<div class="section">
<div class="container">
    <div class="row">
        <!-- Blog Post -->
        <div class="col-sm-8">
            <div class="blog-post blog-single-post">
                <div class="single-post-content modalphotos">
                    <img style="cursor: pointer;cursor: hand;"
                         src="{{ asset('images/HymneCu.png') }}" class="img-responsive">
                </div>
            </div>
        </div>
        <!-- End Blog Post -->
        <!-- Blog Post -->
        <div class="col-sm-4 blog-sidebar">
        <br />
            <h4>Hymne Credit Union Instrumental</h4>
            <audio controls autoplay>
              <source src="{{ asset('music/CU_melodi.mp3') }}" type="audio/mpeg">
              Browser anda tidak mendukung pemutar lagu.
            </audio>
        </div>
        <!-- End Blog Post -->
    </div>
</div>
</div>
<!--modal photos-->
<div class="modal fade" id="modalphotoshow">
    <div class="modal-body">
      <img class="pointer img-responsive center-block" src="" id="modalimage"/>
    </div>
</div>
<!--/modal photos-->
@stop