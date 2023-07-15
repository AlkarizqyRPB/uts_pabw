<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include("../config.php");
include('session.php');
$base_url = "http://localhost/uts_pabw/admin";

$kategori = mysqli_query($mysqli, 'SELECT count(*) jml FROM tb_kategori');
$row_kategori = mysqli_fetch_assoc($kategori);
$artikel = mysqli_query($mysqli, 'SELECT count(*) jml FROM tb_artikel');
$row_artikel = mysqli_fetch_assoc($artikel);
$users = mysqli_query($mysqli, 'SELECT count(*) jml FROM tb_users');
$row_users = mysqli_fetch_assoc($users);
$menu = mysqli_query($mysqli, 'SELECT count(*) jml FROM tb_menu');
$row_menu = mysqli_fetch_assoc($menu);
$agenda = mysqli_query($mysqli, 'SELECT count(*) jml FROM tb_agenda');
$row_agenda = mysqli_fetch_assoc($agenda);
?>
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-6">

        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $row_users['jml'] ?></h3>
            <p>Users</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          <a href="<?= $base_url ?>/dashboard.php?page=users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">

        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= $row_artikel['jml'] ?><sup style="font-size: 20px"></sup></h3>
            <p>Artikel</p>
          </div>
          <div class="icon">
            <i class="fas fa-pen"></i>
          </div>
          <a href="<?= $base_url ?>/dashboard.php?page=artikel" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">

        <div class="small-box bg-warning">
          <div class="inner">
            <h3>
              <?= $row_kategori['jml'] ?>
            </h3>
            <p>Kategori</p>
          </div>
          <div class="icon">
            <i class="fas fa-tags"></i>
          </div>
          <a href="<?= $base_url ?>/dashboard.php?page=kategori" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">

        <div class="small-box bg-danger">
          <div class="inner">
            <h3>
              <?= $row_menu['jml'] ?>
            </h3>
            <p>Menu</p>
          </div>
          <div class="icon">
            <i class="fas fa-th"></i>
          </div>
          <a href="<?= $base_url ?>/dashboard.php?page=menu" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">

        <div class="small-box bg-danger">
          <div class="inner">
            <h3>
              <?= $row_agenda['jml'] ?>
            </h3>
            <p>Agenda</p>
          </div>
          <div class="icon">
            <i class="fas fa-th"></i>
          </div>
          <a href="<?= $base_url ?>/dashboard.php?page=agenda" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

    </div>


    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>