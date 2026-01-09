<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content">
<h4>Siswa Bu Yuni – Angkatan <?= $angkatan ?></h4>

<table class="table table-bordered table-striped">
<thead class="table-dark">
<tr>
  <th>Nama</th>
  <th>Sekolah</th>
  <th>Tanggal Mulai</th>
  <th>Tanggal Selesai</th>
  <th>Dokumen</th>
  <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php if(!empty($siswa)): ?>
<?php foreach($siswa as $s): ?>
<tr>
  <td><?= $s['nama_lengkap']; ?></td>
  <td><?= $s['sekolah']; ?></td>
  <td><?= $s['tanggal_mulai']; ?></td>
  <td><?= $s['tanggal_selesai']; ?></td>

 <td>
  <?php if (!empty($s['dokumen_pendaftaran'])): ?>

      <?php
          $jenis = (!empty($s['sekolah'])) ? 'siswa' : 'mahasiswa';
          $path = 'uploads/pendaftaran/'.$jenis.'/'.$s['dokumen_pendaftaran'];
      ?>

      <a href="<?= base_url($path); ?>" target="_blank">
          Download
      </a>

  <?php else: ?>
      -
  <?php endif; ?>
  </td>

       
  <td>
    <!-- Edit -->
    <a href="<?= site_url('admin/edit_bu_yuni/'.$s['id']); ?>" 
       class="btn btn-sm btn-warning">
       Edit
    </a>

    <!-- Upload Penilaian -->
    <a href="<?= site_url('admin/upload_penilaian/'.$s['data_magang_id']) ?>" 
      class="btn btn-sm btn-warning">
      Upload Penilaian
    </a>


    <!-- Dropdown Kirim Email -->
    <div class="btn-group">
        <button type="button" 
                class="btn btn-sm btn-info dropdown-toggle" 
                data-toggle="dropdown">
            Kirim Email
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item"
               href="<?= site_url('admin/kirim_email_bu_yuni/'.$s['id'].'/pribadi'); ?>">
                Email Pribadi
            </a>
            <a class="dropdown-item"
               href="<?= site_url('admin/kirim_email_bu_yuni/'.$s['id'].'/sekolah'); ?>">
                Email Sekolah
            </a>
        </div>
    </div>

    <!-- Hapus -->
    <a href="<?= site_url('admin/hapus_bu_yuni/'.$s['id']); ?>" 
       onclick="return confirm('Yakin hapus data?')" 
       class="btn btn-sm btn-danger">
       Hapus
    </a>
  </td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
  <td colspan="6" class="text-center">Tidak ada data</td>
</tr>
<?php endif; ?>
</tbody>
</table>
</div>

<?php $this->load->view('admin/layout/footer'); ?>
