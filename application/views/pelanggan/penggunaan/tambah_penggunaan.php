    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><span class="fas fa-plus-circle"></span> <?= $title; ?></h1>
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('pelanggan/tambah_penggunaan'); ?>" method="post">                            
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="">Bulan</label>
                                    <select name="bulan" class='form-select custom-select'>
                                        <option value="">-- Pilih Bulan --</option>
                                        <?php
                                            $bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
                                            $jlh_bulan=count($bulan);
                                            for($i = 0; $i < $jlh_bulan; $i += 1){
                                                echo"<option value=$bulan[$i]> $bulan[$i] </option>";
                                            }
                                        ?>
                                    </select>
                                    <?= form_error('bulan', '<small class="text-danger">', '</small>') ?>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="">Tahun</label>
                                    <select name='tahun' class='form-select custom-select'>
                                        <option selected='selected'>-- Pilih Tahun --</option>
                                        <?php
                                        $now = date('Y');
                                        $sampai = date('Y') + 10; // Tahun sekarang + 10 Tahun
                                            for($i = $now; $i <= $sampai; $i++){
                                                echo "<option value='$i'> $i </option>";
                                            }
                                        ?>
                                    </select>
                                    <?= form_error('tahun', '<small class="text-danger">', '</small>') ?>
                                </div>
                            </div>
                            
                            <?php  
                                $id_pelanggan = $this->session->userdata('id_pelanggan');
                                // $bulan = date('M');
                                $query = "SELECT `penggunaan`.`meter_akhir`, `pelanggan`.`id_pelanggan` 
                                            FROM `penggunaan`
                                            JOIN `pelanggan`
                                           WHERE `penggunaan`.`id_pelanggan` = $id_pelanggan
                                        ORDER BY `id_penggunaan` DESC LIMIT 1
                                    ";

                                $result = $this->db->query($query)->result_array();
                            ?>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="">Meter Awal</label>
                                    <?php foreach ($result as $r) : ?>
                                        <?php if ($r['meter_akhir'] != 0) : ?>
                                            <input type="text" readonly name="meter_awal" class="form-control form-control-user" id="meter_awal"
                                            value="<?= $r['meter_akhir'] ?>">
                                        <?php elseif ($r['meter_akhir'] === null) : ?>
                                            <?php endif ?>
                                            <?php endforeach ?>
                                            <input type="text" name="meter_awal" class="form-control form-control-user" id="meter_awal"
                                                value="<?= set_value('meter_awal') ?>">
                                    <?= form_error('meter_awal', '<small class="text-danger">', '</small>') ?>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="">Meter Akhir</label>
                                    <input type="text" name="meter_akhir" class="form-control form-control-user" id="meter_akhir"
                                        value="<?= set_value('meter_akhir') ?>">
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