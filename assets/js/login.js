document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.querySelector("#login-form");
    const loginMsg = document.querySelector(".alert");
    console.log(loginMsg)

    loginForm.addEventListener("submit", function(e) {
        e.preventDefault();

        const url = './controllers/auth-contoller.php';
        const formData = new FormData(loginForm);

        fetch(url, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loginMsg.innerHTML = data.message;
                loginMsg.style.display = "block";
                loginMsg.classList.add("alert-success");
                window.location = '/A-Kawan-Idrees-Mawlood3/dashboard';
                loginForm.reset(); // reset form
            } else {
                loginMsg.innerHTML = data.message ;
                loginMsg.style.display = "block";
                loginMsg.classList.add("alert-danger");
            }
        })
        .catch(error => {
            console.error(error.message);
        });
    });
});
