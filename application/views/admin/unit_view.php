<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<style>
/* AREA CONTENT */
.container-fluid{
    width:100%;
    max-width:100%;
    padding:0 15px;
}

.table{
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 4px 12px rgba(0,0,0,.08);
}

.table thead th{
    background:#0c0e0f !important;
    color:white !important;
    text-align:center;
    font-weight:600;
}

.table tbody tr:nth-child(even){
    background:#f9f9f9;
}

.table tbody tr:hover{
    background:#eef5fb;
}

/* KOLOM AKSI */
.aksi-column{
    min-width:320px;
}

/* BUTTON */
.btn-sm{
    font-size:12px;
    padding:5px 10px;
}

/* SEARCH */
#searchInput{
    width:100%;
    max-width:400px;
}

.content {
    animation: fadeUp .6s ease;
    padding: 20px;
}

.search-wrapper{
    display:flex;
    justify-content:center;
    margin:25px 0;
}

.search-input{
    width:420px;
    border-radius:30px;
    padding:14px 18px;
    border:none;
    text-align:center;
    box-shadow:0 2px 8px rgba(0,0,0,.08);
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


</style>

<div class="content">

<div class="container-fluid mt-4">

    <h4 class="mb-4 text-center"><?= strtoupper($title) ?></h4>

    <div class="card-body">

        <div class="table-responsive">

            <div class="search-wrapper">
                <input type="text"
                    id="searchInput"
                    placeholder="Cari nama, sekolah, atau universitas..."
                    class="form-control search-input">
            </div>
            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Universitas / Sekolah</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Dokumen</th>
                        <th>Penilaian</th>
                        <th>Unit</th>
                        <th width="450">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach($peserta as $p): ?>

                    <tr>

                        <td><?= $p->nama_lengkap ?></td>

                        <td>
                            <?= !empty($p->universitas) ? $p->universitas : $p->sekolah ?>
                        </td>

                        <td><?= $p->tanggal_mulai ?></td>

                        <td><?= $p->tanggal_selesai ?></td>

                        <!-- DOKUMEN -->
                        <td>

                            <?php if(!empty($p->dokumen_pendaftaran)): ?>

                                <?php $jenis = !empty($p->sekolah) ? 'siswa' : 'mahasiswa'; ?>

                                <a href="<?= base_url('uploads/pendaftaran/'.$jenis.'/'.$p->dokumen_pendaftaran) ?>"class="btn btn-sm btn-download" target="_blank">
                                    Download
                                </a>

                            <?php else: ?>

                                <span class="text-muted">Tidak ada</span>

                            <?php endif; ?>

                        </td>

                        <!-- PENILAIAN ADMIN -->
                        <td>

                            <?php if(!empty($p->dokumen_penilaian)): ?>

                                <?php $jenis = !empty($p->sekolah) ? 'siswa' : 'mahasiswa'; ?>

                                <a href="<?= base_url('uploads/penilaian/'.$jenis.'/'.$p->dokumen_penilaian) ?>"
                                   class="btn btn-sm btn-lihat"
                                   target="_blank">
                                    Lihat
                                </a>

                            <?php else: ?>

                                <span class="text-muted">Belum dinilai</span>

                            <?php endif; ?>

                        </td>

                        <td><?= $p->unit_penempatan ?></td>

                        <td>

                            <div class="d-flex flex-wrap gap-1">

                                <a href="<?= site_url('admin/edit/'.$p->id) ?>"
                                   class="btn btn-aesthetic btn-sm">
                                    Edit
                                </a>

                                <a href="<?= site_url('admin/logbook/'.$p->id) ?>?from=unit"
                                   class="btn btn-aesthetic btn-sm">
                                    Logbook
                                </a>

                                <a href="<?= site_url('admin/upload_penilaian/'.$p->id) ?>"
                                   class="btn btn-aesthetic btn-sm">
                                    Upload Penilaian
                                </a>

                                <div class="btn-group">

                                    <button class="btn btn-aesthetic btn-sm dropdown-toggle"
                                            data-bs-toggle="dropdown">
                                        Kirim Email
                                    </button>

                                    <ul class="dropdown-menu">

                                        <li>
                                            <a class="dropdown-item"
                                               href="<?= site_url('admin/kirim_email_peserta/'.$p->id.'/pribadi') ?>">
                                                Email Peserta
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item"
                                               href="<?= site_url('admin/kirim_email_peserta/'.$p->id.'/universitas') ?>">
                                                Email Universitas
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item"
                                               href="<?= site_url('admin/kirim_email_peserta/'.$p->id.'/sekolah') ?>">
                                                Email Sekolah
                                            </a>
                                        </li>

                                    </ul>

                                </div>
                                <a href="<?= site_url('admin/hapus/'.$p->id) ?>"
                                    class="btn btn-delete btn-sm mt-1"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    Hapus
                                </a>

                            </div>

                            

                        </td>

                    </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>

<script>
document.getElementById("searchInput").addEventListener("keyup", function() {
    let input = this.value.toLowerCase();
    let rows = document.querySelectorAll("table tbody tr");

    rows.forEach(function(row) {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
    });
});
</script>

<?php $this->load->view('admin/layout/footer'); ?>