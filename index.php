<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SMKN 4 Bandung — Portal Resmi</title>
  <meta name="description" content="Portal resmi SMKN 4 Bandung. Informasi program keahlian, berita sekolah, dan galeri kegiatan." />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css?v=2" />
  <link rel="preload" as="image" href="src/opat.png" fetchpriority="high">
</head>
<body>

  <div class="navbar">
    <div class="container">
      <a href="index.php" class="nav-brand">
        <img src="src/logo4.png" alt="Logo SMKN 4 Bandung" class="nav-logo-img" />
        <div>
          <h1>SMKN 4 BANDUNG</h1>
          <p>Sekolah Menengah Kejuruan Negeri</p>
        </div>
      </a>

      <div class="mobile-toggle" id="mobileToggle">
        <span></span>
        <span></span>
        <span></span>
      </div>

      <ul class="nav-menu" id="navMenu">
        <li><a href="#beranda">Beranda</a></li>
        <li><a href="#jurusan">Jurusan</a></li>
        <li><a href="#info">Informasi</a></li>
        <li><a href="#galeri">Galeri</a></li>
        <li><a href="data_siswa.php">Data Siswa</a></li>
        <?php if (isset($_SESSION['user_login'])): ?>
          <li><a href="#" class="btn-login"><?php echo htmlspecialchars($_SESSION['user_login']); ?></a></li>
          <li><a href="logout.php" style="color: var(--clr-danger); font-weight: 600; padding: 8px 14px;">Logout</a></li>
        <?php else: ?>
          <li><a href="login.php" class="btn-login">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>

  <div class="hero" id="beranda">
    <div class="container">
      <h2>Selamat Datang di<br>SMKN 4 Bandung</h2>
      <p>Membentuk generasi unggul, terampil, dan berkarakter melalui pendidikan kejuruan yang relevan dengan kebutuhan industri.</p>
      <a href="#jurusan" class="btn-primary">Lihat Program Jurusan</a>
    </div>
  </div>

  <div class="stats-section scroll-reveal" id="stats">
    <div class="container stats-container">
      <div class="stat-box">
        <h3 class="counter" data-target="2500">0</h3>
        <p>Siswa Aktif</p>
      </div>
      <div class="stat-box">
        <h3 class="counter" data-target="150">0</h3>
        <p>Guru & Staf</p>
      </div>
      <div class="stat-box">
        <h3 class="counter" data-target="6">0</h3>
        <p>Jurusan</p>
      </div>
      <div class="stat-box">
        <h3 class="counter" data-target="62">0</h3>
        <p>Tahun Berdiri</p>
      </div>
    </div>
  </div>

  <div class="container" id="jurusan">
    
    <div class="text-center">
      <h2 class="section-title">Program Keahlian</h2>
    </div>
    
    <div class="card-container">
      
      <div class="card">
        <h3>Teknik Instalasi Tenaga Listrik</h3>
        <p>Mempelajari dasar teknik kelistrikan, sistem instalasi penerangan, dan pemeliharaan tenaga listrik industri.</p>
        <span class="badge">TITL</span>
      </div>
      
      <div class="card">
        <h3>Teknik Otomasi Industri</h3>
        <p>Mempelajari sistem kontrol otomatis, pemrograman PLC, pneumatik, dan robotika industri.</p>
        <span class="badge">TOI</span>
      </div>
    
      <div class="card">
        <h3>Teknik Audio Video</h3>
        <p>Mempelajari elektronika dasar, perakitan perangkat audio video, dan perbaikan perangkat komunikasi.</p>
        <span class="badge">TAV</span>
      </div>
      
      <div class="card">
        <h3>Rekayasa Perangkat Lunak</h3>
        <p>Mempelajari pengembangan perangkat lunak, website, mobile app, dan manajemen database.</p>
        <span class="badge">RPL</span>
      </div>

      <div class="card">
        <h3>Teknik Jaringan Komputer & Telekomunikasi</h3>
        <p>Mempelajari instalasi perangkat komputer, administrasi jaringan, dan infrastruktur telekomunikasi.</p>
        <span class="badge">TJKT</span>
      </div>

      <div class="card">
        <h3>Desain Komunikasi Visual</h3>
        <p>Mempelajari desain grafis, editing video, fotografi komersial, dan pembuatan animasi 2D/3D.</p>
        <span class="badge">DKV</span>
      </div>
    </div>

  </div>

  <div class="info-section" id="info">
    <div class="container">
      
      <div class="text-center">
        <h2 class="section-title">Berita & Pengumuman</h2>
      </div>

      <div class="info-box">
        <h4>Pendaftaran Peserta Didik Baru (PPDB) 2026</h4>
        <p class="info-meta">15 April 2026 &nbsp;·&nbsp; Admin Sekolah</p>
        <p>Pendaftaran PPDB SMKN 4 Bandung tahun ajaran 2026/2027 telah resmi dibuka. Calon siswa dapat mendaftar secara online melalui jalur prestasi, afirmasi, atau zonasi.</p>
      </div>

      <div class="info-box">
        <h4>Jadwal Ujian Praktik Nasional</h4>
        <p class="info-meta">10 April 2026 &nbsp;·&nbsp; Humas Kurikulum</p>
        <p>Ujian Praktik Nasional akan dilaksanakan secara tatap muka di laboratorium masing-masing jurusan. Seluruh siswa kelas 12 wajib hadir sesuai jadwal.</p>
      </div>

    </div>
  </div>

  <div class="container" id="galeri" style="padding-top: 50px;">
    
    <div class="text-center">
      <h2 class="section-title">Galeri</h2>
    </div>

    <div class="gallery-container">
      <div class="gallery-card">
        <div class="gal-text">Upacara Bendera Senin</div>
      </div>
      <div class="gallery-card">
        <img src="src/praktek.png" alt="Praktek Lab Komputer" class="gal-img" />
        <div class="gal-caption">Praktek Lab Komputer</div>
      </div>
      <div class="gallery-card">
        <div class="gal-text">Praktek Mesin Bengkel</div>
      </div>
      <div class="gallery-card">
        <div class="gal-text">Lomba Futsal</div>
      </div>
      <div class="gallery-card">
        <div class="gal-text">Kunjungan Industri</div>
      </div>
      <div class="gallery-card">
        <div class="gal-text">Rapat OSIS MPK</div>
      </div>
    </div>

  </div>

  <footer>
    <div class="container">
      <div class="footer-content">
        
        <div class="footer-col">
          <h4>SMKN 4 Bandung</h4>
          <p>Menjadi sekolah kejuruan unggulan yang mencetak lulusan terampil, kompeten, dan siap bersaing di era industri digital.</p>
        </div>
        
        <div class="footer-col">
          <h4>Navigasi</h4>
          <ul>
            <li><a href="#beranda">Beranda</a></li>
            <li><a href="#jurusan">Program Jurusan</a></li>
            <li><a href="#info">Berita</a></li>
            <li><a href="#galeri">Galeri</a></li>
            <li><a href="login.php">Login</a></li>
          </ul>
        </div>
        
        <div class="footer-col">
          <h4>Kontak</h4>
          <p>Jl. Kliningan No.6, Turangga, Lengkong, Kota Bandung 40264</p>
          <p>Telp: (022) 7303736</p>
          <p>Email: humas@smkn4bdg.sch.id</p>
        </div>

      </div>

      <div class="footer-bottom">
        <p>&copy; 2026 SMKN 4 Bandung. All rights reserved.</p>
      </div>

    </div>
  </footer>

  <script src="script.js"></script>

</body>
</html>
