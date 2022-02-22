    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><span class="fas fa-plus-circle"></span> <?= $title; ?></h1>
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('admin/tambah_penggunaan'); ?>" method="post">
                            <div class="form-group">
                                <label>Pelanggan</label>
                                <select name="id_pelanggan" class='form-select custom-select'>
                                    <option value="">-- Pilih Pelanggan --</option>
                                    <?php foreach($pelanggan as $p) : ?>
                                    <option value="<?= $p['id_pelanggan'] ?>"><?= $p['nama_pelanggan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_pelanggan', '<small class="text-danger">', '</small>') ?>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="">Meter Awal</label>
                                        <input type="text" name="meter_awal" id="meter_awal" class="form-control form-control-user" value="<?= set_value('meter_awal'); ?>">
                                        <?= form_error('meter_awal', '<small class="text-danger">', '</small>') ?>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="">Meter Akhir</label>
                                    <input type="text" name="meter_akhir" id="meter_akhir" class="form-control form-control-user"
                                        value="<?= set_value('meter_akhir') ?>">
                                        <?= form_error('meter_akhir', '<small class="text-danger">', '</small>') ?>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm"><span class="fas fa-save"></span> Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->