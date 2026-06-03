<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<style>
/* ================= DASHBOARD STYLE ================= */
body {
    background: #f4f6f9;
    font-family: 'Segoe UI', sans-serif;
}

.content {
    animation: fadeUp .6s ease;
    padding: 20px;
}

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
    background: #fff !important;
    padding: 22px;
    border-radius: 12px;
    color: #2c3e50 !important;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
    transition: .3s;
    border-left: 6px solid;
}

.card-box h3 {
    margin-top: 8px;
    font-weight: bold;
    font-size: 35px;
    color: #2c3e50 !important;
}

.card-box:hover {
    transform: translateY(-4px);
}

/* warna card */
.bg-primary {
    border-left-color: #3498db !important;
}

.bg-success {
    border-left-color: #2ecc71 !important;
}

.bg-secondary {
    border-left-color: #ff6a00 !important;
}

/* ================= SEARCH ================= */
.search-wrapper {
    display: flex;
    justify-content: center;
    margin: 25px 0;
}

.search-input {
    width: 420px;
    border-radius: 30px;
    padding: 14px 18px;
    border: none;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,.08);
}

/* ================= TABLE ================= */
.table {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
}

.table thead th {
    background: #0c0e0f !important;
    color: white !important;
    text-align: center;
    font-weight: 600;
}

.table tbody tr:nth-child(even) {
    background: #f9f9f9;
}

.table tbody tr:hover {
    background: #eef5fb;
}

/* ================= TITLE ================= */
.section-title {
    font-weight: bold;
    color: #2c3e50;
}

/* ================= HR ================= */
hr {
    border: none;
    border-top: 1px solid #ddd;
    margin: 25px 0;
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

<div style="display:flex; justify-content:center; margin-bottom:20px;">
    <input type="text" id="searchDashboard" 
           placeholder="Cari nama / sekolah / universitas..." 
           class="form-control" 
           style="width:350px; text-align:center;">
</div>

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

<tbody id="tableDashboard">
<?php
$unik = [];

if (!empty($penilaian_terbaru)):
    foreach ($penilaian_terbaru as $p):

        // filter hanya yang sudah dinilai
        if (empty($p['dokumen_penilaian'])) continue;

        $key = $p['nama_lengkap'] . '-' . $p['angkatan'];
        if (isset($unik[$key])) continue;
        $unik[$key] = true;
?>
<tr>
  <td><?= $p['nama_lengkap']; ?></td>
  <td><?= !empty($p['sekolah']) ? $p['sekolah'] : $p['universitas']; ?></td>
  <td><?= $p['tanggal_mulai']; ?></td>
  <td><?= $p['tanggal_selesai']; ?></td>
  <td>
    <?= !empty($p['tanggal_dinilai']) 
        ? $p['tanggal_dinilai'] 
        : '-' ?>
  </td>
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
<script>
document.getElementById("searchDashboard").addEventListener("keyup", function() {
    let input = this.value.toLowerCase();
    let rows = document.querySelectorAll("#tableDashboard tr");

    rows.forEach(function(row) {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
    });
});
</script>

<?php $this->load->view('admin/layout/footer'); ?>
