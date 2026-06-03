<?php $this->load->view('peserta/layout/header'); ?>
<?php $this->load->view('peserta/layout/sidebar'); ?>

<div class="content">

<?php if($logbook->status != 'ditolak' && $logbook->status != 'menunggu'): ?>

<div class="alert alert-danger">
    Terkunci - Logbook sudah diproses admin.
</div>

<?php else: ?>

<div class="header-box">
    <p>Sistem Penilaian Magang</p>
    <small>Dinas Kependudukan Dan Pencatatan Sipil</small>
</div>

<div class="form-card">

    <h5>Edit Logbook Kegiatan Magang</h5>

    <form action="<?= base_url('logbook/update') ?>" method="post">

        <input type="hidden" name="id" value="<?= $logbook->id ?>">

        <div class="form-row">

            <div class="form-group">
                <label>Tanggal</label>
                <input
                    type="date"
                    name="tanggal"
                    class="form-control"
                    value="<?= $logbook->tanggal ?>"
                    required>
            </div>

            <div class="form-group">
                <label>Kegiatan</label>
                <input
                    type="text"
                    name="kegiatan"
                    class="form-control"
                    value="<?= $logbook->kegiatan ?>"
                    required>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea
                    name="deskripsi"
                    class="form-control"
                    rows="3"
                    required><?= $logbook->deskripsi ?></textarea>
            </div>

        </div>

        <div style="margin-top:20px;">

            <button type="submit" class="btn-update">
                Update
            </button>

            <a href="<?= base_url('logbook') ?>" class="btn-back">
                Kembali
            </a>

        </div>

    </form>

</div>

<?php endif; ?>

</div>

<?php $this->load->view('peserta/layout/footer'); ?>