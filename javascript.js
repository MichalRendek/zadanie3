function toggleResetPswd(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle() // display:block or none
}

function toggleSignUp(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle(); // display:block or none
    $('#logreg-forms .form-signup').toggle(); // display:block or none
}

$(()=>{
    // Login Register Form
    $('#logreg-forms #btn-signup').click(toggleSignUp);
    $('#logreg-forms #cancel_signup').click(toggleSignUp);
})

$(document).ready(function () {
    let name = $('#user-name');
    let email = $('#user-email');
    let pass = $('#user-pass');
    let repass = $('#user-repeatpass');
    let email_verify = $('#user-email-verify');
    let qr_code = $('#qr_code');
    let qr_code_verify = $('#qr_code_verify');

    $('#signup_form').submit(function () {
        event.preventDefault();
        $.ajax({
            url: '2FA/signup.php',
            type : "POST",
            data : $(this).serialize(),
            success : function(data) {
                console.log(data);
                email.removeClass("is-invalid");
                email_verify.addClass("d-none");
                qr_code.removeClass("is-invalid");
                qr_code_verify.addClass("d-none");
                if (data.includes("for key 'user.email'")){
                    email.addClass("is-invalid");
                    email_verify.removeClass("d-none");
                } else if (data == "failed") {
                    qr_code.addClass("is-invalid");
                    qr_code_verify.removeClass("d-none");
                } else if (data == "success") {
                    $(location).attr('href', 'http://147.175.98.129/zadanie3?registrate=success')
                } else {
                    alert("Something gona wrong!")
                }
            }
        })
    })
});