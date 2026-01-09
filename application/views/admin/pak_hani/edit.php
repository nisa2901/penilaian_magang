<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content">
<h4>Edit Data Mahasiswa (Pak Hani)</h4>

<form method="post" action="<?= site_url('admin/update_pak_hani/'.$row['id']) ?>">

    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control"
               value="<?= $row['nama_lengkap'] ?>" required>
    </div>

    <div class="form-group">
        <label>Angkatan</label>
        <input type="number" name="angkatan" class="form-control"
               value="<?= $row['angkatan'] ?>" required>
    </div>

    <div class="form-group">
        <label>Universitas</label>
        <input type="text" name="universitas" class="form-control"
               value="<?= $row['universitas'] ?>" required>
    </div>

    <div class="form-group">
        <label>Email Pribadi</label>
        <input type="email" name="email_pribadi" class="form-control"
               value="<?= $row['email_pribadi'] ?>">
    </div>

    <div class="form-group">
        <label>Email Universitas</label>
        <input type="email" name="email_universitas" class="form-control"
               value="<?= $row['email_universitas'] ?>">
    </div>

    <div class="form-group">
        <label>Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" class="form-control"
               value="<?= $row['tanggal_mulai'] ?>">
    </div>

    <div class="form-group">
        <label>Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" class="form-control"
               value="<?= $row['tanggal_selesai'] ?>">
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="<?= site_url('admin/pak_hani') ?>" class="btn btn-secondary">Batal</a>
</form>
</div>

<?php $this->load->view('admin/layout/footer'); ?>
