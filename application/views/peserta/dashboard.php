<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Dashboard Peserta</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* ================= BODY ================= */
body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0f4f8;
}
.wrapper {
    display: flex;
    min-height: 100vh;
}

/* ================= SIDEBAR ================= */
.sidebar {
    width: 230px;
    background: linear-gradient(180deg, #002b5c, #001a38);
    color: #fff;
    padding: 22px 18px;
    display: flex;
    flex-direction: column;
    box-shadow: 4px 0 18px rgba(0,0,0,.25);
}

.sidebar h3 {
    margin: 0 0 24px;
    font-size: 16px;
    font-weight: 700;
    text-align: center;
    letter-spacing: 1px;
    color: #e9f1ff;
    position: relative;
}

.sidebar h3::after {
    content: "";
    display: block;
    width: 40px;
    height: 3px;
    background: #4da3ff;
    margin: 10px auto 0;
    border-radius: 10px;
}

/* MENU LINK */
.sidebar a {
    display: block;
    color: #e9f1ff;
    text-decoration: none;
    padding: 12px 14px;
    margin: 6px 0;
    border-radius: 10px;
    background: rgba(255,255,255,0.06);
    font-weight: 500;
    transition: all 0.3s ease;
}

.sidebar a:hover {
    background: linear-gradient(135deg, #004b9a, #006bd6);
    box-shadow: 0 6px 16px rgba(0,0,0,.35);
    transform: translateX(4px);
}

/* ================= LOGOUT BUTTON ================= */
.logout {
    margin-top: auto;
    text-align: center;
    background: linear-gradient(135deg, #ff4d4d, #e6f0ff);
    color: #fff !important;
    padding: 12px;
    border-radius: 12px;
    font-weight: 700;
    transition: all 0.3s ease;
}

/* HOVER → MERAH */
.logout:hover {
    background: linear-gradient(135deg, #d90429, #ef233c);
    color: #ffffff !important;
    box-shadow: 0 10px 25px rgba(217,4,41,.45);
    transform: translateY(-2px);
}

/* KLIK */
.logout:active {
    background: #b00020 !important;
    color: #ffffff !important;
    transform: scale(0.96);
}

/* ================= CONTENT ================= */
.content {
    flex: 1;
    padding: 25px;
}

/* ================= HEADER ================= */
.header {
    background: #ffffff;
    padding: 18px;
    font-weight: bold;
    border-radius: 12px;
    border: 1px solid #ccc;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}

/* ================= CARD ================= */
.card {
    background: #ffffff;
    padding: 25px;
    margin-top: 15px;
    border-radius: 12px;
    border: 1px solid #ccc;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

/* ================= FORM ================= */
.form-row {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    flex-wrap: wrap;
}
.form-row label {
    width: 180px;
    font-weight: 600;
}
.form-row input {
    flex: 1;
    min-width: 250px;
    padding: 8px 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
}
.form-row select {
    flex: 1;
    min-width: 250px;
    padding: 8px 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

/* ================= BUTTON ================= */
.buttons {
    text-align: right;
    margin-top: 20px;
}
.buttons button {
    padding: 8px 18px;
    margin-left: 10px;
    border-radius: 8px;
    border: none;
    font-weight: 600;
    cursor: pointer;
}
.buttons button[type="submit"] {
    background: #002b5c;
    color: #fff;
}
.buttons button[type="button"] {
    background: #f0f4f8;
    border: 1px solid #ccc;
}
</style>
</head>

<body>

<?php if ($this->session->flashdata('success')): ?>
<script>
alert("<?= $this->session->flashdata('success') ?>");
</script>
<?php endif; ?>

<div class="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h3>PESERTA MAGANG</h3>
        <a href="dashboard">Input Data</a>
         <!-- MENU LOGBOOK -->
        <a href="<?= base_url('logbook') ?>" class="menu">Logbook</a>
        <a href="<?= site_url('auth/logout') ?>" class="logout">Logout</a>
    </div>

    <!-- CONTENT -->
    <div class="content"> <div class="header">
            Sistem Penilaian Magang<br>
            Dinas Kependudukan dan Pencatatan Sipil
        </div>

         <div class="alert alert-info" style="border-radius:10px;">
                <strong>Informasi Kriteria Penilaian</strong>
                <hr style="margin:8px 0;">

                <ul style="margin-bottom:0;">
                    <li><b>Disiplin</b> → Ketepatan waktu dan kepatuhan terhadap aturan</li>
                    <li><b>Kehadiran</b> → Tingkat kehadiran selama magang</li>
                    <li><b>Tanggung Jawab</b> → Keseriusan dalam menyelesaikan tugas</li>
                    <li><b>Kejujuran</b> → Integritas dalam bekerja</li>
                    <li><b>Kerjasama Tim</b> → Kemampuan bekerja dalam tim</li>
                    <li><b>Inisiatif</b> → Kemampuan mengambil tindakan tanpa disuruh</li>
                    <li><b>Kerapihan Kerja</b> → Keteraturan dan kerapihan hasil kerja</li>
                    <li><b>Kemampuan Tugas</b> → Kemampuan menyelesaikan pekerjaan</li>
                    <li><b>Penguasaan Skill</b> → Kemampuan teknis sesuai bidang</li>
                    <li><b>Komunikasi</b> → Kemampuan berkomunikasi dengan baik</li>
                </ul>

                <small style="color:#555;">
                    * Nilai akan diberikan oleh pembimbing berdasarkan kriteria di atas.
                </small>
            </div>

        <div class="card">
            <strong>Input Data Magang</strong>
            <hr>


            <form method="post" action="<?= site_url('peserta/save') ?>" enctype="multipart/form-data">

                <div class="form-row">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap"
                           value="<?= $peserta['nama_lengkap'] ?? '' ?>" required>
                </div>

                <div class="form-row">
                    <label>Angkatan</label>
                    <input type="number" name="angkatan"
                           value="<?= $peserta['angkatan'] ?? '' ?>" required>
                </div>

                <div class="form-row">
                    <label>Sekolah (jika siswa)</label>
                    <input type="text" name="sekolah"
                           value="<?= $peserta['sekolah'] ?? '' ?>">
                </div>

                <div class="form-row">
                    <label>Email Sekolah</label>
                    <input type="email" name="email_sekolah"
                           value="<?= $peserta['email_sekolah'] ?? '' ?>">
                </div>

                <div class="form-row">
                    <label>Universitas (jika mahasiswa)</label>
                    <input type="text" name="universitas"
                           value="<?= $peserta['universitas'] ?? '' ?>">
                </div>

                <div class="form-row">
                    <label>Email Universitas</label>
                    <input type="email" name="email_universitas"
                           value="<?= $peserta['email_universitas'] ?? '' ?>">
                </div>

                <div class="form-row">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai"
                           value="<?= $peserta['tanggal_mulai'] ?? '' ?>" required>
                </div>

                <div class="form-row">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai"
                           value="<?= $peserta['tanggal_selesai'] ?? '' ?>" required>
                </div>

                  <div class="form-row">
                    <label>Unit Penempatan</label>
                    <select name="unit_penempatan" required>
                        <option value="">-- Pilih Unit --</option>
                        <option value="ARSIPARIS" <?= ($peserta['unit_penempatan'] ?? '')=='ARSIPARIS'?'selected':''; ?>>ARSIPARIS</option>
                        <option value="SEKRETARIAT" <?= ($peserta['unit_penempatan'] ?? '')=='SEKRETARIAT'?'selected':''; ?>>SEKRETARIAT</option>
                        <option value="UMPEG" <?= ($peserta['unit_penempatan'] ?? '')=='UMPEG'?'selected':''; ?>>UMPEG</option>
                        <option value="CAPIL" <?= ($peserta['unit_penempatan'] ?? '')=='CAPIL'?'selected':''; ?>>CAPIL</option>
                        <option value="DAFDUK" <?= ($peserta['unit_penempatan'] ?? '')=='DAFDUK'?'selected':''; ?>>DAFDUK</option>
                        <option value="PIAK" <?= ($peserta['unit_penempatan'] ?? '')=='PIAK'?'selected':''; ?>>PIAK</option>
                        <option value="RENKEU" <?= ($peserta['unit_penempatan'] ?? '')=='RENKEU'?'selected':''; ?>>RENKEU</option>
                    </select>
                </div>


                <div class="form-row">
                    <label>Upload Dokumen (PDF)</label>
                    <input type="file" name="dokumen" accept=".pdf">
                </div>

                <div class="buttons">
                    <button type="button"
                        onclick="if(confirm('Yakin ingin reset semua data magang?')){window.location.href='<?= site_url('peserta/reset_data') ?>'}">
                        Reset
                    </button>
                    <button type="submit" id="btnSubmit">Simpan</button>
                </div>

                <script>
                document.querySelector("form").addEventListener("submit", function(){
                    const btn = document.getElementById("btnSubmit");
                    btn.disabled = true;
                    btn.innerText = "Menyimpan...";
                });
                </script>
                </div>

            </form>
        </div>

    </div>
</div>

</body>
</html>
