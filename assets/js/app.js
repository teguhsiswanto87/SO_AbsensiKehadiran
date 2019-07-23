//password & repeat password validation
function checkPass() {
    //element
    let message = document.getElementById("messageId");
    let confirmPassword = document.getElementById("confirmPasswordId");
    let password = document.getElementById("passwordId");

    if (document.getElementById("password").value
        === document.getElementById("confirmPassword").value) {
        password.classList.remove("error");
        confirmPassword.classList.remove("error");
        message.innerHTML = 'Password cocok';
        message.style.color = 'green';
    } else {
        message.style.color = 'red';
        password.classList.add("error");
        confirmPassword.classList.add("error");
        message.innerHTML = 'Konfirmasi password tidak valid';
    }
    return false;
}