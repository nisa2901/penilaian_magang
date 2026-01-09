<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content">
<h4>Mahasiswa Pak Hani – Angkatan <?= $angkatan ?></h4>

<table class="table table-bordered table-striped">
<thead class="table-dark">
<tr>
  <th>Nama</th>
  <th>Universitas</th>
  <th>Tanggal Mulai</th>
  <th>Tanggal Selesai</th>
  <th>Dokumen</th>
  <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php if(!empty($mahasiswa)): ?>
<?php foreach($mahasiswa as $m): ?>
<tr>
  <td><?= $m['nama_lengkap']; ?></td>
  <td><?= $m['universitas']; ?></td>
  <td><?= $m['tanggal_mulai']; ?></td>
  <td><?= $m['tanggal_selesai']; ?></td>

 
  <td>
  <?php if (!empty($m['dokumen_pendaftaran'])): ?>

      <?php
          $jenis = (!empty($m['universitas'])) ? 'mahasiswa' : 'siswa';
          $path = 'uploads/pendaftaran/'.$jenis.'/'.$m['dokumen_pendaftaran'];
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
    <a href="<?= site_url('admin/edit_pak_hani/'.$m['id']); ?>" 
       class="btn btn-sm btn-warning">Edit</a>

    <a href="<?= site_url('admin/upload_penilaian/'.$m['data_magang_id']) ?>" 
      class="btn btn-sm btn-warning">Upload Penilaian</a>

    <!-- Dropdown Kirim Email -->
    <div class="btn-group">
        <button type="button" 
                class="btn btn-sm btn-info dropdown-toggle" 
                data-toggle="dropdown">
            Kirim Email
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item"
               href="<?= site_url('admin/kirim_email/'.$m['id'].'/pribadi'); ?>">
                Email Pribadi
            </a>
            <a class="dropdown-item"
               href="<?= site_url('admin/kirim_email/'.$m['id'].'/universitas'); ?>">
                Email Universitas
            </a>
        </div>
    </div>

    <!-- Hapus -->
    <a href="<?= site_url('admin/hapus_pak_hani/'.$m['id']); ?>" 
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
