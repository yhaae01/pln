    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><span class="fas fa-edit"></span> <?= $title; ?></h1>
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">                            
                            <input type="hidden" name="id_penggunaan" value="<?= $penggunaan['id_penggunaan'] ?>">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="">Meter Awal</label>
                                    <input type="text" name="meter_awal" class="form-control form-control-user" id="meter_awal"
                                        value="<?= $penggunaan['meter_awal'] ?>">
                                        <?= form_error('meter_awal', '<small class="text-danger">', '</small>') ?>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="">Meter Akhir</label>
                                    <input type="text" name="meter_akhir" class="form-control form-control-user" id="meter_akhir"
                                        value="<?= $penggunaan['meter_akhir'] ?>">
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