<style>
/* SIDEBAR */
.sidebar{
    width:220px;
    min-height:100vh;
    background:linear-gradient(180deg,#002b5c,#001a38);
    color:#fff;
    box-shadow:4px 0 15px rgba(0,0,0,.15);
    z-index:1000;
}

/* JUDUL */
.sidebar h5{
    font-weight:700;
    letter-spacing:1px;
    color:#eaf2ff;
    border-bottom:1px solid rgba(255,255,255,.15);
    margin-bottom:20px;
}

/* LINK */
.sidebar a{
    display:flex;
    align-items:center;
    padding:12px 18px;
    margin:8px 14px;
    border-radius:10px;
    color:#e6efff;
    text-decoration:none;
    font-weight:500;
    transition:all .3s ease;
    position:relative;
    overflow:hidden;
}

/* GARIS AKTIF */
.sidebar a::before{
    content:"";
    position:absolute;
    left:0;
    top:0;
    width:4px;
    height:100%;
    background:#4da3ff;
    opacity:0;
    transition:.3s;
}

/* HOVER */
.sidebar a:hover{
    background:rgba(255,255,255,.12);
    transform:translateX(6px);
}

/* ACTIVE */
.sidebar a.active{
    background:rgba(255,255,255,.18);
    font-weight:600;
}

.sidebar a.active::before{
    opacity:1;
}

/* LOGOUT */
.sidebar a[href*="logout"]{
    margin-top:30px;
    background:rgba(255,255,255,.08);
    justify-content:center;
    font-weight:600;
}

.sidebar a[href*="logout"]:hover{
    background:#ff4d4d;
    color:#fff;
}
</style>

<div class="sidebar position-fixed">
    <h5 class="text-center py-3">ADMIN</h5>
    <a href="<?= site_url('admin/dashboard') ?>" class="<?= $this->uri->segment(2)=='dashboard'?'active':'' ?>">Dashboard</a>
    <a href="<?= site_url('admin/data_magang') ?>" class="<?= $this->uri->segment(2)=='data_magang'?'active':'' ?>">Data Magang</a>
    <a href="<?= site_url('admin/logout') ?>">Logout</a>
</div>
