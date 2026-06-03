<!DOCTYPE html>
<html>
<head>
    <title>Rekap Magang</title>
    <style>
        body { font-family: Arial; font-size: 12px; }
        h2 { text-align: center; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            text-align: center;
        }
    </style>
</head>
<body onload="window.print()">

<h2>REKAP PESERTA MAGANG TAHUN <?= $tahun ?></h2>

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Sekolah / Universitas</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
    </tr>

    <?php $no=1; foreach($rekap as $d): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $d->nama_lengkap ?></td>
        <td><?= $d->universitas ?: $d->sekolah ?></td>
        <td><?= $d->tanggal_mulai ?></td>
        <td><?= $d->tanggal_selesai ?></td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>