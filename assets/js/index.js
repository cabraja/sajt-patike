$(document).ready(function (){
    $("#poll-vote-btn").on('click', function (){
        const brandId = $(".brand-check:checked").val();
        const error = $("#poll-error");
        const success = $("#poll-success");

        if(!brandId){
            error.html("Izaberite jednu od opcija.");
        }else{
           error.html("");

            $.ajax({
                url: 'models/poll/vote.php',
                method: 'POST',
                dataType: 'json',
                data:{
                    brandId: brandId
                },
                success: function (res){
                    error.html('')
                    success.html('')
                    if(res.done === 1){
                        success.html(res.response);
                    }else{
                        error.html(res.response);
                    }
                },
                error: function (err){
                    console.log(err)
                }
            })
        }
    })


})