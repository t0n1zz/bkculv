@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $detail_artikel->KategoriArtikel->name }}</h1>
            </div>
        </div>
    </div>
</div>
<!-- Page Title -->
<img class="img-responsive" src="{{ asset('images/top.png') }}" width="100%"  style="vertical-align: top;margin-top: -10px;margin-bottom: -3%;"/>
<div class="section">
    <div class="container">
        <div class="row">
            <!-- Blog Post -->
            <div class="col-sm-8">
                <div class="blog-post blog-single-post">
                    <div class="single-post-title">
                        <h3>{{ $detail_artikel->judul }}</h3>
                    </div>
                    <br />
                    <div class="single-post-info">
                        <i class="fa fa-clock-o"></i> {{ date('F j, Y, g:i a ',strtotime($detail_artikel->created_at)) }}
                    </div>
                    <div class="single-post-content">
                        @if(!empty($detail_artikel->gambar) && is_file("images_artikel/{$detail_artikel->gambar}"))
                            {{ HTML::image('images_artikel/'.$detail_artikel->gambar, $artikel->judul, array(
                                'class' => 'img-responsive')) }}
                        @endif
                        <br />
                        {{ $detail_artikel->content }}
                    </div>
                </div>
            </div>
            <!-- /Blog Post -->
            <!-- Sidebar -->
            <div class="col-sm-4 blog-sidebar">
                <h4>Pencarian</h4>
                {{ Form::open(array('route' => array('cari'))) }}
                    <div class="input-group">
                        {{ Form::text('searchkey',null,array('class' => 'form-control', 'placeholder' => 'Masukkan kata kunci'))}}
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                         </span>
                    </div>
                {{ Form::close() }}
                <h4>Artikel Terbaru</h4>
                <ul class="recent-posts">
                 @if(!$artikelbarus->isEmpty())
                    @foreach($artikelbarus as $artikelbaru)
                        <li>{{ link_to_route('detail_artikel', $artikelbaru->judul, array($artikelbaru->id)) }} </li>
                    @endforeach
                 @else
                    <li>Belum terdapat artikel</li>
                 @endif
                </ul>
            </div>
            <!-- /Sidebar -->
        </div>
    </div>
</div>
@stop