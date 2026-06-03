<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Email Berhasil Dikirim</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
body{
    margin:0;
    font-family:"Segoe UI",Tahoma,sans-serif;
    background:#f3f6fa;
}

.success-wrapper{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.success-card{
    background:#ffffff;
    padding:30px 36px;
    border-radius:16px;
    width:100%;
    max-width:480px;
    box-shadow:0 15px 35px rgba(0,0,0,0.15);
    text-align:center;
}

.success-icon{
    font-size:48px;
    color:#2ecc71;
}

.success-card h3{
    color:#002b5c;
}

.back-btn{
    display:inline-block;
    padding:12px 22px;
    background:#002b5c;
    color:#fff;
    text-decoration:none;
    border-radius:10px;
}
</style>
</head>

<body>

<div class="success-wrapper">
<div class="success-card">

<div class="success-icon">✔</div>

<h3>Email Berhasil Dikirim</h3>

<p><b>Nama:</b> <?= $nama ?></p>
<p><b>Email:</b> <?= $email ?></p>


<br>

<!-- 🔥 INI YANG DIPERBAIKI -->
<a class="back-btn" href="<?= site_url('admin/unit/'.$unit) ?>">
Kembali 
</a>

</div>
</div>

</body>
</html>