<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to PLN-Ku</title>
    <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>

	<div class="container">

		<div class="card" style="margin-top: 150px;">
			<div class="card-body text-center">
				<h1>Selamat Datang di PLN-Ku</h1>
				<hr>
				<div>
					<h4>Silahkan Login</h4>
				</div>

				<div class="row my-4">
					<div class="col-lg-6">
						<div class="card">
							<div class="card-body">
								<a href="<?= base_url('auth/login_admin') ?>" class="btn btn-lg btn-primary btn-block">Admin</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="card">
							<div class="card-body">
								<a href="<?= base_url('auth/login_pelanggan') ?>" class="btn btn-lg btn-secondary btn-block">Pelanggan</a>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>

</body>
</html>