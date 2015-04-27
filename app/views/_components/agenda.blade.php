<div class="col-md-12 visible-md visible-lg">
    @if(!$kegiatans->isEmpty())
        <table class="events-list ">
        <thead>
        <tr>
            <th>Tanggal</th>
            <th>Jenis Diklat</th>
            <th>Wilayah</th>
            <th>Tempat</th>
            <th>Waktu</th>
            <th>Sasaran Peserta</th>
        </tr>
        </thead>
        <tbody>

            @foreach($kegiatans as $kegiatan)
                <tr>
                    <td>
                        <div class="event-date">
                            <?php $mysqldate = new Date($kegiatan->tanggal ); ?>
                            <div class="event-day">{{ $mysqldate->format('d')}}</div>
                            <div class="event-month" style="color: #808080">{{ $mysqldate->format('M') }}</div>
                        </div>
                    </td>

                    <td>{{ $kegiatan->name }}</td>

                    @if(!empty($kegiatan->wilayah))
                        <td>{{ $kegiatan->wilayah }}</td>
                    @else
                        <td>-</td>
                    @endif

                    @if(!empty($kegiatan->tempat))
                        <td class="event-venue">{{ $kegiatan->tempat }}</td>
                    @else
                        <td class="event-venue">-</td>
                    @endif

                    <?php
                        $startTimeStamp = strtotime($kegiatan->tanggal);
                        $endTimeStamp = strtotime($kegiatan->tanggal2);
                        $timeDiff = abs($endTimeStamp - $startTimeStamp);
                        $numberDays = $timeDiff/86400;
                        $numberDays = intval($numberDays) + 1;
                    ?>
                    <td class="event-venue">{{ $numberDays  }} Hari</td>

                    @if(!empty($kegiatan->sasaran))
                        <td class="event-venue">{{ $kegiatan->sasaran }}</td>
                    @else
                        <td class="event-venue">-</td>
                    @endif

                    <td>&nbsp;</td>
                </tr>
            @endforeach
        </tbody>
        </table>
    @else
        <div class="blog-post shadow">
            <div class="post-summary">
                <h3>Belum terdapat agenda pelatihan</h3>
            </div>
        </div>
    @endif
</div>
<div class="col-sm-12 visible-sm visible-xs">
    @if(!$kegiatans->isEmpty())
        @foreach($kegiatans as $kegiatan)
            <div class="well well-sm">
                    <b>Tanggal</b> {{ date('d',strtotime($kegiatan->tanggal)) }} {{ date('M',strtotime($kegiatan->tanggal)) }}
                <br />
                    <b>Jenis Diklat :</b> {{ $kegiatan->name }}
                <br />
                    @if(!empty($kegiatan->wilayah))
                        <td><b>Wilayah :</b>{{ $kegiatan->wilayah }}</td>
                    @else
                        <td>-</td>
                    @endif
                <br />
                    @if(!empty($kegiatan->tempat))
                        <b>Tempat :</b> {{ $kegiatan->tempat }}
                    @else
                        <b>Tempat :</b> -
                    @endif
                <br />
                    <?php
                        $startTimeStamp = strtotime($kegiatan->tanggal);
                        $endTimeStamp = strtotime($kegiatan->tanggal2);
                        $timeDiff = abs($endTimeStamp - $startTimeStamp);
                        $numberDays = $timeDiff/86400;
                        $numberDays = intval($numberDays);
                    ?>
                    <b>Waktu :</b> {{ $numberDays }} Hari
                <br />
                    @if(!empty($kegiatan->sasaran))
                        <b>Sasaran :</b> {{ $kegiatan->sasaran }}
                    @else
                        <b>Sasaran :</b> -
                    @endif
            </div>
        @endforeach
    @else
        <div class="well well-sm">
            Belum terdapat agenda pelatihan
        </div>
    @endif
</div>