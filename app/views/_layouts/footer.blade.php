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
                        <b>Jumlah CU Primer :</b> <a href="{{ route('jejaring') }}">{{ number_format($infogerakan->jumlah_cu,0,",",".")}}</a>
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
                            <li><a href="{{ route('tim') }}">Tim</a></li>
                            <li><a href="{{ route('jejaring') }}">Jejaring</a></li>
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
    			<div class="footer-copyright">&copy; <?php echo date("Y") ?> Puskopdit BKCU Kalimantan • Badan Hukum Nomor : 927/BH/M.KUKM.2/X/2010  • <a href="{{ route('attribution') }}">Attribution</a>
    		</div>
    		<br/>
    		<div align="center">
                <a href="#" class="scrollToTop2" style="color: #808080;">
                    <b>-</b> <i class="fa fa-fw fa-2x fa-chevron-up" ></i> <b>-</b>
                </a>
    	</div>
    </div>
</div>