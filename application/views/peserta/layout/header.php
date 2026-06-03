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

.sidebar h3{
margin:0 0 24px;
font-size:16px;
font-weight:700;
text-align:center;
color:#e9f1ff;
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
padding:15px 20px;
background:#f4f6f9;
min-height:100vh;
}

/* HEADER */
.header-box{
background:#fff;
padding:15px 20px;
border-radius:10px;
border:1px solid #dcdcdc;
box-shadow:0 2px 8px rgba(0,0,0,.08);
margin-bottom:15px;
}

.header-box h4{
margin:0;
font-size:22px;
font-weight:700;
}

.header-box p{
margin:0;
font-weight:600;
}

/* CARD */
.form-card{
background:#fff;
padding:25px;
border-radius:12px;
border:1px solid #ddd;
box-shadow:0 3px 10px rgba(0,0,0,.08);
}

.form-card h5{
font-weight:700;
margin-bottom:25px;
}

/* FORM */
.form-row{
display:flex;
gap:15px;
align-items:flex-start;
flex-wrap:wrap;
}

.form-group{
flex:1;
min-width:220px;
}

.form-group label{
display:block;
font-weight:600;
margin-bottom:8px;
}

.form-control{
width:100%;
border:1px solid #bbb;
border-radius:6px;
padding:10px;
}

/* BUTTON */
.btn-update{
background:#0d6efd;
color:#fff;
border:none;
padding:8px 20px;
border-radius:5px;
font-weight:600;
}

.btn-update:hover{
background:#0b5ed7;
}

.btn-back{
background:#6c757d;
color:#fff;
padding:8px 20px;
border-radius:5px;
text-decoration:none;
font-weight:600;
margin-left:8px;
}

.btn-back:hover{
background:#5c636a;
color:#fff;
}

/* RESPONSIVE */
@media(max-width:768px){

.sidebar{
width:200px;
}

.form-row{
flex-direction:column;
}

.form-group{
width:100%;
}

.content{
padding:10px;
}

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
.form-control {
    border-radius: 8px;
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
}

.btn-primary {
    background: #0d6efd;
    border: none;
}

.btn-primary:hover {
    background: #0b5ed7;
}

.btn-secondary {
    border: none;
} 
}

</style>
</head>
<body>

<div class="wrapper">

