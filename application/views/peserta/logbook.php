<?php $this->load->view('peserta/layout/header'); ?>
<?php $this->load->view('peserta/layout/sidebar'); ?>

<div class="container-fluid">

<div class="card shadow-sm mb-4">
<div class="card-body">
<h5 class="mb-3">Logbook Kegiatan Magang</h5>

<form method="post" action="<?= base_url('logbook/tambah') ?>">
<div class="row">

<div class="col-md-3">
<label class="form-label">Tanggal</label>
<input type="date" name="tanggal" class="form-control" required>
</div>

<div class="col-md-4">
<label class="form-label">Kegiatan</label>
<input type="text" name="kegiatan" class="form-control" placeholder="Masukkan kegiatan" required>
</div>

<div class="col-md-5">
<label class="form-label">Deskripsi</label>
<input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi kegiatan">
</div>

</div>

<div class="mt-3">
<button class="btn btn-primary">Simpan Logbook</button>
</div>
</form>

</div>
</div>

    <!-- STATISTIK -->
<div class="row mb-4">

    <!-- TOTAL KEGIATAN -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 text-center p-2">
            <div class="card-body p-2">
                <h6 class="text-muted mb-1" style="font-size:14px;">
                    Total Kegiatan
                </h6>

                <h3 class="text-primary fw-bold m-0">
                    <?= $total_logbook ?>
                </h3>
            </div>
        </div>
    </div>

    <!-- STATUS LOGBOOK -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 text-center p-2">
            <div class="card-body p-2">

                <h6 class="text-muted mb-1" style="font-size:14px;">
                    Status Logbook
                </h6>

                <?php if($status == 'disetujui'){ ?>
                    <span class="badge bg-success px-3 py-2">
                        Disetujui
                    </span>

                <?php } elseif($status == 'ditolak'){ ?>
                    <span class="badge bg-danger px-3 py-2">
                        Ditolak
                    </span>

                <?php } else { ?>
                    <span class="badge bg-warning text-dark px-3 py-2">
                        Menunggu
                    </span>
                <?php } ?>

            </div>
        </div>
    </div>

    <!-- CETAK LOGBOOK -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 text-center p-2">
            <div class="card-body p-2">

                <h6 class="text-muted mb-2" style="font-size:14px;">
                    Cetak Logbook
                </h6>

                <?php if($semua_disetujui): ?>
                    <a href="<?= base_url('logbook/cetak') ?>" 
                       target="_blank"
                       class="btn btn-primary btn-sm">
                        🖨 Cetak
                    </a>
                <?php else: ?>
                    <button class="btn btn-secondary btn-sm" disabled>
                        Belum Bisa
                    </button>
                <?php endif; ?>

            </div>
        </div>
    </div>

</div>
<!-- TABEL -->
<table id="tabelLogbook" class="table table-bordered table-striped">

<thead class="table-dark text-center">

<tr>
<th width="50">No</th>
<th width="120">Tanggal</th>
<th>Kegiatan</th>
<th>Deskripsi</th>
<th>Status</th>
<th width="140">Aksi</th>
</tr>

</thead>

<tbody>

<?php $no=1; foreach($logbook as $l): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= date('d-m-Y', strtotime($l->tanggal)) ?></td>
    <td><?= $l->kegiatan ?></td>
    <td><?= $l->deskripsi ?></td>

    <!-- STATUS -->
    <td>
        <?php if($l->status == 'disetujui'): ?>
            <span class="badge bg-success">Disetujui</span>
        <?php elseif($l->status == 'ditolak'): ?>
            <span class="badge bg-danger">Ditolak</span>
        <?php else: ?>
            <span class="badge bg-warning text-dark">Menunggu</span>
        <?php endif; ?>
    </td>

    <!-- AKSI -->
    <td>
        <?php if($l->status == 'menunggu' || $l->status == 'ditolak'): ?>
            <a href="<?= base_url('logbook/edit/'.$l->id) ?>" class="btn btn-warning btn-sm">
                Edit
            </a>

            <a href="<?= base_url('logbook/hapus/'.$l->id) ?>"
               class="btn btn-danger btn-sm"
               onclick="return confirm('Yakin hapus data ini?')">
               Hapus
            </a>
        <?php else: ?>
            <span class="text-muted">Terkunci</span>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
    </td>
</tr>

</tbody>

</table>

</div>

<?php $this->load->view('peserta/layout/footer'); ?>