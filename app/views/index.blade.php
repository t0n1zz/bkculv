<?php $page = ""; ?>
@extends('_layouts.layout')

@section('content')
<!-- slider -->
<div class="homepage-slider" >
	<div id="sequence" style="border-bottom: 4px solid #4f8db3;">
		<ul class="sequence-canvas">
            <!--<li style=" background-image: url('{{asset('images/slider-easter.jpg')}}');">
                <h3 class="title" style="color: #ffffff">Selamat Hari Raya Paskah</h3>
                <h4 class="subtitle"><p align="justify" style="color: #ffffff">
                        Pengurus, Pengawas, Dan Manajemen Puskopdit BKCU Mengucapkan Selamat Hari Raya Paskah <br/>
                        Semoga Semangat Kebangkitan Hadir Untuk Mewujudkan Pelayanan Nyata Bagi Sesama</p></h4>
                <?php //HTML::image('images/easter.jpg', 'easter', array(
                        //'class' => 'slide-img img-rounded img-responsive', 'width' => '300'))}} ?>
            </li>-->
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
            <?php $i=0; ?>
            @foreach($artikelpilihans as $artikelpilihan)
                <?php $i++; ?>
                <li class="bg{{$i}}">
                    <h3 class="title"><a
                        href="{{ route('detail_artikel',array($artikelpilihan->id)) }}"
                        style="color: white"
                        >{{ str_limit($artikelpilihan->judul,70) }}</a></h3>
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
                    <?php $i2++; ?>
                    <!--<li>{{$i2}}</li>-->
		        @if(!empty($ultahcu))
		            <?php $i2++; ?>
                    <li>{{$i2}}</li>
		        @endif
		        @foreach($artikelpilihans as $artikelpilihan)
		            <?php $i2++; ?>
		            <li>{{$i2}}</li>
		        @endforeach
		    </ul>
		</div>
	</div>
</div>
<!-- /slider -->
<!--<img class="img-responsive" src="{{ asset('images/topimlek.png') }}" width="100%"
               style="vertical-align: top;margin-top: -30px;margin-bottom: -3%;"/>-->
<!-- pemilihan-->
@include('_components.pemilihan')
<!-- pemilihan-->
<!-- berita -->
<div class="section">
    <div class="container">
        <div class="row">
            <!-- BKCU -->
            <div class="col-sm-12 featured-news">
                <div class="visible-md visible-lg">
                    <h2>{{ $judulBeritas[1]->name }}
                        <a href="{{ route('artikel',array(2)) }}" class="btn btn-sm pull-right">
                            Selengkapnya <i class="fa fa-arrow-circle-right"></i></a> </h2>
                </div>
                <div class="visible-sm visible-xs">
                    <a href="{{ route('artikel',array(2)) }}" class="btn btn-block">
                        {{ $judulBeritas[1]->name }}</a>
                </div>

                 @if(!$beritaBKCUs->isEmpty())
                    <?php $i=0; ?>
                    @foreach($beritaBKCUs as $bkcu)
                        @if($i % 2 == 0 || $i == 0)
                            <div class="col-sm-6">
                        @endif
                        <div class="row mainArticle">
                            <a href="{{ route('detail_artikel',array($bkcu->id)) }}">
                                @if(!empty($bkcu->gambar) && is_file("images_artikel/{$bkcu->gambar}"))
                                <div class="col-xs-4">{{ HTML::image('images_artikel/'.$bkcu->gambar, 'a picture', array('class' => 'img-rounded',
                                            'alt' => '{$bkcu->judul}', 'width' => '100%')) }}</div>
                                <div class="col-xs-8">
                                    <div class="caption "><b>{{ $bkcu->judul}}</b></div>
                                    <?php $date = new Date($bkcu->created_at); ?>
                                    <div class="date" style="font-size: 14px;padding-bottom: 5px"><i class="fa fa-fw fa-clock-o"></i> {{ $date->format('l, j F Y, H:i:s') }}</div>
                                    <div class="intro">
                                        <p align="justify">{{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $bkcu->content),150) }}}</p>
                                    </div>
                                </div>
                                @else
                                <div class="col-xs-12">
                                    <div class="caption"><b>{{ $bkcu->judul }}</b></div>
                                    <?php $date = new Date($bkcu->created_at); ?>
                                    <div class="date" style="font-size: 14px;padding-bottom: 5px;"><i class="fa fa-fw fa-clock-o"></i> {{ $date->format('l, j F Y, H:i:s') }}</div>
                                    <div class="intro"><p align="justify">{{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $bkcu->content),200) }}}</p></div>
                                </div>
                                @endif
                            </a>
                        </div>
                        <?php $result = $bkcu->count(); ?>
                        <?php $i++; ?>
                        @if($i % 2 == 0 || $i == $result)
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="col-xs-12">
                        <div class="caption"><b>Belum terdapat artikel</b></div>
                    </div>
                @endif

            </div>
            <!-- /BKCU -->
        </div>
        <br>

        <div class="row">
            <!-- Filosofi -->
            <div class="col-sm-6 featured-news">
                <div class="visible-md visible-lg">
                    <h2>{{ $judulBeritas[2]->name }}
                        <a href="{{ route('artikel',array(4)) }}" class="btn  btn-sm pull-right">
                           Selengkapnya <i class="fa fa-arrow-circle-right"></i></a></h2>
                </div>
                <div class="visible-sm visible-xs">
                    <a href="{{ route('artikel',array(4)) }}" class="btn  btn-block">
                        {{ $judulBeritas[2]->name }} </a>
                </div>
                @if(!$filosofis->isEmpty())
                    @foreach($filosofis as $filosofi)
                        <div class="col-sm-12">
                            <div class="row mainArticle">
                                <a href="{{ route('detail_artikel',array($filosofi->id)) }}">
                                    @if(!empty($filosofi->gambar) && is_file("images_artikel/{$filosofi->gambar}"))
                                        <div class="col-xs-4">{{ HTML::image('images_artikel/'.$filosofi->gambar, 'a picture', array('class' => 'img-rounded',
                                          'alt' => '{$cu->judul}', 'width' => '100%')) }}</div>
                                        <div class="col-xs-8">
                                            <div class="caption"><b>{{ $filosofi->judul }}</b></div>
                                            <?php $date = new Date($filosofi->created_at); ?>
                                            <div class="date" style="font-size: 14px;padding-bottom: 5px"><i class="fa fa-fw fa-clock-o"></i> {{ $date->format('l, j F Y, H:i:s') }}</div>
                                            <div class="intro"><p align="justify">{{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $filosofi->content),150) }}}</p></div>
                                        </div>
                                    @else
                                        <div class="col-xs-12">
                                            <div class="caption"><b>{{ $filosofi->judul }}</b></div>
                                            <?php $date = new Date($filosofi->created_at); ?>
                                            <div class="date" style="font-size: 14px;padding-bottom: 5px"><i class="fa fa-fw fa-clock-o"></i> {{ $date->format('l, j F Y, H:i:s') }}</div>
                                            <div class="intro"><p align="justify">{{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $filosofi->content),200) }}}</p></div>
                                        </div>
                                    @endif
                                </a>
                            </div>
                        </div>

                    @endforeach
                @else
                    <div class="col-xs-12">
                        <div class="caption"><b>Belum terdapat artikel</b></div>
                    </div>
                @endif

            </div>
            <!-- /filosofi -->
            <!-- cu -->
            <div class="col-sm-6 featured-news">
                <div class="visible-md visible-lg">
                    <h2>{{ $judulBeritas[7]->name }}
                        <a href="{{ route('artikel',array(9)) }}" class="btn btn-sm pull-right">
                           Selengkapnya <i class="fa fa-arrow-circle-right"></i></a></h2>
                </div>
                <div class="visible-sm visible-xs">
                    <a href="{{ route('artikel',array(9)) }}" class="btn btn-block ">
                        {{ $judulBeritas[7]->name }}</a>
                </div>
                @if(!$beritaCUs->isEmpty())
                    @foreach($beritaCUs as $beritaCU)
                        <div class="col-sm-12">
                            <div class="row mainArticle">
                                <a href="{{ route('detail_artikel',array($beritaCU->id)) }}">
                                    @if(!empty($beritaCU->gambar) && is_file("images_artikel/{$beritaCU->gambar}"))
                                        <div class="col-xs-4">{{ HTML::image('images_artikel/'.$beritaCU->gambar, 'a picture', array('class' => 'img-rounded',
                                          'alt' => '{$cu->judul}', 'width' => '100%')) }}</div>
                                        <div class="col-xs-8">
                                            <div class="caption"><b>{{ $beritaCU->judul }}</b></div>
                                            <?php $date = new Date($beritaCU->created_at); ?>
                                            <div class="date" style="font-size: 14px;padding-bottom: 5px"><i class="fa fa-fw fa-clock-o"></i> {{ $date->format('l, j F Y, H:i:s') }}</div>
                                            <div class="intro"><p align="justify">{{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $beritaCU->content),150) }}}</p></div>
                                        </div>
                                    @else
                                        <div class="col-xs-12">
                                            <div class="caption"><b>{{ $beritaCU->judul }}</b></div>
                                            <?php $date = new Date($beritaCU->created_at); ?>
                                            <div class="date" style="font-size: 14px;padding-bottom: 5px"><i class="fa fa-fw fa-clock-o"></i> {{ $date->format('l, j F Y, H:i:s') }}</div>
                                            <div class="intro"><p align="justify">{{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $beritaCU->content),200) }}}</p></div>
                                        </div>
                                    @endif
                                </a>
                            </div>
                        </div>

                    @endforeach
                @else
                    <div class="col-xs-12">
                        <div class="caption"><b>Belum terdapat artikel</b></div>
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
                <div class="visible-md visible-lg">
                <h3 class="underline">{{$berita->name}}<a href="{{ route('artikel',array($berita->id)) }}" class="btn btn-sm pull-right">
                             <i class="fa fa-arrow-circle-right"></i></a></h3>
                </div>
                <div class="visible-sm visible-xs">
                    <a href="{{ route('artikel',array($berita->id)) }}" class="btn btn-block">
                        {{$berita->name}}</a>
                </div>
                <br/>
                <ul class="list-group mainArticle">
                    @if(!$berita->artikel->isEmpty())
                        @foreach($berita->artikel as $artikel)
                            <li class="list-group-item " style="margin-bottom: 5px;">{{ link_to_route('detail_artikel', $artikel->judul, array($artikel->id)) }}</li>
                        @endforeach
                        @if($berita->artikel->count() > 2)
                            <li class="list-group-item" style="margin-bottom: 5px"><b><a href="{{ route('artikel',array($berita->id)) }}">Selengkapnya</a></b></li>
                        @endif
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
        <div class="visible-md visible-lg">
            <h2>Pelayanan <a href="{{ route('pelayanan') }}" class="btn btn-sm pull-right">
                    Selengkapnya <i class="fa fa-arrow-circle-right"></i></a></h2>
        </div>
        <div class="visible-sm visible-xs">
            <a href="{{ route('pelayanan') }}" class="btn btn-block">
                Pelayanan</a>
        </div>
        <br/>
        <div class="row">
        @foreach($pelayanans as $pelayanan)
        <?php $pelayanancount = $pelayanan->count(); ?>
                <div class="col-md-4 col-sm-6">
                <a href="{{ route('pelayanans',array($pelayanan->id)) }}">
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
        <div class="visible-md visible-lg">
            <h2>Kegiatan <a href="{{ route('kegiatan') }}" class="btn btn-sm pull-right">
                    Selengkapnya <i class="fa fa-arrow-circle-right"></i></a></h2>
        </div>
        <div class="visible-sm visible-xs">
            <a href="{{ route('kegiatan') }}" class="btn btn-block ">Kegiatan</a>
        </div>
        <br/>
        <div class="row">
            @include('_components.agenda')
        </div>
    </div>
</div>
<!-- /agenda-->
<!-- gambar kegiatan-->
<div class="section">
    <div class="container">
        <div class="visible-md visible-lg">
            <h2>Foto Kegiatan Terbaru <a href="https://www.flickr.com/photos/127271987@N07/"
                                         target="_BLANK"
                                         class="btn btn-sm pull-right">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a></h2>
        </div>
        <div class="visible-sm visible-xs">
            <a href="https://www.flickr.com/photos/127271987@N07/"
               target="_BLANK"
               class="btn btn-block">Foto Kegiatan Terbaru</a>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="products-slider">
                    @foreach($gambars as $gambar)
                        <div class="shop-item shadow" >
                            <div class="image modalflickr" >
                                <?php
                                    $img_url = "http://farm{$gambar['farm']}.staticflickr.com/{$gambar['server']}/{$gambar['id']}_{$gambar['secret']}_q.jpg";
                                    $img_url_big = "http://farm{$gambar['farm']}.staticflickr.com/{$gambar['server']}/{$gambar['id']}_{$gambar['secret']}_b.jpg";
                                 ?>
                                {{ HTML::image($img_url,$img_url_big,
                                    array('class' => 'img-rounded img-responsive', 'width' => '100%',
                                           'style' => 'cursor: pointer;cursor: hand')) }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- gambar kegiatan-->

<!--modal flickr-->
<div class="modal fade" id="modalflickrshow">
  <div class="modal-body">
    <img class="pointer img-responsive center-block" src="" id="modalflickr"/>
  </div>
</div>
<!--/modal flickr-->
@stop