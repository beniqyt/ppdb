<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="login-box">
    <!-- LOGO -->
    <div class="logo-area">
        <img src="../img/logosmk.png" class="logo-sekolah">
        <img src="../img/logosma.png" class="logo-sekolah">
    </div>

    <div class="judul-sekolah">
        Yayasan Suluk Insan Kamil Tartila
    </div>

    <h2>Login Admin</h2>

    <form action="cek_login.php" method="POST" id="formLogin" novalidate>
        <div class="input-group-custom">
            <i class="bi bi-person-fill"></i>
            <input
            type="text"
            id="username"
            name="username"
            placeholder="Masukkan Username">
        </div>
        <small id="userError" class="error-text">
            Masukkan Username terlebih dahulu
        </small>

        <div class="input-group-custom">
            <i class="bi bi-lock-fill"></i>
            <input
            type="password"
            id="password"
            name="password"
            placeholder="Masukkan Password">

    <span onclick="togglePassword()" class="toggle-pass">
    <i id="eyeIcon" class="bi bi-eye-slash-fill"></i>
</span>
</div>

<small id="passError" class="error-text">
    Masukkan Password terlebih dahulu
</small>

        <button type="submit">
            Login
        </button>

    </form>

    <div class="footer-login">
        @2026 Sistem Informasi PPDB Online
    </div>

</div>
<script>

document.getElementById("formLogin")
.addEventListener("submit", function(e){

    let valid = true;

    let username = document.getElementById("username");
    let password = document.getElementById("password");

    let userError = document.getElementById("userError");
    let passError = document.getElementById("passError");

    userError.style.display = "none";
    passError.style.display = "none";

    username.classList.remove("input-error");
    password.classList.remove("input-error");

    if(username.value.trim() == ""){

        userError.style.display = "block";
        username.classList.add("input-error");

        valid = false;
    }

    if(password.value.trim() == ""){

        passError.style.display = "block";
        password.classList.add("input-error");

        valid = false;
    }

    if(!valid){
        e.preventDefault();
    }

});

</script>
<script>
    /* untuk bagian mata */
function togglePassword(){

    let password = document.getElementById("password");
    let eyeIcon = document.getElementById("eyeIcon");

    if(password.type === "password"){

        password.type = "text";

        eyeIcon.classList.remove("bi-eye-slash-fill");
        eyeIcon.classList.add("bi-eye-fill");

    }else{

        password.type = "password";

        eyeIcon.classList.remove("bi-eye-fill");
        eyeIcon.classList.add("bi-eye-slash-fill");

    }

}
</script>
</body>
</html>