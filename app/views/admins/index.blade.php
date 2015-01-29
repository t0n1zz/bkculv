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
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
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
    <!-- /1st huge button -->
    <!-- 2nd huge button -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-sitemap fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $total_gambar = Staff::count();
                    ?>
                        <div class="huge">{{ $total_gambar }}</div>
                        <div>Staff</div>
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
    <!-- /2nd huge button -->
    <!-- 3rd huge button -->
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
    <!-- /3rd huge button -->
    <!-- 4th huge button -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
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
    <!-- 4th huge button -->
</div>
<!-- /2nd row -->
<hr />
<!-- 3rd row -->
<div class="row">
    <div class="col-lg-5">
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
            <hr />
            	<a href="{{ route('statistik') }}" class="btn btn-default btn-block">
                    <div>
                        <span class="pull-left"><b>Detail</b></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
         <div class="panel panel-default">
            <div class="panel-heading">
                <h4><b><i class="fa fa-user"></i> Aktivitas Admin</b></h4>
            </div>
            <div class="panel-body">
                <div role="tabpanel">

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#online" aria-controls="login" role="tab" data-toggle="tab"><b><i class="fa fa-sign-in fa-fw"></i> Login</b></a></li>
                    <li role="presentation"><a href="#offline" aria-controls="logoff" role="tab" data-toggle="tab"><b><i class="fa fa-sign-out"></i> Logout</b></a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="online">
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
                                <?php $datelogin = new Date($login->login); ?>
                                     <td>{{ $datelogin->format('l, j F Y, H:i:s') }}</td>
                                @else
                                    <td>-</td>
                                @endif
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="offline">
                    <?php
                        $logouts = Admin::select('name','logout')
                                        ->orderBy('logout','desc')
                                        ->get();
                    ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama </th>
                                    <th>Logout</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                            @foreach($logouts as $logout)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i; }}</td>

                                @if(!empty($logout->name))
                                    <td>{{ $logout->name }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if(!empty($logout->logout))
                                <?php $datelogout = new Date($logout->logout); ?>
                                     <td>{{ $datelogout->format('l, j F Y, H:i:s') }}</td>
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
            </div>
        </div>

    </div>
</div>
<!-- /3rd row -->
@stop