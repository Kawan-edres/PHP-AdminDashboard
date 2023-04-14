document.addEventListener("DOMContentLoaded", function() {
    const resetForm = document.querySelector("#reset-password-form");
    const resetMsg = document.querySelector("#msg");
   

    resetForm.addEventListener("submit", function(e) {
        e.preventDefault();

        const url = './controllers/auth-contoller.php';
        const formData = new FormData(resetForm);

        fetch(url, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                resetMsg.innerHTML = data.message;
                resetMsg.style.display = "block";
                resetMsg.classList.add("alert-success");
                resetForm.reset(); // reset form
                
            } else {
                resetMsg.innerHTML = data.message ;
                resetMsg.style.display = "block";
                resetMsg.classList.add("alert-danger");
            }
        })
        .catch(error => {
            console.error(error.message);
        });
    });
});
