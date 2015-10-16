@extends('_layouts.layout')

@section('content')
 <!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><a href="{{ route('anggota') }}"
                       style="color: #ffffff"><i class="fa fa-fw fa-arrow-circle-left"></i></a> Credit Union Wilayah {{$cudetail->wilayahcuprimer->name}}</h1>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <!-- Product Image & Available Colors -->
            <div class="col-sm-6">
                <div class="portfolio-item">
                    <div class="portfolio-image">
                        @if(!empty($cudetail->gambar) && is_file("images_cu/{$cudetail->gambar}"))
                            <img src="{{ asset('images_cu/'.$cudetail->gambar) }}" alt="{{ $cudetail->name }}" width="100%">
                        @else
                            <img src="{{ asset('images/cudetail.jpg') }}" alt="{{ $cudetail->name }}">
                        @endif
                    </div>
                </div>
            </div>
            <!-- End Product Image & Available Colors -->
            <!-- Product Summary & Options -->
            <div class="col-sm-6 product-details">
                <?php
                    $date = new Date($cudetail->ultah);
                    $date2 = Date::now()->format('d-m');
                    $datejoin = new Date($cudetail->bergabung);
                ?>
                <div class="row">
                    <div class="col-lg-10">
                        <h2>
                            Credit Union {{ $cudetail->name }}
                        </h2>
                    </div>
                    <div class="col-lg-2">
                        <h3 >
                            @if(!empty($cudetail->logo) && is_file("images_cu/{$cudetail->logo}"))
                                <img src="{{ asset('images_cu/'.$cudetail->logo) }}" class="img-thumbnail" alt="{{ $cudetail->name }}">
                            @endif
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <dl class="dl-horizontal" style="font-size: medium">
                            @if(!empty($cudetail->badan_hukum))
                                <dt>No. Badan Hukum :</dt>
                                <dd>{{ $cudetail->badan_hukum }}</dd>
                            @endif
                            @if($date != '01/01/1970')
                                <dt>Berdiri :</dt>
                                <dd>{{$date->format('j F Y')}}</dd>
                            @endif
                            @if($datejoin != '01/01/1970')
                                <dt>Menjadi Anggota :</dt>
                                <dd>{{ $datejoin->format('j F Y') }}</dd>
                            @endif
                            @if(!empty($cudetail->telp))
                                <dt>Telepon :</dt>
                                <dd>{{$cudetail->telp}}</dd>
                            @endif
                            @if(!empty($cudetail->hp))
                                <dt>Handphone :</dt>
                                <dd>{{$cudetail->hp}}</dd>
                            @endif
                            @if(!empty($cudetail->email))
                                <dt>Email :</dt>
                                <dd>
                                    <a target="_blank" href="mailto:{{$cudetail->email}}">{{$cudetail->email}}</a>
                                </dd>
                            @endif
                            @if(!empty($cudetail->tp))
                                <dt>Tempat Pelayanan :</dt>
                                <dd>{{$cudetail->tp}}</dd>
                            @endif
                            @if(!empty($cudetail->pos))
                                <dt>Kode Pos :</dt>
                                <dd>{{$cudetail->pos}}</dd>
                            @endif
                            @if(!empty($cudetail->alamat))
                                <dt>Alamat :</dt>
                                <dd>{{$cudetail->alamat}}</dd>
                            @endif
                            @if(!empty($cudetail->website))
                                <dt>Website :</dt>
                                <dd>
                                    <a class="btn btn-blue" target="_blank"
                                       href="http://{{$cudetail->website}}"><i class="fa fa-globe"></i> {{$cudetail->website}}</a>
                                </dd>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>
            <!-- End Product Summary & Options -->
        </div>
    </div>
</div>
 <!-- ulang tahun -->
 @if($date->format('d-m') == $date2)
 <div class="section">
     <div class="container">
         <h2>Selamat Ulang Tahun</h2>
         <div class="row" >
             <div class="col-md-4 col-sm-4" >
                 <img src="{{ asset('images/birthday.png') }}" class="img-responsive" width="100%" alt="{{ $cudetail->name }}" >
             </div>
             <div class="col-md-8 col-sm-8">
                 <?php
                 $year1 = new Date($cudetail->ultah);
                 $year2 = Date::now()->format('Y');
                 $totalyear = $year2 - $year1->format('Y');
                 ?>
                 <h3 align="middle"><b>Pengurus, Pengawas dan Manajemen Puskopdit BKCU Kalimantan Mengucapkan</b>
                     <br/><br/> Selamat Ulang Tahun Ke-{{$totalyear}}
                     <br/><br/>Kepada<br/><br/>
                     <b style="font-size: xx-large;color: orange;">Credit Union {{$cudetail->name}}</b>
                     <br/><br/><b>"Semoga Semakin Maju Dan Terus Berkarya"</b></h3>
             </div>
         </div>
     </div>
 </div>
 @endif
 <!-- /ulang tahun -->
 <!-- deskripsi -->
 @if(!empty($cudetail->deskripsi))
 <div class="section">
     <div class="container">
         <h2>Tentang Kami</h2>
         <div class="row">
             <div class="col-md-12 col-sm-12">
                 {{ $cudetail->deskripsi }}
             </div>
         </div>
     </div>
 </div>
 @endif
 <!-- /deskripsi -->
 <!-- staff -->
 @if(!$staffs->isEmpty())
 <div class="section">
     <div class="container">
         <h2>Tim Kami</h2>
         <div class="row">
             <div class="col-md-12 col-sm-12">
                 <div class="table-responsive" style="font-size: medium">
                     <table class="table table-bordered table-hover" id="dataTables-example">
                         <thead>
                         <tr>
                             <th>No.</th>
                             <th>Nama </th>
                             <th>Jabatan</th>
                             <th>Tingkat</th>
                             <th>Foto</th>
                         </tr>
                         </thead>
                         <tbody>
                         <?php $i=0; ?>
                         @foreach($staffs as $staff)
                             <?php $i++; ?>
                             <tr>
                                 <td><a>{{ $i }}</a></td>

                                 @if(!empty($staff->name))
                                     <td><a>{{ $staff->name}}</a></td>
                                 @else
                                     <td><a>-</a></td>
                                 @endif

                                 @if(!empty($staff->jabatan))
                                     <td><a>{{ $staff->jabatan }}</a></td>
                                 @else
                                     <td><a>-</a></td>
                                 @endif

                                 @if(!empty($staff->tingkat))
                                     @if($staff->tingkat == 1 )
                                         @if($staff->periode1 > 0 && $staff->periode2 > 0)
                                             <td><a>Pengurus Periode {{ $staff->periode1 }} - {{ $staff->periode2 }}</a></td>
                                         @else
                                             <td><a>Pengurus</a></td>
                                         @endif
                                     @elseif($staff->tingkat == 2)
                                         @if($staff->periode1 > 0 && $staff->periode2 > 0)
                                            <td><a>Pengawas Periode {{ $staff->periode1 }} - {{ $staff->periode2 }}</a></td>
                                         @else
                                            <td><a>Pengawas</a></td>
                                         @endif
                                     @elseif($staff->tingkat == 3)
                                         <td><a>Manajemen</a></td>
                                     @endif
                                 @else
                                     <td><a>-</a></td>
                                 @endif

                                 @if(!empty($staff->gambar) && is_file("images_cu/{$staff->gambar}"))
                                     <td>{{ HTML::image('images_cu/'.$staff->gambar, 'a picture', array('class' => 'img-responsive',
			        	'id' => 'tampilgambar', 'width' => '50')) }}</td>
                                 @else
                                     @if($staff->kelamin == "Wanita")
                                         <td>{{ HTML::image('images/no_image_woman.jpg', 'a picture', array('class' => 'img-responsive',
                                                'id' => 'tampilgambar', 'width' => '50')) }}</td>
                                     @else
                                         <td>{{ HTML::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                                                'id' => 'tampilgambar', 'width' => '50')) }}</td>
                                     @endif
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
 @endif
 <!-- /staff -->
@stop