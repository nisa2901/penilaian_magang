<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Sistem Penilaian Magang</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- DATATABLES -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<style>

body{
margin:0;
font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
background:#f0f4f8;
}

.wrapper{
display:flex;
min-height:100vh;
}

/* SIDEBAR */

.sidebar{
width:230px;
background:linear-gradient(180deg,#002b5c,#001a38);
color:#fff;
padding:22px 18px;
display:flex;
flex-direction:column;
box-shadow:4px 0 18px rgba(0,0,0,.25);
}

.sidebar a{
display:block;
color:#e9f1ff;
text-decoration:none;
padding:12px 14px;
margin:6px 0;
border-radius:10px;
background:rgba(255,255,255,0.06);
transition:all .3s;
}

.sidebar a:hover{
background:linear-gradient(135deg,#004b9a,#006bd6);
transform:translateX(4px);
}

.logout{
margin-top:auto;
text-align:center;
background:linear-gradient(135deg,#ff4d4d,#e6f0ff);
color:#fff !important;
padding:12px;
border-radius:12px;
font-weight:700;
}

.logout:hover{
background:linear-gradient(135deg,#d90429,#ef233c);
}

/* CONTENT */

.content{
flex:1;
padding:25px;
}

.header{
background:#fff;
padding:18px;
font-weight:bold;
border-radius:12px;
border:1px solid #ccc;
box-shadow:0 6px 18px rgba(0,0,0,.08);
margin-bottom:20px;
}

.card{
background:#fff;
padding:25px;
border-radius:12px;
border:1px solid #ccc;
box-shadow:0 10px 25px rgba(0,0,0,.08);
}

/* BUTTON */
.btn-secondary{
    text-align: center;
    padding: 8px;
    border: none;
    border-radius: 10px;
    color: white;
    cursor: pointer;
    text-decoration: none;
}

.btn-secondary { background: #6c757d; }

.btn-secondary:hover {
    opacity: 0.9;
}

.btn-gradient{
    background:linear-gradient(135deg,#003566,#00509d);
    color:white;
    border:none;
}

.btn-gradient:hover{
    background:linear-gradient(135deg,#002b5c,#003f88);
    color:white;
}

.btn-aesthetic{
    background: linear-gradient(135deg,#2196f3,#1976d2);
    color: white !important;
    border: none;
    border-radius: 10px;
    padding: 6px 14px;
    font-weight: 500;
    box-shadow: 0 4px 10px rgba(24,119,242,.25);
    transition: all .3s ease;
}

.btn-aesthetic:hover{
    background: linear-gradient(to right, #4cc0ff, #0d6efd);
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(24,119,242,.35);
}

.btn-sm{
    font-size:12px;
    padding:4px 8px;
}

/* DOWNLOAD */
.btn-download{
    background: linear-gradient(135deg,#003566,#00509d);
    color:white !important;
    border:none;
    border-radius:10px;
    font-weight: 500;
    box-shadow:0 4px 10px rgba(0,53,102,.25);
    transition:all .3s ease;
}

.btn-download:hover{
    background: linear-gradient(135deg,#004080,#0066cc);
    color:white !important;
    transform:translateY(-2px);
    box-shadow:0 6px 15px rgba(0,53,102,.35);
}

/* LIHAT */
.btn-lihat{
    background: linear-gradient(135deg,#003566,#00509d);
    color:white !important;
    border:none;
    border-radius:10px;
    font-weight: 500;
    box-shadow:0 4px 10px rgba(0,53,102,.25);
    transition:all .3s ease;
}

.btn-lihat:hover{
    background: linear-gradient(135deg,#004080,#0066cc);
    color:white !important;
    transform:translateY(-2px);
    box-shadow:0 6px 15px rgba(0,53,102,.35);
}

/* HAPUS */
.btn-delete{
    background: linear-gradient(135deg,#ff4d4d,#d90429);
    color:white !important;
    border:none;
    border-radius:10px;
    font-weight: 500;
    box-shadow:0 4px 10px rgba(217,4,41,.25);
    transition:all .3s ease;
}

.btn-delete:hover{
    background: linear-gradient(135deg,#ff6b6b,#c1121f);
    color:white !important;
    transform:translateY(-2px);
    box-shadow:0 6px 15px rgba(217,4,41,.35);
}

/* ================= SEARCH ================= */
.search-wrapper {
    display: flex;
    justify-content: center;
    margin: 25px 0;
}

.search-input {
    width: 350px;
    text-align: center;
    border-radius: 25px;
    padding: 10px 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
</style>
</head>

<div class="wrapper">

