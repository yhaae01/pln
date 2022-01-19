<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-6 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Daftar Akun!</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/register_pelanggan'); ?>">
                            <div class="form-group">
                                <input type="username" name="username" class="form-control form-control-user" id="username"
                                    placeholder="Username" value="<?= set_value('username') ?>">
                                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <input type="text" name="nama_pelanggan" class="form-control form-control-user" id="nama_pelanggan"
                                    placeholder="Nama Lengkap" value="<?= set_value('nama_pelanggan') ?>">
                                    <?= form_error('nama_pelanggan', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password1" class="form-control form-control-user"
                                        id="password1" placeholder="Password">
                                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="password2" class="form-control form-control-user"
                                        id="password2" placeholder="Ulangi Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="number" name="nomor_kwh" class="form-control form-control-user" id="nomor_kwh"
                                    placeholder="Nomor KWH" value="<?= set_value('nomor_kwh') ?>">
                                    <?= form_error('nomor_kwh', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" value="<?= set_value('alamat') ?>" placeholder="Alamat"></textarea>
                                    <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group form-select">
                                <select name="id_tarif" class="form-select custom-select" value="<?= set_value('id_tarif') ?>">
                                    <option value="">-- Pilih Daya --</option>
                                    <option name="id_tarif" value="1">450</option>
                                    <option name="id_tarif" value="2">900</option>
                                    <option name="id_tarif" value="3">1300</option>
                                    <option name="id_tarif" value="4">2200</option>
                                    <option name="id_tarif" value="5">3500</option>
                                    <option name="id_tarif" value="6">6600</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Daftar
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth/login_pelanggan') ?>">Sudah punya akun? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
