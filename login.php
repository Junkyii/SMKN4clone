<?php
session_start();
include 'koneksi.php';


$pesan_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $pesan_error = "Username dan password wajib diisi!";
    } else {
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($koneksi, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            $_SESSION['user_login'] = $user['username'];
            $_SESSION['user_role'] = $user['role'];

            echo "<script>
                alert('Login berhasil! Selamat datang, " . htmlspecialchars($user['username']) . "');
                window.location.href = 'index.php';
            </script>";
            exit;
        } else {
            echo "<script>alert('Login gagal! Username atau password salah.');</script>";
            $pesan_error = "Username atau password salah.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login — SMKN 4 Bandung</title>
  <meta name="description" content="Halaman login portal akses sistem informasi SMKN 4 Bandung." />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=DM+Serif+Display&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css?v=2" />
  <style>
    .login-divider {
      display: flex;
      align-items: center;
      gap: 14px;
      margin: 24px 0;
      color: var(--clr-text-muted);
      font-size: 12px;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .login-divider::before,
    .login-divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--clr-border);
    }
    .link-register {
      display: block;
      text-align: center;
      margin-top: 16px;
      font-size: 14px;
      color: var(--clr-text-muted);
      font-weight: 500;
    }
    .link-register a {
      color: var(--clr-text);
      font-weight: 600;
    }
    .link-register a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body class="login-body">

  <div class="login-box">
    
    <div class="login-header">
      <a href="index.php">
        <img src="src/logo4.png" alt="Logo SMKN 4 Bandung" />
      </a>
      <h2>Login Sistem</h2>
      <p>Masukkan username dan password Anda.</p>
    </div>

    <?php if (!empty($pesan_error)): ?>
      <div class="alert-message" style="display: block;">
        <?php echo $pesan_error; ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="login.php" id="formLogin">
      
      <div class="form-group">
        <label for="usernameInput">Username (NIS)</label>
        <input type="text" id="usernameInput" name="username" placeholder="Masukkan NIS Anda" required />
      </div>

      <div class="form-group">
        <label for="passwordInput">Password</label>
        <div class="password-wrapper">
          <input type="password" id="passwordInput" name="password" placeholder="Masukkan password" required />
          <span class="password-toggle" id="togglePassword">Tampilkan</span>
        </div>
      </div>

      <button type="submit" class="btn-submit">Login</button>

    </form>

    <div class="login-divider">atau</div>

    <p class="link-register">Belum punya akun? <a href="data_siswa.php">Daftar sebagai Siswa</a></p>

    <a href="index.php" class="back-link">← Kembali ke Beranda</a>

  </div>

  <script>
    var togglePassword = document.getElementById('togglePassword');
    var passwordInput = document.getElementById('passwordInput');
    if (togglePassword && passwordInput) {
      togglePassword.addEventListener('click', function() {
        var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.textContent = type === 'password' ? 'Tampilkan' : 'Sembunyikan';
      });
    }
  </script>

</body>
</html>
