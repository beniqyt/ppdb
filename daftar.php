<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PPDB Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            min-height: 100vh;
        }
        .card {
            border-radius: 15px;
        }
        .email-info{
    background:#ffe69c;
    border-left:4px solid #ffc107;
    padding:12px 15px;
    border-radius:8px;
    color:#333;
    font-size:14px;
    line-height:1.6;
    margin-top:15px;
    margin-bottom:20px;
}
@media (max-width:768px){
    .email-info{
        font-size:13px;
        padding:10px 12px;
    }
}
    </style>
</head>

<body>

<div class="container py-5">
    <div class="card shadow-lg p-4">
        <h3 class="text-center mb-4">Form Pendaftaran PPDB</h3>

        <form action="simpan.php" method="POST" id="formPPDB" novalidate>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>NISN</label>
                    <input type="text"
                    name="nisn"
                    class="form-control"
                    maxlength="10"
                    oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                    <small class="text-danger d-none">Wajib diisi - Maksimal 10 Karakter</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control">
                    <small class="text-danger d-none">Wajib diisi</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <!-- Dengan type="email" browser otomatis mengecek harus ada @ ,format email valid -->
                    <input type="email"
                    name="email"
                    class="form-control"
                    required
                    pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$">
                    <small class="text-danger d-none">Wajib diisi dan menggunakan format contoh: nama@gmail.com</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option>Laki-laki</option>
                        <option>Perempuan</option>
                    </select>
                    <small class="text-danger d-none">Wajib diisi</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label>No HP</label>
                    <!-- Dengan type="text" tidak bisa mengetik huruf hanya angka saja dan maksimal 13 digit -->
                    <input type="text"
                    name="no_hp"
                    class="form-control"
                    maxlength="13"
                    oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                    <small class="text-danger d-none">Wajib diisi</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control">
                    <small class="text-danger d-none">Wajib diisi</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control">
                    <small class="text-danger d-none">Wajib diisi</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Asal Sekolah</label>
                    <input type="text" name="asal_sekolah" class="form-control">
                    <small class="text-danger d-none">Wajib diisi</small>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label>Tanggal Daftar</label>
                    <input type="date" name="tanggal_daftar" class="form-control">
                    <small class="text-danger d-none">Wajib diisi</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Pilih Sekolah</label>
                    <select name="id_sekolah" id="pilihan_sekolah" class="form-select">
                    <option value="">-- Pilih Sekolah Yang Diinginkan --</option>
                    <option value="1">SMK</option>
                     <option value="2">SMA</option>
                    </select>
                    <small class="text-danger d-none">Wajib diisi</small>
                </div>

                <div class="col-md-6 mb-3">
                <label>Jurusan</label>
                <select name="id_jurusan" id="jurusan" class="form-select">
                <option value="">-- Pilih Jurusan --</option>
                </select>
                <small class="text-danger d-none">Wajib diisi</small>
                </div>

                <div class="col-12 mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"></textarea>
                    <small class="text-danger d-none">Wajib diisi</small>
                </div>

                <div class="col-12">
    <div class="email-info">
        <strong>📧 Informasi Penting</strong><br>
        Pastikan email yang Anda masukkan aktif dan benar.<br>
        Hasil seleksi PPDB akan dikirim melalui email tersebut.<br>
        Jika email tidak ditemukan di <b>Inbox</b>, silakan cek folder <b>Spam</b> atau <b>Promosi</b>.
    </div>
</div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="index.php" class="btn btn-secondary text-white">Kembali</a>
            </div>
        </form>
    </div>
</div>
<script>

// ================= VALIDASI FORM =================
document.getElementById("formPPDB").addEventListener("submit", function(e){

    let valid = true;

    let inputs = document.querySelectorAll("#formPPDB input, #formPPDB select, #formPPDB textarea");

    inputs.forEach(function(input){

        let errorText = input.nextElementSibling;

        if(input.value.trim() === ""){
            valid = false;
            input.classList.add("is-invalid");

            if(errorText){
                errorText.classList.remove("d-none");
            }

        } else {

            input.classList.remove("is-invalid");

            if(errorText){
                errorText.classList.add("d-none");
            }
        }

    });

    if(!valid){
    e.preventDefault();
} else {

    let yakin = confirm(
        "Apakah kamu sudah yakin dengan data kamu yang telah diisi?\n\nPeriksa kembali data kamu sebelum dikirim."
    );

    if(!yakin){
        e.preventDefault();
    }

}

});


// ================= DROPDOWN JURUSAN =================
const pilihanSekolah = document.getElementById("pilihan_sekolah");
const jurusan = document.getElementById("jurusan");

pilihanSekolah.addEventListener("change", function(){

    if(this.value === "1"){

        jurusan.innerHTML = `
            <option value="">-- Pilih Jurusan --</option>
            <option value="1">TKJ</option>
            <option value="2">MPLB</option>
        `;

    }

    else if(this.value === "2"){

        jurusan.innerHTML = `
            <option value="">-- Pilih Jurusan --</option>
            <option value="3">IPA</option>
        `;

    }

    else{

        jurusan.innerHTML = `
            <option value="">-- Pilih Jurusan --</option>
        `;

    }

});

</script>

</body>
</html>