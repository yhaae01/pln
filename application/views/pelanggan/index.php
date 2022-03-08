    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="row">
            <div class="col-lg-6">
                <?php if ($tagihan['status'] === 'Dibayar') : ?>
                    <div class="alert alert-success" role="alert">
                        Tagihan tidak ada atau sudah dibayar.
                    </div>
                <?php elseif ($tagihan['status'] === 'Belum Dibayar') : ?>
                    <div class="alert alert-danger" role="alert">
                        Tagihan bulan ini belum <strong>dibayar</strong>.
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->