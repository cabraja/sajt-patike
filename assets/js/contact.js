$(document).ready(function (){
    $("#send-message-btn").on('click', function (e){
        e.preventDefault();
        const subject = $("#subject");
        const body = $("#body");

        let errors = 0;

        //     CHECK SUBJECT
        if(subject.val().length < 4){
            subject.next().html('Naslov mora imati bar 4 karaktera.');
            errors++;
        }else{
            subject.next().html('');
        }
        //     CHECK TEXT BODY
        if(body.val().length < 8){
            body.next().html('Poruka mora imati bar 8 karaktera.');
            errors++;
        }else{
            body.next().html('');
        }


        if(errors === 0){
            $.ajax({
                url: 'models/contact/send.php',
                method: 'POST',
                dataType: 'json',
                data: {
                  subject: subject.val(),
                  body: body.val()
                },
                success: function (res){
                    var contactModal = new bootstrap.Modal(document.getElementById('contact-modal'))
                    let message = `<p>${res.response}</p>`;
                    $("#contact-modal-text").html(message);
                    contactModal.show();
                },
                error: function (err){
                    var contactModal = new bootstrap.Modal(document.getElementById('contact-modal'))
                    let message = `<p>${err}</p>`;
                    $("#contact-modal-body").html(message);
                    contactModal.show();

                }
            })
        }
    })
})