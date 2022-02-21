    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><span class="fas fa-eye"></span> <?= $title; ?></h1>
        
        <div class="row">
            <div class="col-lg-8">
            <a href="<?= base_url('admin/pelanggan') ?>" class="btn btn-sm btn-primary mb-3"><span class="fas fa-chevron-left"></span> Kembali</a>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td style="width: 25%">Username</td>
                                    <td style="width: 5%">:</td>
                                    <td><?= $pelanggan['username'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Pelanggan</td>
                                    <td>:</td>
                                    <td><?= $pelanggan['nama_pelanggan'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nomor KWH</td>
                                    <td>:</td>
                                    <td><?= $pelanggan['nomor_kwh'] ?></td>
                                </tr>
                                <tr>
                                    <td>Daya</td>
                                    <td>:</td>
                                    <td><?= $pelanggan['daya'] ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><?= $pelanggan['alamat'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->