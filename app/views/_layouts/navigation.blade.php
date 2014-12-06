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
                            <li><a href="{{ route('artikel',array(2)) }}">BKCU</a></li>
                            <li><a href="{{ route('artikel',array(3)) }}">CU</a></li>
                            <li><a href="{{ route('artikel',array(5)) }}">Internasional</a></li>
                            <li><a href="{{ route('artikel',array(6)) }}">Teknologi</a></li>
                            <li><a href="{{ route('artikel',array(7)) }}">Ekonomi</a></li>
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
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Lain-lain <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profil') }}">Download</a></li>
                            <li><a href="{{ route('tim') }}">Foto Kegiatan</a></li>
                            <li><a href="{{ route('hymnecu') }}">Hymne CU</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!--/.container-->
    </nav><!--/nav-->
</div>