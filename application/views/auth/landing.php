<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Sistem Informasi Magang Dukcapil</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

/* =========================
    GLOBAL
========================= */

html, body{
    margin:0;
    padding:0;
    font-family:'Segoe UI', sans-serif;
    scroll-behavior:smooth;
    background:#f4f6f9;
}

.container{
    max-width:1200px;
}

/* =========================
    HERO
========================= */

.hero{
    min-height:85vh;

    background:
    linear-gradient(
        rgba(0,0,0,.55),
        rgba(0,0,0,.55)
    ),
    url('<?= base_url('assets/img/bg.jpeg') ?>');

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;

    display:flex;
    align-items:center;
    justify-content:center;

    color:white;
    text-align:center;

    padding:40px 20px;

    position:relative;
    overflow:hidden;
}

/* EFEK BLUR FULL BACKGROUND */
.hero::before{
    content:"";
    position:absolute;
    inset:0;

    background:rgba(0,0,0,.25);

    backdrop-filter:blur(8px);
    -webkit-backdrop-filter:blur(8px);

    z-index:1;
}

/* SEMUA ISI DI ATAS BLUR */
.hero-content{
    position:relative;
    z-index:2;

    max-width:850px;

    animation:fadeUp 1s ease;

    padding:50px;
}

@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

.hero-logo{
    height:110px;
    margin-bottom:25px;
}

.hero h1{
    font-size:55px;
    font-weight:700;
    margin-bottom:20px;
}

.hero p{
    font-size:20px;
    line-height:1.8;
    color:rgba(255, 255, 255, 0.92);
}

/* =========================
    BUTTON
========================= */

.btn-login{
    margin-top:30px;
    background:linear-gradient(135deg,#0d6efd,#0050c8);
    color:white;
    border:none;
    padding:15px 36px;
    border-radius:50px;
    font-size:18px;
    font-weight:700;
    transition:.3s;
    letter-spacing:.3px;
    box-shadow:0 10px 25px rgba(13,110,253,.35);
}

.btn-login:hover{
    transform:translateY(-4px);
    box-shadow:0 15px 30px rgba(0,0,0,.25);
    color:white;
}

/* =========================
    SECTION
========================= */

.section{
    padding:60px 0;
}

.section-title{
    text-align:center;
    font-size:34px;
    font-weight:700;
    color:#003366;
    margin-bottom:35px;
}

/* =========================
    CARD
========================= */

.info-card{
    background:white;
    border-radius:22px;
    padding:30px 24px;
    text-align:center;
    height:100%;
    transition:.3s;
    box-shadow:0 8px 22px rgba(0,0,0,.06);
    border:1px solid rgba(0,0,0,.04);
}

.info-card:hover{
    transform:translateY(-8px);
    box-shadow:0 18px 35px rgba(0,0,0,.12);
}

.info-icon{
    font-size:45px;
    margin-bottom:18px;
}

.info-card h5{
    font-weight:700;
    color:#003366;
}

/* =========================
    ABOUT
========================= */

.about{
    background:#ffffff;
}

.about-text{
    font-size:18px;
    line-height:1.9;
    color:#444;
}

/* =========================
    LOGIN INFO BOX
========================= */

.login-info{
    margin-top:22px;
    display:inline-block;
    padding:14px 24px;
    border-radius:18px;

    
}

.login-info p{
    margin:0;

    font-size:15px;

    color:rgba(255,255,255,.95);

    line-height:1.8;
}

.login-info span{
    color:#ffd166;
    font-weight:700;
}

/* =========================
    STATS
========================= */

.stats-section{
    background:linear-gradient(135deg,#003366,#0055aa);
    color:white;
    padding:45px 0;
}

.stat-box{
    text-align:center;
}

.stat-number{
    font-size:42px;
    font-weight:700;
}

.stat-label{
    font-size:16px;
    opacity:.9;
}

/* =========================
    TIMELINE
========================= */

.timeline-box{
    background:white;
    border-radius:20px;
    padding:24px;
    box-shadow:0 8px 20px rgba(0,0,0,.06);
    height:100%;
    transition:.3s;
    border:1px solid rgba(0,0,0,.04);
}

.timeline-box:hover{
    transform:translateY(-6px);
}

.timeline-icon{
    font-size:40px;
    margin-bottom:15px;
}

/* =========================
    CONTACT
========================= */

.contact-box{
    background:white;
    border-radius:20px;
    padding:40px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.contact-item{
    margin-bottom:20px;
    font-size:17px;
}

/* =========================
    CONTACT SECTION
========================= */

.contact-card{
    background:#1e88ff;
    color:white;
    border-radius:22px;
    padding:45px 35px;
    height:100%;
    box-shadow:0 10px 30px rgba(0,0,0,.12);
}

.contact-title{
    font-weight:700;
    margin-bottom:18px;
}

.contact-desc{
    color:rgba(255,255,255,.92);
    line-height:1.8;
    margin-bottom:35px;
}

.contact-item{
    display:flex;
    align-items:flex-start;
    gap:18px;
    margin-bottom:28px;
}

.contact-icon{
    min-width:55px;
    width:55px;
    height:55px;

    background:rgba(255,255,255,.18);

    border-radius:50%;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:22px;

    color:white;
}

.contact-text h5{
    font-weight:700;
    margin-bottom:6px;
}

.contact-text p{
    margin:0;
    color:rgba(255,255,255,.92);
    line-height:1.8;
}

.contact-map{
    background:white;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    height:100%;
}

/* =========================
    MAP
========================= */

.map-wrapper{
    background:white;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    height:100%;
}

.map-frame{
    width:100%;
    height:100%;
    min-height:500px;
    border:0;
}

/* =========================
    RESPONSIVE
========================= */

@media(max-width:768px){

.hero h1{
    font-size:38px;
}

.hero p{
    font-size:17px;
}

.hero-logo{
    height:80px;
}

.section-title{
    font-size:28px;
}

}

.section-divider{
    width:80px;
    height:4px;
    background:#0d6efd;
    margin:0 auto 35px;
    border-radius:10px;
}

/* =========================
    FOOTER
========================= */

.footer{
    background:#002244;
    color:white;
    text-align:center;
    padding:35px 20px;
    line-height:1.8;
}
</style>
</head>

<body>

<!-- =========================
        HERO
========================= -->

<section class="hero">

<div class="hero-content">

<img src="<?= base_url('assets/img/logo_dukcapil.png') ?>"
class="hero-logo">

<h1>
Informasi Sistem Penilaian Magang Dukcapil 
</h1>

<p>
Platform digital untuk monitoring peserta magang,
pengelolaan logbook, dan penilaian peserta magang
di lingkungan Dinas Kependudukan dan Pencatatan Sipil Kabupaten Sleman.
</p>

<a href="<?= site_url('auth/login?role=participant') ?>"
class="btn btn-login">
Masuk ke Sistem
</a>

<!-- INFO LOGIN -->
<div class="login-info">

<p>

 Sudah terdaftar sebagai peserta magang?<br>

<span>
Silakan masuk ke sistem
</span>

untuk mengakses logbook kegiatan,
monitoring aktivitas magang,
dan informasi penilaian secara online.

</p>

</div>

</section>

<section class="stats-section">

<div class="container">

<div class="row">

    <!-- TOTAL PESERTA -->
    <div class="col-md-4 stat-box">

        <div class="stat-number">
            <?= $total_peserta ?>
        </div>

        <div class="stat-label">
            Peserta Magang
        </div>

    </div>

    <!-- TOTAL UNIT -->
   
    <div class="col-md-4 stat-box">
    <div class="stat-number">7</div>
    <div class="stat-label">Unit Penempatan</div>
    </div>

    <!-- MONITORING -->
    <div class="col-md-4 stat-box">

        <div class="stat-number">
            100%
        </div>

        <div class="stat-label">
            Monitoring Digital
        </div>

    </div>

</div>

</div>

</section>

<!-- =========================
        TENTANG
========================= -->

<section class="section about">

<div class="container">

<h2 class="section-title">
Tentang Program Magang
</h2>

<div class="section-divider"></div>

<div class="row align-items-center">

<div class="col-lg-6 mb-4">

<p class="about-text">

Program magang Dinas Kependudukan dan Pencatatan Sipil
memberikan kesempatan kepada siswa dan mahasiswa
untuk memperoleh pengalaman kerja secara langsung
di lingkungan instansi pemerintahan.

Melalui sistem ini, peserta dapat melakukan pengisian
logbook aktivitas harian, monitoring aktivitas magang,
serta memperoleh hasil penilaian secara digital melalui email.

</p>

</div>

<div class="col-lg-6">

<img src="<?= base_url('assets/img/bg.jpeg') ?>"
class="img-fluid rounded-4 shadow">

</div>

</div>

</div>

</section>

<!-- =========================
        FITUR
========================= -->

<section class="section">

<div class="container">

<h2 class="section-title">
Fitur Sistem
</h2>

<div class="section-divider"></div>

<div class="row g-4">

<div class="col-md-4">

<div class="info-card">

<div class="info-icon">
<i class="bi bi-journal-text"></i>
</div>

<h5>Logbook Digital</h5>

<p>
Peserta dapat mencatat seluruh kegiatan magang
setiap hari secara online.
</p>

</div>

</div>

<div class="col-md-4">

<div class="info-card">

<div class="info-icon">
<i class="bi bi-bar-chart-line"></i>
</div>

<h5>Monitoring Magang</h5>

<p>
Pembimbing dapat memonitor aktivitas peserta
dengan lebih mudah dan cepat.
</p>

</div>

</div>

<div class="col-md-4">

<div class="info-card">

<div class="info-icon">
<i class="bi bi-trophy"></i>
</div>

<h5>Penilaian Online</h5>

<p>
Penilaian peserta dilakukan secara digital
dan dapat diakses langsung melalui sistem.
</p>

</div>

</div>

</div>

</div>

</section>

<section class="section">

<div class="container">

<h2 class="section-title">
Alur Program Magang
</h2>
    
<div class="section-divider"></div>

<div class="row g-4">

<div class="col-md-3">

<div class="timeline-box text-center">

<div class="timeline-icon">
<i class="bi bi-file-earmark-text"></i>
</div>

<h5>Pendaftaran</h5>

<p>
Peserta melakukan pendaftaran magang dan pengumpulan dokumen.
</p>

</div>

</div>

<div class="col-md-3">

<div class="timeline-box text-center">

<div class="timeline-icon">
<i class="bi bi-building"></i>
</div>

<h5>Penempatan</h5>

<p>
Peserta ditempatkan pada unit kerja sesuai kebutuhan instansi.
</p>

</div>

</div>

<div class="col-md-3">

<div class="timeline-box text-center">

<div class="timeline-icon">
<i class="bi bi-journal-text"></i>
</div>

<h5>Logbook</h5>

<p>
Peserta mengisi kegiatan harian magang secara online.
</p>

</div>

</div>

<div class="col-md-3">

<div class="timeline-box text-center">

<div class="timeline-icon">
<i class="bi bi-trophy"></i>
</div>

<h5>Penilaian</h5>

<p>
Pembimbing melakukan evaluasi dan penilaian peserta magang.
</p>

</div>

</div>

</div>

</div>
</section>

<!-- =========================
        KONTAK
========================= -->

<!-- =========================
        KONTAK
========================= -->

<section class="section" style="background:#eef3f8;">

<div class="container">

<div class="row g-4 align-items-stretch">

    <div class="col-lg-5">

        <div class="contact-card">

            <h2 class="contact-title">
                Kontak Info
            </h2>

            <p class="contact-desc">
                Dinas Kependudukan dan Pencatatan Sipil Kabupaten Sleman
            </p>

            <!-- LOKASI -->
            <div class="contact-item">

                <div class="contact-icon">
                    <i class="bi bi-geo-alt"></i>
                </div>

                <div class="contact-text">

                    <h5>Lokasi</h5>

                    <p>
                        Jl. Magelang No.Km.11,
                        Beran Lor, Tridadi,
                        Kec. Sleman,
                        Kabupaten Sleman,
                        Daerah Istimewa Yogyakarta 55511
                    </p>

                </div>

            </div>

            <!-- TELEPON -->
            <div class="contact-item">

                <div class="contact-icon">
                    <i class="bi bi-telephone"></i>
                </div>

                <div class="contact-text">

                    <h5>No. Telp</h5>

                    <p>
                        +62274 868 362
                    </p>

                </div>

            </div>

            <!-- EMAIL -->
            <div class="contact-item">

                <div class="contact-icon">
                    <i class="bi bi-envelope"></i>
                </div>

                <div class="contact-text">

                    <h5>Alamat Email</h5>

                    <p>
                        dukcapil@slemankab.go.id
                    </p>

                </div>

            </div>

            <!-- JAM -->
            <div class="contact-item">

                <div class="contact-icon">
                    <i class="bi bi-clock"></i>
                </div>

                <div class="contact-text">

                    <h5>Jam Operasional</h5>

                    <p>
                        Senin - Kamis : 08.00 - 14.00 WIB<br>
                        Jumat : 08.00 - 11.00 WIB
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- MAP -->
    <div class="col-lg-7">

        <div class="map-wrapper">

            <iframe
                class="map-frame"
                src="https://maps.google.com/maps?q=Dinas%20Kependudukan%20dan%20Pencatatan%20Sipil%20Kabupaten%20Sleman&t=&z=15&ie=UTF8&iwloc=&output=embed"
                allowfullscreen=""
                loading="lazy">
            </iframe>

        </div>

    </div>

</div>

</div>

</section>

<!-- =========================
        FOOTER
========================= -->

<div class="footer">

<div class="container">

<h4 style="font-weight:700; margin-bottom:15px;">
DISDUKCAPIL
</h4>

<p style="margin-bottom:8px;">
Dinas Kependudukan dan Pencatatan Sipil Kabupaten Sleman
</p>

<p style="margin-bottom:8px;">
Jl. Magelang No.Km.11, Beran Lor, Tridadi, Sleman,
Daerah Istimewa Yogyakarta 55511
</p>

<p style="margin-bottom:8px;">
Phone: +62274 868 362
</p>

<p style="margin-bottom:0;">
© <?= date('Y') ?> FAPERLUD HORIZON
</p>

</div>

</div>