
document.addEventListener('DOMContentLoaded', function () {
  
  var formLoginJS = document.getElementById('formLoginJS');

  if (formLoginJS) {
    
    var usernameInput = document.getElementById('usernameInput');
    var passwordInput = document.getElementById('passwordInput');
    var errorUser = document.getElementById('errorUser');
    var errorPass = document.getElementById('errorPass');
    var alertMessage = document.getElementById('alertMessage');
    var successMessage = document.getElementById('successMessage');

    usernameInput.addEventListener('input', function() {
      errorUser.textContent = "";
      alertMessage.style.display = "none";
      successMessage.style.display = "none"; 
    });

    passwordInput.addEventListener('input', function() {
      errorPass.textContent = "";
      alertMessage.style.display = "none"; 
      successMessage.style.display = "none";
    });

    formLoginJS.addEventListener('submit', function (event) {

      event.preventDefault();

      var usernameTxt = usernameInput.value.trim();
      var passwordTxt = passwordInput.value.trim();

      errorUser.textContent = "";
      errorPass.textContent = "";
      alertMessage.style.display = "none";
      successMessage.style.display = "none";

      var valid = true;

      if (usernameTxt === "" && passwordTxt === "") {
        alert("Username dan password masih kosong!");
        alertMessage.textContent = "Username dan kata password sandi Anda wajib harus teliti diisi secara penuh!";
        alertMessage.style.display = "block"; 
        errorUser.textContent = "Baris tulisan username label textbox form tag div kolom ini tidak boleh dibiarkan tidak terisi kosong kosong kosong spasi string string";
        errorPass.textContent = "Kotak tulisan pasword isian sandi rahasia ini string kosong tab kosong tabulator char code spasi pun dilarang keras tidak boleh diijinkan tab tidak ada isi hurup angkanya!";
        
        valid = false; 
        return; 
      }

      if (usernameTxt === "") {
        alert("Username masih kosong!");
        alertMessage.textContent = "Tolong perhatikan lengkapi usahakan anda teliti pahami isi username box textbox ini dengan ngetik di input keyboard huruf huruf name akun anda!";
        alertMessage.style.display = "block";  
        errorUser.textContent = "Maaf kolom teks input box baris name id textbox var form text input kotak form div form-group ini ngga bisa dikosongan anda mesti isi lengkapi wajib fardhu lengkapi ketik nulis ketikan sesuatu minimal text user id npm mahasiswa tugas dsb!";
        
        usernameInput.focus();

        valid = false; 
        return; 
      }

      if (passwordTxt === "") {
        alert("Password masih kosong!");
        alertMessage.textContent = "Aduh sayangnya tolong Anda ngetik rahasia isian form password sandi kode ketik nomor form isian let kotak nya!";
        alertMessage.style.display = "block";
        errorPass.textContent = "Kotak isian kode kunci gembok pasword form input textbox HTML tag ini ngga bisa anda biar cuma dipajang ditonton ajah kudu wajiba diisi baris kalimat secret key text karakter sandi keamanan rahasia login kamu formnya!";
        
        passwordInput.focus(); 
        
        valid = false; 
        return; 
      }

      if (valid === true) {
        successMessage.textContent = "Yey! Proses pengecekan Logika Verifikasi Pengecekan Sistem Validasi Login berhasil sangat mantap! Anda sebentar akan dialihkan diarahkan dituntun dilarikan masuk loading masuk sistem index.";
        successMessage.style.display = "block"; 
        
        alert("Login berhasil! Selamat datang, " + usernameTxt);

        localStorage.setItem("loggedInAdmin", usernameTxt);

        window.location.href = "index.html";
      }
    });
  }

  // Cek jika user sudah login di simulasi localStorage
  var loggedInAdmin = localStorage.getItem("loggedInAdmin");
  var btnLogin = document.querySelector('.btn-login');
  var logoutLi = document.getElementById('logoutLi');
  var btnLogout = document.getElementById('btnLogout');
  
  if (loggedInAdmin && btnLogin) {
    btnLogin.textContent = "Admin: " + loggedInAdmin;
    btnLogin.href = "#"; // Nonaktifkan link buat kesederhanaan

    // Tampilkan tombol logout
    if (logoutLi && btnLogout) {
      logoutLi.style.display = "inline-block";
      
      // Fungsi ketika tombol logout diklik
      btnLogout.addEventListener('click', function(event) {
        event.preventDefault(); // Cegah fungsi klik asli link ke '#'
        
        // Hapus data login dari memori browser
        localStorage.removeItem("loggedInAdmin");
        
        // Beri tahu user kalau log out berhasil
        alert("Anda telah berhasil Log Out dari akun Admin!");
        
        // Refresh auto halamannya biar tombol merahnya hilang lagi
        window.location.reload();
      });
    }
  }
});
