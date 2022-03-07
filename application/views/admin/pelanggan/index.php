    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><span class="fas fa-users"></span> <?= $title; ?></h1>

        <div class="row">
            <div class="col-lg-8">
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                <a href="<?= base_url('admin/tambah_pelanggan') ?>" class="btn btn-sm btn-primary mb-3"><span class="fas fa-plus-circle"></span> Tambah Pelanggan</a>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Nomor KWH</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($pelanggan as $p) : 
                        ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $p['nama_pelanggan']; ?></td>
                            <td><?= $p['nomor_kwh']; ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('admin/detail_pelanggan/') . $p['id_pelanggan'] ?>" class="badge badge-info"><span class="fas fa-eye"></span> detail</a>
                                <a href="<?= base_url('admin/ubah_pelanggan/') . $p['id_pelanggan'] ?>" class="badge badge-warning"><span class="fas fa-edit"></span> ubah</a>
                                <a href="#" data-toggle="modal" data-target="#modalHapus<?= $p['id_pelanggan']; ?>" class="badge badge-danger"><span class="fas fa-trash"></span> delete</a>
                            </td>
                        </tr>
                        <!-- Modal Hapus -->
                        <div class="modal fade" id="modalHapus<?= $p['id_pelanggan']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalHapusLabel">Hapus Pelanggan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('admin/hapus_pelanggan/') . $p['id_pelanggan']; ?>" method="post">
                                    <div class="modal-body">
                                        Yakin ingin hapus pelanggan <strong> <?= $p['username']; ?> </strong> ?
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
                        endforeach 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->