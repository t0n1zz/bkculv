<?php 
$servername = "localhost";
$username = "puskopdi_bkcu";
$password = "puskopdi_bkcu";
$myDB = "puskopdi_bkcu";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM kegiatan WHERE tanggal2 < NOW()";
    // use exec() because no results are returned
    $conn->exec($sql);
}
catch(PDOException $e)
{
    echo " ";
}

?>