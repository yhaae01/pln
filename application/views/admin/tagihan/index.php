    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="row">
            <div class="col-lg-12">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nomor KWH</th>
                            <th scope="col">Bulan</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Jumlah Meter</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($tagihan as $t) : 
                        ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $t['nomor_kwh']; ?></td>
                            <td><?= $t['bulan'] = date('F'); ?></td>
                            <td><?= $t['tahun']; ?></td>
                            <td><?= $t['jumlah_meter']; ?></td>
                            <td>
                                <?php if ($t['status'] === 'Dibayar') : ?>
                                    <span class="badge badge-primary">Sudah Dibayar</span>
                                <?php elseif ($t['status'] === 'Belum Dibayar') : ?>
                                    <span class="badge badge-danger">Belum Dibayar</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="#" data-toggle="modal" data-target="#modalHapus<?= $t['id_tagihan']; ?>" class="badge badge-danger"><span class="fas fa-trash"></span> hapus</a>
                            </td>
                        </tr>
                        <!-- Modal Hapus -->
                        <div class="modal fade" id="modalHapus<?= $t['id_tagihan']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalHapusLabel">Hapus Tagihan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('admin/hapus_tagihan/') . $t['id_tagihan']; ?>" method="post">
                                    <div class="modal-body">
                                        Yakin ingin hapus tagihan <strong><?= $t['nomor_kwh']; ?></strong> ?
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