<div class="col-md-12 visible-md visible-lg">
    <table class="events-list ">
    <thead>
    <tr>
        <th>Tanggal</th>
        <th>Jenis Diklat</th>
        <th>Wilayah</th>
        <th>Tempat</th>
        <th>Waktu</th>
        <th>Sasaran Peserta</th>
        <th>Fasilitator</th>
    </tr>
    </thead>
    <tbody>
    @if(!$kegiatans->isEmpty())
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
                @if($kegiatan->wilayah == 1)
                    <td class="event-venue">Barat</td>
                @elseif($kegiatan->wilayah == 2)
                    <td class="event-venue">Tengah</td>
                @elseif($kegiatan->wilayah == 3)
                    <td class="event-venue">Timur</td>
                @else
                    <td class="event-venue">-</td>
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

                @if(!empty($kegiatan->fasilitator))
                    <td class="event-venue">{{$kegiatan->fasilitator}}</td>
                @else
                    <td class="event-venue">-</td>
                @endif

                <td>&nbsp;</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="7"><a class="btn btn-grey btn-block">Belum terdapat agenda kegiatan</a></td>
        </tr>
    @endif
    </tbody>
    </table>
</div>
<div class="col-sm-12 visible-sm visible-xs">
    @if(!$kegiatans->isEmpty())
        @foreach($kegiatans as $kegiatan)
            <div class="well well-sm">
                    <b>Tanggal</b> {{ date('d',strtotime($kegiatan->tanggal)) }} {{ date('M',strtotime($kegiatan->tanggal)) }}
                <br />
                    <b>Jenis Diklat :</b> {{ $kegiatan->name }}
                <br />
                    @if($kegiatan->wilayah == 1)
                        <b>Wilayah :</b> Barat
                    @elseif($kegiatan->wilayah == 2)
                        <b>Wilayah :</b> Tengah
                    @elseif($kegiatan->wilayah == 3)
                        <b>Wilayah :</b> Timur
                    @else
                        <b>Wilayah :</b> -
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
                <br />
                    @if(!empty($kegiatan->fasilitator))
                        <b>Fasilitator :</b> {{$kegiatan->fasilitator}}
                    @else
                        <b>Fasilitator :</b> -
                    @endif
            </div>
        @endforeach
    @else
        <div class="well well-sm">
            Belum terdapat agenda kegiatan
        </div>
    @endif
</div>