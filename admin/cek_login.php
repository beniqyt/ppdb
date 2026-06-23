<?php
session_start();
include '../koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$data = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($data);

if($cek > 0){
    $_SESSION['username'] = $username;
    header("location:dashboard.php");
}else{
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Gagal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg, #2563eb, #1e3a8a);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .error-card{
            background: white;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            animation: muncul 0.4s ease;
        }

        @keyframes muncul{
            from{
                opacity: 0;
                transform: translateY(20px);
            }
            to{
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-icon{
            font-size: 70px;
            margin-bottom: 15px;
        }

        h2{
            color: #dc2626;
            font-weight: bold;
            margin-bottom: 10px;
        }

        p{
            color: #64748b;
            margin-bottom: 25px;
        }

        .btn-kembali{
            background: #2563eb;
            color: white;
            padding: 12px 25px;
            border-radius: 10px;
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
        }

        .btn-kembali:hover{
            background: #1d4ed8;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <div class="error-card">
        <div class="error-icon">❌</div>

        <h2>Login Gagal</h2>

        <p>
            Username atau password yang anda masukkan salah.
        </p>

        <a href="login.php" class="btn-kembali">
            Kembali ke Login
        </a>
    </div>

</body>
</html>
<?php
}
?>