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
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Bulan</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Total Meter</th>
                            <th scope="col">Status Pembayaran</th>
                            <th scope="col" class="text-center">Aksi</th>
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
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $p['bulan']; ?></td>
                            <td><?= $p['tahun']; ?></td>
                            <td><?= $p['jumlah_meter']; ?></td>
                            <td><?= $p['status']; ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('pelanggan/bayar_tagihan/') . $p['id_tagihan'] ?>" class="badge badge-success">
                                    <span class="fas fa-money-bill"></span> bayar
                                </a>
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