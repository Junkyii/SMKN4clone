
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
        alertMessage.textContent = "Silakan isi username dan password Anda.";
        alertMessage.style.display = "block"; 
        errorUser.textContent = "Username wajib diisi.";
        errorPass.textContent = "Password wajib diisi.";
        
        valid = false; 
        return; 
      }

      if (usernameTxt === "") {
        alert("Username masih kosong!");
        alertMessage.textContent = "Username belum diisi.";
        alertMessage.style.display = "block";  
        errorUser.textContent = "Username wajib diisi.";
        
        usernameInput.focus();

        valid = false; 
        return; 
      }

      if (passwordTxt === "") {
        alert("Password masih kosong!");
        alertMessage.textContent = "Password belum diisi.";
        alertMessage.style.display = "block";
        errorPass.textContent = "Password wajib diisi.";
        
        passwordInput.focus(); 
        
        valid = false; 
        return; 
      }

      if (valid === true) {
        successMessage.textContent = "Login berhasil! Anda akan dialihkan ke dashboard.";
        successMessage.style.display = "block"; 
        
        alert("Login berhasil! Selamat datang, " + usernameTxt);

        localStorage.setItem("loggedInAdmin", usernameTxt);

        window.location.href = "index.html";
      }
    });
  }

  var loggedInAdmin = localStorage.getItem("loggedInAdmin");
  var btnLogin = document.querySelector('.btn-login');
  var logoutLi = document.getElementById('logoutLi');
  var btnLogout = document.getElementById('btnLogout');
  
  if (loggedInAdmin && btnLogin) {
    btnLogin.textContent = "Admin: " + loggedInAdmin;
    btnLogin.href = "#"; 

    if (logoutLi && btnLogout) {
      logoutLi.style.display = "inline-block";
      
      btnLogout.addEventListener('click', function(event) {
        event.preventDefault(); 
        
        localStorage.removeItem("loggedInAdmin");
        
        alert("Anda telah berhasil Log Out dari akun Admin!");
        
        window.location.reload();
      });
    }
  }

  var revealElements = document.querySelectorAll('.card, .info-box, .gallery-card, .section-title');
  
  revealElements.forEach(function(el) {
    el.classList.add('scroll-reveal');
  });

  var scrollObserver = new IntersectionObserver(function(entries, obs) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('active');
        obs.unobserve(entry.target); 
      }
    });
  }, {
    threshold: 0.15,
    rootMargin: "0px 0px -50px 0px"
  });

  revealElements.forEach(function(el) {
    scrollObserver.observe(el);
  });

  var mobileToggle = document.getElementById('mobileToggle');
  var navMenu = document.getElementById('navMenu');
  if (mobileToggle && navMenu) {
    mobileToggle.addEventListener('click', function() {
      navMenu.classList.toggle('active');
    });
  }

  var togglePassword = document.getElementById('togglePassword');
  var passwordInputEl = document.getElementById('passwordInput');
  if (togglePassword && passwordInputEl) {
    togglePassword.addEventListener('click', function() {
      var type = passwordInputEl.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInputEl.setAttribute('type', type);
      this.textContent = type === 'password' ? 'Tampilkan' : 'Sembunyikan';
    });
  }

  var counters = document.querySelectorAll('.counter');
  var counterObserver = new IntersectionObserver(function(entries, observer) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        var counter = entry.target;
        var updateCount = function() {
          var target = +counter.getAttribute('data-target');
          var count = +counter.innerText;
          var speed = 200; 
          var inc = target / speed;
          if (count < target) {
            counter.innerText = Math.ceil(count + inc);
            setTimeout(updateCount, 15);
          } else {
            counter.innerText = target;
          }
        };
        updateCount();
        observer.unobserve(counter);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach(function(counter) {
    counterObserver.observe(counter);
  });

  var sections = document.querySelectorAll('.hero, #jurusan, #info, #galeri');
  var navLinks = document.querySelectorAll('.nav-menu li a');

  var scrollSpy = function() {
    var scrollPos = window.scrollY || document.documentElement.scrollTop;
    
    sections.forEach(function(section) {
      if (scrollPos >= section.offsetTop - window.innerHeight / 3 && 
          scrollPos < section.offsetTop + section.offsetHeight) {
        var id = section.getAttribute('id');
        if (!id && section.classList.contains('hero')) id = 'beranda';
        
        navLinks.forEach(function(link) {
          link.classList.remove('active');
          if (link.getAttribute('href') === '#' + id) {
            link.classList.add('active');
          }
        });
      }
    });
  };

  if (sections.length > 0) {
    window.addEventListener('scroll', scrollSpy);
    scrollSpy();
  }

});

