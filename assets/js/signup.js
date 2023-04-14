const signUpform = document.getElementById('signup-form');
const signUpmsg= document.querySelector(".alert");

signUpform.addEventListener('submit', (event) => {
    event.preventDefault();

    const url = './controllers/auth-contoller.php';
    const data = new FormData(signUpform);

    fetch(url, {
            method: 'POST',
            body: data,

        })
        .then(response =>response.json())
        .then(data => {
            if (data.success) {
                signUpmsg.innerHTML=data.message;
                signUpmsg.style.display="block";
                signUpmsg.classList.add("alert-success");
               
                setTimeout(()=>{
                    window.location = 'login.php';
                },500)

                signUpform.reset(); // reset form
            } else {
                signUpmsg.innerHTML=data.message;
                signUpmsg.style.display="block";
                signUpmsg.classList.add("alert-danger");
            }
        })
        .catch(error => {
            console.error(error.message);
        });
});
