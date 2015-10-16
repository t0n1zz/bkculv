<div class="footer">
	<div class="container">
    	<div class="row">
    		<div class="col-footer col-md-3 col-xs-6">
    			<h3>Info Gerakan</h3>
                <p class="contact-us-details">
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
                        <b>Jumlah CU Primer :</b> <a href="{{ route('anggota') }}">{{ number_format($infogerakan->jumlah_cu,0,",",".")}}</a>
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
                </p>
    		</div>
    		<div class="col-footer col-md-4 col-xs-6">
    			<h3>Navigasi Website</h3>
    			<div class="row">
    			    <div class="col-md-7">
                        <ul class="no-list-style footer-navigate-section">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('kegiatan') }}">Kegiatan</a></li>
                            @foreach($navberita as $berita)
                                <li><a href="{{ route('artikel',array($berita->id)) }}">{{$berita->name}}</a></li>
                            @endforeach
                            <li><a href="{{ route('profil') }}">Profil</a></li>
                            <li><a href="{{ route('pelayanan') }}">Pelayanan</a></li>
                        </ul>
    			    </div>
    			    <div class="col-md-5">
    			        <ul class="no-list-style footer-navigate-section">
                            <li><a href="{{ route('pengurus') }}">Pengurus</a></li>
                            <li><a href="{{ route('pengawas') }}">Pengawas</a></li>
                            <li><a href="{{ route('manajemen') }}">Manajemen</a></li>
                            <li><a href="{{ route('anggota') }}">Anggota</a></li>
                            <li><a href="{{ route('artikel',array(4)) }}">Filosofi</a></li>
                            <li><a href="{{ route('artikel',array(8)) }}">Sejarah</a></li>
                            <li><a href="{{ route('download') }}">Download</a></li>
                            <li><a href="https://www.flickr.com/photos/127271987@N07/" target="_BLANK">Foto Kegiatan</a></li>
                            <li><a href="{{ route('hymnecu') }}">Hymne CU</a></li>
                        </ul>
    			    </div>
    			</div>

    		</div>
    		
    		<div class="col-footer col-md-3 col-xs-6">
    			<h3>Statistik Website </h3>
                @include('_components.statistik')
    		</div>
    		<div class="col-footer col-md-2 col-xs-6">
    			<h3>Social Network</h3>
    			<ul class="footer-stay-connected no-list-style">
    				<li><a href="https://www.facebook.com/PuskopditBKCUKalimantan" class="facebook" target="_blank"></a></li>
    			</ul>
    		</div>
    	</div>
    	<div class="row">
            <div class="col-md-12">
                <br/>
                @if(Session::has('message'))
                    <div align="col-md-12">
                        <div class="btn btn-default  btn-block" style="cursor: default">Terima Kasih Atas Saran atau Kritik Anda</div>
                    </div>
                @else
                    <div align="col-md-12">
                        <button class="btn btn-default modal1 btn-block"><i class="fa fa-fw fa-paper-plane-o"></i> Saran atau Kritik</button>
                    </div>
                @endif
                <br />
                <div class="footer-copyright">
                    &copy; <?php echo date("Y") ?> Puskopdit BKCU Kalimantan • Badan Hukum Nomor : 927/BH/M.KUKM.2/X/2010  - <a href="{{ route('attribution') }}">Attribution</a>
                </div>
            </div>
            <br/>
            <div class="visible-sm visible-xs" align="center">
                <a href="#" class="scrollToTop2" style="color: #808080;">
                    <b>-</b> <i class="fa fa-fw fa-2x fa-arrow-up" ></i> <b>-</b>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- scroll to top -->
<div class="visible-lg">
    <a href="#" class="scrollToTop">
        <i class="fa fa-arrow-up" style="font-size: 1.5em;"></i>
    </a>
</div>
<!-- scroll to top -->



<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('saran'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><i class="fa fa-fw fa-paper-plane-o"></i> Saran atau Kritik</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" name="name" placeholder="Silahkan masukkan nama / identitas anda" />
                <br />
                    <textarea class="form-control" name="content"
                              placeholder="Silahkan masukkan saran atau kritik anda" style="height: 150px"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-check"></i> Ok</button>
                <button type="button" class="btn btn-red" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>

<!-- feedback -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('saran'))) }}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title "><i class="fa fa-fw fa-envelope"></i> Saran dan Kritik</h4>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" name="nama" placeholder="Silahkan masukkan nama / identitas anda" />
                    <br />
                    <textarea class="form-control" name="content"
                              placeholder="Silahkan masukkan saran dan kritik anda" style="height: 150px"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-check"></i> Ok</button>
                    <button type="button" class="btn btn-red" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<!-- /feedback -->
