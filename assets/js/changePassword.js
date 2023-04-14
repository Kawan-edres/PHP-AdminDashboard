document.addEventListener("DOMContentLoaded", function() {
    const changeForm = document.querySelector("#change-password");
    const changeMsg = document.querySelector("#change-passwordMsg");
   

    changeForm.addEventListener("submit", function(e) {
        e.preventDefault();

        const url = './controllers/auth-contoller.php';
        const formData = new FormData(changeForm);

        fetch(url, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                changeMsg.innerHTML = data.message;
                changeMsg.style.display = "block";
                changeMsg.classList.add("alert-success");
                changeForm.reset(); // reset form
            } else {
                changeMsg.innerHTML = data.message ;
                changeMsg.style.display = "block";
                changeMsg.classList.add("alert-danger");
            }
        })
        .catch(error => {
            console.error(error.message);
        });
    });
});
