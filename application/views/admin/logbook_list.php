<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<style>
.content{
    animation: fadeUp .6s ease;
    padding:20px;
}

@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(12px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
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

.action-bar{
    display:flex;
    gap:10px;
    margin-bottom:20px;
    flex-wrap:wrap;
}

.badge{
    font-size:12px;
    padding:8px 12px;
}

@media(max-width:768px){

    .content{
        padding:15px;
    }

    .action-bar{
        flex-direction:column;
        align-items:flex-start;
    }

}
</style>

<div class="content">

<h4 class="mb-4 fw-bold">Data Logbook Peserta Magang</h4>

<?php

$from = $this->input->get('from');

if ($from == 'unit') {

    $url_kembali = base_url('admin/unit/'.$peserta->unit_penempatan);

} elseif ($from == 'pak_hani') {

    $url_kembali = base_url('admin/pak_hani_angkatan/'.$peserta->angkatan);

} elseif ($from == 'bu_yuni') {

    $url_kembali = base_url('admin/bu_yuni_angkatan/'.$peserta->angkatan);

} else {

    $url_kembali = base_url('admin/dashboard');

}

?>

<div class="action-bar">

    <a href="<?= $url_kembali ?>"
       class="btn btn-secondary btn-sm">
        ← Kembali
    </a>

    <?php if(isset($data_magang_id)): ?>
        <a href="<?= site_url('admin/approve_logbook/'.$data_magang_id) ?>"
           class="btn btn-success btn-sm"
           onclick="return confirm('Setujui semua logbook?')">
            Approve Semua
        </a>
    <?php endif; ?>

</div>

<div class="table-responsive">

<table class="table table-bordered table-striped align-middle">

    <thead class="table-dark">
        <tr>
            <th width="60">No</th>
            <th width="120">Tanggal</th>
            <th>Kegiatan</th>
            <th>Deskripsi</th>
            <th width="120">Status</th>
            <th width="130">Aksi</th>
        </tr>
    </thead>

    <tbody>

    <?php if(!empty($logbook)): ?>

        <?php $no=1; foreach($logbook as $l): ?>

        <tr>

            <td class="text-center">
                <?= $no++ ?>
            </td>

            <td>
                <?= date('d-m-Y', strtotime($l->tanggal)) ?>
            </td>

            <td>
                <?= $l->kegiatan ?>
            </td>

            <td>
                <?= $l->deskripsi ?>
            </td>

            <td class="text-center">

                <?php if($l->status == 'disetujui'): ?>

                    <span class="badge bg-success">
                        Disetujui
                    </span>

                <?php elseif($l->status == 'ditolak'): ?>

                    <span class="badge bg-danger">
                        Ditolak
                    </span>

                <?php else: ?>

                    <span class="badge bg-warning text-dark">
                        Menunggu
                    </span>

                <?php endif; ?>

            </td>

            <td class="text-center">

                <?php if($l->status != 'ditolak'): ?>

                    <a href="<?= base_url('admin/tolak_logbook/'.$l->id) ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin ingin menolak logbook ini?')">
                        Tolak
                    </a>

                <?php else: ?>

                    <span class="text-muted">
                        Sudah Ditolak
                    </span>

                <?php endif; ?>

            </td>

        </tr>

        <?php endforeach; ?>

    <?php else: ?>

        <tr>
            <td colspan="6" class="text-center text-muted">
                Belum ada data logbook
            </td>
        </tr>

    <?php endif; ?>

    </tbody>

</table>

</div>

</div>

<?php $this->load->view('admin/layout/footer'); ?>