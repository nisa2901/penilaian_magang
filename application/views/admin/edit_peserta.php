<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>
<style>
.center-wrapper {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    background: #f4f6f9;
    padding: 30px 15px;
}

.form-card {
    width: 100%;
    max-width: 700px;
    background: #fff;
    padding: 30px;
    border-radius: 14px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.form-card h4 {
    margin-bottom: 20px;
    color: #002b5c;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    font-weight: 600;
    margin-bottom: 5px;
    display: block;
}

.form-control {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #ccd6e0;
    background: #f9fbff;
}

.button-row {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.btn {
    flex: 1;
    padding: 12px;
    border-radius: 10px;
    border: none;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    text-align: center;
}

.btn-success { background: #28a745; }
.btn-secondary { background: #6c757d; }

.btn:hover {
    opacity: 0.9;
}
</style>



<div class="content">
<div class="center-wrapper">

<div class="form-card">

<h4>
Edit Data <?= !empty($peserta->universitas) ? 'Mahasiswa' : 'Siswa' ?> 
(<?= $peserta->nama_lengkap ?>)
</h4>

<form method="post" action="<?= site_url('admin/update') ?>">

<input type="hidden" name="id" value="<?= $peserta->id ?>">

<div class="form-group">
<label>Nama Lengkap</label>
<input type="text" name="nama_lengkap"
value="<?= $peserta->nama_lengkap ?>" class="form-control">
</div>

<div class="form-group">
<label>Angkatan</label>
<input type="number" name="angkatan"
value="<?= $peserta->angkatan ?? '' ?>" class="form-control">
</div>

<div class="form-group">
<label>Email Pribadi</label>
<input type="email" name="email_pribadi"
value="<?= $peserta->email_pribadi ?>" class="form-control">
</div>


<?php if(!empty($peserta->universitas)){ ?>

<!-- MAHASISWA -->
<div class="form-group">
<label>Universitas</label>
<input type="text" name="universitas"
value="<?= $peserta->universitas ?>" class="form-control">
</div>

<div class="form-group">
<label>Email Universitas</label>
<input type="email" name="email_universitas"
value="<?= $peserta->email_universitas ?? '' ?>" class="form-control">
</div>

<input type="hidden" name="email_sekolah" value="">

<?php } else { ?>

<!-- SISWA -->
<div class="form-group">
<label>Sekolah</label>
<input type="text" name="sekolah"
value="<?= $peserta->sekolah ?>" class="form-control">
</div>

<div class="form-group">
<label>Email Sekolah</label>
<input type="email" name="email_sekolah"
value="<?= $peserta->email_sekolah ?? '' ?>" class="form-control">
</div>

<input type="hidden" name="email_universitas" value="">

<input type="hidden" name="universitas" value="">

<?php } ?>


<div class="form-group">
<label>Tanggal Mulai</label>
<input type="date" name="tanggal_mulai"
value="<?= $peserta->tanggal_mulai ?>" class="form-control">
</div>

<div class="form-group">
<label>Tanggal Selesai</label>
<input type="date" name="tanggal_selesai"
value="<?= $peserta->tanggal_selesai ?>" class="form-control">
</div>

<div class="form-group">
<label>Unit Penempatan</label>
<select name="unit_penempatan" class="form-control">

<option value="ARSIPARIS" <?= $peserta->unit_penempatan=="ARSIPARIS"?'selected':'' ?>>ARSIPARIS</option>
<option value="SEKRETARIAT" <?= $peserta->unit_penempatan=="SEKRETARIAT"?'selected':'' ?>>SEKRETARIAT</option>
<option value="UMPEG" <?= $peserta->unit_penempatan=="UMPEG"?'selected':'' ?>>UMPEG</option>
<option value="CAPIL" <?= $peserta->unit_penempatan=="CAPIL"?'selected':'' ?>>CAPIL</option>
<option value="DAFDUK" <?= $peserta->unit_penempatan=="DAFDUK"?'selected':'' ?>>DAFDUK</option>
<option value="PIAK" <?= $peserta->unit_penempatan=="PIAK"?'selected':'' ?>>PIAK</option>
<option value="RENKEU" <?= $peserta->unit_penempatan=="RENKEU"?'selected':'' ?>>RENKEU</option>

</select>
</div>

<div class="button-row">
<button type="submit" class="btn btn-success">Update</button>

<a href="<?= site_url('admin/unit/'.$peserta->unit_penempatan) ?>" class="btn btn-secondary">
Batal
</a>
</div>

</form>

</div>
</div>
</div>

<?php $this->load->view('admin/layout/footer'); ?>