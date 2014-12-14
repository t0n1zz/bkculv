<?php $page = ""; ?>
@extends('_layouts.layout')

@section('content')
<!-- slider -->
<div class="homepage-slider" >
	<div id="sequence" style="border-bottom: 4px solid #4f8db3;">
		<ul class="sequence-canvas">
		    @if(!empty($ultahcu))
		        <li style=" background-image: url('{{asset('images/slider-birthday.jpg')}}');">
                    <h3 class="title"><a href="{{ route('jejaring') }}" style="color: white"
                        >Selamat Ulang Tahun Kepada CU
                        <?php $i3=0; ?>
                        @foreach($ultahcu as $ultah)
                            <?php
                                $i3++;
                                $total = count($ultahcu);
                             ?>
                            {{ $ultah->name }}
                            @if( $total == 1 && $i3 != $total)
                                {{ 'dan' }}
                            @elseif( $total > 1 && $i3 < ($total-1))
                                {{ ',' }}
                            @elseif( $total > 1 && $i3 == ($total-1))
                                {{ 'dan' }}
                            @endif
                        @endforeach
                        </a></h3>
                    <h4 class="subtitle"><p align="justify"><a
                        href="{{ route('jejaring') }}"
                        style="color: white"
                        >Pengurus, Pengawas, Dan Manajemen Puskopdit BKCU Mengucapkan Selamat Ulang Tahun Kepada Credit Union
                        <?php $i4=0; ?>
                         @foreach($ultahcu as $ultah)
                            <?php
                                $i4++;
                                $total2 = count($ultahcu);
                            ?>
                            {{ $ultah->name }}
                            @if( $total2 == 1 && $i4 != $total2)
                                {{ 'dan' }}
                            @elseif( $total2 > 1 && $i4 < ($total2-1))
                                {{ ', ' }}
                            @elseif( $total2 > 1 && $i4 == ($total2-1))
                                {{ 'dan' }}
                            @endif
                         @endforeach
                         Semoga Semakin Maju Dan Terus Berkarya</a></p></h4>
                    {{ HTML::image('images/birthday.png', 'birthday', array(
                                            'class' => 'slide-img img-rounded img-responsive', 'width' => '400')) }}
                </li>
		    @endif
            <li style=" background-image: url('{{asset('images/slider-christmast.jpg')}}');">
                <h3 class="title"><a href="#" style="color: white"
                    >Selamat Natal Dan Tahun Baru</a></h3>
                <h4 class="subtitle"><p align="justify"><a
                    href="#"
                    style="color: white"
                    >Pengurus, Pengawas, Dan Manajemen Puskopdit BKCU Mengucapkan Selamat Natal dan Tahun Baru 2015.</a></p></h4>
                {{ HTML::image('images/christmast.jpg', 'christmast', array(
                                        'class' => 'slide-img img-rounded img-responsive', 'width' => '400')) }}
            </li>
            <?php $i=0; ?>
            @foreach($artikelpilihans as $artikelpilihan)
                <?php $i++; ?>
                <li class="bg{{$i}}">
                    <h3 class="title"><a
                        href="{{ route('detail_artikel',array($artikelpilihan->id)) }}"
                        style="color: white"
                        >{{ $artikelpilihan->judul }}</a></h3>
                    <h4 class="subtitle"><p align="justify"><a
                        href="{{ route('detail_artikel',array($artikelpilihan->id)) }}"
                        style="color: white"
                        >{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $artikelpilihan->content),250) }}</a></p></h4>
                     @if(!empty($artikelpilihan->gambar) && is_file("images_artikel/{$artikelpilihan->gambar}"))
                        {{ HTML::image('images_artikel/'.$artikelpilihan->gambar, $artikelpilihan->judul, array(
                            'class' => 'slide-img img-rounded img-responsive', 'width' => '400')) }}
                     @endif
                </li>
            @endforeach
		</ul>
		<div class="sequence-pagination-wrapper hidden-xs">
		    <ul class="sequence-pagination">
		        <?php $i2 = 0; ?>
		        @if(!empty($ultahcu))
		            <?php $i2++; ?>
                    <li>{{$i2}}</li>
		        @endif
                <?php $i2++; ?>
                <li>{{$i2}}</li>
		        @foreach($artikelpilihans as $artikelpilihan)
		            <?php $i2++; ?>
		            <li>{{$i2}}</li>
		        @endforeach
		    </ul>
		</div>
	</div>
</div>
<!-- /slider -->
      <img class="img-responsive" src="{{ asset('images/top.png') }}" width="100%"  style="vertical-align: top;margin-top: -30px;margin-bottom: -3%;"/>
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
                        <div class="col-xs-4"><a href="{{ route('detail_artikel',array($bkcu->id)) }}"
                                >{{ HTML::image('images_artikel/'.$bkcu->gambar, 'a picture', array('class' => 'img-rounded shadow',
                                    'alt' => '{$bkcu->judul}', 'width' => '100%')) }}</a></div>
                        <div class="col-xs-8">
                            <div class="caption">{{ link_to_route('detail_artikel', $bkcu->judul, array($bkcu->id)) }}</div>
                            <?php $date = new Date($bkcu->created_at); ?>
                            <div class="date" style="font-size: 14px;color: #017ebc;padding-bottom: 5px"><i class="fa fa-fw fa-clock-o"></i> {{ $date->format('l, j F Y, H:i:s') }}</div>
                            <div class="intro"><p align="justify">{{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $bkcu->content),150) }}}<b>
                            <br/> {{ link_to_route('detail_artikel', 'Selengkapnya', array($bkcu->id)) }}</b></p> </div>
                        </div>
                        @else
                        <div class="col-xs-12">
                            <div class="caption">{{ link_to_route('detail_artikel', $bkcu->judul, array($bkcu->id)) }}</div>
                            <?php $date = new Date($bkcu->created_at); ?>
                            <div class="date" style="font-size: 14px;color: #017ebc;padding-bottom: 5px;"><i class="fa fa-fw fa-clock-o"></i> {{ $date->format('l, j F Y, H:i:s') }}</div>
                            <div class="intro"><p align="justify">{{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $bkcu->content),200) }}} <b>
                             {{ link_to_route('detail_artikel','Selengkapnya', array($bkcu->id)) }}</b></p></div>
                        </div>
                        @endif
                    </div>
                    @endforeach
                @else
                    <div class="col-xs-12">
                        <div class="caption"><b>Belum terdapat artikel</b></div>
                    </div>
                @endif

                @if($beritaBKCUs->count() > 2)
                    <div class="col-sm-12">
                        <hr style="border-top:1px solid #D2D2D2;"/>
                        <a href="{{ route('artikel',array(2)) }}" class="btn pull-right"><b>Selengkapnya</b></a>
                    </div>
                @endif
            </div>
            <!-- /BKCU -->
            <!-- CU -->
            <div class="col-sm-6 featured-news">
                <h2><a href="{{ route('artikel',array(3)) }}" style="color: #53555c">Berita CU</a></h2>
                @if(!$beritaCUs->isEmpty())
                    @foreach($beritaCUs as $cu)
                    <div class="row">
                        @if(!empty($cu->gambar) && is_file("images_artikel/{$cu->gambar}"))
                        <div class="col-xs-4"><a href="{{ route('detail_artikel',array($cu->id)) }}"
                            >{{ HTML::image('images_artikel/'.$cu->gambar, 'a picture', array('class' => 'img-rounded shadow',
                                      'alt' => '{$cu->judul}', 'width' => '100%')) }}</a></div>
                        <div class="col-xs-8">
                            <div class="caption">{{ link_to_route('detail_artikel', $cu->judul, array($cu->id)) }}</div>
                            <?php $date = new Date($cu->created_at); ?>
                            <div class="date" style="font-size: 14px;color: #017ebc;padding-bottom: 5px"><i class="fa fa-fw fa-clock-o"></i> {{ $date->format('l, j F Y, H:i:s') }}</div>
                            <div class="intro"><p align="justify">{{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $cu->content),150) }}} <b>
                            <br/> {{ link_to_route('detail_artikel', 'Selengkapnya', array($cu->id)) }}</b></p></div>
                        </div>
                        @else
                        <div class="col-xs-12">
                            <div class="caption">{{ link_to_route('detail_artikel', $cu->judul, array($cu->id)) }}</div>
                            <?php $date = new Date($cu->created_at); ?>
                            <div class="date" style="font-size: 14px;color: #017ebc;padding-bottom: 5px"><i class="fa fa-fw fa-clock-o"></i> {{ $date->format('l, j F Y, H:i:s') }}</div>
                            <div class="intro"><p align="justify">{{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $cu->content),200) }}} <b>
                             {{ link_to_route('detail_artikel', 'Selengkapnya', array($cu->id)) }}</b></p></div>
                        </div>
                        @endif
                    </div>
                    @endforeach
                @else
                    <div class="col-xs-12">
                        <div class="caption"><b>Belum terdapat artikel</b></div>
                    </div>
                @endif

                @if($beritaCUs->count() > 2)
                    <div class="col-sm-12">
                        <hr style="border-top:1px solid #D2D2D2;"/>
                        <a href="{{ route('artikel',array(3)) }}" class="btn pull-right"><b>Selengkapnya</b></a>
                    </div>
                @endif
            </div>
            <!-- /cu -->
        </div>
        <br />

        <?php $i=0; ?>
        @foreach($beritas as $berita)
            @if($i % 3 == 0 || $i == 0)
                <div class="row">
            @endif

            <div class="col-sm-4 ">
                <h3 class="underline"><a href="{{ route('artikel',array($berita->id)) }}" style="color: #53555c">{{$berita->name}}</a></h3>
                <ul class="list-group ">
                    @if(!$berita->artikel->isEmpty())
                        @foreach($berita->artikel as $artikel)
                            <li class="list-group-item shadow " style="margin-bottom: 5px;">{{ link_to_route('detail_artikel', $artikel->judul, array($artikel->id),array('style'=>'color:#53555c')) }}</li>
                        @endforeach
                        @if($berita->artikel->count() > 2)
                            <li class="list-group-item shadow" style="margin-bottom: 5px"><b><a href="{{ route('artikel',array($berita->id)) }}">Selengkapnya</a></b></li>
                        @endif
                    @else
                        <li class="list-group-item shadow" style="margin-bottom: 5px">Belum terdapat artikel</li>
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
                        <div class="shop-item shadow">
                            <div class="image modalphotos">
                            @if(!empty($gambarkegiatan->gambar) && is_file("images_kegiatan/{$gambarkegiatan->gambar}"))
                                {{ HTML::image('images_kegiatan/'.$gambarkegiatan->gambar, 'a picture',
                                    array('class' => 'img-rounded img-responsive','alt' => '{$cu->judul}', 'width' => '100%',
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