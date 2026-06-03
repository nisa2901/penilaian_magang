<?php $this->load->view('admin/layout/header'); ?>

<!-- SIDEBAR -->
<div class="sidebar">

    <h5 class="p-3">ADMIN</h5>

    <a href="<?= site_url('admin/dashboard') ?>">Dashboard</a>

    <a href="<?= site_url('admin/data_magang') ?>">Data Magang</a>

    <a href="<?= site_url('admin/rekap') ?>">Rekap Data Magang</a>

    <a href="<?= site_url('admin/logout') ?>">Logout</a>

</div>

<div class="content">
<h4>Edit Data <?= !empty($row->sekolah) ? 'Mahasiswa' : 'Siswa' ?> 
(<?= !empty($row['nama_lengkap']) ? $row['nama_lengkap'] : 'Tanpa Nama' ?>)
</h4>

<form method="post" action="<?= site_url('admin/update_bu_yuni/'.$row['id']) ?>">

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
        <label>Email Pribadi</label>
        <input type="email" name="email_pribadi" class="form-control"
               value="<?= $row['email_pribadi'] ?>">
    </div>

    <div class="form-group">
        <label>Sekolah</label>
        <input type="text" name="sekolah" class="form-control"
               value="<?= $row['sekolah'] ?>" required>
    </div>


    <div class="form-group">
        <label>Email Sekolah</label>
        <input type="email" name="email_sekolah" class="form-control"
               value="<?= $row['email_sekolah'] ?>">
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

    <?php $unit = isset($row['unit_penempatan']) ? $row['unit_penempatan'] : ''; ?>

    <div class="form-group">
        <label>Unit Penempatan</label>
        <select name="unit_penempatan" class="form-control">

            <option value="ARSIPARIS" <?= $unit=="ARSIPARIS"?'selected':'' ?>>ARSIPARIS</option>
            <option value="SEKRETARIAT" <?= $unit=="SEKRETARIAT"?'selected':'' ?>>SEKRETARIAT</option>
            <option value="UMPEG" <?= $unit=="UMPEG"?'selected':'' ?>>UMPEG</option>
            <option value="CAPIL" <?= $unit=="CAPIL"?'selected':'' ?>>CAPIL</option>
            <option value="DAFDUK" <?= $unit=="DAFDUK"?'selected':'' ?>>DAFDUK</option>
            <option value="PIAK" <?= $unit=="PIAK"?'selected':'' ?>>PIAK</option>
            <option value="RENKEU" <?= $unit=="RENKEU"?'selected':'' ?>>RENKEU</option>

        </select>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="<?= site_url('admin/bu_yuni_angkatan/'.$row['angkatan']) ?>" class="btn btn-secondary">Batal</a>
</form>
</div>

<?php $this->load->view('admin/layout/footer'); ?>
