<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Login Siswa — Penilaian Magang</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* ================== RESET ================== */
html, body {
  height: 100%;
  margin: 0;
  font-family: 'Segoe UI', system-ui, sans-serif;
}

/* ================== BACKGROUND ================== */
.bg-cover {
  background: url('<?= base_url('assets/img/bg.jpeg') ?>') no-repeat center center fixed;
  background-size: cover;
  height: 100vh;
  position: relative;
  display: flex;
  flex-direction: column;
}

/* OVERLAY GELAP */
.bg-cover::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.45); /* ← tingkat kegelapan */
  z-index: 1;
}

/* Semua isi harus di atas overlay */
.bg-cover > * {
  position: relative;
  z-index: 2;
}

/* ================== HEADER ================== */
.topbar {
  padding: 16px 36px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.brand {
  display: flex;
  align-items: center;
  gap: 12px;
}

.logo {
  height: 60px;
}

.brand-text {
  line-height: 1.25;
}

.brand-text .title {
  font-size: 20px;
  font-weight: 700;
  color: #fff;
  text-shadow: 0 2px 6px rgba(0,0,0,.7);
}

.brand-text .subtitle {
  font-size: 15px;
  color: rgba(255,255,255,.9);
  text-shadow: 0 2px 6px rgba(0,0,0,.6);
}

/* ================== ROLE BUTTON ================== */
.role-buttons a {
  font-size: 15px;
  padding: 6px 14px;
  border-radius: 20px;
  margin-left: 6px;
}

/* ================== LOGIN AREA ================== */
.center-wrapper {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px;
}

/* ================== CARD ================== */
.glass-card {
  width: 100%;
  max-width: 360px;
  padding: 28px 26px;
  background: rgba(255,255,255,.92);
  border-radius: 16px;
  backdrop-filter: blur(6px);
  box-shadow: 0 18px 45px rgba(0,0,0,.35);
  animation: fadeSlide .8s ease;
}

@keyframes fadeSlide {
  from {
    opacity: 0;
    transform: translateY(12px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.glass-card h5 {
  font-weight: 700;
  color: #003366;
  text-align: center;
  margin-bottom: 22px;
}

/* ================== FORM ================== */
.form-control {
  border-radius: 10px;
  padding: 10px 12px;
}

.form-control:focus {
  border-color: #003366;
  box-shadow: 0 0 0 0.15rem rgba(0,51,102,.25);
}

/* ================== BUTTON ================== */
.btn-primary {
  background: linear-gradient(135deg, #003366, #0055aa);
  border: none;
  border-radius: 25px;
  font-weight: 600;
  padding: 10px;
  transition: all .3s ease;
}

.btn-primary:hover {
  transform: translateY(-1px);
  box-shadow: 0 8px 20px rgba(0,0,0,.25);
}

/* ================== ALERT ================== */
.alert {
  font-size: 13px;
}

/* ================== REGISTER LINK ================== */
.register-link {
  font-size: 13px;
  margin-top: 14px;
  text-align: center;
}

.register-link a {
  color: #ffb300;
  font-weight: 600;
  text-decoration: none;
}

.register-link a:hover {
  text-decoration: underline;
}

/* ================== RESPONSIVE ================== */
@media (max-width: 576px) {
  .topbar {
    padding: 12px 18px;
  }
  .logo {
    height: 40px;
  }
  .brand-text .title {
    font-size: 14px;
  }
  .brand-text .subtitle {
    font-size: 12px;
  }
}
</style>
</head>

<body>

<div class="bg-cover">

  <!-- HEADER -->
  <div class="topbar">
    <div class="brand">
      <img src="<?= base_url('assets/img/logo_dukcapil.png') ?>" class="logo">
      <div class="brand-text">
        <div class="title">Sistem Penilaian Magang</div>
        <div class="subtitle">Dinas Kependudukan dan Pencatatan Sipil</div>
      </div>
    </div>

    <div class="role-buttons">
      <a href="<?= site_url('auth/login?role=admin') ?>" class="btn btn-sm btn-outline-light">Admin</a>
      <a href="<?= site_url('auth/login?role=participant') ?>" class="btn btn-sm btn-outline-light active">Peserta</a>
    </div>
  </div>

  <!-- LOGIN -->
  <div class="center-wrapper">
    <div class="glass-card">

      <h5>LOGIN SISWA</h5>

      <?php if(!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
      <?php endif; ?>

      <form method="post" action="<?= site_url('auth/login?role=participant') ?>">
        <div class="mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>

        <div class="mb-4">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button class="btn btn-primary w-100">LOGIN</button>
      </form>

      <div class="register-link">
        Belum punya akun?<br>
        <a href="<?= site_url('auth/register_participant') ?>">Daftar di sini</a>
      </div>

    </div>
  </div>

</div>

</body>
</html>
