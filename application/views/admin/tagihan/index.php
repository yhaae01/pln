    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="row">
            <div class="col-lg-10">
                <?= $this->session->flashdata('message'); ?>
                <a href="<?= base_url('admin/tambah_tagihan') ?>" class="btn btn-sm btn-primary mb-3">
                    <span class="fas fa-plus-circle"></span> Tambah Tagihan
                </a>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nomor KWH</th>
                            <th scope="col">Bulan</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Jumlah Meter</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <?php  
                        $query = "SELECT *
                                    FROM tagihan
                                    JOIN penggunaan ON (tagihan.id_penggunaan = penggunaan.id_penggunaan)
                                    JOIN pelanggan ON (penggunaan.id_pelanggan = pelanggan.id_pelanggan)
                                    ";

                        $result = $this->db->query($query)->result_array();
                    ?>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($result as $p) : 
                        ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $p['nomor_kwh']; ?></td>
                            <td><?= $p['bulan']; ?></td>
                            <td><?= $p['tahun']; ?></td>
                            <td><?= $p['jumlah_meter']; ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('pelanggan/ubah_tagihan/') . $p['id_tagihan'] ?>" class="badge badge-warning"><span class="fas fa-edit"></span> ubah</a>
                                <a href="#" data-toggle="modal" data-target="#modalHapus<?= $p['id_tagihan']; ?>" class="badge badge-danger"><span class="fas fa-trash"></span> delete</a>
                            </td>
                        </tr>
                        <!-- Modal Hapus -->
                        <div class="modal fade" id="modalHapus<?= $p['id_tagihan']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalHapusLabel">Hapus Pelanggan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('pelanggan/hapus_tagihan/') . $p['id_tagihan']; ?>" method="post">
                                    <div class="modal-body">
                                        Yakin ingin hapus penggunaan bulan <strong><?= $p['bulan']; ?></strong> ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <?php 
                        endforeach 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->