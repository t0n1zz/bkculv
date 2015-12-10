@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Kegiatan</h1>
            </div>
        </div>
    </div>
</div>
<img class="img-responsive" src="{{ asset('images/topnatal.png') }}" width="100%"
     style="vertical-align: top;margin-top: -30px;margin-bottom: 1%;"/>
<!-- /Page Title -->
<div class="section section-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="calltoaction-wrapper">
                    <i class="fa fa-info-circle fa-2x"></i>
                    <h3> Dapatkan catalog diklat yang berisi informasi mengenai semua diklat yang diselenggarakan Tahun 2015 </h3>
                    <a href="https://drive.google.com/file/d/0B5-CAlY_YuBDXzZnblgyOG5jcVE/view?usp=sharing" target="_blank" class="btn btn-orange">Disini</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section blog-posts-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis Diklat</th>
                            <th>Wilayah</th>
                            <th>Tempat</th>
                            <th>Waktu</th>
                            <th>Sasaran Peserta</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0; ?>
                        @foreach($kegiatans as $kegiatan)
                            <tr>
                                @if(!empty($kegiatan->tanggal))
                                    <?php $date = new Date($kegiatan->tanggal); ?>
                                    <td><i hidden="true">{{  $kegiatan->tanggal }}</i> {{ $date->format('l, j F Y') }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if(!empty($kegiatan->name))
                                    <td>{{ $kegiatan->name }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if(!empty($kegiatan->wilayah))
                                    <td>{{ $kegiatan->wilayah }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if(!empty($kegiatan->tempat))
                                    <td>{{ $kegiatan->tempat }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                <?php
                                $startTimeStamp = strtotime($kegiatan->tanggal);
                                $endTimeStamp = strtotime($kegiatan->tanggal2);
                                $timeDiff = abs($endTimeStamp - $startTimeStamp);
                                $numberDays = $timeDiff/86400;
                                $numberDays = intval($numberDays) + 1;
                                $realnumber = sprintf("%02s", $numberDays);
                                ?>
                                <td class="event-venue"><i hidden="true">{{ $realnumber }}</i> {{ $numberDays  }} Hari</td>

                                @if(!empty($kegiatan->sasaran))
                                    <td>{{ $kegiatan->sasaran }}</td>
                                @else
                                    <td>-</td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
       </div>
    </div>
</div>

@stop