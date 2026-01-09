<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<style>
/* ================= DASHBOARD STYLE ================= */
.content {
    animation: fadeUp .6s ease;
}

/* Animasi */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(12px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ================= CARD BOX ================= */
.card-box {
    padding: 22px;
    border-radius: 14px;
    color: #fff;
    box-shadow: 0 10px 25px rgba(0,0,0,.15);
    transition: all .35s ease;
    position: relative;
    overflow: hidden;
}

.card-box h3 {
    margin-top: 6px;
    font-weight: 700;
}

/* efek highlight */
.card-box::after {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        120deg,
        transparent,
        rgba(255,255,255,.25),
        transparent
    );
    transition: .6s;
}

.card-box:hover::after {
    left: 100%;
}

.card-box:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(0,0,0,.25);
}

/* ================= SECTION TITLE ================= */
.section-title {
    margin-top: 30px;
    font-weight: 700;
    color: #2c3e50;
}

/* ================= TABLE ================= */
.table {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,.1);
}

.table thead th {
    vertical-align: middle;
    font-size: 14px;
}

.table tbody tr {
    transition: all .25s ease;
}

.table tbody tr:hover {
    background-color: rgba(0,123,255,.08);
    transform: scale(1.01);
}

/* ================= HR ================= */
hr {
    margin: 28px 0;
    border-top: 2px dashed #ddd;
}
</style>

<div class="content">

<h4 class="mb-4 fw-bold">Dashboard</h4>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card-box bg-primary">
            Jumlah Siswa
            <h3><?= $jumlah_siswa ?></h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-box bg-success">
            Siswa Aktif
            <h3><?= $aktif ?></h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-box bg-secondary">
            Siswa Selesai
            <h3><?= $selesai ?></h3>
        </div>
    </div>
</div>

<hr>

<h5 class="section-title">Penilaian Terbaru</h5>

<div class="table-responsive mt-3">
<table class="table table-bordered table-striped align-middle">

<thead class="table-dark text-center">
<tr>
  <th>Nama</th>
  <th>Sekolah / Universitas</th>
  <th>Tanggal Mulai</th>
  <th>Tanggal Selesai</th>
  <th>Tanggal Dinilai</th>
</tr>
</thead>

<tbody>
<?php
$unik = [];

if (!empty($penilaian_terbaru)):
    foreach ($penilaian_terbaru as $p):

        $key = $p['nama_lengkap'] . '-' . $p['angkatan'];
        if (isset($unik[$key])) continue;
        $unik[$key] = true;
?>
<tr>
  <td><?= $p['nama_lengkap']; ?></td>
  <td><?= !empty($p['sekolah']) ? $p['sekolah'] : $p['universitas']; ?></td>
  <td><?= $p['tanggal_mulai']; ?></td>
  <td><?= $p['tanggal_selesai']; ?></td>
  <td><?= $p['tanggal_dinilai'] ?? date('Y-m-d', strtotime($p['created_at'])); ?></td>
</tr>
<?php
    endforeach;
else:
?>
<tr>
  <td colspan="5" class="text-center text-muted">Belum ada penilaian</td>
</tr>
<?php endif; ?>
</tbody>

</table>
</div>

</div>

<?php $this->load->view('admin/layout/footer'); ?>
