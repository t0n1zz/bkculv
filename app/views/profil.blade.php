@extends('_layouts.layout')

@section('content')
<style>
  #map_canvas {
    width: 100%;
    height: 350px;
  }
</style>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
  function initialize() {
    var mapCanvas = document.getElementById('map_canvas');
    var mapOptions = {
      center: new google.maps.LatLng(-0.03946, 109.34875),
      zoom: 18,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(mapCanvas, mapOptions)
    var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(-0.03946, 109.34875),
      map: map,
      icon: iconBase + 'schools_maps.png'
    });
  }
  google.maps.event.addDomListener(window, 'load', initialize);
</script>

<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Profil Puskopdit BKCU Kalimantan</h1>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
<img class="img-responsive" src="{{ asset('images/top.png') }}" width="100%"  style="vertical-align: top;margin-top: -10px;margin-bottom: -3%;"/>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h2 id="tentang">Puskopdit BKCU Kalimantan</h2>
                <p>
                    BKCU Kalimantan (awalnya BK3D Kalbar) berdiri pada tanggal 27 November 1988 di Pontianak.<br/><br/>
                    Sebagai credit union sekunder, BKCU Kalimantan aktif mempromosikan dan memfasilitasi berdirinya credit union - credit union primer.<br/>

                </p>
                <br/>
                <h3>&nbsp Jaringan BKCU Kalimantan</h3>
                <p>
                    Jaringan BKCU Kalimantan tersebar hampir ke seluruh wilayah Republik Indonesia.<br/>
                    Mayoritas credit union anggota BKCU Kalimantan berkembang dengan baik;aset dan jumlah anggota cukup kencang peningkatannya.<br/><br/>
                    Walaupun demikian, kami tetap menyadari masih diperlukan pembenahan-pembenahan baik internal maupun eksternal pada masa yang akan datang agar credit union mampu menghadapi berbagai dinamika yang terjadi.
                </p>
            </div>
            <div class="col-sm-6">
                <img src="images/bkcu.jpg" class="img-rounded" width="550">
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <h2 id="temui">Temui Kami Di</h2>
        <?php $i=0; ?>
        @foreach($kantor_pelayanans as $kantor_pelayanan)
            @if($i % 3 == 0 || $i == 0)
                <div class="row">
            @endif

            <div class="testimonial col-md-4 col-sm-4">
                <div class="testimonial-bubble shadow">
                        <h3>{{ $kantor_pelayanan->name }}</h3>
                    <br />
                        {{ $kantor_pelayanan->alamat }}
                    <br />
                        {{ $kantor_pelayanan->alamat2 }}
                    <br />
                        {{ $kantor_pelayanan->alamat3 }} {{ $kantor_pelayanan->pos }}
                    <br />
                        @if(!empty($kantor_pelayanan->telp))
                            Telp : {{ $kantor_pelayanan->telp }}
                        @endif
                        @if(!empty($kantor_pelayanan->fax))
                             • Fax : {{ $kantor_pelayanan->fax }}
                        @endif
                    <br />
                        <abbr title="Email"><a href="mailto:{$kantor_pelayanan->email}" target="_top">{{$kantor_pelayanan->email}}</a> </abbr>
                </div>
            </div>

            <?php $i++; ?>
            @if($i % 3 == 0)
                </div>
            @endif
        @endforeach
    </div>
</div>

<div class="section">
    <div class="container">
        <h2 id="temui">Peta Lokasi Kantor Pusat Kami</h2>
        <div class="row">
            <div class="col-sm-12">
                <div id="map_canvas" class="shadow"></div>
                <!--<div id="contact-us-map">
                </div>-->
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <h2 id="hadir">Informasi Terkait</h2>
        <div class="col-md-4 col-sm-6">
            <div class="portfolio-item">
                <div class="portfolio-image">
                    <a href="page-portfolio-item.html"><img src="{{ asset('images/sejarah.jpg') }}" alt="sejarah"></a>
                </div>
                <div class="portfolio-info-fade">
                    <ul>
                        <li class="portfolio-project-name">Sejarah Puskopdit BKCU</li>
                        <li class="read-more"><a href="page-portfolio-item.html" class="btn">Selengkapnya</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="portfolio-item">
                <div class="portfolio-image">
                    <a href="{{ route('jejaring') }}"><img src="{{ asset('images/jejaring.jpg') }}" alt="jejaring"></a>
                </div>
                <div class="portfolio-info-fade">
                    <ul>
                        <li class="portfolio-project-name">Jejaring</li>
                        <li class="read-more"><a href="{{ route('jejaring') }}" class="btn">Selengkapnya</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="portfolio-item">
                <div class="portfolio-image">
                    <a href="{{ route('tim') }}"><img src="{{ asset('images/tim.jpg') }}" alt="Tim"></a>
                </div>
                <div class="portfolio-info-fade">
                    <ul>
                        <li class="portfolio-project-name">Tim Kami</li>
                        <li class="read-more"><a href="{{ route('tim') }}" class="btn">Selengkapnya</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop