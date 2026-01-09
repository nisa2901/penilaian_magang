<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<style>
/* ================= PAGE ANIMATION ================= */
.content {
    padding: 24px;
    animation: fadeIn .6s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ================= TITLE ================= */
.content h4 {
    font-weight: 700;
    margin-bottom: 20px;
    color: #1f2937;
}

/* ================= CARD EFFECT ================= */
.content .card {
    border-radius: 16px;
    background: linear-gradient(135deg, #ffffff, #f9fafb);
    border: none;
    box-shadow: 0 10px 28px rgba(0,0,0,.12);
    transition: all .35s ease;
    position: relative;
    overflow: hidden;
    color: #1f2937;
}

/* glow sweep */
.content .card::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        120deg,
        transparent,
        rgba(59,130,246,.18),
        transparent
    );
    transform: translateX(-100%);
}

.content .card:hover::after {
    transform: translateX(100%);
    transition: transform .6s ease;
}

/* hover animation */
.content .card:hover {
    transform: translateY(-6px);
    box-shadow: 0 22px 45px rgba(0,0,0,.22);
}

/* ================= TEXT ================= */
.content .card h5 {
    font-weight: 700;
    margin-bottom: 6px;
}

.content .card small {
    font-size: 14px;
    color: #6b7280;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 768px) {
    .content .card {
        margin-bottom: 16px;
    }
}
</style>

<div class="content">
<h4>Data Siswa / Mahasiswa</h4>

<div class="row mt-4">
    <div class="col-md-6">
        <a href="<?= site_url('admin/pak_hani') ?>" class="card p-4 text-center text-decoration-none">
            <h5>Pak Hani</h5>
            <small>Mahasiswa Universitas</small>
        </a>
    </div>
    <div class="col-md-6">
        <a href="<?= site_url('admin/bu_yuni') ?>" class="card p-4 text-center text-decoration-none">
            <h5>Bu Yuni</h5>
            <small>Siswa SMK</small>
        </a>
    </div>
</div>
</div>

<?php $this->load->view('admin/layout/footer'); ?>
