<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include("config.php");


$no = 1;
$allArtikel = mysqli_query($mysqli, "SELECT tb_artikel.*,
                            tb_kategori.nama_kategori,
                            tb_users.nama_operator
                            FROM tb_artikel
                            INNER JOIN tb_kategori ON tb_artikel.id_kategori = tb_kategori.id
                            INNER JOIN tb_users ON tb_artikel.user_id = tb_users.id
                            ORDER BY id DESC
                            ");
$batas = 2;
$halaman = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;
$jumlah_data = $allArtikel->num_rows;
$total_halaman = ceil($jumlah_data / $batas);

$new_artikel = mysqli_query($mysqli, "SELECT tb_artikel.*,
                            tb_kategori.nama_kategori,
                            tb_users.nama_operator
                            FROM tb_artikel
                            INNER JOIN tb_kategori ON tb_artikel.id_kategori = tb_kategori.id
                            INNER JOIN tb_users ON tb_artikel.user_id = tb_users.id
                            LIMIT $halaman_awal, $batas
                           ");

$artikel = mysqli_query($mysqli, "SELECT tb_artikel.*,
                            tb_kategori.nama_kategori,
                            tb_users.nama_operator
                            FROM tb_artikel
                            INNER JOIN tb_kategori ON tb_artikel.id_kategori = tb_kategori.id
                            INNER JOIN tb_users ON tb_artikel.user_id = tb_users.id
                            ORDER BY id DESC
                            limit 4
                            ");

$agenda = mysqli_query($mysqli, "SELECT tb_agenda.*,
                          tb_kategori.nama_kategori,
                          tb_users.nama_operator
                          FROM tb_agenda
                          INNER JOIN tb_kategori ON tb_agenda.id_kategori = tb_kategori.id
                          INNER JOIN tb_users ON tb_agenda.user_id = tb_users.id
                          ORDER BY id DESC
                          limit 4
                          ");


$about = mysqli_query($mysqli, "SELECT * from tb_tentang");
$kategori = mysqli_query($mysqli, "SELECT * from tb_kategori");
$menu = mysqli_query($mysqli, "SELECT * from tb_menu");

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.101.0">
  <title>Blog Website</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/blog/">



  <!-- Bootstrap core CSS -->
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">



  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    .jumbotron-image {
      background-position: center center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="blog.css" rel="stylesheet">
</head>

<body>

  <div class="container">
    <header class="blog-header py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
          <a class="text-muted" href="#"></a>
        </div>
        <div class="col-4 text-center">
          <a class="blog-header-logo text-dark" href="#">My blog</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <a class="text-muted" href="#" aria-label="Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false">
              <title>Search</title>
              <circle cx="10.5" cy="10.5" r="7.5" />
              <path d="M21 21l-5.2-5.2" />
            </svg>
          </a>
        </div>
      </div>
    </header>

    <div class="nav-scroller py-1 mb-2">
      <nav class="nav d-flex justify-content-between">
        <?php
        while ($data_menu = mysqli_fetch_array($menu)) {
          $i = 1;

        ?>
          <a class="p-2 text-muted" href="#<?= $i++ ?>"><?= $data_menu['nama_menu'] ?></a>

        <?php } ?>
      </nav>
    </div>

    <div class="container py-5">
      <div class="jumbotron text-white jumbotron-image shadow" style="background-image: url(https://rb.gy/7lw36);">
        <h2 class="mb-4">
          ALKARIZQY RESTU PRIBADI BUDIANTO
        </h2>
        <p class="mb-4">
          A22100015
        </p>
        <a href="https://bootstrapious.com/snippets" class="btn btn-primary">Find More</a>
      </div>
    </div>

    <div class="row mb-2" id="1">
      <?php
      while ($data = mysqli_fetch_array($artikel)) {
      ?>
        <div class="col-md-6">
          <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-primary">
                <?= $data['nama_kategori'] ?>
              </strong>
              <h3 class="mb-0">New post</h3>
              <div class="mb-1 text-muted">
                <?= date('d-M-Y', strtotime($data['created_time'])) ?>
              </div>
              <p class="card-text mb-auto text-justify">
                <?= substr($data['content_artikel'], 0, 100) . '...' ?>
              </p>
              <a href="artikel.php?id=<?= $data['id'] ?>" class="stretched-link">Continue reading</a>
            </div>
            <div class="col-auto d-none d-lg-block">
              <img width="200px" class="rounded float-right" src="admin/artikel/image/<?= $data['cover'] ?>" alt="">
            </div>
          </div>
        </div>
      <?php } ?>
    </div>


  </div>

  <main role="main" class="container" id="2">

    <div class="row">

      <div class="col-md-8 blog-main">
        <?php
        while ($dataArtikel = mysqli_fetch_array($new_artikel)) {
        ?>
          <h3 class="pb-4 mb-4 font-italic border-bottom">
            Artikel
          </h3>

          <div class="blog-post">
            <h2 class="blog-post-title">
              <?= $dataArtikel['judul_artikel'] ?>
              <img width="200px" class="rounded float-right" src="admin/artikel/image/<?= $dataArtikel['cover'] ?>" alt="">

            </h2><br><br>
            <p class="blog-post-meta">
              <?= date('d-M-Y', strtotime($dataArtikel['created_time'])) ?> by <a href="#">
                <?= $dataArtikel['nama_operator'] ?>
              </a>
            </p>
            <p class="text-justify">
              <?= $dataArtikel['content_artikel'] ?>
            </p>
          </div><!-- /.blog-post -->
          <?php ?>
          <?php ?>
        <?php } ?>

        <h3 class="pb-4 mb-4 font-italic border-bottom">
          Agenda
        </h3>
        <?php while ($dataAgenda = mysqli_fetch_array($agenda)) : ?>
          <img width="200px" class="rounded float-right" src="admin/agenda/image/<?= $dataAgenda['cover'] ?>" alt="">
          <p class="blog-post-meta">
          <div class="blog-post">
            <h2 class="blog-post-title">
              <?= $dataAgenda['judul_agenda'] ?>
            </h2>
            <?= date('d-M-Y', strtotime($dataAgenda['created_time'])) ?> by <a href="#">
              <?= $dataAgenda['nama_operator'] ?>
            </a>
            </p>
            <p class="text-justify">
              <?= $dataAgenda['content_agenda'] ?>
            </p>
          </div>

          <!-- /.agenda-post -->

        <?php endwhile ?>

        <nav class="blog-pagination">
          <ul class="pagination justify-content-center">
            <li class="page-item">
              <a class="page-link" <?php if ($halaman > 1) {
                                      echo "href='?halaman=$previous'";
                                    } ?>>Sebelumnya</a>
            </li>
            <?php
            for ($x = 1; $x <= $total_halaman; $x++) {
            ?>
              <li class="page-item"><a class="page-link" href="?halaman=<?= $x ?>"><?= $x; ?></a></li>
            <?php
            }
            ?>
            <li class="page-item">
              <a class="page-link" <?php if ($halaman < $total_halaman) {
                                      echo "href='?halaman=$next'";
                                    } ?>>Selanjutnya</a>
            </li>
          </ul>
        </nav>

      </div><!-- /.row -->
      <aside class="col-md-4 blog-sidebar">
        <div class="p-4 mb-3 bg-light rounded">
          <h4 class="font-italic">About</h4>
          <p class="mb-0">Hidup adalah perjalanan yang luar biasa penuh dengan berbagai pengalaman, tantangan, dan peluang untuk tumbuh. Ini adalah keseimbangan yang rapuh antara sukacita dan duka, keberhasilan dan kegagalan, cinta dan patah hati. Setiap hari membawa babak baru, kesempatan untuk belajar, berkembang, dan menemukan tujuan sejati kita. Hidup mengajarkan kepada kita pelajaran berharga tentang ketangguhan, belas kasihan, dan kekuatan hubungan manusia. Ini adalah kain yang dianyam dengan momen-momen tawa, air mata, dan introspeksi yang mendalam. Di tengah ketidakpastian, kita menemukan ketenangan dalam keindahan momen ini dan kemungkinan tak terbatas yang ada di depan. Hidup adalah anugerah berharga, dan terserah kepada kita untuk merangkul kerumitan-kerumitannya, hidup dengan autentik, dan memberikan dampak positif bagi dunia di sekitar kita.</p>
        </div>


      </aside><!-- /.blog-sidebar -->

  </main><!-- /.container -->

  <footer class="blog-footer">
    <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
    <p>
      <a href="#">Back to top</a>
    </p>
  </footer>



</body>

</html>