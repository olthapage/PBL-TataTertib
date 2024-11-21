<?php
include_once 'database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if (empty($user) || empty($pass)) {
        echo "Username dan Password tidak boleh kosong.";
    } else {
        // Query untuk mencari pengguna berdasarkan username
        $sql = "SELECT * FROM userDatabase WHERE username = ?";
        $params = array($user); // Pastikan params adalah array

        // Mempersiapkan dan menjalankan statement
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Eksekusi query
        if (sqlsrv_execute($stmt)) {
            $userData = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

            if ($userData) {
                // Verifikasi password secara langsung tanpa hash
                if ($pass === $userData['password']) {
                    // Simpan data user di session
                    $_SESSION['user_id'] = $userData['iduser'];
                    $_SESSION['username'] = $userData['username'];
                    header("Location: ../index.html"); // Redirect ke halaman setelah login berhasil
                    exit;
                } else {
                    echo "Password salah.";
                }
            } else {
                echo "Username tidak ditemukan.";
            }
        } else {
            echo "Gagal mengeksekusi query.";
            die(print_r(sqlsrv_errors(), true));
        }
    }
}
?>
