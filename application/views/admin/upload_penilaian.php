<style>
.center-wrapper {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f3f6fa;
    padding: 30px 15px;
}

.upload-card {
    max-width: 850px;
    width: 100%;
    background: #ffffff;
    padding: 25px 30px;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    border: 1px solid #e0e0e0;
}

/* TEMPLATE FORM */
.penilaian-box {
    background: #fff;
    padding: 30px;
    border: 1px solid #ddd;
    border-radius: 10px;
}

.header-penilaian {
    display: flex;
    align-items: center;
    gap: 20px;
}

.logo-sleman {
    width: 90px;
    height: auto;
}

.judul-header h2 {
    margin: 0;
    font-size: 22px;
    color: #002b5c;
}

.judul-header h3 {
    margin-top: 8px;
    font-size: 18px;
    color: #444;
}

.identitas-table {
    width: 100%;
    font-size: 16px;
}

.identitas-table td {
    padding: 6px 0;
}

.upload-card label {
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
    display: block;
}

.upload-card b {
    color: #002b5c;
}

.upload-card input[type="number"],
.upload-card textarea,
.upload-card input[type="file"] {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #ccd6e0;
    background: #f8fbff;
    margin-bottom: 15px;
}

.row-grid {
    display: grid;
    grid-template-columns: repeat(2,1fr);
    gap: 20px;
}

/* BUTTON */
.button-row {
    display: flex;
    gap: 15px;
    margin-top: 20px;
    flex-wrap: wrap;
}

.btn-kiri,
.btn-kanan,
.btn-secondary,
.btn-info,
.btn-primary {
    flex: 1;
    text-align: center;
    padding: 12px;
    border: none;
    border-radius: 12px;
    font-weight: bold;
    color: white;
    cursor: pointer;
    text-decoration: none;
}

.btn-kiri { background: #00509d; }
.btn-kanan { background: #28a745; }
.btn-primary { background: #007bff; }
.btn-info { background: #17a2b8; }
.btn-secondary { background: #6c757d; }

.btn-kiri:hover,
.btn-kanan:hover,
.btn-primary:hover,
.btn-info:hover,
.btn-secondary:hover {
    opacity: 0.9;
}
</style>

<?php if($this->session->flashdata('success')): ?>
<div style="background:#2ecc71;color:#fff;padding:12px;border-radius:8px;margin-bottom:15px;">
    <?= $this->session->flashdata('success') ?>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('error')): ?>
<div style="background:#e74c3c;color:#fff;padding:12px;border-radius:8px;margin-bottom:15px;">
    <?= $this->session->flashdata('error') ?>
</div>
<?php endif; ?>

<div class="center-wrapper">
<div class="upload-card">

<form method="post" action="<?= site_url('admin/upload_penilaian/'.$magang['id']) ?>" enctype="multipart/form-data">

<div class="penilaian-box">

    <!-- HEADER -->
    <div class="header-penilaian">
        <img src="<?= base_url('assets/img/logo_dukcapil.png') ?>" class="logo-sleman">

        <div class="judul-header">
            <h2>Dinas Kependudukan dan Pencatatan Sipil Kabupaten Sleman</h2>
            <h3>Form Penilaian Peserta Magang</h3>
        </div>
    </div>

    <hr>

    <!-- IDENTITAS -->
    <table class="identitas-table">
        <tr>
            <td width="180"><b>Nama</b></td>
            <td>: <?= $magang['nama_lengkap']; ?></td>
        </tr>
        <tr>
            <td><b>Jenis Peserta</b></td>
            <td>: <?= !empty($magang['universitas']) ? 'Mahasiswa' : 'Siswa SMK'; ?></td>
        </tr>
        <tr>
            <td><b>Asal Institusi</b></td>
            <td>: <?= !empty($magang['universitas']) ? $magang['universitas'] : $magang['sekolah']; ?></td>
        </tr>
    </table>

    <br>

    <!-- FORM NILAI -->
    <div class="row-grid">

        <div>
            <label>Disiplin</label>
            <input type="number" name="disiplin" required value="<?= $penilaian['disiplin'] ?? '' ?>">
        </div>

        <div>
            <label>Kehadiran</label>
            <input type="number" name="kehadiran" required value="<?= $penilaian['kehadiran'] ?? '' ?>">
        </div>

        <div>
            <label>Tanggung Jawab</label>
            <input type="number" name="tanggung_jawab" required value="<?= $penilaian['tanggung_jawab'] ?? '' ?>">
        </div>

        <div>
            <label>Kejujuran</label>
            <input type="number" name="kejujuran" required value="<?= $penilaian['kejujuran'] ?? '' ?>">
        </div>

        <div>
            <label>Kerjasama Tim</label>
            <input type="number" name="kerjasama_tim" required value="<?= $penilaian['kerjasama_tim'] ?? '' ?>">
        </div>

        <div>
            <label>Inisiatif</label>
            <input type="number" name="inisiatif" required value="<?= $penilaian['inisiatif'] ?? '' ?>">
        </div>

        <div>
            <label>Kerapihan Kerja</label>
            <input type="number" name="kerapihan_kerja" required value="<?= $penilaian['kerapihan_kerja'] ?? '' ?>">
        </div>

        <div>
            <label>Kemampuan Tugas</label>
            <input type="number" name="kemampuan_tugas" required value="<?= $penilaian['kemampuan_tugas'] ?? '' ?>">
        </div>

        <div>
            <label>Penguasaan Skill</label>
            <input type="number" name="penguasaan_skill" required value="<?= $penilaian['penguasaan_skill'] ?? '' ?>">
        </div>

        <div>
            <label>Komunikasi</label>
            <input type="number" name="komunikasi" required value="<?= $penilaian['komunikasi'] ?? '' ?>">
        </div>

    </div>

    <label><b>Catatan Pembimbing</b></label>
    <textarea name="catatan_pembimbing" rows="5"><?= $penilaian['catatan_pembimbing'] ?? '' ?></textarea>

</div>

<!-- FORM UTAMA -->
<form method="post" action="<?= site_url('admin/upload_penilaian/'.$magang['id']) ?>">

    <div class="button-row">
        <button type="submit" name="aksi" value="simpan_form" class="btn-primary">
            Simpan Form
        </button>

        <a href="<?= site_url('admin/preview_penilaian/'.$magang['id']) ?>" 
           target="_blank" class="btn-info">
            Preview PDF
        </a>

        <button type="submit" name="aksi" value="upload_form" class="btn-primary">
            Upload Form
        </button>
    </div>

</form>

<hr>

<!-- FORM UPLOAD FILE -->
<form method="post" action="<?= site_url('admin/upload_penilaian/'.$magang['id']) ?>" enctype="multipart/form-data">

    <label>File Penilaian (PDF)</label>
    <input type="file" name="dokumen" accept=".pdf">

    <div class="button-row">
        <button type="submit" name="aksi" value="upload_file" class="btn-kanan">
            Upload File
        </button>

        <!-- tombol kembali -->
        <a href="<?= $this->session->userdata('redirect_back') ?? site_url('admin/data_magang'); ?>" 
        class="btn-secondary">
            Kembali
        </a>
    </div>

</form>

</div>
</div>