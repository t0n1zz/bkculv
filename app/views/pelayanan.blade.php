@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Pelayanan</h1>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
@include('_layouts.event')
<div class="section">
    <div class="container">
        <?php $i=1;$pos=""; ?>
        @foreach($pelayanans as $pelayanan)
            @if($i % 2 == 0)
                <?php $pos =2; ?>
            @elseif($i % 3 == 0)
                <?php $pos =1; ?>
            @elseif($i % 2 == 1)
                <?php $pos =1; ?>
            @endif

            @if($pos == 1)
                <div class="row" id="{{ $pelayanan->id }}">
                    <h2>{{ $pelayanan->name }}</h2>
                    <div class="col-sm-6">
                        {{ $pelayanan->content }}
                    </div>
                    <div class="col-sm-6">
                        @if(!empty($pelayanan->gambar) && is_file("images_artikel/{$pelayanan->gambar}"))
                            {{ HTML::image('images_artikel/'.$pelayanan->gambar, $pelayanan->judul, array(
                                'class' => 'img-responsive img-thumbnail shadow','width' => '700px')) }}
                        @endif
                    </div>
                </div>
                 <br/>
            @elseif($pos ==2)
                <div class="row" id="{{$pelayanan->id}}">
                    <h2>{{ $pelayanan->name }}</h2>
                    <div class="col-sm-6">
                        @if(!empty($pelayanan->gambar) && is_file("images_artikel/{$pelayanan->gambar}"))
                            {{ HTML::image('images_artikel/'.$pelayanan->gambar, $pelayanan->judul, array(
                                'class' => 'img-responsive img-thumbnail shadow','width' => '700px')) }}
                        @endif
                    </div>
                    <div class="col-sm-6">
                        {{ $pelayanan->content }}
                    </div>
                </div>
                <br/>
            @endif

            <?php  $i++; ?>
        @endforeach
    </div>
</div>
@stop