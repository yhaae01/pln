    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="col-lg-8">
            <div class="card">
                <?php if (!empty($tagihan['id_tagihan'])) : ?>
                    <table class="table table-hover">
                        <tr>
                            <td>Nomor KWH</td>
                            <td><?= $tagihan['nomor_kwh']; ?></td>
                        </tr>
                        <tr>
                            <td>Bulan</td>
                            <td><?= $tagihan['bulan']; ?></td>
                        </tr>
                        <tr>
                            <td>Tahun</td>
                            <td><?= $tagihan['tahun']; ?></td>
                        </tr>
                        <tr>
                            <td>Total Meter</td>
                            <td><?= $tagihan['jumlah_meter']; ?></td>
                        </tr>
                        <tr>
                            <td>Status Pembayaran</td>
                            <td>
                                <?php if ($tagihan['status'] === 'sudah') : ?>
                                    <span class="badge badge-primary">Sudah Bayar</span>
                                <?php elseif ($tagihan['status'] === 'belum') : ?>
                                    <span class="badge badge-danger">Belum Bayar</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <?php if ($tagihan['status'] === 'belum') : ?>
                                    <a href="<?= base_url('pelanggan/pembayaran') ?>" class="badge badge-success">
                                        <span class="fas fa-money-bill"></span> bayar
                                    </a>
                                <?php endif ?>
                            </td>
                        </tr>
                    </table>
                <?php else : ?>
                    <h4>Tagihan kosong!</h4>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->