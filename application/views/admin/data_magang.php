<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>
<style>

/* ================= CARD STYLE SEPERTI DASHBOARD ================= */
.stat-card{
    display:block;
    padding:20px;
    border-radius:14px;
    background:#f9fafb;
    box-shadow:0 6px 18px rgba(0,0,0,.12);
    text-decoration:none;
    transition:.3s;
    position:relative;
}

.stat-card:hover{
    transform:translateY(-5px);
    box-shadow:0 18px 35px rgba(0,0,0,.2);
}

/* garis kiri warna */
.stat-blue{
    border-left:6px solid #22c55e; /* hijau */
}

.stat-orange{
    border-left:6px solid #f59e0b; /* kuning/orange */
}

/* teks */
.stat-title{
    font-size:15px;
    color:#6b7280;
    margin-bottom:8px;
}

.stat-value{
    font-size:25px;
    font-weight:700;
    color:#111827;
}
/* ================= UNIT STYLE DASHBOARD ================= */
/* ================= LIST UNIT STYLE ================= */
.unit-list{
    background:#fff;
    border-radius:12px;
    box-shadow:0 6px 16px rgba(0,0,0,.1);
    overflow:hidden;
}

.unit-item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:16px 20px;
    text-decoration:none;
    color:#111827;
    border-bottom:1px solid #e5e7eb;
    transition:.3s;
}

.unit-item:last-child{
    border-bottom:none;
}

.unit-item:hover{
    background:#f9fafb;
    transform:translateX(4px);
}

/* kiri (titik + nama) */
.unit-left{
    display:flex;
    align-items:center;
    gap:12px;
}

/* titik warna */
.unit-dot{
    width:10px;
    height:10px;
    border-radius:50%;
}

/* warna beda tiap unit */
.arsiparis{ background:#3b82f6; }
.sekretariat{ background:#10b981; }
.umpeg{ background:#f59e0b; }
.capil{ background:#8b5cf6; }
.dafduk{ background:#ef4444; }
.piak{ background:#6366f1; }
.renkeu{ background:#14b8a6; }

/* panah kanan */
.unit-arrow{
    font-size:18px;
    color:#9ca3af;
}
</style>


<div class="content">

<h4 class="mb-4 fw-bold">Data Peserta Magang</h4>

<!-- ================= DATA PESERTA ================= -->
<div class="row mt-4">

<div class="col-md-6 mb-3">
<a href="<?= site_url('admin/pak_hani') ?>" class="stat-card stat-blue">
    <div class="stat-title">Mahasiswa</div>
    <div class="stat-value">Universitas</div>
</a>
</div>

<div class="col-md-6 mb-3">
<a href="<?= site_url('admin/bu_yuni') ?>" class="stat-card stat-orange">
    <div class="stat-title">Siswa</div>
    <div class="stat-value">SMK</div>
</a>
</div>

</div>


<hr class="mt-4 mb-4">

<h6 class="fw-bold text-secondary mb-4">
Unit Penempatan Magang
</h6>

<div class="unit-list">

<a href="<?= site_url('admin/unit/ARSIPARIS') ?>" class="unit-item">
    <div class="unit-left">
        <span class="unit-dot arsiparis"></span>
        <span>Arsiparis</span>
    </div>
    <span class="unit-arrow">›</span>
</a>

<a href="<?= site_url('admin/unit/SEKRETARIAT') ?>" class="unit-item">
    <div class="unit-left">
        <span class="unit-dot sekretariat"></span>
        <span>Sekretariat</span>
    </div>
    <span class="unit-arrow">›</span>
</a>

<a href="<?= site_url('admin/unit/UMPEG') ?>" class="unit-item">
    <div class="unit-left">
        <span class="unit-dot umpeg"></span>
        <span>Umpeg</span>
    </div>
    <span class="unit-arrow">›</span>
</a>

<a href="<?= site_url('admin/unit/CAPIL') ?>" class="unit-item">
    <div class="unit-left">
        <span class="unit-dot capil"></span>
        <span>Capil</span>
    </div>
    <span class="unit-arrow">›</span>
</a>

<a href="<?= site_url('admin/unit/DAFDUK') ?>" class="unit-item">
    <div class="unit-left">
        <span class="unit-dot dafduk"></span>
        <span>Dafduk</span>
    </div>
    <span class="unit-arrow">›</span>
</a>

<a href="<?= site_url('admin/unit/PIAK') ?>" class="unit-item">
    <div class="unit-left">
        <span class="unit-dot piak"></span>
        <span>Piak</span>
    </div>
    <span class="unit-arrow">›</span>
</a>

<a href="<?= site_url('admin/unit/RENKEU') ?>" class="unit-item">
    <div class="unit-left">
        <span class="unit-dot renkeu"></span>
        <span>Renkeu</span>
    </div>
    <span class="unit-arrow">›</span>
</a>

</div>

</div>

</div>

<?php $this->load->view('admin/layout/footer'); ?>