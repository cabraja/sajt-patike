$(document).ready(function (){

    // REGISTRATION
    $("#register-btn").on('click', function (e){
        e.preventDefault();

        const username = $("#username");
        const email = $("#email");
        const phone = $("#phone");
        const password = $("#password");
        const passwordConfirm = $("#passwordConfirm");

        // REGEX
        const usernameReg = /^[a-z][a-z0-9]{5,16}$/i;
        const emailReg = /^[a-z0-9\.\-]+@[a-z0-9\.\-]+$/i;
        const phoneReg = /^[0][6][0-9]{7,12}$/;
        const passwordReg = /^(?=.*[a-z])(?=.*\d)[a-z\d]{8,20}$/i;

        let errors = 0;

        //     CHECK USERNAME
        if(!usernameReg.test(username.val())){
            username.next().html('Neispravno korisničko ime. Dozvoljeni su samo brojevi i slova i morate početi slovom.');
            errors++;
        }else{
            username.next().html('');
        }

        //     CHECK EMAIL
        if(!emailReg.test(email.val())){
            email.next().html('Neispravan format email adrese.');
            errors++;
        }else{
            email.next().html('');
        }

        //     CHECK PHONE
        if(!phoneReg.test(phone.val())){
            phone.next().html('Neispravan format mobilnog telefona. Telefon mora početi sa 06 (prihvatamo samo brojeve iz Srbije).');
            errors++;
        }else{
            phone.next().html('');
        }

        //     CHECK PASSWORD
        if(!passwordReg.test(password.val()) || password.val() === ""){
            password.next().html('Neispravan format lozinke. Dozvoljeni su samo slova i brojevi. Minimum 8 karaktera.');
            errors++;
        }else{
            password.next().html('');
        }

        //     CHECK PASSWORD CONFIRM
        if(passwordConfirm.val() !== password.val()){
            passwordConfirm.next().html('Ne poklapa se sa lozinkom iznad.');
            errors++;
        }else{
            passwordConfirm.next().html('');
        }


        if(errors === 0){
            $.ajax({
                url: 'models/auth/register.php',
                method: 'POST',
                data: {
                  username: username.val(),
                  email: email.val(),
                  phone: phone.val(),
                  password: password.val()
                },
                dataType: 'json',
                success: function (res){
                    var registerModal = new bootstrap.Modal(document.getElementById('register-modal'))
                    let message = `<p>${res.response}</p>`;
                    $("#register-modal-body").html(message);
                    registerModal.show();

                },
                error: function (err){
                    var registerModal = new bootstrap.Modal(document.getElementById('register-modal'))
                    let message = `<p>${res.response}</p>`;
                    $("#register-modal-body").html(message);
                    registerModal.show();
                }
            })
        }
    })

    $("#login-btn").on('click', function (e){
        e.preventDefault();
        // HIDE ALERT
        document.getElementById("login-alert").style.display = "none";

        const username = $("#username");
        const password = $("#password");

        // REGEX
        const usernameReg = /^[a-z][a-z0-9]{5,16}$/i;
        const passwordReg = /^(?=.*[a-z])(?=.*\d)[a-z\d]{8,20}$/i;

        let errors = 0;

        //     CHECK USERNAME
        if(!usernameReg.test(username.val())){
            username.next().html('Neispravno korisničko ime. Dozvoljeni su samo brojevi i slova i morate početi slovom.');
            errors++;
        }else{
            username.next().html('');
        }

        //     CHECK PASSWORD
        if(!passwordReg.test(password.val()) || password.val() === ""){
            password.next().html('Neispravan format lozinke. Dozvoljeni su samo slova i brojevi. Minimum 8 karaktera.');
            errors++;
        }else{
            password.next().html('');
        }

    //     CHECK CREDENTIALS
            if(errors === 0){
                $.ajax({
                    url: 'models/auth/login.php',
                    method: 'POST',
                    data: {
                        username: username.val(),
                        password: password.val()
                    },
                    dataType: 'json',
                    success: function (res){
                        window.location.href = "index.php";
                    },
                    error: function (err){
                        document.getElementById("login-alert").style.display = "block";
                    }
                })
            }

    })

})