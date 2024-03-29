    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="row">
            <div class="col-lg-6">
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                <div class="card">
                    <div class="card-block col-md mx-auto my-2">
                        <?php if (!empty($tagihan['id_tagihan'])) : ?>
                        <table class="table mb-3">
                            <tr>
                                <td style="width: 200px">Nomor KWH</td>
                                <td><?= $tagihan['nomor_kwh']; ?></td>
                            </tr>
                            <tr>
                                <td>Bulan</td>
                                <td><?= date('F'); ?></td>
                            </tr>
                            <tr>
                                <td>Tahun</td>
                                <td><?= $tagihan['tahun']; ?></td>
                            </tr>
                            <tr>
                                <td>Daya</td>
                                <td><?= $tagihan['daya']; ?></td>
                            </tr>
                            <tr>
                                <td>Total Meter</td>
                                <td><?= $tagihan['jumlah_meter']; ?></td>
                            </tr>
                            <tr>
                                <td>Status Pembayaran</td>
                                <td>
                                    <?php if ($tagihan['status'] === 'Dibayar') : ?>
                                        <span class="badge badge-primary">Sudah Dibayar</span>
                                    <?php elseif ($tagihan['status'] === 'Belum Dibayar') : ?>
                                        <span class="badge badge-danger">Belum Bayar</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <?php if ($tagihan['status'] === 'Belum Dibayar') : ?>
                                        <a href="<?= base_url('pelanggan/pembayaran') ?>" class="btn btn-sm btn-primary btn-block">
                                            Bayar Tagihan
                                        </a>
                                    <?php endif ?>
                                    <?php else : ?>
                                        <h4 class="my-3 mx-4">Tagihan kosong!</h4>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->