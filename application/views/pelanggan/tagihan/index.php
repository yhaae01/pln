    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="row">
            <div class="col-lg-10">
                <?= $this->session->flashdata('message'); ?>
                <!-- <a href="<?= base_url('pelanggan/tambah_penggunaan') ?>" class="btn btn-sm btn-primary mb-3">
                    <span class="fas fa-plus-circle"></span> Tambah Penggunaan
                </a> -->
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Bulan</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Total Meter</th>
                            <th scope="col">Status Pembayaran</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <?php  
                        $id_pelanggan = $this->session->userdata('id_pelanggan');
                        $query = "SELECT `penggunaan`.`id_penggunaan`, `tagihan`.`id_tagihan`, `jumlah_meter`, `penggunaan`.`tahun`, `penggunaan`.`bulan`, `penggunaan`.`meter_awal`, `penggunaan`.`meter_akhir`, `status`
                                    FROM `penggunaan`
                                    JOIN `tagihan` 
                                      ON `penggunaan`.`id_penggunaan` = `tagihan`.`id_penggunaan`
                                   WHERE `penggunaan`.`id_pelanggan` = $id_pelanggan";

                        $result = $this->db->query($query)->result_array();
                    ?>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($result as $p) : 
                        ?>
                        <tr class="text-center">
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $p['bulan']; ?></td>
                            <td><?= $p['tahun']; ?></td>
                            <td><?= $p['jumlah_meter']; ?></td>
                            <td>
                                <?php if ($p['status'] === 'sudah') : ?>
                                    <span class="badge badge-primary">Sudah Bayar</span>
                                <?php elseif ($p['status'] === 'proses') : ?>
                                    <span class="badge badge-warning">Pembayaran Diproses</span>
                                <?php elseif ($p['status'] === 'belum') : ?>
                                    <span class="badge badge-danger">Belum Bayar</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($p['status'] === 'belum') : ?>
                                    <a href="#" data-toggle="modal" data-target="#ModalBayar<?= $p['id_tagihan'] ?>" class="badge badge-success">
                                        <span class="fas fa-money-bill"></span> bayar
                                    </a>
                                <?php endif ?>
                                <!-- Modal Tagihan -->
                                <div class="modal fade" id="ModalBayar<?= $p['id_tagihan'] ?>" tabindex="-1" role="dialog" aria-labelledby="ModalBayarLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalBayarLabel">Bayar Tagihan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url('pelanggan/bayar_tagihan/') . $p['id_tagihan'] ?>" method="post">
                                                <div class="modal-body">
                                                    Yakin ingin bayar tagihan bulan <strong><?= $p['bulan']; ?></strong>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-sm btn-primary">Bayar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
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