const iamgeForm = document.getElementById('update-form');
const msg= document.querySelector(".alert");

iamgeForm.addEventListener('submit', (event) => {
    event.preventDefault();
    const url = './controllers/auth-contoller.php';
    const data = new FormData(iamgeForm);

    fetch(url, {
            method: 'POST',
            body: data,

        })
        .then(response =>response.json())
        .then(data => {
            if (data.success) {
                msg.innerHTML=data.message;
                msg.style.display="block";
                msg.classList.add("alert-success");
                iamgeForm.reset(); // reset form
            } else {
                msg.innerHTML=data.message;
                msg.style.display="block";
                msg.classList.add("alert-danger");
            }
        })
        .catch(error => {
            console.error(error.message);
        });
});
