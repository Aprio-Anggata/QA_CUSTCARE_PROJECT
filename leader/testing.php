<?php
include '../config/koneksi.php'; // untuk koneksi ke database
include '../library/fungsi.php'; // untuk memasukan library

session_start(); // untuk menampung session
date_default_timezone_set("Asia/Jakarta"); // untuk mengatur zona waktu

$aksi = new oop(); // untuk memanggil class di library

// tampung username & password agar dibaca string bukan syntax
@$user = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['user'] ?? '');
@$password = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['password'] ?? '');

// jika session username tidak kosong, pindah ke halaman utama
if (@$_SESSION['user'] != "") {
    $aksi->redirect("menu_utama.php?menu=home");
}

// jika tekan login maka menjalankan fungsi login dari library
if (isset($_POST['login'])) {
    // Cek username dan password
    $sql = "SELECT * FROM user_tbl WHERE user = '$user' AND password = '$password'";
    $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Simpan session
        $_SESSION['user'] = $row['user'];
        $_SESSION['role'] = $row['role'];

        // Arahkan pengguna berdasarkan role
        if ($row['role'] == 'QA Agent') {
            $aksi->redirect("menu_utama.php?menu=home_qa_agent");
        } elseif ($row['role'] == 'Team Leader') {
            $aksi->redirect("menu_utama.php?menu=home_team_leader");
        } elseif ($row['role'] == 'Manager') {
            $aksi->redirect("menu_utama.php?menu=home_manager");
        } else {
            $aksi->redirect("menu_utama.php?menu=home");
        }
    } else {
        // Jika login gagal
        echo "<script>alert('Username atau Password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>FORM LOGIN QA- PT.HOME CREDIT INDONESIA</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="icon" type="image/png" href="../QA_OPS_HCI/images/R.png/">
</head>
<body style="background:url('../images/BG1.jpg');">
    <div class="container" style="color: black;font-family: Myriad Pro Light">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <!-- judul aplikasi -->
                        <div class="panel-heading">
                            <div style="margin-top: 5px;margin-bottom: 5px;">
                                <img src="../images/R.png" alt="logo" class="logo" width="90px">
                            </div>
                            <div style="margin-left: 110px; margin-top: -90px; font-size: 120%;">
                                Q U A L I T Y  &nbsp; A S S U R A N C E &nbsp; 
                                <br>
                                S C O R E &nbsp; C A R D
                            </div>
                            <div style="margin-left: 110px; font-size: 200%;">
                                <strong>FORM LOGIN</strong>
                            </div>
                        </div>
                        <!-- end judul aplikasi -->

                        <!-- isi -->
                        <div class="panel-body">
                            <div class="col-md-12">
                                <form method="post">
                                    <div class="form-group">
                                        <label>USERNAME</label>
                                        <input type="text" name="user" class="form-control" placeholder="Masukkan Username Anda..." required maxlength="30" autocomplete="off" required onsubmit="this.setCustomValidity('')">
                                    </div>
                                    <div class="form-group">
                                        <label>PASSWORD</label>
                                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password Anda..." required maxlength="30" autocomplete="off" required onsubmit="this.setCustomValidity('')">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="login" class="btn btn-primary btn-block btn-lg" value="LOGIN" style="background: #0ab0ff;">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end isi -->

                        <!-- footer -->
                        <div class="panel-footer">
                            <center>
                                <strong>&copy;2024 - Home Credit Indonesia (<a href="https://www.homecredit.co.id/">HCID</a>)</strong>
                            </center>
                        </div>
                        <!-- end footer -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
