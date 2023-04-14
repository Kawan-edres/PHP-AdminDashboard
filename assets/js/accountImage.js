const form = document.getElementById('image-form');
const imageMsg= document.querySelector(".alert-img");



form.addEventListener('submit', (event) => {
    event.preventDefault();
    const url = './controllers/auth-contoller.php';
    const data = new FormData(form);

    fetch(url, {
            method: 'POST',
            body: data,

        })
        .then(response =>response.json())
        .then(data => {
            if (data.success) {
                imageMsg.innerHTML=data.message;
                imageMsg.style.display="block";
                imageMsg.style.color="white";
                imageMsg.style.background="green";
                imageMsg.classList.add("alert-success");
                form.reset(); // reset form
            } else {
                imageMsg.innerHTML=data.message;
                imageMsg.style.display="block";
                imageMsg.style.color="white";
                imageMsg.style.background="red";
                imageMsg.classList.add("alert-danger");
            }
        })
        .catch(error => {
            console.error(error.message);
        });
});
