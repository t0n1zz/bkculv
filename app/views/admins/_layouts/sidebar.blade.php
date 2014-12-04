<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <!-- search -->
            <!--<li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>                            
            </li>-->
            <!-- /search -->
            <!-- dashboard -->
            <li>
                <a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <!-- /dashboard -->
            <!-- pengumuman -->
            <li><a  @if($title == "Kelola Pengumuman")
                        {{ "class='active'" }}
                    @endif
                    href="{{ route('admins.pengumuman.index') }}"><i class="fa fa-comments-o fa-fw"></i> Pengumuman</a>
            </li>
            <!-- /pengumuman -->
            <!-- info gerakan -->
            <li>
                <a  @if($title == "Informasi Gerakan")
                        {{ "class='active'" }}
                    @endif
                    href="{{ route('admins.infogerakan.edit',array(1)) }}"><i class="fa fa-exclamation-circle fa-fw"></i> Informasi Gerakan</a>
            </li>
            <!-- /info gerakan -->
            <!-- artikel -->
            <li @if($title == "Kelola Artikel" || $title == "Tambah Artikel" || $title == "Ubah Artikel" ||
                    $title == "Kelola Kategori Artikel")
                   {{ "class='active'" }}
               @endif
            ><a href="#"><i class="fa fa-book fa-fw"></i> Artikel<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a  @if($title == "Tambah Artikel")
                                {{ "class='active'" }}
                            @endif
                            href="{{ route('admins.artikel.create') }}"><i class="fa fa-plus"></i> Tambah Artikel</a>
                    </li>
                    <li>
                        <a  @if($title == "Kelola Artikel")
                                {{ "class='active'" }}
                            @endif
                            href="{{ route('admins.artikel.index') }}"><i class="fa fa-archive"></i> Kelola Artikel</a>
                    </li>
                    <li>
                        <a  @if($title == "Kelola Kategori Artikel")
                                {{ "class='active'" }}
                            @endif
                            href="{{ route('admins.kategoriartikel.index') }}"><i class="fa fa-archive"></i> Kelola Kategori Artikel</a>
                    </li>
                </ul>
            </li>
            <!-- /artikel -->
            <!-- gambar -->
            <li @if($title == "Kelola Gambar Kegiatan" || $title == "Tambah Gambar Kegiatan" || $title == "Ubah Gambar Kegiatan")
                   {{ "class='active'" }}
               @endif
            ><a href="#"><i class="fa fa-image fa-fw"></i> Gambar<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                	<li>
                        <a  @if($title == "Tambah Gambar Kegiatan")
                                {{ "class='active'" }}
                            @endif
                            href="{{ route('admins.gambarkegiatan.create') }}"><span class="fa fa-plus"></span> Tambah Gambar Kegiatan</a>
                    </li>
                    <li>
                        <a  @if($title == "Kelola Gambar Kegiatan")
                                {{ "class='active'" }}
                            @endif
                            href="{{ route('admins.gambarkegiatan.index') }}"><span class="fa fa-archive"></span> Kelola Gambar Kegiatan</a>
                    </li>
                </ul>
            </li>
            <!-- /gambar -->
            <!-- pelayanan -->
            <li @if($title == "Kelola Pelayanan" || $title == "Tambah Pelayanan" || $title == "Ubah Pelayanan" ||
                    $title == "Tambah Kantor Pelayanan" || $title == "Kelola Kantor Pelayanan" || $title == "Ubah Informasi Kantor Pelayanan")
                    {{ "class='active'" }}
                @endif
            ><a href="#"><i class="fa fa-male"></i><i class="fa fa-female fa-fw"></i>Pelayanan<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                	<li>
                        <a  @if($title == "Tambah Pelayanan")
                                {{ "class='active'" }}
                            @endif
                            href="{{ route('admins.pelayanan.create') }}"><span class="fa fa-plus"></span> Tambah Pelayanan</a>
                    </li>
                    <li>
                        <a @if($title == "Tambah Kantor Pelayanan")
                               {{ "class='active'" }}
                           @endif
                           href="{{ route('admins.kantorpelayanan.create') }}"><span class="fa fa-plus"></span> Tambah Kantor Pelayanan</a>
                    </li>
                    <li>
                        <a  @if($title == "Kelola Pelayanan")
                                {{ "class='active'" }}
                            @endif
                            href="{{ route('admins.pelayanan.index') }}"><span class="fa fa-archive"></span> Kelola Pelayanan</a>
                    </li>
                    <li>
                        <a @if($title == "Kelola Kantor Pelayanan")
                               {{ "class='active'" }}
                           @endif
                           href="{{ route('admins.kantorpelayanan.index') }}"><span class="fa fa-archive"></span> Kelola Kantor Pelayanan</a>
                    </li>
                </ul>
            </li>
            <!-- /pelayanan -->
            <!-- diklat -->
            <li @if($title == "Kelola Kegiatan" || $title == "Tambah Kegiatan" || $title == "Ubah Kegiatan" )
                    {{ "class='active'" }}
                @endif
            ><a href="#"><i class="fa fa-calendar fa-fw"></i> Agenda<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a @if($title == "Tambah Kegiatan")
                                   {{ "class='active'" }}
                               @endif
                               href="{{ route('admins.kegiatan.create') }}"><span class="fa fa-plus"></span> Tambah Kegiatan</a>
                        </li>
                        <li>
                            <a @if($title == "Kelola Kegiatan")
                                   {{ "class='active'" }}
                               @endif
                               href="{{ route('admins.kegiatan.index') }}"><span class="fa fa-archive"></span> Kelola Kegiatan</a>
                        </li>
                    </ul>
            </li>
            <!-- /diklat -->
            <!-- cuprimer -->
            <li @if($title == "Kelola CU" || $title == "Tambah CU" || $title == "Ubah CU" || $title == "Kelola Wilayah CU" )
                    {{ "class='active'" }}
                @endif
            >
                    <a href="#"><i class="fa fa-building-o fa-fw"></i> CU Primer<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a  @if($title == "Tambah CU")
                                      {{ "class='active'" }}
                                @endif
                                href="{{ route('admins.cuprimer.create') }}"><span class="fa fa-plus"></span> Tambah CU</a>
                        </li>
                        <li>
                            <a @if($title == "Kelola CU")
                                     {{ "class='active'" }}
                               @endif
                               href="{{ route('admins.cuprimer.index') }}"><span class="fa fa-archive"></span> Kelola CU</a>
                        </li>
                        <li>
                            <a @if($title == "Kelola Wilayah CU")
                                   {{ "class='active'" }}
                               @endif
                               href="{{ route('admins.wilayahcuprimer.index') }}"><span class="fa fa-archive"></span> Kelola Wilayah CU</a>
                        </li>
                    </ul>
            </li>
            <!-- /cuprimer -->
            <!-- staff -->
            <li @if($title == "Kelola Staff" || $title == "Tambah Staff" || $title == "Ubah Staff" )
                    {{ "class='active'" }}
                @endif
            >
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Staff <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a @if($title == "Tambah Staff")
                                {{ "class='active'" }}
                            @endif
                            href="{{ route('admins.staff.create') }}"><span class="fa fa-plus"></span> Tambah Staff</a>
                    </li>
                    <li>
                        <a @if($title == "Kelola Staff")
                                {{ "class='active'" }}
                            @endif
                            href="{{ route('admins.staff.index') }}"><span class="fa fa-archive"></span> Kelola staff</a>
                    </li>
                </ul>
            </li>
            <!-- /staff -->
            <!-- admin -->
            <li @if($title == "Kelola Admin" || $title == "Tambah Admin" || $title == "Ubah Admin" )
                    {{ "class='active'" }}
                @endif
             >
                <a href="#"><i class="fa fa-user fa-fw"></i> Admin<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a @if($title == "Tambah Admin")
                               {{ "class='active'" }}
                           @endif
                            href="{{ route('admins.admin.create') }}"><span class="fa fa-plus"></span> Tambah Admin</a>
                    </li>
                    <li>
                        <a @if($title == "Kelola Admin")
                               {{ "class='active'" }}
                           @endif
                           href="{{ route('admins.admin.index') }}"><span class="fa fa-archive"></span> Kelola Admin</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>