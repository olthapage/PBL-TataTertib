<?php
$host = "DESKTOP-5O8DG63"; // nama server\nama_instance
$connInfo = array(
    "Database" => "master",
    "UID" => "sa", // ganti dengan username SQL Server
    "PWD" => "123"  // ganti dengan password SQL Server
);

$conn = sqlsrv_connect($host, $connInfo);

if ($conn) {
    echo "Koneksi berhasil.<br />";
} else {
    echo "Koneksi Gagal";
    die(print_r(sqlsrv_errors(), true));
}
?>
