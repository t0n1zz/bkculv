<!-- Navigation & Logo-->
<div class="mainmenu-wrapper">
    <nav class="navbar navbar-inverse" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only"  style="background: black">Toggle navigation</span>
                    <span class="icon-bar" style="background: black"></span>
                    <span class="icon-bar" style="background: black"></span>
                    <span class="icon-bar" style="background: black"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/logo2.png') }}"
                class="img-responsive" width="200" alt="logo"></a>
            </div>

            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Berita <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            @foreach($navberita as $berita)
                                <li><a href="{{ route('artikel',array($berita->id)) }}">{{$berita->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ route('artikel',array(4)) }}">Filosofi</a></li>
                    <li><a href="{{ route('pelayanan') }}">Solusi</a></li>
                    <li><a href="{{ route('agenda') }}">Agenda</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tentang Kami <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profil') }}">Profil</a></li>
                            <li><a href="{{ route('tim') }}">Tim</a></li>
                            <li><a href="{{ route('jejaring') }}">Jejaring</a></li>
                            <li><a href="{{ route('artikel',array(8)) }}">Sejarah</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Lain-lain <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('download') }}">Download</a></li>
                            <li><a href="https://www.flickr.com/photos/127271987@N07/" target="_BLANK">Foto Kegiatan</a></li>
                            <li><a href="{{ route('hymnecu') }}">Hymne CU</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!--/.container-->
    </nav><!--/nav-->
</div>