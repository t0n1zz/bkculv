@extends('_layouts.layout')

@section('content')
 <!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><a href="{{ route('jejaring') }}"
                       style="color: #ffffff"><i class="fa fa-fw fa-arrow-circle-left"></i></a> Credit Union Wilayah {{$cudetail->wilayahcuprimer->name}}</h1>
            </div>
        </div>
    </div>
</div>
<img class="img-responsive" src="{{ asset('images/top.png') }}" width="100%"  style="vertical-align: top;margin-top: -10px;margin-bottom: -3%;"/>
<div class="section">
    <div class="container">
        <div class="row">
            <!-- Product Image & Available Colors -->
            <div class="col-sm-6">
                <div class="portfolio-item">
                    <div class="portfolio-image">
                        <img src="{{ asset('images/cudetail.jpg') }}" alt="{{ $cudetail->name }}">
                    </div>
                </div>
            </div>
            <!-- End Product Image & Available Colors -->
            <!-- Product Summary & Options -->
            <div class="col-sm-6 product-details">
                <h2>Credit Union {{ $cudetail->name }} </h2>
                <p>
                <?php
                    $date = new Date($cudetail->ultah);
                    $date2 = Date::now()->format('d-m');
                ?>
                <b>Tanggal Berdiri :</b> {{$date->format('j F Y')}}

                @if($date->format('d-m') == $date2)
                    <a href="#" class="btn btn-orange btn-sm modal1"><b>Anniversary</b></a>
                @endif

                {{ $cudetail->content }}</p>
            </div>
            <!-- End Product Summary & Options -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body" style="background: wheat;">
            <img src="{{ asset('images/birthday.png') }}" class="img-responsive" width="100%" alt="{{ $cudetail->name }}" >
            <?php
                $year1 = new Date($cudetail->ultah);
                $year2 = Date::now()->format('Y');
                $totalyear = $year2 - $year1->format('Y');
            ?>
            <h3 align="middle"><b>Pengurus, Pengawas dan Manajemen Puskopdit BKCU Kalimantan Mengucapkan</b>
            <br/><br/> Selamat Ulang Tahun Ke-{{$totalyear}}
            <br/>Kepada<br/><br/>
            <b style="font-size: xx-large;color: orange;">Credit Union {{$cudetail->name}}</b>
            <br/><br/><b>"Semoga Semakin Maju Dan Terus Berkarya"</b></h3>
        </div>
        <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@stop