<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-md-8">

            <div class="card o-hidden border-0 shadow-lg" style="margin-top: 140px;">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Silahkan Login!</h1>
                                </div>
                                <?php if($this->session->flashdata('pwpelanggan_salah')){ ?>
                                    <div class="alert alert-danger">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <?= $this->session->flashdata('pwpelanggan_salah'); ?>
                                    </div>
                                <?php } else if($this->session->flashdata('uspelanggan_salah')){  ?>
                                    <div class="alert alert-danger">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <?= $this->session->flashdata('uspelanggan_salah'); ?>
                                    </div>
                                <?php } else if($this->session->flashdata('reg_pelanggan')){  ?>
                                    <div class="alert alert-success">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <?= $this->session->flashdata('reg_pelanggan'); ?>
                                    </div>
                                <?php } else if($this->session->flashdata('logout_pelanggan')){  ?>
                                    <div class="alert alert-success">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <?= $this->session->flashdata('logout_pelanggan'); ?>
                                    </div>
                                <?php } ?>
                                <form class="user" method="post" action="<?= base_url('auth/login_pelanggan') ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control"
                                            id="username" name="username" aria-describedby="username"
                                            placeholder="Username" value="<?= set_value('username') ?>">
                                            <?= form_error('username', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control"
                                            id="password" name="password" placeholder="Password">
                                            <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/register_pelanggan') ?>">Daftar Akun!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>