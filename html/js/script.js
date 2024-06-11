document.addEventListener("DOMContentLoaded", function() {
    let timeout;
    const strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})');
    const mediumPassword = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))');

    const registerPassword = document.querySelector('#registerPassword');
    const resetPassword = document.querySelector('#resetPassword');
    const passwordEye = document.querySelector('#passwordEye');
    const fl = document.querySelector('#fl');
    const forgetForm = document.querySelector('#forgetForm');

    if (registerPassword !== null) {
        registerPassword.addEventListener("input", () => {
            strengthBadge.style.display = 'block';
            clearTimeout(timeout);

            timeout = setTimeout(() => strengthChecker(registerPassword.value, strengthBadge), 300);

            if (registerPassword.value.length !== 0) {
                strengthBadge.style.display = 'block';
            } else {
                strengthBadge.style.display = 'none';
            }
        });
    }

    if (resetPassword !== null) {
        resetPassword.addEventListener("input", () => {
            strengthBadge.style.display = 'block';
            clearTimeout(timeout);

            timeout = setTimeout(() => strengthChecker(resetPassword.value, strengthBadge), 300);

            if (resetPassword.value.length !== 0) {
                strengthBadge.style.display = 'block';
            } else {
                strengthBadge.style.display = 'none';
            }
        });
    }

    if (passwordEye !== null) {
        passwordEye.addEventListener('click', function () {
            let passwordVisibility = document.querySelector('.passwordVisibility');
            let type = passwordVisibility.getAttribute("type") === "password" ? "text" : "password";

            if (type === "text") {
                this.classList.remove('bi-eye-slash-fill');
                this.classList.add('bi-eye-fill');
            } else {
                this.classList.remove('bi-eye-fill');
                this.classList.add('bi-eye-slash-fill');
            }
            passwordVisibility.setAttribute("type", type);
        });
    }

    if (fl !== null) {
        fl.addEventListener('click', function (e) {
            let forgetForm = document.querySelector('#forgetForm');

            if (forgetForm.style.display !== "block") {
                forgetForm.style.display = "block";
                this.textContent = 'Hide form.';
            } else {
                forgetForm.style.display = "none";
                this.textContent = 'Have you forgotten your password?';
            }

            e.preventDefault();
        });
    }

    if (forgetForm !== null) {
        forgetForm.addEventListener('submit', function (e) {
            e.preventDefault();

            let isValid = true;
            const forgetEmail = document.querySelector('#forgetEmail');

            if (forgetEmail.value.trim() === "") {
                showErrorMessage(forgetEmail, 'Email cannot be empty.');
                isValid = false;
            } else if (!isValidEmail(forgetEmail.value.trim())) {
                showErrorMessage(forgetEmail, 'Email is in incorrect format!');
                isValid = false;
            } else {
                hideErrorMessage(forgetEmail);
            }

            if (isValid) this.submit();
        });
    }
});
