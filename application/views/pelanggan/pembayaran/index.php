    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <div class="row">
            <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>

                <div class="card">
                    <?php if (!empty($tagihan['status'] == 'Belum Dibayar')) : ?>
                        <div class="card-block col-md mx-auto my-2">
                            <!-- From Pembayaran -->
                            <form action="" method="post">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="id_tagihan" name="id_tagihan" value="<?= $tagihan['id_tagihan'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="nama_pelanggan">Nama</label>
                                            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= $user['nama_pelanggan']; ?>" readonly>
                                            <input type="hidden" class="form-control" id="id_pelanggan" name="id_pelanggan" value="<?= $user['id_pelanggan']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="jumlah_meter">Jumlah Meter</label>
                                            <input type="text" class="form-control" id="jumlah_meter" name="jumlah_meter" value="<?= $tagihan['jumlah_meter']; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="tgl_bayar">Tanggal Bayar</label>
                                            <input type="text" class="form-control" id="tgl_bayar" name="tgl_bayar" value="<?= date('d-F-Y'); ?>" readonly>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="biaya_admin">Biaya Admin</label>
                                                    <input type="hidden" class="form-control" id="nama_admin" name="nama_admin" value="<?= $admin['nama_admin']; ?>" readonly>
                                                    <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $admin['id_user']; ?>">
                                                    <input type="text" class="form-control" id="biaya_admin" name="biaya_admin" value="3000" readonly>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Biaya Tagihan</label>
                                                    <input type="text" class="form-control" id="" name="" value="<?= $tagihan['jumlah_meter'] * $tagihan['tarif_perkwh']?>" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="total_bayar">Total Bayar</label>
                                            <input type="text" class="form-control" id="total_bayar" name="total_bayar" value="<?= $tagihan['jumlah_meter'] * $tagihan['tarif_perkwh'] + 3000; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="nominal">Masukan Nominal Bayar</label>
                                            <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Masukan Nominal...">
                                            <!-- Menampilkan Eror -->
                                            <small class="form-text text-danger"><?= form_error('nominal'); ?></small>
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-3 btn-block">
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