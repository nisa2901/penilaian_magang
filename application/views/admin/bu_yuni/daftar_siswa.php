<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content">
<h4>Daftar Siswa – Angkatan <?= $angkatan ?></h4>

<div style="display:flex; justify-content:center; margin-bottom:20px;">
    <input type="text" id="searchInput" 
           placeholder="Cari nama, sekolah, atau unit..." 
           class="form-control" 
           style="width:300px; text-align:center;">
</div>

<table class="table table-bordered table-striped">
<thead class="table-dark">
<tr>
  <th>Nama</th>
  <th>Sekolah</th>
  <th>Tanggal Mulai</th>
  <th>Tanggal Selesai</th>
  <th>Unit</th>
  <th>Dokumen</th>
  <th>Penilaian</th>
  <th style="min-width:320px;">Aksi</th>
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
  <td><?= $s['unit_penempatan']; ?></td>

  <!-- DOKUMEN -->
  <td>
  <?php if (!empty($s['dokumen_pendaftaran'])): ?>

      <?php
          $jenis = (!empty($s['sekolah'])) ? 'siswa' : 'mahasiswa';
          $path = 'uploads/pendaftaran/'.$jenis.'/'.$s['dokumen_pendaftaran'];
      ?>

      <a href="<?= base_url($path); ?>" class="btn btn-sm btn-download" target="_blank">
          Download
      </a>

  <?php else: ?>
      -
  <?php endif; ?>
  </td>

  <!-- PENILAIAN -->
  <td>
  <?php if(!empty($s['dokumen_penilaian'])): ?>

  <?php
  $jenis = (!empty($s['sekolah'])) ? 'siswa' : 'mahasiswa';
  $path = 'uploads/penilaian/'.$jenis.'/'.$s['dokumen_penilaian'];
  ?>

  <a href="<?= base_url($path) ?>" 
     class="btn btn-sm btn-lihat"
     target="_blank">
     Lihat
  </a>

  <?php else: ?>
      <span class="text-muted">Belum Upload</span>
  <?php endif; ?>
  </td>

  <!-- AKSI -->
  <td style="white-space:nowrap;">
    
    <!-- Edit -->
    <a href="<?= site_url('admin/edit_bu_yuni/'.$s['id']); ?>" 
       class="btn btn-sm btn-aesthetic">
       Edit
    </a>

    <!-- Logbook -->
    <a href="<?= site_url('admin/logbook/'.$s['data_magang_id']) ?>?from=bu_yuni" 
       class="btn btn-sm btn-aesthetic">
       Logbook 
    </a>

    <!-- Upload -->
    <a href="<?= site_url('admin/upload_penilaian/'.$s['data_magang_id']) ?>" 
       class="btn btn-sm btn-aesthetic">
       Upload Penilaian
    </a>

    <!-- Email -->
    <div class="btn-group">
        <button type="button" 
                class="btn btn-sm btn-aesthetic dropdown-toggle" 
                data-toggle="dropdown">
            Kirim Email
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item"
               href="<?= site_url('admin/kirim_email_bu_yuni/'.$s['id'].'/pribadi'); ?>">
                Email Peserta
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
       class="btn btn-sm btn-delete">
       Hapus
    </a>

  </td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
  <td colspan="8" class="text-center">Tidak ada data</td>
</tr>
<?php endif; ?>
</tbody>
</table>

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
</div>

<?php $this->load->view('admin/layout/footer'); ?>