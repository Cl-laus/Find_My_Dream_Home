const form = document.getElementById("register-container");
const email = document.getElementById("email");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirm-password");
const button = document.querySelector("button");

const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

function checkAuth(event) {
  event.preventDefault();

  let isValid = true;

  document.querySelectorAll(".error").forEach((el) => (el.textContent = ""));
  // document.querySelectorAll("input").forEach((el) => el.classList.remove("invalid"));

  if (!emailRegex.test(email.value)) {
    isValid = false;
    // email.classList.add("invalid");
    document.getElementById("emailError").textContent =
      "Veuillez entrer une adresse email valide.";
  }

  if (!passwordRegex.test(password.value)) {
    isValid = false;
    // password.classList.add("invalid");
    document.getElementById("passwordError").textContent =
      "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
  }

  if (password.value !== confirmPassword.value) {
    isValid = false;
    // confirmPassword.classList.add("invalid");
    document.getElementById("confirmPasswordError").textContent =
      "Les mots de passe ne correspondent pas.";
  }
  // Active ou désactive le bouton en fonction de la validité
  button.disabled = !isValid;
  button.style.display = isValid ? "inline-block" : "none";
}

form.addEventListener("input", checkAuth);
