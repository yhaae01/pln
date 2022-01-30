    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="row">
            <div class="col-lg-10">
                <?= $this->session->flashdata('message'); ?>
                <a href="<?= base_url('pelanggan/tambah_penggunaan') ?>" class="btn btn-sm btn-primary mb-3">
                    <span class="fas fa-plus-circle"></span> Tambah Penggunaan
                </a>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nomor KWH</th>
                            <th scope="col">Bulan</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Meter Awal</th>
                            <th scope="col">Meter Akhir</th>
                        </tr>
                    </thead>
                    <?php  
                        $id_pelanggan = $this->session->userdata('id_pelanggan');
                        $query = "SELECT `pelanggan`.`id_pelanggan`, `penggunaan`.`id_pelanggan`, `penggunaan`.`id_penggunaan`, `nama_pelanggan`, `nomor_kwh`, `tahun`, `bulan`, `meter_awal`, `meter_akhir`
                                    FROM `pelanggan`
                                    JOIN `penggunaan` 
                                      ON `pelanggan`.`id_pelanggan` = `penggunaan`.`id_pelanggan`
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
                            <td><?= $p['nomor_kwh']; ?></td>
                            <td><?= $p['bulan']; ?></td>
                            <td><?= $p['tahun']; ?></td>
                            <td><?= $p['meter_awal']; ?></td>
                            <td><?= $p['meter_akhir']; ?></td>
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