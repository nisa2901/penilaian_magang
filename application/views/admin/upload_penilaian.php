<style>
/* ===== CENTER WRAPPER ===== */
.center-wrapper {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f3f6fa;
}

/* ===== CARD ===== */
.upload-card {
    max-width: 520px;
    width: 100%;
    background: #ffffff;
    padding: 25px 30px;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    border: 1px solid #e0e0e0;
}

/* ===== TITLE ===== */
.upload-card h3 {
    margin-bottom: 20px;
    font-weight: 700;
    color: #002b5c;
    text-align: center;
}

/* ===== LABEL ===== */
.upload-card label {
    font-weight: 600;
    color: #333;
}

/* ===== NAME ===== */
.upload-card b {
    color: #002b5c;
    font-size: 16px;
}

/* ===== FILE INPUT ===== */
.upload-card input[type="file"] {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: 1px dashed #b0c4de;
    background: #f8fbff;
    cursor: pointer;
    transition: all 0.3s ease;
}

.upload-card input[type="file"]:hover {
    border-color: #002b5c;
    background: #eef5ff;
}

/* ===== BUTTON ===== */
.upload-card button {
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, #002b5c, #00509d);
    color: #ffffff;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
}

.upload-card button:hover {
    background: linear-gradient(135deg, #004b9a, #0077ff);
    box-shadow: 0 10px 25px rgba(0,0,0,0.25);
    transform: translateY(-2px);
}

.upload-card button:active {
    transform: scale(0.97);
}
</style>

<div class="center-wrapper">

    <div class="upload-card">

        <h3>Upload Penilaian</h3>

        <form action="<?= base_url('admin/upload_penilaian/'.$magang['id']); ?>"
              method="post"
              enctype="multipart/form-data">

            <div>
                <label>Nama:</label>
                <b><?= $magang['nama_lengkap']; ?></b>
            </div>

            <br>

            <div>
                <label>File Penilaian (PDF)</label><br>
                <input type="file" name="dokumen" required>
            </div>

            <br>

            <button type="submit">Upload & Simpan</button>

        </form>

    </div>

</div>
