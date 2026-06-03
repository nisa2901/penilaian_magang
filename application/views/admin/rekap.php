<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<style>
        body {
            background: #f4f6f9;
            margin: 0;
        }

        

        h2 {
            font-size:25px;
            margin-bottom: 20px;
        }

        /* ================= TEXT CARD ================= */

        .card-title{
            font-size:15px;
            color:#6b7280;
            margin-bottom:8px;
            font-weight:500;
        }

        .card-value{
            font-size:28px;
            font-weight:700;
            color:#111827;
        }
        /* ================= CARD STYLE ================= */

        .cards{
            display:flex;
            gap:18px;
            flex-wrap:wrap;
            margin-bottom:25px;
        }

        .card{
            flex:1;
            min-width:190px;

            background:#f9fafb;

            padding:20px;

            border-radius:14px;

            box-shadow:0 6px 18px rgba(0,0,0,.12);

            transition:.3s;

            position:relative;

            border:none;
        }

        .card:hover{
            transform:translateY(-5px);
            box-shadow:0 18px 35px rgba(0,0,0,.2);
        }

        /* warna garis kiri */

        .blue{
            border-left:6px solid #3b82f6;
        }

        .green{
            border-left:6px solid #22c55e;
        }

        .orange{
            border-left:6px solid #f59e0b;
        }

        .red{
            border-left:6px solid #ef4444;
        }

        .purple{
            border-left:6px solid #8b5cf6;
        }

        /* isi text */

        .card h3{
            font-size:15px;
            color:#6b7280;
            margin-bottom:8px;
            font-weight:500;
        }

        .card h1{
            font-size:28px;
            font-weight:700;
            color:#111827;
            margin:0;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background: #000000;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #f1f1f1;
        }

        .status-aktif {
            color: green;
            font-weight: bold;
        }

        .status-selesai {
            color: red;
            font-weight: bold;
        }

</style>


<div class="content">

<div class="container">

    <h2 class="mb-4 fw-bold">Dashboard Rekap Magang</h2>

    <!-- CARD -->
    <div class="cards">

        <div class="card blue">
            <div class="card-title">Total Peserta</div>
            <div class="card-value"><?= $total->total ?></div>
        </div>

        <div class="card green">
            <div class="card-title">Mahasiswa</div>
            <div class="card-value"><?= $total->mahasiswa ?></div>
        </div>

        <div class="card orange">
            <div class="card-title">Siswa</div>
            <div class="card-value"><?= $total->siswa ?></div>
        </div>

        <div class="card purple">
            <div class="card-title">Peserta Aktif</div>
            <div class="card-value"><?= $aktif ?></div>
        </div>

        <div class="card red">
            <div class="card-title">Peserta Selesai</div>
            <div class="card-value"><?= $selesai ?></div>
        </div>

</div>
<form method="get" action="<?= base_url('admin/rekap') ?>" style="display:flex; gap:10px; align-items:center;">

    <!-- DROPDOWN -->
    <select name="tahun" onchange="this.form.submit()" style="padding:8px; border-radius:6px;">
        <option value="">Pilih Tahun</option>
        <?php for($i=date('Y'); $i>=2020; $i--): ?>
            <option value="<?= $i ?>" <?= ($this->input->get('tahun')==$i)?'selected':'' ?>>
                <?= $i ?>
            </option>
        <?php endfor; ?>
    </select>

    <!-- BUTTON DOWNLOAD -->
    <a href="<?= base_url('index.php/admin/download?tahun='.$this->input->get('tahun')) ?>" target="_blank">
        <button type="button" style="padding:8px 12px; background:#28a745; color:white; border:none; border-radius:6px;">
            Download
        </button>
    </a>

</form>

<br>

    <!-- TABLE -->
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Sekolah / Universitas</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Status</th>
        </tr>

        <?php $no=1; foreach($rekap as $r): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $r->nama_lengkap ?></td>
            <td><?= $r->universitas ?: $r->sekolah ?></td>
            <td><?= $r->tanggal_mulai ?></td>
            <td><?= $r->tanggal_selesai ?></td>
            <td>
                <?php if($r->tanggal_selesai >= date('Y-m-d')): ?>
                    <span class="status-aktif">Aktif</span>
                <?php else: ?>
                    <span class="status-selesai">Selesai</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</div>

<?php $this->load->view('admin/layout/footer'); ?>
