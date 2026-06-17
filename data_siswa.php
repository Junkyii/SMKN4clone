<?php
session_start();
include 'koneksi.php';

$daftar_kelas = array(
    "X RPL 1", "X RPL 2",
    "X TJKT 1", "X TJKT 2",
    "X DKV 1", "X DKV 2",
    "X TITL 1", "X TITL 2",
    "X TOI 1", "X TOI 2",
    "X TAV 1", "X TAV 2",
    "XI RPL 1", "XI RPL 2",
    "XI TJKT 1", "XI TJKT 2",
    "XI DKV 1", "XI DKV 2",
    "XI TITL 1", "XI TITL 2",
    "XI TOI 1", "XI TOI 2",
    "XI TAV 1", "XI TAV 2",
    "XII RPL 1", "XII RPL 2",
    "XII TJKT 1", "XII TJKT 2",
    "XII DKV 1", "XII DKV 2",
    "XII TITL 1", "XII TITL 2",
    "XII TOI 1", "XII TOI 2",
    "XII TAV 1", "XII TAV 2"
);

$pesan_sukses = "";
$pesan_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $password = $_POST['password'];

    if (empty($nama_lengkap) || empty($nis) || empty($kelas) || empty($jenis_kelamin) || empty($alamat) || empty($password)) {
        $pesan_error = "Semua field wajib diisi!";
    } else {
        $cek_nis = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis = '$nis'");
        if (mysqli_num_rows($cek_nis) > 0) {
            $pesan_error = "NIS '$nis' sudah terdaftar! Gunakan NIS yang lain.";
        } else {
            $query_siswa = "INSERT INTO siswa (nama_lengkap, nis, kelas, jenis_kelamin, alamat) 
                            VALUES ('$nama_lengkap', '$nis', '$kelas', '$jenis_kelamin', '$alamat')";
            $simpan_siswa = mysqli_query($koneksi, $query_siswa);

            $query_users = "INSERT INTO users (username, password, role) 
                            VALUES ('$nis', '$password', 'siswa')";
            $simpan_users = mysqli_query($koneksi, $query_users);

            if ($simpan_siswa && $simpan_users) {
                $pesan_sukses = "Data siswa '$nama_lengkap' berhasil didaftarkan!";
            } else {
                $pesan_error = "Gagal menyimpan data: " . mysqli_error($koneksi);
            }
        }
    }
}


$data_siswa = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pendaftaran Siswa — SMKN 4 Bandung</title>
  <meta name="description" content="Halaman pendaftaran dan data siswa SMKN 4 Bandung." />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="style.css?v=3" />
  <style>
    .page-wrapper {
      min-height: 100vh;
      background: linear-gradient(135deg, #fafaf9 0%, #f5f5f4 100%);
    }

    .page-header {
      background: var(--clr-surface);
      border-bottom: 1px solid var(--clr-border-light);
      padding: 48px 24px;
      text-align: center;
    }
    .page-header h2 {
      font-family: var(--font-serif);
      color: var(--clr-text);
      font-size: 28px;
      font-weight: 500;
      margin-bottom: 6px;
      letter-spacing: -0.5px;
    }
    .page-header p {
      color: var(--clr-text-muted);
      font-size: 14px;
      font-weight: 400;
    }

    .content-container {
      max-width: 720px;
      margin: -24px auto 0;
      padding: 0 24px 64px;
      position: relative;
      z-index: 10;
    }

    .alert {
      padding: 12px 18px;
      border-radius: var(--radius-md);
      font-size: 13px;
      font-weight: 500;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 8px;
      animation: slideDown 0.3s ease;
    }
    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .alert-success {
      background: var(--clr-success-soft);
      color: var(--clr-success);
      border-left: 3px solid var(--clr-success);
    }
    .alert-error {
      background: var(--clr-danger-soft);
      color: var(--clr-danger);
      border-left: 3px solid var(--clr-danger);
    }

    .form-card {
      background: var(--clr-surface);
      border: 1px solid var(--clr-border);
      border-radius: var(--radius-xl);
      padding: 36px 32px;
      margin-bottom: 32px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.06);
    }
    .form-card h3 {
      font-family: var(--font-serif);
      font-size: 20px;
      font-weight: 500;
      color: var(--clr-text);
      margin-bottom: 6px;
    }
    .form-card .form-subtitle {
      color: var(--clr-text-muted);
      font-size: 13px;
      margin-bottom: 28px;
      line-height: 1.5;
    }

    .form-grid {
      display: flex;
      flex-direction: column;
      gap: 18px;
    }

    .input-group {
      display: flex;
      flex-direction: column;
    }
    .input-group label {
      font-weight: 600;
      font-size: 13px;
      color: var(--clr-text);
      margin-bottom: 7px;
      letter-spacing: -0.2px;
    }
    .input-group label .required {
      color: var(--clr-danger);
      margin-left: 2px;
    }
    .input-group input,
    .input-group select,
    .input-group textarea {
      padding: 12px 16px;
      border: 1.5px solid var(--clr-border);
      border-radius: var(--radius-md);
      font-size: 14px;
      font-family: var(--font-sans);
      color: var(--clr-text);
      background: var(--clr-surface);
      transition: all var(--transition);
      outline: none;
    }
    .input-group input:focus,
    .input-group select:focus,
    .input-group textarea:focus {
      border-color: var(--clr-text);
      box-shadow: 0 0 0 3px rgba(28,25,23,0.08);
    }
    .input-group input::placeholder,
    .input-group textarea::placeholder {
      color: var(--clr-text-muted);
      font-weight: 400;
    }
    .input-group textarea {
      resize: vertical;
      min-height: 90px;
      font-family: var(--font-sans);
      line-height: 1.6;
    }
    .input-group select {
      cursor: pointer;
      appearance: none;
      -webkit-appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%231c1917' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 16px center;
      padding-right: 42px;
      font-weight: 500;
    }

    .radio-group {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
      margin-top: 4px;
    }
    .radio-option {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      cursor: pointer;
      padding: 12px 16px;
      border: 1.5px solid var(--clr-border);
      border-radius: var(--radius-md);
      transition: all var(--transition);
      background: var(--clr-surface);
    }
    .radio-option:hover {
      border-color: var(--clr-text);
      background: var(--clr-surface-alt);
    }
    .radio-option:has(input:checked) {
      border-color: var(--clr-text);
      background: var(--clr-text);
    }
    .radio-option:has(input:checked) span {
      color: #fff;
      font-weight: 600;
    }
    .radio-option input[type="radio"] {
      accent-color: #fff;
      width: 18px;
      height: 18px;
      cursor: pointer;
    }
    .radio-option span {
      font-size: 14px;
      color: var(--clr-text);
      font-weight: 500;
    }

    .btn-daftar {
      background: var(--clr-text);
      color: #fff;
      border: none;
      padding: 14px 28px;
      border-radius: var(--radius-md);
      font-size: 14px;
      font-weight: 600;
      font-family: var(--font-sans);
      cursor: pointer;
      transition: all var(--transition);
      margin-top: 12px;
      width: 100%;
      letter-spacing: -0.2px;
    }
    .btn-daftar:hover {
      background: var(--clr-accent-hover);
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(28,25,23,0.15);
    }
    .btn-daftar:active {
      transform: translateY(0);
    }

    .table-card {
      background: var(--clr-surface);
      border: 1px solid var(--clr-border);
      border-radius: var(--radius-xl);
      padding: 36px 32px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.06);
    }
    .table-card h3 {
      font-family: var(--font-serif);
      font-size: 20px;
      font-weight: 500;
      color: var(--clr-text);
      margin-bottom: 6px;
    }
    .table-card .table-subtitle {
      color: var(--clr-text-muted);
      font-size: 13px;
      margin-bottom: 24px;
    }

    .table-responsive {
      overflow-x: auto;
      border-radius: var(--radius-md);
      border: 1px solid var(--clr-border-light);
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }
    .data-table thead {
      background: var(--clr-surface-alt);
    }
    .data-table thead th {
      color: var(--clr-text-muted);
      font-weight: 600;
      padding: 12px 16px;
      text-align: left;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      border-bottom: 1px solid var(--clr-border-light);
      white-space: nowrap;
    }
    .data-table tbody tr {
      border-bottom: 1px solid var(--clr-border-light);
      transition: background var(--transition);
    }
    .data-table tbody tr:last-child {
      border-bottom: none;
    }
    .data-table tbody tr:hover {
      background: rgba(245,245,244,0.5);
    }
    .data-table tbody td {
      padding: 14px 16px;
      color: var(--clr-text);
      vertical-align: middle;
      font-size: 13px;
    }

    .badge-gender {
      display: inline-block;
      padding: 4px 12px;
      border-radius: 100px;
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.2px;
    }
    .badge-l {
      background: var(--clr-highlight-soft);
      color: var(--clr-highlight);
    }
    .badge-p {
      background: #fdf2f8;
      color: #be185d;
    }

    .empty-state {
      text-align: center;
      padding: 56px 20px;
      color: var(--clr-text-muted);
    }
    .empty-state .empty-icon {
      font-size: 32px;
      margin-bottom: 16px;
      opacity: 0.3;
    }
    .empty-state p {
      font-size: 14px;
      font-weight: 600;
      color: var(--clr-text-secondary);
    }
    .empty-state small {
      font-size: 13px;
      color: var(--clr-text-muted);
      display: block;
      margin-top: 6px;
    }

    .nav-back-container {
      text-align: center;
      margin-top: 36px;
    }
    .nav-back {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: var(--clr-text-muted);
      font-weight: 500;
      font-size: 14px;
      padding: 10px 24px;
      border-radius: var(--radius-md);
      border: 1.5px solid var(--clr-border);
      background: var(--clr-surface);
      transition: all var(--transition);
    }
    .nav-back:hover {
      color: var(--clr-text);
      border-color: var(--clr-text);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }

    @media (max-width: 768px) {
      .radio-group {
        grid-template-columns: 1fr;
        gap: 8px;
      }
      .form-card, .table-card {
        padding: 28px 20px;
        border-radius: var(--radius-lg);
      }
      .content-container {
        max-width: 100%;
      }
      .page-header {
        padding: 48px 20px 40px;
      }
      .page-header h2 {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>
  <div class="page-wrapper">

    <div class="navbar">
      <div class="container">
        <a href="index.php" class="nav-brand">
          <img src="src/logo4.png" alt="Logo SMKN 4 Bandung" class="nav-logo-img" />
          <div>
            <h1>SMKN 4 BANDUNG</h1>
            <p>Sekolah Menengah Kejuruan Negeri</p>
          </div>
        </a>
        <ul class="nav-menu">
          <li><a href="index.php">Beranda</a></li>
          <li><a href="data_siswa.php" class="active">Data Siswa</a></li>
          <li><a href="login.php" class="btn-login">Login</a></li>
        </ul>
      </div>
    </div>

    <div class="page-header">
      <h2>Pendaftaran Siswa Baru</h2>
      <p>Lengkapi formulir untuk mendaftarkan siswa baru ke sistem</p>
    </div>

    <div class="content-container">

      <?php if (!empty($pesan_sukses)): ?>
        <div class="alert alert-success">
          <span>✓</span>
          <?php echo $pesan_sukses; ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($pesan_error)): ?>
        <div class="alert alert-error">
          <span>✕</span>
          <?php echo $pesan_error; ?>
        </div>
      <?php endif; ?>

      <div class="form-card">
        <h3>Form Pendaftaran</h3>
        <p class="form-subtitle">Semua field bertanda <span style="color: var(--clr-danger);">*</span> wajib diisi.</p>

        <form method="POST" action="data_siswa.php" id="formPendaftaran">
          <div class="form-grid">

            <div class="input-group">
              <label for="nama_lengkap">Nama Lengkap <span class="required">*</span></label>
              <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" required />
            </div>

            <div class="input-group">
              <label for="nis">NIS <span class="required">*</span></label>
              <input type="text" id="nis" name="nis" placeholder="Contoh: 20260001" required />
            </div>

            <div class="input-group">
              <label for="kelas">Kelas <span class="required">*</span></label>
              <select id="kelas" name="kelas" required>
                <option value="" disabled selected>Pilih kelas</option>
                <?php foreach ($daftar_kelas as $kelas_item): ?>
                  <option value="<?php echo $kelas_item; ?>"><?php echo $kelas_item; ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="input-group">
              <label>Jenis Kelamin <span class="required">*</span></label>
              <div class="radio-group">
                <label class="radio-option">
                  <input type="radio" name="jenis_kelamin" value="Laki-laki" required />
                  <span>Laki-laki</span>
                </label>
                <label class="radio-option">
                  <input type="radio" name="jenis_kelamin" value="Perempuan" />
                  <span>Perempuan</span>
                </label>
              </div>
            </div>

            <div class="input-group">
              <label for="alamat">Alamat <span class="required">*</span></label>
              <textarea id="alamat" name="alamat" placeholder="Masukkan alamat lengkap" required></textarea>
            </div>

            <div class="input-group">
              <label for="password">Password <span class="required">*</span></label>
              <input type="password" id="password" name="password" placeholder="Buat password untuk login" required minlength="4" />
            </div>

            <button type="submit" class="btn-daftar">Daftarkan Siswa</button>

          </div>
        </form>
      </div>

      <div class="table-card">
        <h3>Data Siswa Terdaftar</h3>
        <p class="table-subtitle">
          Menampilkan <?php echo mysqli_num_rows($data_siswa); ?> siswa yang terdaftar.
        </p>

        <?php if (mysqli_num_rows($data_siswa) > 0): ?>
          <div class="table-responsive">
            <table class="data-table" id="tabelSiswa">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>NIS</th>
                  <th>Kelas</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($data_siswa)): ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td style="font-weight: 600;"><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
                    <td><code style="background: var(--clr-surface-alt); padding: 3px 8px; border-radius: 4px; font-size: 13px; font-weight: 600;"><?php echo htmlspecialchars($row['nis']); ?></code></td>
                    <td><?php echo htmlspecialchars($row['kelas']); ?></td>
                    <td>
                      <span class="badge-gender <?php echo ($row['jenis_kelamin'] == 'Laki-laki') ? 'badge-l' : 'badge-p'; ?>">
                        <?php echo htmlspecialchars($row['jenis_kelamin']); ?>
                      </span>
                    </td>
                    <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        <?php else: ?>
          <div class="empty-state">
            <div class="empty-icon">—</div>
            <p>Belum ada data siswa</p>
            <small>Daftarkan siswa baru melalui form di atas.</small>
          </div>
        <?php endif; ?>
      </div>

      <div class="nav-back-container">
        <a href="index.php" class="nav-back">← Kembali ke Beranda</a>
      </div>

    </div>
  </div>

</body>
</html>
