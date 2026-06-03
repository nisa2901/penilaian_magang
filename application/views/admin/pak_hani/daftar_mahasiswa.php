<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content">
<h4>Daftar Mahasiswa – Angkatan <?= $angkatan ?></h4>

<div style="display:flex; justify-content:center; margin-bottom:20px;">
    <input type="text" id="searchInput" 
           placeholder="Cari nama, universitas, atau unit..." 
           class="form-control" 
           style="width:300px; text-align:center;">
</div>

<table class="table table-bordered table-striped">
<thead class="table-dark">
<tr>
  <th>Nama</th>
  <th>Universitas</th>
  <th>Tanggal Mulai</th>
  <th>Tanggal Selesai</th>
  <th>Unit</th>
  <th>Dokumen</th>
   <th>Penilaian</th>
  <th width="450">Aksi</th>
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
  <td><?= $m['unit_penempatan']; ?></td>

 
  <td>
  <?php if (!empty($m['dokumen_pendaftaran'])): ?>

      <?php
          $jenis = (!empty($m['universitas'])) ? 'mahasiswa' : 'siswa';
          $path = 'uploads/pendaftaran/'.$jenis.'/'.$m['dokumen_pendaftaran'];
      ?>

      <a href="<?= base_url($path); ?>" class="btn btn-sm btn-download" target="_blank">
          Download
      </a>

  <?php else: ?>
      -
  <?php endif; ?>
  </td>

<td>
<?php if(!empty($m['dokumen_penilaian'])): ?>

<?php
$jenis = (!empty($m['universitas'])) ? 'mahasiswa' : 'siswa';
$path = 'uploads/penilaian/'.$jenis.'/'.$m['dokumen_penilaian'];
?>

<a href="<?= base_url($path) ?>" 
class="btn btn-sm btn-lihat" target="_blank">
Lihat
</a>

<?php else: ?>

<span class="text-muted">Belum Upload</span>

<?php endif; ?>
</td>

 <td>
    <!-- Edit -->
    <a href="<?= site_url('admin/edit_pak_hani/'.$m['id']); ?>" 
        class="btn btn-sm btn-aesthetic"> Edit </a>

    <a href="<?= site_url('admin/logbook/'.$m['data_magang_id'].'?from=pak_hani') ?>"
        class="btn btn-sm btn-aesthetic">
        Logbook 
    </a>

    <a href="<?= site_url('admin/upload_penilaian/'.$m['data_magang_id']) ?>" 
      class="btn btn-sm btn-aesthetic">Upload Penilaian</a>

    <!-- Dropdown Kirim Email -->
    <div class="btn-group">
        <button type="button" 
                class="btn btn-sm btn-aesthetic dropdown-toggle" 
                data-toggle="dropdown">
            Kirim Email
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item"
               href="<?= site_url('admin/kirim_email/'.$m['id'].'/pribadi'); ?>">
                Email Peserta
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
       class="btn btn-sm btn-delete">
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
