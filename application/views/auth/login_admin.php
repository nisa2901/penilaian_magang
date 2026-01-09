<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Login Admin — Penilaian Magang</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
html, body {
  height: 100%;
  margin: 0;
  font-family: 'Segoe UI', system-ui, sans-serif;
}

/* BACKGROUND */
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
  background: rgba(0,0,0,0.55);
  z-index: 0;
}

/* HEADER */
.topbar {
  position: relative;
  z-index: 1;
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

.logo { height: 60px; }

.brand-text .title {
  font-size: 20px;
  font-weight: 700;
  color: #fff;
}

.brand-text .subtitle {
  font-size: 15px;
  color: rgba(255,255,255,.85);
}

.role-buttons a {
  font-size: 15px;
  padding: 6px 14px;
  border-radius: 20px;
  margin-left: 6px;
}

/* CENTER */
.center-wrapper {
  position: relative;
  z-index: 1;
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
}

/* CARD */
.glass-card {
  width: 100%;
  max-width: 360px;
  padding: 28px;
  background: rgba(255,255,255,.92);
  border-radius: 16px;
  box-shadow: 0 18px 45px rgba(0,0,0,.4);
  animation: fade .8s ease;
}

@keyframes fade {
  from { opacity:0; transform: translateY(12px); }
  to { opacity:1; transform:none; }
}

.glass-card h5 {
  text-align: center;
  font-weight: 700;
  color: #003366;
  margin-bottom: 22px;
}

.form-control {
  border-radius: 10px;
  padding: 10px 12px;
}

.btn-primary {
  background: linear-gradient(135deg, #003366, #0055aa);
  border: none;
  border-radius: 25px;
  font-weight: 600;
}
</style>
</head>

<body>
<div class="bg-cover">

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
      <a href="<?= site_url('auth/login?role=participant') ?>" class="btn btn-sm btn-outline-light">Peserta</a>
    </div>
  </div>

  <div class="center-wrapper">
    <div class="glass-card">
      <h5>LOGIN ADMIN</h5>

      <?php if(!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
      <?php endif; ?>

      <form method="post" action="<?= site_url('auth/login?role=admin') ?>">
        <input class="form-control mb-3" name="username" placeholder="Username" required>
        <input type="password" class="form-control mb-4" name="password" placeholder="Password" required>
        <button class="btn btn-primary w-100">LOGIN</button>
      </form>
    </div>
  </div>

</div>
</body>
</html>
