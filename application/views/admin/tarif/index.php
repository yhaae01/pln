    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="row">
            <div class="col-lg-6">
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                <a href="<?= base_url('admin/tambah_tarif') ?>" class="btn btn-sm btn-primary mb-3">
                    <span class="fas fa-plus-circle"></span> Tambah Tarif
                </a>
                <table class="table table-hover">
                    <tr>
                        <th>#</th>
                        <th>Daya</th>
                        <th>Tarif</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                    <?php  
                    $no = 1;
                    foreach($tarif as $t) :
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $t['daya']; ?></td>
                        <td><?= $t['tarif_perkwh']; ?></td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/ubah_tarif/') . $t['id_tarif'] ?>" class="badge badge-warning"><span class="fas fa-edit"></span> ubah</a>
                            <a href="#" data-toggle="modal" data-target="#modalHapus<?= $t['id_tarif']; ?>" class="badge badge-danger"><span class="fas fa-trash"></span> hapus</a>
                        </td>
                    </tr>
                    <!-- Modal Hapus -->
                    <div class="modal fade" id="modalHapus<?= $t['id_tarif']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalHapusLabel">Hapus Tarif</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('admin/hapus_tarif/') . $t['id_tarif']; ?>" method="post">
                                <div class="modal-body">
                                    Yakin ingin hapus daya <strong> <?= $t['daya']; ?> </strong> ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <?php  
                    endforeach;
                    ?>
                </table>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->