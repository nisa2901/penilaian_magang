<?php $this->load->view('admin/layout/header'); ?>

<style>
/* =================== CARD EFFECT DASHBOARD =================== */
.angkatan-card {
    transition: all 0.35s ease;
    border-radius: 16px;
    cursor: pointer;
    background: linear-gradient(135deg, #ffffff, #f9fafb);
    box-shadow: 0 10px 28px rgba(0,0,0,0.12);
    position: relative;
    overflow: hidden;
}

/* hover effect floating + shadow */
.angkatan-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 22px 45px rgba(0,0,0,0.22);
}

/* glow sweep */
.angkatan-card::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, transparent, rgba(59,130,246,.18), transparent);
    transform: translateX(-100%);
}

.angkatan-card:hover::after {
    transform: translateX(100%);
    transition: transform .6s ease;
}

/* angkatan icon */
.angkatan-icon {
    font-size: 40px;
    opacity: 0.8;
}

/* hovers text smoothly */
.angkatan-card h5, .angkatan-card h4 {
    transition: all 0.3s ease;
}

/* hover text color shift */
.angkatan-card:hover h4 {
    color: #2563eb;
}

/* responsive adjustments */
@media (max-width: 768px) {
    .angkatan-card {
        margin-bottom: 16px;
    }
}
</style>


<!-- SIDEBAR -->
<div class="sidebar">

    <h5 class="p-3">ADMIN</h5>

    <a href="<?= site_url('admin/dashboard') ?>">Dashboard</a>

    <a href="<?= site_url('admin/data_magang') ?>">Data Magang</a>

    <a href="<?= site_url('admin/rekap') ?>">Rekap Data Magang</a>

    <a href="<?= site_url('admin/logout') ?>">Logout</a>

</div>

<div class="content">
    <div class="mb-4">
        <h3 class="fw-bold">Tahun Angkatan</h3>
        <p class="text-muted">Pilih angkatan untuk melihat data Mahasiswa</p>
    </div>

    <div class="row">
        <?php foreach($angkatan as $a): ?>
        <div class="col-md-3 col-sm-6 mb-4">
            <a href="<?= site_url('admin/pak_hani_angkatan/'.$a['angkatan']) ?>"
               class="text-decoration-none text-dark">

                <div class="card angkatan-card text-center p-4">
                    <div class="angkatan-icon mb-3 text-primary">
                        <!-- bisa ditambahkan icon di sini -->
                    </div>
                    <h5 class="fw-semibold">Angkatan</h5>
                    <h4 class="fw-bold text-primary"><?= $a['angkatan'] ?></h4>
                </div>

            </a>
        </div>
        <?php endforeach ?>
    </div>
</div>

<?php $this->load->view('admin/layout/footer'); ?>
