    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><span class="fas fa-edit"></span> <?= $title; ?></h1>
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                        <input type="hidden" name="id_pelanggan" value="<?= $pelanggan['id_pelanggan'] ?>">
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="username" name="username" class="form-control form-control-user" id="username"
                                    value="<?= $pelanggan['username'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Pelanggan</label>
                                <input type="text" name="nama_pelanggan" class="form-control form-control-user" id="nama_pelanggan"
                                    value="<?= $pelanggan['nama_pelanggan'] ?>">
                                    <?= form_error('nama_pelanggan', '<small class="text-danger">', '</small>') ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="">Nomor KWH</label>
                                    <input type="text" name="nomor_kwh" maxlength="11" class="form-control form-control-user" id="nomor_kwh"
                                        value="<?= $pelanggan['nomor_kwh'] ?>">
                                        <?= form_error('nomor_kwh', '<small class="text-danger">', '</small>') ?>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="">ID Tarif</label>
                                    <select name="id_tarif" class="form-select custom-select" value="<?= $pelanggan['id_tarif'] ?>">
                                        <option value="<?= $pelanggan['id_tarif'] ?>"><?= $pelanggan['id_tarif']; ?></option>
                                        <option name="id_tarif" value="1">450</option>
                                        <option name="id_tarif" value="2">900</option>
                                        <option name="id_tarif" value="3">1300</option>
                                        <option name="id_tarif" value="4">2200</option>
                                        <option name="id_tarif" value="5">3500</option>
                                        <option name="id_tarif" value="6">6600</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= $pelanggan['alamat'] ?></textarea>
                                    <?= form_error('alamat', '<small class="text-danger">', '</small>') ?>
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