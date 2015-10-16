<?php $title="Dashboard"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-dashboard"></i> {{$title}}</h1>
    </div>
</div>
<!-- 1st row -->
<div class="row">
    <div class=" col-lg-12">
        @if(Session::has('message'))
            <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>{{ Session::get('message') }}</p>
            </div>
        @endif

        @if(Session::has('errormessage'))
            <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>{{ Session::get('errormessage') }}</p>
            </div>
        @endif
	</div>
</div>
<!-- /1st row -->
<!-- 2nd row -->
<div class="row">
    <!-- 1st huge button -->
    @if(Entrust::can('pengumuman'))
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                        $total_pengumuman = Pengumuman::count();
                        ?>
                        <div class="huge">{{ $total_pengumuman }}</div>
                        <div>Pengumuman</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('admins.pengumuman.index') }}">
                <div class="panel-footer">
                    <span class="pull-left">Detail</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    @endif
    <!-- /1st huge button -->
    <!-- 1st huge button -->
    @if(Entrust::can('artikel'))
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-book fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $total_artikel = Artikel::count();
                    ?>
                        <div class="huge">{{ $total_artikel }}</div>
                        <div>Artikel</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('admins.artikel.index') }}">
                <div class="panel-footer">
                    <span class="pull-left">Detail</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    @endif
    <!-- /1st huge button -->
    <!-- 2nd huge button -->
    @if(Entrust::can('pelayanan'))
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-gift fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $total_pelayanan = Pelayanan::count();
                    ?>
                        <div class="huge">{{ $total_pelayanan }}</div>
                        <div>Pelayanan</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('admins.pelayanan.index') }}">
                <div class="panel-footer">
                    <span class="pull-left">Detail</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    @endif
    <!-- /2nd huge button -->
    <!-- 3rd huge button -->
    @if(Entrust::can('kegiatan'))
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-calendar fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $total_kegiatan = kegiatan::count();
                    ?>
                        <div class="huge">{{ $total_kegiatan }}</div>
                        <div>Kegiatan</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('admins.kegiatan.index') }}">
                <div class="panel-footer">
                    <span class="pull-left">Detail</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    @endif
    <!-- /3rd huge button -->
    <!-- 4th huge button -->
    @if(Entrust::can('cuprimer'))
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-building fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $total_cuprimer = Cuprimer::count();
                    ?>
                        <div class="huge">{{$total_cuprimer}}</div>
                        <div>CU Primer</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('admins.cuprimer.index') }}">
                <div class="panel-footer">
                    <span class="pull-left">Detail</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    @endif
    <!-- 4th huge button -->
    <!-- 5th huge button -->
    @if(Entrust::can('staff'))
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-sitemap fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                        $total_staff = Staff::count();
                        ?>
                        <div class="huge">{{ $total_staff }}</div>
                        <div>Staf</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('admins.staff.index') }}">
                <div class="panel-footer">
                    <span class="pull-left">Detail</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    @endif
    <!-- /5th huge button -->
    <!-- 6th huge button -->
    @if(Entrust::can('download'))
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-download fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                        $total_download = Download::count();
                        ?>
                        <div class="huge">{{ $total_download }}</div>
                        <div>Download</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('admins.download.index') }}">
                <div class="panel-footer">
                    <span class="pull-left">Detail</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    @endif
    <!-- /6th huge button -->
    <!-- 7th huge button -->
    @if(Entrust::can('admin'))
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                        $total_admin = Admin::count();
                        ?>
                        <div class="huge">{{ $total_admin }}</div>
                        <div>Admin</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('admins.admin.index') }}">
                <div class="panel-footer">
                    <span class="pull-left">Detail</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    @endif
    <!-- /7th huge button -->
</div>
<!-- /2nd row -->
<hr />
<!-- 3rd row -->
<div class="row">
    <div class="col-lg-5">
        <!--statistik website-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><b><i class="fa fa-road"></i> Statistik Pengunjung Website</b></h4>
            </div>
            <div class="panel-body">
            <?php
                $tabel = "stat_pengunjung";
                $tanggal = date("Ymd");

                $pengunjung = DB::table($tabel)
                                    ->where('tanggal',$tanggal)
                                    ->groupBy('ip')
                                    ->count();

                $totalpengunjung = DB::table($tabel)
                                       ->count();

                $bataswaktu       = time() - 300;

                $pengunjungonline = DB::table($tabel)
                                            ->where('online','>',$bataswaktu)
                                            ->count();

                $tanggal_hariini  = date('d-m-Y');
            ?>
            <h4 style="text-align: center;" ><b>Pengunjung Hari Ini</b></h4>
            <h4 style="text-align: center;" >{{ Date::now()->format('l , j F Y ')}}</h4>
            <h3 style="text-align: center;" ><b>{{$pengunjung}}</b> orang</h3>
            <hr />
            <dl class="dl-horizontal">
              <dt><b style="font-size: 13px" >Total Pengunjung : </b></dt>
              <dd><b style="font-size: 13px" >{{$totalpengunjung}} orang</b></dd>
              <dt><b style="font-size: 13px" >Pengunjung Online : </b></dt>
              <dd><b style="font-size: 13px" >{{$pengunjungonline}} orang</b></dd>
              <dt><b style="font-size: 13px" >Reset : </b></dt>
              <dd><b style="font-size: 13px" > 5 September 2014 </b></dd>
            </dl>
            </div>
            <div class="panel-footer">
                <a href="{{ route('statistik') }}" class="btn btn-default btn-block">
                    <div>
                        <span class="pull-left"><b>Detail</b></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <!--/statistik website-->
        <!--info gerakan-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><b><i class="fa fa-exclamation-circle"></i> Info Gerakan</b></h4>
            </div>
            <div class="panel-body">
             <?php $infogerakan = InfoGerakan::find(1); ?>
                @if(!empty($infogerakan->tanggal))
                    <?php $date = new Date($infogerakan->tanggal) ?>
                    <b>Per tanggal :</b> {{ $date->format('j F Y ')}}
                    <br/>
                @endif
                @if(!empty($infogerakan->jumlah_anggota))
                    <b>Jumlah Anggota :</b> {{ number_format($infogerakan->jumlah_anggota,0,",",".") }} orang
                    <br/>
                @endif
                @if(!empty($infogerakan->jumlah_cu))
                    <b>Jumlah CU Primer :</b> {{ number_format($infogerakan->jumlah_cu,0,",",".")}}
                    <br/>
                @endif
                @if(!empty($infogerakan->jumlah_staff_cu))
                    <b>Jumlah Staff CU Primer :</b> {{ number_format($infogerakan->jumlah_staff_cu,0,",",".") }} orang
                    <br/>
                @endif
                @if(!empty($infogerakan->asset))
                    <b>Jumlah Asset :</b> Rp. {{ number_format($infogerakan->asset,0,",",".") }}
                    <br/>
                @endif
                @if(!empty($infogerakan->piutang_beredar))
                    <b>Jumlah Piutang Beredar :</b> Rp. {{ number_format($infogerakan->piutang_beredar,0,",",".") }}
                    <br/>
                @endif
                @if(!empty($infogerakan->piutang_lalai_1))
                    <b>Jumlah Piutang Lalai 1 s.d. 12 Bulan  :</b> Rp. {{ number_format($infogerakan->piutang_lalai_1,0,",",".") }}
                    <br/>
                @endif
                @if(!empty($infogerakan->piutang_lalai_2))
                    <b>Jumlah Piutang > 12 Bulan  :</b> Rp. {{ number_format($infogerakan->piutang_lalai_2,0,",",".") }}
                    <br/>
                @endif
                @if(!empty($infogerakan->piutang_bersih))
                    <b>Jumlah Piutang Bersih  :</b> Rp. {{ number_format($infogerakan->piutang_bersih,0,",",".") }}
                    <br/>
                @endif
                @if(!empty($infogerakan->shu))
                    <b>SHU  :</b> Rp. {{ number_format($infogerakan->shu,0,",",".") }}
                    <br/>
                @endif

            </div>
            @if(Entrust::can('infogerakan'))
            <div class="panel-footer">
                <a href="{{ route('admins.infogerakan.edit',array(1)) }}" class="btn btn-default btn-block">
                    <div>
                        <span class="pull-left"><b>Detail</b></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
            @endif
        </div>
        <!--/info gerakan-->
    </div>

    <div class="col-lg-7">
         <div class="panel panel-default">
            <div class="panel-heading">
                <h4><b><i class="fa fa-user"></i> Waktu Terakhir Admin Login</b></h4>
            </div>
            <div class="panel-body">
                <?php
                $logins = Admin::select('name','login')
                        ->orderBy('login','desc')
                        ->get();
                ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama </th>
                            <th>Login</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0; ?>
                        @foreach($logins as $login)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i; }}</td>

                                @if(!empty($login->name))
                                    <td>{{ $login->name }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if(!empty($login->login))
                                    @if($login->login != "0000-00-00 00:00:00")
                                        <?php $datelogin = new Date($login->login); ?>
                                        <td>{{ $datelogin->format('l, j F Y, H:i:s') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
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
        @if(Entrust::can('saran'))
        <div class="chat-panel panel panel-default">
            <div class="panel-heading">
                <h4><b><i class="fa fa-paper-plane-o fa-fw"></i> Saran Atau Kritik</b></h4>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <ul class="chat">
                    <?php
                    $sarans = Saran::orderBy('created_at','desc')->take(10)->get();
                    ?>
                    @foreach($sarans as $saran)
                    <li class=" clearfix">
                        <div class="chat-body clearfix">
                            <div class="header">
                                @if(!empty($saran->name))
                                    <strong class="primary-font">{{ $saran->name }}</strong>
                                @else
                                    <strong class="primary-font">-</strong>
                                @endif
                                <small class="pull-right text-muted">
                                    @if(!empty($saran->created_at ))
                                        <?php $date = new Date($saran->created_at); ?>
                                        <i class="fa fa-clock-o fa-fw"></i> {{  $date->format('d/n/Y') }}
                                    @else
                                        <i class="fa fa-clock-o fa-fw"></i> -
                                    @endif
                                </small>
                            </div>
                            @if(!empty($saran->content))
                                <p>{{ $saran->content }}</p>
                            @else
                                <p>-</p>
                            @endif
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- /.panel-body -->
            <div class="panel-footer">
                <a href="{{ route('admins.saran.index') }}" class="btn btn-default btn-block">
                    <div>
                        <span class="pull-left"><b>Detail</b></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
            <!-- /.panel-footer -->
        </div>
        @endif
    </div>
    </div>
</div>
<!-- /3rd row -->
@stop