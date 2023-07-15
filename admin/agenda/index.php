<?php
include_once("../config.php");

?>
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Agenda</h3>

                        <div class="card-tools">
                            <!-- This will cause the card to maximize when clicked -->
                            <a href='agenda/create.php?page=agenda' class="btn btn-info"><i class="fas fa-plus"></i>Tambah Agenda</a>
                        </div>
                        <!-- /.card-tools -->
                    </div>

                    <div class="card-body">

                        <table width='100%' id='tabel-simpel' class="table table-bordered">

                            <tr>
                                <th>No</th>
                                <th>Nama Acara</th>
                                <th>Kategori Agenda</th>
                                <th>Penulis</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = 1;
                            $result = mysqli_query($mysqli, "SELECT tb_agenda.*,
                            tb_kategori.nama_kategori,
                            tb_users.nama_operator
                            FROM tb_agenda
                            INNER JOIN tb_kategori ON tb_agenda.id_kategori = tb_kategori.id
                            INNER JOIN tb_users ON tb_agenda.user_id = tb_users.id
                            
                            ORDER BY id DESC");


                            while ($data = mysqli_fetch_array($result)) {
                            ?>

                                <tr>
                                    <td>
                                        <?= $no++ ?>
                                    </td>
                                    <td>
                                        <?= $data['judul_agenda'] ?>
                                    </td>
                                    <td>
                                        <?= $data['nama_kategori'] ?>
                                    </td>
                                    <td>
                                        <?= $data['nama_operator'] ?>
                                    </td>
                                    <td>
                                        <div class="user-panel d-flex">
                                            <div class="image">
                                                <img src="../admin/agenda/image/<?= $data['cover']; ?>" alt="Gambar" class="img-square elevation-1" style="width: 60px; height: 50px; margin-left: auto; margin-right: auto;">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <a class="btn btn-success" href='agenda/edit.php?id=<?= $data['id'] ?>&page=agenda'>Edit</a>
                                        <a class="btn btn-danger" onclick='return confirmDelete()' href='agenda/delete.php?id=<?= $data['id'] ?>&page=agenda'>Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div><!-- /.card -->
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>