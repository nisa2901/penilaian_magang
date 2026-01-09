<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Register Siswa — Penilaian Magang</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
html, body { height:100%; margin:0; font-family:'Segoe UI',system-ui,sans-serif; }

.bg-cover {
  background: url('<?= base_url('assets/img/bg.jpeg') ?>') no-repeat center center fixed;
  background-size: cover;
  height: 100vh;
  position: relative;
  display: flex;
  flex-direction: column;
}

.bg-cover::before {
  content:"";
  position:absolute;
  inset:0;
  background: rgba(0,0,0,0.55);
  z-index:0;
}

.topbar, .center-wrapper {
  position: relative;
  z-index: 1;
}

.topbar {
  padding: 16px 36px;
}

.logo { height:60px; }

.center-wrapper {
  flex:1;
  display:flex;
  justify-content:center;
  align-items:center;
}

.glass-card {
  width:100%;
  max-width:380px;
  padding:28px;
  background:rgba(255,255,255,.93);
  border-radius:16px;
  box-shadow:0 18px 45px rgba(0,0,0,.4);
}

.glass-card h5 {
  text-align:center;
  font-weight:700;
  color:#003366;
  margin-bottom:22px;
}

.form-control { border-radius:10px; padding:10px; }

.btn-primary {
  background:linear-gradient(135deg,#003366,#0055aa);
  border:none;
  border-radius:25px;
  font-weight:600;
}
</style>
</head>

<body>
<div class="bg-cover">

  <div class="topbar">
    <img src="<?= base_url('assets/img/logo_dukcapil.png') ?>" class="logo">
  </div>

  <div class="center-wrapper">
    <div class="glass-card">
      <h5>REGISTER SISWA</h5>

      <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
      <?php endif; ?>

      <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
      <?php endif; ?>

      <form method="post" action="<?= site_url('auth/register_participant') ?>">
        <input class="form-control mb-2" name="username" placeholder="Username" required>
        <input type="password" class="form-control mb-2" name="password" placeholder="Password" required>
        <input type="email" class="form-control mb-2" name="email_pribadi" placeholder="Email" required>
        <input class="form-control mb-3" name="instansi_kampus" placeholder="Instansi / Kampus">
        <button class="btn btn-primary w-100">REGISTER</button>
      </form>

      <div class="text-center mt-3 small">
        Sudah punya akun?<br>
        <a href="<?= site_url('auth/login?role=participant') ?>" class="fw-bold text-warning">Login di sini</a>
      </div>
    </div>
  </div>

</div>
</body>
</html>
