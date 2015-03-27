<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{ route('admins') }}">
    <img class="img-responsive pull-left"
         src="{{ asset('images/logo.png') }}" width="23" height="23"
         alt="Logo Puskopdit BKCU Kalimantan"> &nbsp Puskopdit BKCU Kalimantan
    </a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
    <!-- alert -->
    <?php
    if(Auth::check()) { $id = Auth::user()->getId();}
    $admin = Admin::find($id);
    $date = new Date($admin->logout);
    ?>
    <li class="dropdown">
        <a href="#" style="cursor: default">
            @if($admin->logout != "0000-00-00 00:00:00")
                <i class="fa fa-clock-o fa-fw"></i>  Terakhir login pada : {{ $date->format('d/n/Y, H:i') }}
            @else
                <i class="fa fa-clock-o fa-fw"></i> Terakhir login pada : Belum pernah login
           @endif
        </a>
    </li>
    <!-- /alert -->
    <!-- user -->
    <li class="dropdown">
        <!--<a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="#"><i class="fa fa-user fa-fw"></i> Profil</a>
            </li>
            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Pengaturan</a>
            </li>
            <li class="divider"></li>
            <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
        </ul>-->

        <a href="{{ route('admins.logout') }}">
            <i class="fa fa-sign-out fa-fw"></i>  Logout</i>
        </a>
    </li>
    <!-- /user -->
</ul>
