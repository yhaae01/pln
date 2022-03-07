    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="row">
            <div class="col-lg-12">
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                <a href="<?= base_url('admin/tambah_penggunaan') ?>" class="btn btn-sm btn-primary mb-3">
                    <span class="fas fa-plus-circle"></span> Tambah Penggunaan
                </a>
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nomor KWH</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Bulan</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Meter Awal</th>
                            <th scope="col">Meter Akhir</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($penggunaan as $p) : 
                        ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $p['nomor_kwh']; ?></td>
                            <td><?= $p['nama_pelanggan']; ?></td>
                            <td><?= $p['bulan'] = date('F'); ?></td>
                            <td><?= $p['tahun']; ?></td>
                            <td><?= $p['meter_awal']; ?></td>
                            <td><?= $p['meter_akhir']; ?></td>
                            <td>
                                <a href="<?= base_url('admin/ubah_penggunaan/') . $p['id_penggunaan'] ?>" class="badge badge-warning"><span class="fas fa-edit"></span> ubah</a>
                                <a href="#" data-toggle="modal" data-target="#modalHapus<?= $p['id_penggunaan']; ?>" class="badge badge-danger"><span class="fas fa-trash"></span> hapus</a>
                            </td>
                        </tr>
                            <!-- Modal Hapus -->
                            <div class="modal fade" id="modalHapus<?= $p['id_penggunaan']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalHapusLabel">Hapus Penggunaan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?= base_url('admin/hapus_penggunaan/') . $p['id_penggunaan']; ?>" method="post">
                                        <div class="modal-body">
                                            Yakin ingin hapus Penggunaan <strong> <?= $p['nomor_kwh']; ?> </strong> pada <strong> <?= $p['bulan'] ?> - <?= $p['tahun'] ?></strong> ?
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