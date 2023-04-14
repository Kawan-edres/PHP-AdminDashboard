document.addEventListener("DOMContentLoaded", function() {
    const forgetForm = document.querySelector("#forget-password-form");
    const forgetMsg = document.querySelector("#msg");
   

    forgetForm.addEventListener("submit", function(e) {
        e.preventDefault();

        const url = './controllers/auth-contoller.php';
        const formData = new FormData(forgetForm);

        fetch(url, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                forgetMsg.innerHTML = data.message;
                forgetMsg.style.display = "block";
                forgetMsg.classList.add("alert-success");
                forgetForm.reset(); // reset form
            } else {
                forgetMsg.innerHTML = data.message ;
                forgetMsg.style.display = "block";
                forgetMsg.classList.add("alert-danger");
            }
        })
        .catch(error => {
            console.error(error.message);
        });
    });
});
