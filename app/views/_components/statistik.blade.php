<?php 

$tabel = "stat_pengunjung";
$ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
$tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
$waktu   = time(); // 

// Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini
$s = DB::table($tabel)
        ->where('ip', $ip)
        ->where('tanggal', $tanggal)
        ->count();

// Kalau belum ada, simpan data user tersebut ke database
if($s == 0){
    DB::table($tabel)->insert(
      array('ip' => $ip, 'tanggal' => $tanggal, 'online' => $waktu)
    );
} else{
    DB::table($tabel)
        ->where('ip', $ip)
        ->where('tanggal', $tanggal)
        ->update(array('online' => $waktu));
}

	$pengunjung = DB::table($tabel)
                        ->where('tanggal',$tanggal)
                        ->groupBy('ip')
                        ->count();

	$totalpengunjung = DB::table($tabel)
                           ->count('hits');

	$bataswaktu       = time() - 300;

	$pengunjungonline = DB::table($tabel)
                            ->where('online','>',$bataswaktu)
                            ->count();

?>

<p class="contact-us-details">
    <b>Dari :</b> 5 September 2014 <br/>
    <b>Pengunjung Hari Ini :</b> {{ $pengunjung }} orang <br/>
    <b>Pengunjung Online :</b> {{ $pengunjungonline }} orang</br/>
    <b>Total Pengunjung :</b> {{ $totalpengunjung }} orang<br/>
</p>