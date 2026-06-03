<style>
body{
    font-family: Arial, sans-serif;
    font-size:14px;
    margin:30px;
}

.judul{
    text-align:center;
    font-size:20px;
    font-weight:bold;
    margin-bottom:15px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th, td{
    border:1px solid #000;
    padding:8px;
    vertical-align:top;
}

th{
    text-align:center;
    font-weight:bold;
}

.header-identitas{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
    margin-bottom:10px;
}

.header-identitas td{
    border:none !important;
    padding:3px 0;
    font-size:15px;
    text-align:left;
}

.header-identitas .label{
    width:180px;
}

.header-identitas .colon{
    width:15px;
    text-align:center;
}

/* TTD hanya muncul sekali di halaman terakhir */
.ttd-wrapper{
    margin-top:40px;
    width:100%;
    page-break-inside:avoid;
}

.ttd-kanan{
    width:300px;
    float:right;
    text-align:center;
}

@media print{
    thead{
        display:table-header-group;
    }

    tr{
        page-break-inside:avoid;
    }

    .last-page-signature{
        page-break-inside:avoid;
    }
}
</style>

<table>
    <thead>
        <!-- HEADER BERULANG DI SETIAP HALAMAN -->
        <tr>
            <th colspan="4" style="border:none; padding-bottom:15px;">
                
                <div class="judul">LOGBOOK KEGIATAN MAGANG</div>

                <table class="header-identitas">
                    <tr>
                        <td class="label">Nama</td>
                        <td class="colon">:</td>
                        <td><?= $magang->nama_lengkap ?></td>
                    </tr>
                    <tr>
                        <td class="label">Identitas Perusahaan</td>
                        <td class="colon">:</td>
                        <td>Dinas Kependudukan dan Pencatatan Sipil Kabupaten Sleman</td>
                    </tr>
                </table>

            </th>
        </tr>

        <tr>
            <th width="5%">No</th>
            <th width="25%">Hari / Tanggal</th>
            <th width="30%">Kegiatan</th>
            <th width="40%">Deskripsi</th>
        </tr>
    </thead>

    <tbody>
    <?php $no=1; foreach($logbook as $l): ?>
        <tr>
            <td style="text-align:center;"><?= $no++ ?></td>
            <td>
            <?php
            $hari = [
                'Sunday'    => 'Minggu',
                'Monday'    => 'Senin',
                'Tuesday'   => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday'  => 'Kamis',
                'Friday'    => 'Jumat',
                'Saturday'  => 'Sabtu'
            ];

            $namaHari = $hari[date('l', strtotime($l->tanggal))];
            echo $namaHari . ', ' . date('d-m-Y', strtotime($l->tanggal));
            ?>
            </td>
            <td><?= $l->kegiatan ?></td>
            <td><?= $l->deskripsi ?></td>
        </tr>
    <?php endforeach; ?>

    <!-- TTD HANYA SEKALI DI AKHIR DATA -->
    <tr class="last-page-signature">
        <td colspan="4" style="border:none; padding-top:40px;">
            <div class="ttd-wrapper">
                <div class="ttd-kanan">
                    <?= date('d F Y') ?><br>
                    Pembimbing Lapangan
                    <br><br><br><br>
                    ............................
                </div>
            </div>
        </td>
    </tr>
    </tbody>
</table>

<script>
window.print();
</script>