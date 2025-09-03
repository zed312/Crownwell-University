
document.addEventListener('DOMContentLoaded', function() {
  const tabLinks = document.querySelectorAll('.tab-link');
  const tabContents = document.querySelectorAll('.tab-content');
  tabLinks.forEach(function(link) {
      link.addEventListener('click', function(e) {
          e.preventDefault();
          tabLinks.forEach(function(tab) {
              tab.classList.remove('active');
          });
          tabContents.forEach(function(content) {
              content.classList.remove('active');
          });
          this.classList.add('active');
          const tabId = this.getAttribute('data-tab');
          document.getElementById(tabId).classList.add('active');
          window.location.hash = tabId;
          window.scrollTo({
              top: 200,
              behavior: 'smooth'
          });
      });
  });
  
  if (window.location.hash) {
      const hash = window.location.hash.substring(1);
      const correspondingTab = document.querySelector(`.tab-link[data-tab="${hash}"]`);
      if (correspondingTab) {
          tabLinks.forEach(function(tab) {
              tab.classList.remove('active');
          });
          tabContents.forEach(function(content) {
              content.classList.remove('active');
          });
          correspondingTab.classList.add('active');
          document.getElementById(hash).classList.add('active');
      }
  }
  
});

function showForm(formId) {
  document.querySelectorAll(".form-box").forEach(form => form.classList.remove("active"));
  document.getElementById(formId).classList.add("active");
}

// Calculate Age from Birthday
document.getElementById("birthday").addEventListener("change", function() {
  const birthDate = new Date(this.value);
  const today = new Date();
  let age = today.getFullYear() - birthDate.getFullYear();
  const monthDiff = today.getMonth() - birthDate.getMonth();

  if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
    age--;
  }

  document.getElementById("age").value = age;
});

// Preview uploaded picture
document.getElementById("picture").addEventListener("change", function(event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const preview = document.getElementById("preview");
      preview.src = e.target.result;
      preview.style.display = "block";
    };
    reader.readAsDataURL(file);
  }
});

// Validate GWA
document.getElementById("registerForm").addEventListener("submit", function(e) {
  const gwa = parseFloat(document.getElementById("gwa").value);
  if (gwa < 90) {
    e.preventDefault();
    alert("Enrollment not allowed. GWA must be 90 or above.");
  }
});


// Toggle forms
function showForm(formId) {
  document.querySelectorAll(".form-box").forEach(f => f.classList.remove("active"));
  document.getElementById(formId).classList.add("active");
}

// Calculate age
document.getElementById("birthday").addEventListener("change", function() {
  const birthDate = new Date(this.value);
  const today = new Date();
  let age = today.getFullYear() - birthDate.getFullYear();
  const m = today.getMonth() - birthDate.getMonth();
  if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
  document.getElementById("age").value = age;
});

// Preview picture
document.getElementById("picture").addEventListener("change", function(e) {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const preview = document.getElementById("preview");
      preview.src = e.target.result;
      preview.style.display = "block";
    };
    reader.readAsDataURL(file);
  }
});

// REGISTER
document.getElementById("registerForm").addEventListener("submit", function(e) {
  e.preventDefault();
  const gwa = parseFloat(document.getElementById("gwa").value);
  if (gwa < 90) {
    document.getElementById("registerError").textContent = "Enrollment denied: GWA must be 90 or above.";
    return;
  }

  const name = document.getElementById("name").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const birthday = document.getElementById("birthday").value;
  const age = document.getElementById("age").value;
  const guardian = document.getElementById("guardianName").value;
  const guardianPhone = document.getElementById("guardianPhone").value;
  const program = document.getElementById("program").value;
  const pictureFile = document.getElementById("picture").files[0];

  const readerPic = new FileReader();
  readerPic.onload = function(e) {
    const picture = e.target.result;
    const user = { name, email, password, birthday, age, gwa, guardian, guardianPhone, program, picture };
    localStorage.setItem("userData", JSON.stringify(user));
    alert("Registration successful! Please login.");
    showForm("login-form");
  };
  readerPic.readAsDataURL(pictureFile);
});

// LOGIN
document.getElementById("loginForm").addEventListener("submit", function(e) {
  e.preventDefault();
  const email = document.getElementById("loginEmail").value;
  const password = document.getElementById("loginPassword").value;
  const user = JSON.parse(localStorage.getItem("userData") || "{}");

  if (user.email === email && user.password === password) {
    localStorage.setItem("loggedInUser", JSON.stringify(user));
    window.location.href = "user_page.html";
  } else {
    document.getElementById("loginError").textContent = "Incorrect email or password.";
  }
});



