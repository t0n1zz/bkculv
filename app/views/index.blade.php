<?php $page = ""; ?>
@extends('_layouts.layout')

@section('content')
<!-- slider -->
<div class="homepage-slider">
	<div id="sequence">
		<ul class="sequence-canvas">
		<?php $i=0; ?>
		@foreach($artikelpilihans as $artikelpilihan)
		    <?php $i++; ?>
		    <li class="bg{{$i}}">
		        <h2 class="title">{{ $artikelpilihan->judul }}</h2>
		        <h3 class="subtitle">{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $artikelpilihan->content),200) }}</h3>
		         @if(!empty($artikelpilihan->gambar) && is_file("images_artikel/{$artikelpilihan->gambar}"))
                    {{ HTML::image('images_artikel/'.$artikelpilihan->gambar, $artikelpilihan->judul, array(
                        'class' => 'slide-img img-rounded img-responsive', 'width' => '400')) }}
                 @endif
		    </li>
		@endforeach
		</ul>
		<div class="sequence-pagination-wrapper">
		    <ul class="sequence-pagination">
		        <?php $i2 = 0; ?>
		        @foreach($artikelpilihans as $artikelpilihan)
		            <?php $i2++; ?>
		            <li>{{$i2}}</li>
		        @endforeach
		    </ul>
		</div>
	</div>
</div>
<!-- /slider -->
<!-- berita -->
<div class="section">
    <div class="container">
        <div class="row">
            <!-- BKCU -->
            <div class="col-sm-6 featured-news">
                <h2><a href="{{ route('artikel',array(2)) }}" style="color: #53555c">Berita BKCU</a></h2>
                 @if(!$beritaBKCUs->isEmpty())
                    @foreach($beritaBKCUs as $bkcu)
                    <div class="row">
                        @if(!empty($bkcu->gambar) && is_file("images_artikel/{$bkcu->gambar}"))
                        <div class="col-xs-4"><a href="{{ route('detil_artikel',array($artikel->id)) }}">{{ HTML::image('images_artikel/'.$bkcu->gambar, 'a picture', array('class' => 'img-responsive',
                                                                                                                'alt' => '{$bkcu->judul}', 'width' => '50')) }}</a></div>
                        <div class="col-xs-8">
                            <div class="caption">{{ link_to_route('detail_artikel', $bkcu->judul, array($bkcu->id)) }}</div>
                            <div class="date">{{ $bkcu->created_at->format('l jS \\of F Y h:i:s A') }}</div>
                            <div class="intro">{{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $bkcu->content),200,$end = '.') }}} • {{ link_to_route('detail_artikel', 'Selengkapnya...', array($bkcu->id)) }}</div>
                        </div>
                        @else
                        <div class="col-xs-12">
                            <div class="caption">{{ link_to_route('detail_artikel', $bkcu->judul, array($bkcu->id)) }}</div>
                            <div class="date">{{ $bkcu->created_at->format('l jS \\of F Y h:i:s A') }}</div>
                            <div class="intro">{{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $bkcu->content),200,$end = '.') }}} • {{ link_to_route('detail_artikel','Selengkapnya...', array($bkcu->id)) }}</div>
                        </div>
                        @endif
                    </div>
                    @endforeach
                @else
                    <div class="col-xs-12">
                        <div class="caption">Belum terdapat artikel</div>
                    </div>
                @endif
            </div>
            <!-- /BKCU -->
            <!-- CU -->
            <div class="col-sm-6 latest-news">
                <h2><a href="{{ route('artikel',array(3)) }}" style="color: #53555c">Berita CU</a></h2>
                @if(!$beritaCUs->isEmpty())
                    @foreach($beritaCUs as $cu)
                    <div class="row">
                        @if(!empty($cu->gambar) && is_file("images_artikel/{$cu->gambar}"))
                        <div class="col-xs-4"><a href="{{ route('detil_artikel',array($cu->id)) }}">{{ HTML::image('images_artikel/'.$cu->gambar, 'a picture', array('class' => 'img-responsive',
                                                                                                                'alt' => '{$cu->judul}', 'width' => '50')) }}</a></div>
                        <div class="col-xs-8">
                            <div class="caption">{{ link_to_route('detail_artikel', $cu->judul, array($cu->id)) }}/div>
                            <div class="date">{{ $cu->created_at->format('l jS \\of F Y h:i:s A') }}</div>
                            <div class="intro">{{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $cu->content),200,$end = '.') }}} • {{ link_to_route('detail_artikel', 'Selengkapnya...', array($cu->id)) }}</div>
                        </div>
                        @else
                        <div class="col-xs-12">
                            <div class="caption">{{ link_to_route('detail_artikel', $cu->judul, array($cu->id)) }}</div>
                            <div class="date">{{ $cu->created_at->format('l jS \\of F Y h:i:s A') }}</div>
                            <div class="intro">{{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $cu->content),200,$end = '.') }}} • {{ link_to_route('detail_artikel', 'Selengkapnya...', array($cu->id)) }}</div>
                        </div>
                        @endif
                    </div>
                    @endforeach
                @else
                    <div class="col-xs-12">
                        <div class="caption">Belum terdapat artikel</div>
                    </div>
                @endif
            </div>
            <!-- /cu -->
        </div>
        <hr />
        <?php $i=0; ?>
        @foreach($beritas as $berita)
            @if($i % 3 == 0 || $i == 0)
                <div class="row">
            @endif

            <div class="col-sm-4 ">
                <h3 class="underline"><a href="{{ route('artikel',array($berita->id)) }}" style="color: #53555c">{{$berita->name}}</a></h3>
                <ul class="list-group">
                    @if(!$berita->artikel->isEmpty())
                        @foreach($berita->artikel as $artikel)
                            @if($artikel->status == "1")
                                @if($artikel->pilihan == "0")
                                    <li class="list-group-item" style="margin-bottom: 5px">{{ link_to_route('detail_artikel', $artikel->judul, array($artikel->id)) }}</li>
                                @else
                                    <li class="list-group-item" style="margin-bottom: 5px">Belum terdapat artikel</li>
                                @endif
                            @else
                                <li class="list-group-item" style="margin-bottom: 5px">Belum terdapat artikel</li>
                            @endif
                        @endforeach
                    @else
                        <li class="list-group-item" style="margin-bottom: 5px">Belum terdapat artikel</li>
                    @endif
                </ul>
            </div>

            <?php $result = $berita->count(); ?>
            <?php $i++; ?>
            @if($i % 3 == 0 || $i == $result)
                </div>
            @endif
        @endforeach
    </div>
</div>
<!-- /berita -->

<!-- Solusi-->
<div class="section">
    <div class="container">
        <h2>Solusi</h2>
        <div class="row">
        @foreach($pelayanans as $pelayanan)
        <?php $pelayanancount = $pelayanan->count(); ?>
                <div class="col-md-4 col-sm-6">
                <a href="{{ route('solusi',array($pelayanan->id)) }}">
                    <div class="portfolio-item" style="color: #53555c">
                        <div class="portfolio-image">
                            @if(!empty($pelayanan->gambar) && is_file("images_artikel/{$pelayanan->gambar}"))
                                {{ HTML::image('images_artikel/'.$pelayanan->gambar, 'a picture',
                                    array('alt' => '{$cu->judul}', 'width' => '500')) }}
                            @endif
                        </div>
                        <div class="portfolio-info">
                            <ul>
                                <li class="portfolio-project-name"><b>{{ $pelayanan->name }}</b></li>
                                <hr style="border-top:1px solid #D2D2D2;"/>
                                <p>{{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $pelayanan->content),210) }}}</p>
                            </ul>
                        </div>
                    </div>
                </a>
                </div>
        @endforeach
        </div>
    </div>
</div>
<!-- /Solusi-->
<!-- agenda-->
<div class="section">
    <div class="container">
        <h2>Agenda Pelatihan</h2>
        <div class="row">
            @include('_components.agenda')
        </div>
    </div>
</div>
<!-- /agenda-->
<!-- gambar kegiatan-->
<div class="section">
    <div class="container">
        <h2>Kegiatan Kami</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="products-slider">
                    @foreach($gambarkegiatans as $gambarkegiatan)
                        <div class="shop-item">
                            <div class="image modalphotos">
                            @if(!empty($gambarkegiatan->gambar) && is_file("images_kegiatan/{$gambarkegiatan->gambar}"))
                                {{ HTML::image('images_kegiatan/'.$gambarkegiatan->gambar, 'a picture',
                                    array('class' => 'img-rounded img-responsive','alt' => '{$cu->judul}', 'width' => '300',
                                           'style' => 'cursor: pointer;cursor: hand')) }}
                            @endif
                            </div>
                            <div class="title">
                                <h3>{{ $gambarkegiatan->name }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-12">
                    <hr style="border-top:1px solid #D2D2D2;"/>
                    <a href="https://www.flickr.com/photos/127271987@N07/"
                       target="_BLANK"
                       class="btn pull-right"><b>Selengkapnya</b></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- gambar kegiatan-->

<!--modal photos-->
<div class="modal fade" id="modalphotoshow">
    <div class="modal-body">
      <img class="pointer img-responsive center-block" src="" id="modalimage"/>
    </div>
</div>
<!--/modal photos-->

@stop