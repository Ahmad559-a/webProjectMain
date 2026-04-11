let form=document.getElementById("contact-form");

form.addEventListener("submit",function(e){
    e.preventDefault();

    let namevalue=document.getElementById("name").value;
    let emailvalue=document.getElementById("email").value;
    let subjectvalue=document.getElementById("subject").value;
    let messagevalue=document.getElementById("message").value;

    let errorMsg=document.getElementById("error-message");
    let successMsg=document.getElementById("success-message");

    errorMsg.textContent="";
    successMsg.textContent="";

    if(namevalue === "" || emailvalue === "" || subjectvalue === "" || messagevalue === ""){
        errorMsg.textContent="Error, All fields are required."
        return
    }

    let emailpattern=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    if(emailpattern.test(emailvalue) === false){
        errorMsg.textContent="Error, Enter a valid email address."
        return;
    }

    successMsg.textContent="Your message has been sent successfully."

});