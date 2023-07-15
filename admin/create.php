<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include("../../config.php");
include('session.php');

if (isset($_POST['submit'])) {
    $judul_agenda = @$_POST['judul_agenda'];
    $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($_POST["judul_agenda"])));
    $created_time = date("Y-m-d H:i:s");
    $user_id = $_SESSION['id'];
    $kategori = @$_POST['kategori'];
    $content_agenda = @$_POST['content_agenda'];
    $sql = "SELECT * FROM tb_news WHERE judul_agenda='$judul_agenda'";

    $gambar = $_FILES['gambar'];
    $ext = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png');
    $tipe = $gambar['type'];
    $size = $gambar['size'];

    if (is_uploaded_file($gambar['tmp_name'])) { //cek apakah ada file yang di upload

        if (!in_array(($tipe), $ext)) { //cek ekstensi file
            echo '<script type="text/javascript">alert("Format gambar tidak diperbolehkan!");window.history.go(-1)</script>';
            return false;
        } else if ($size > 2097152) {
            echo '<script type="text/javascript">alert("Ukuran gambar terlalu besar!");window.history.go(-1);</script>';
            return false;
        } else {
            $extractFile = pathinfo($gambar['name']);
            $dir = "./image/";
            $newName = microtime() . '.' . $extractFile['extension'];

            //pindahkan file yang di upload ke directory tujuan bila berhasil jalankan perintah query untuk mennyimpan ke database
            if (move_uploaded_file($gambar['tmp_name'], $dir . $newName)) {
                // $sql = "INSERT INTO mahasiswa(gambar, nim, nama, email, jurusan) VALUES(?, ?, ?, ?, ?)";
                $result = mysqli_query($mysqli, "INSERT INTO tb_agenda(judul_agenda,created_time,user_id,id_kategori,content_agenda,cover)
                    VALUES('$judul_agenda','$created_time','$user_id','$kategori','$content_agenda','$newName')");
                header("Location:../dashboard.php?page=agenda");
                return true;
            } else {
                echo '<script type="text/javascript">alert("Foto gagal diupload");window.history.go(-1);</script>';
                return false;
            }
        }
    } else {
        echo "<script>alert('terjadi kesalahan')</script>";
        return false;
    }
}
// 
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('../template/navbar.php'); ?>
        <?php include('../template/sidebar.php'); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php include('content-header.php'); ?>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card">

                                <div class="card-header">
                                    <h3 class="card-title">Data news
                                    </h3>

                                    <div class="card-tools">
                                        <!-- This will cause the card to maximize when clicked -->
                                        <a href="../admin?page=agenda" class="btn btn-info">Kembali</a>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <form action="../agenda/create.php?page=agenda" method="post" enctype="multipart/form-data">

                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="judul_agenda">Judul Agenda</label>
                                            <input type="text" class="form-control" name="judul_agenda" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="content_agenda">Content</label>
                                            <textarea type="text" class="form-control" name="content_agenda" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="gambar">Gambar</label>
                                            <input type="file" class="form-control" name="gambar" required accept="image/*">
                                        </div>
                                        <?php
                                        $kategori = mysqli_query($mysqli, "SELECT * FROM tb_kategori ORDER BY id DESC");
                                        ?>
                                        <div class="form-group">
                                            <label for="gambar">Kategori</label>
                                            <select class="form-control" name="kategori" required>
                                                <option value="">Pilih Kategori</option>
                                                <?php while ($data = mysqli_fetch_array($kategori)) { ?>
                                                    <option value="<?= $data['id'] ?>"><?= $data['nama_kategori'] ?>
                                                    </option>
                                                <?php } ?>
                                                <select>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->


        <?php include('../template/footer.php'); ?>

    </div>
</body>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script>
    function confirmDelete() {
        if (confirm('Anda yakin menghapus data?')) {
            //action confirmed
        } else {
            //action cancelled
            alert('Data batal di hapus');
            return false;

        }
    }
</script>
</body>

</html>