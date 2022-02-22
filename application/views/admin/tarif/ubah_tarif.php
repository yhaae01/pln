    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><span class="fas fa-edit"></span> <?= $title; ?></h1>
        
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">                            
                            <input type="hidden" name="id_tarif" value="<?= $tarif['id_tarif'] ?>">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="">Daya</label>
                                    <input type="text" name="daya" class="form-control form-control-user" id="daya"
                                        value="<?= $tarif['daya'] ?>">
                                        <?= form_error('daya', '<small class="text-danger">', '</small>') ?>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="">Tarif</label>
                                    <input type="text" name="tarif_perkwh" class="form-control form-control-user" id="tarif_perkwh"
                                        value="<?= $tarif['tarif_perkwh'] ?>">
                                        <?= form_error('tarif_perkwh', '<small class="text-danger">', '</small>') ?>
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