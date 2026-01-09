<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Sistem Penilaian Magang - Dukcapil Sleman</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="bg-cover">
    <header class="topbar">
      <img src="<?= base_url('assets/img/logo_dukcapil.png') ?>" alt="logo" class="logo">
      <div class="role-buttons">
        <a class="btn btn-sm btn-outline-light" href="<?= site_url('auth/login?role=admin') ?>">LOGIN ADMIN</a>
        <a class="btn btn-sm btn-outline-light" href="<?= site_url('auth/login?role=assessor') ?>">LOGIN PEMBIMBING</a>
        <a class="btn btn-sm btn-outline-light" href="<?= site_url('auth/login?role=participant') ?>">LOGIN SISWA</a>
      </div>
    </header>

    <div class="center-card">
      <h2 class="title">Sistem Penilaian Magang<br>Dinas Kependudukan Dan Pencatatan Sipil</h2>
      <div class="card glass p-4" style="width:340px;">
        <p class="text-center small text-muted">Silakan pilih login di atas atau daftar sebagai siswa</p>
        <div class="d-grid gap-2">
          <a href="<?= site_url('auth/login?role=participant') ?>" class="btn btn-primary">LOGIN SISWA</a>
          <a href="<?= site_url('peserta/register') ?>" class="btn btn-outline-light">REGISTER SISWA</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
