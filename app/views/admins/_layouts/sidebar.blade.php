
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <?php
                    $gambar = Auth::user()->getGambar();
                    $imagepath = 'images/';
                ?>
                @if(!empty($gambar) && is_file($imagepath.$gambar.".jpg"))
                    <div class="pull-left image">
                        <img src="{{ asset($imagepath.$gambar.".jpg") }}" class="img-circle" alt="User Image" />
                    </div>
                @else
                    <div class="pull-left image">
                        <img src="{{ asset($imagepath."user.png") }}" class="img-circle" alt="User Image" />
                    </div>
                @endif
                <div class="pull-left info">
                    <p><small>Welcome Back!</small></p>

                    <p><i class="fa fa-circle text-success"></i> {{ Auth::user()->getName(); }}</p>
                </div>
            </div>
            <!-- Sidebar user panel -->
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <li class="header"><b>KELOLA WEBSITE</b></li>
            <!-- dashboard -->
            <li @if($title == "Dashboard") {{ "class='active'" }} @endif>
                <a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <!-- /dashboard -->
            <!-- pengumuman -->
            @if(Entrust::can('pengumuman'))
                <li @if($title == "Kelola Pengumuman"){{ "class='active'" }}@endif>
                    <a href="{{ route('admins.pengumuman.index') }}"><i class="fa fa-comments-o fa-fw"></i> Pengumuman</a>
                </li>
            @endif
            <!-- /pengumuman -->
            <!-- saran -->
            @if(Entrust::can('saran'))
                <li @if($title == "Kelola Saran atau Kritik"){{ "class='active'" }}@endif>
                    <a href="{{ route('admins.saran.index') }}"><i class="fa fa-paper-plane-o fa-fw"></i> Saran atau Kritik</a>
                </li>
            @endif
            <!-- /saran -->
            <!-- info gerakan -->
            @if(Entrust::can('infogerakan'))
                <li @if($title == "Informasi Gerakan"){{ "class='active'" }}@endif>
                    <a href="{{ route('admins.infogerakan.edit',array(1)) }}"><i class="fa fa-university fa-fw"></i> Informasi Gerakan</a>
                </li>
            @endif
            <!-- /info gerakan -->
            <!-- artikel -->
            @if(Entrust::can('artikel'))
                <li @if($title == "Kelola Artikel" || $title == "Tambah Artikel" || $title == "Ubah Artikel" ||$title == "Kelola Kategori Artikel")
                        {{ "class='treeview active'" }}
                        @else
                        {{ "class='treeview'" }}
                    @endif>
                    <a href="#"><i class="fa fa-book fa-fw"></i> <span>Artikel</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul @if($title == "Kelola Artikel" || $title == "Tambah Artikel" || $title == "Ubah Artikel" ||$title == "Kelola Kategori Artikel")
                            {{ "class='treeview-menu menu-open' style='display:block;'" }}
                        @else
                            {{ "class='treeview-menu'" }}
                        @endiF>
                        <li>
                            <a  href="{{ route('admins.artikel.create') }}"><i class="fa fa-plus"></i> Tambah Artikel</a>
                        </li>
                        <li>
                            <a  href="{{ route('admins.artikel.index') }}"><i class="fa fa-archive"></i> Kelola Artikel</a>
                        </li>
                        <li>
                            <a  href="{{ route('admins.kategoriartikel.index') }}"><i class="fa fa-archive"></i> Kelola Kategori Artikel</a>
                        </li>
                    </ul>
                </li>
            @endif
            <!-- /artikel -->
            <!-- diklat -->
            @if(Entrust::can('kegiatan'))
                <li @if($title == "Kelola Kegiatan" || $title == "Tambah Kegiatan" || $title == "Ubah Kegiatan" )
                        {{ "class='treeview active'" }}
                    @else
                        {{ "class='treeview'" }}
                    @endif>
                    <a href="#"><i class="fa fa-calendar fa-fw"></i> <span>Kegiatan</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul @if($title == "Kelola Kegiatan" || $title == "Tambah Kegiatan" || $title == "Ubah Kegiatan" )
                            {{ "class='treeview-menu menu-open' style='display:block;'" }}
                        @else
                            {{ "class='treeview-menu'" }}
                        @endif>
                        <li>
                            <a href="{{ route('admins.kegiatan.create') }}"><span class="fa fa-plus"></span> Tambah Kegiatan</a>
                        </li>
                        <li>
                            <a href="{{ route('admins.kegiatan.index') }}"><span class="fa fa-archive"></span> Kelola Kegiatan</a>
                        </li>
                    </ul>
                </li>
            @endif
            <!-- /diklat -->
            <!-- cuprimer -->
            @if(Entrust::can('cuprimer'))
                <li @if($title == "Kelola CU" || $title == "Tambah CU" || $title == "Ubah CU" || $title == "Kelola Wilayah CU" ||
                    $title == "Kelola Staff CU" || $title == "Tambah Staff CU" || $title == "Ubah Staff CU")
                        {{ "class='treeview active'" }}
                    @else
                        {{ "class='treeview'" }}
                    @endif>
                    <a href="#"><i class="fa fa-building-o fa-fw"></i> <span>CU</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul @if($title == "Kelola CU" || $title == "Tambah CU" || $title == "Ubah CU" || $title == "Kelola Wilayah CU" ||
                        $title == "Kelola Staff CU" || $title == "Tambah Staff CU" || $title == "Ubah Staff CU")
                            {{ "class='treeview-menu menu-open' style='display:block;'" }}
                        @else
                            {{ "class='treeview-menu'" }}
                        @endif>
                        <li>
                            <a href="{{ route('admins.cuprimer.create') }}"><span class="fa fa-plus"></span> Tambah CU</a>
                        </li>
                        <li>
                            <a href="{{ route('admins.cuprimer.index') }}"><span class="fa fa-archive"></span> Kelola CU</a>
                        </li>
                        <li>
                            <a href="{{ route('admins.wilayahcuprimer.index') }}"><span class="fa fa-archive"></span> Kelola Wilayah CU</a>
                        </li>
                    </ul>
                </li>
            @endif
            <!-- /cuprimer -->
            <!-- staff -->
            @if(Entrust::can('staff'))
                <li @if($title == "Kelola Staf" || $title == "Tambah Staf" || $title == "Ubah Staf" )
                        {{ "class='treeview active'" }}
                    @else
                        {{ "class='treeview'" }}
                    @endif>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i> <span>Staf</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul
                    @if($title == "Kelola Staf" || $title == "Tambah Staf" || $title == "Ubah Staf" )
                        {{ "class='treeview-menu menu-open' style='display:block;'" }}
                    @else
                        {{ "class='treeview-menu'" }}
                    @endif>
                        <li>
                            <a href="{{ route('admins.staf.create') }}"><span class="fa fa-plus"></span> Tambah Staf</a>
                        </li>
                        <li>
                            <a href="#}"><i class="fa fa-archive"></i> Kelola staf <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="{{ route('admins.staf.index') }}"><i class="fa fa-circle-o"></i> Semua</a></li>
                                <li><a href="{{ route('admins.staf.index') }}"><i class="fa fa-circle-o"></i> BKCU</a></li>

                            </ul>
                        </li>
                    </ul>
                </li>
            @endif
            <!-- /staff -->
            <!-- download -->
            @if(Entrust::can('download'))
                <li @if($title == "Kelola File" || $title == "Tambah File" || $title == "Ubah File" )
                        {{ "class='treeview active'" }}
                    @else
                        {{ "class='treeview'" }}
                    @endif>
                    <a href="#"><i class="fa fa-download fa-fw"></i> <span>Download</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul @if($title == "Kelola File" || $title == "Tambah File" || $title == "Ubah File" )
                            {{ "class='treeview-menu menu-open' style='display:block;'" }}
                        @else
                            {{ "class='treeview-menu'" }}
                        @endif>
                        <li>
                            <a href="{{ route('admins.download.create') }}"><span class="fa fa-plus"></span> Tambah File</a>
                        </li>
                        <li>
                            <a href="{{ route('admins.download.index') }}"><span class="fa fa-archive"></span> Kelola File</a>
                        </li>
                    </ul>
                </li>
            @endif
            <!-- /download -->
            <!-- admin -->
            @if(Entrust::can('admin'))
                <li @if($title == "Kelola Admin" || $title == "Tambah Admin" || $title == "Ubah Admin" )
                        {{ "class='treeview active'" }}
                    @else
                        {{ "class='treeview'" }}
                    @endif>
                <a href="#"><i class="fa fa-user fa-fw"></i> <span>Admin</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul @if($title == "Kelola Admin" || $title == "Tambah Admin" || $title == "Ubah Admin" )
                        {{ "class='treeview-menu menu-open' style='display:block;'" }}
                    @else
                        {{ "class='treeview-menu'" }}
                    @endif>
                    <li>
                        <a href="{{ route('admins.admin.create') }}"><span class="fa fa-plus"></span> Tambah Admin</a>
                    </li>
                    <li>
                        <a href="{{ route('admins.admin.index') }}"><span class="fa fa-archive"></span> Kelola Admin</a>
                    </li>
                </ul>
            </li>
            @endif
            <!-- /admin -->
        </ul>
    </section>
</aside>
