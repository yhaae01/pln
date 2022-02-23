    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <div class="row">
            <div class="col-lg-6 col-md-8">
            <?= $this->session->flashdata('message'); ?>

                <div class="card">
                    <?php if (!empty($tagihan['status'] == 'Belum Dibayar')) : ?>
                        <div class="card-block col-md mx-auto my-2">

                            <table class="table table-responsive">
                                <tr>
                                    <th style="width: 140px">Nama</th>
                                    <td style="width: 5px;">:</td>
                                    <td><?= $user['nama_pelanggan']; ?></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Meter</th>
                                    <td>:</td>
                                    <td><?= $tagihan['jumlah_meter']; ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Bayar</th>
                                    <td>:</td>
                                    <td><?= date('d F Y'); ?></td>
                                </tr>
                                <tr>
                                    <th>Biaya Admin</th>
                                    <td>:</td>
                                    <td>3000</td>
                                </tr>
                                <tr>
                                    <th>Biaya Tagihan</th>
                                    <td>:</td>
                                    <td><?= $tagihan['jumlah_meter'] * $tagihan['tarif_perkwh']?></td>
                                </tr>
                                <tr>
                                    <th>Total Bayar</th>
                                    <td>:</td>
                                    <td><?= $tagihan['jumlah_meter'] * $tagihan['tarif_perkwh'] + 3000; ?></td>
                                </tr>
                            </table>
                            
                            <!-- From Pembayaran -->
                            <form action="" method="post">
                                <input type="hidden" class="form-control" id="id_tagihan" name="id_tagihan" value="<?= $tagihan['id_tagihan'] ?>">
                                <input type="hidden" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= $user['nama_pelanggan']; ?>" readonly>
                                <input type="hidden" class="form-control" id="id_pelanggan" name="id_pelanggan" value="<?= $user['id_pelanggan']; ?>">
                                <input type="hidden" class="form-control" id="jumlah_meter" name="jumlah_meter" value="<?= $tagihan['jumlah_meter']; ?>" readonly>
                                <input type="hidden" class="form-control" id="tgl_bayar" name="tgl_bayar" value="<?= date('d-F-Y'); ?>" readonly>
                                <input type="hidden" class="form-control" id="nama_admin" name="nama_admin" value="<?= $admin['nama_admin']; ?>" readonly>
                                <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $admin['id_user']; ?>">
                                <input type="hidden" class="form-control" id="biaya_admin" name="biaya_admin" value="3000" readonly>
                                <input type="hidden" class="form-control" id="" name="" value="<?= $tagihan['jumlah_meter'] * $tagihan['tarif_perkwh']?>" readonly>
                                <input type="hidden" class="form-control" id="total_bayar" name="total_bayar" value="<?= $tagihan['jumlah_meter'] * $tagihan['tarif_perkwh'] + 3000; ?>" readonly>
                                <input type="hidden" class="form-control" id="nominal" name="nominal" value="<?= $tagihan['jumlah_meter'] * $tagihan['tarif_perkwh'] + 3000; ?>">

                                <button type="button" class="btn btn-primary btn-sm mb-3 btn-block" data-toggle="modal" data-target="#exampleModal">
                                    Bayar
                                </button>

                            </form>
                            <!-- End Form -->
                        </div>

                    <?php else : ?>
                        <li class="list-group-item">Tagihan sudah dibayar atau belum ada tagihan!</li>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bayar tagihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    Yakin ingin bayar tagihan <strong><?= date('F Y'); ?></strong> ?
                    <input type="hidden" class="form-control" id="id_tagihan" name="id_tagihan" value="<?= $tagihan['id_tagihan'] ?>">
                    <input type="hidden" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= $user['nama_pelanggan']; ?>" readonly>
                    <input type="hidden" class="form-control" id="id_pelanggan" name="id_pelanggan" value="<?= $user['id_pelanggan']; ?>">
                    <input type="hidden" class="form-control" id="jumlah_meter" name="jumlah_meter" value="<?= $tagihan['jumlah_meter']; ?>" readonly>
                    <input type="hidden" class="form-control" id="tgl_bayar" name="tgl_bayar" value="<?= date('d-F-Y'); ?>" readonly>
                    <input type="hidden" class="form-control" id="nama_admin" name="nama_admin" value="<?= $admin['nama_admin']; ?>" readonly>
                    <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $admin['id_user']; ?>">
                    <input type="hidden" class="form-control" id="biaya_admin" name="biaya_admin" value="3000" readonly>
                    <input type="hidden" class="form-control" id="" name="" value="<?= $tagihan['jumlah_meter'] * $tagihan['tarif_perkwh']?>" readonly>
                    <input type="hidden" class="form-control" id="total_bayar" name="total_bayar" value="<?= $tagihan['jumlah_meter'] * $tagihan['tarif_perkwh'] + 3000; ?>" readonly>
                    <input type="hidden" class="form-control" id="nominal" name="nominal" value="<?= $tagihan['jumlah_meter'] * $tagihan['tarif_perkwh'] + 3000; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm">Ya, bayar</button>
                </div>
            </form>
        </div>
    </div>
</div>