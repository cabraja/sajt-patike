$(document).ready(function (){

    // DELETE ONE ITEM
    $(".delete-cart-item").on('click' , function (e){
        let btn = null
        if(e.target.tagName === "I"){
            btn = e.target.parentElement;
        }else{
            btn = e.target;
        }

        const cartItemId = btn.dataset.id;

        $.ajax({
            url: 'models/cart/deleteFromCart.php',
            method: 'POST',
            dataType: 'json',
            data: {
                id:cartItemId
            },
            success: function (res){
                location.reload()
            },
            error: function (err){
                console.log(err)
            }
        })
    })

//     DELETE WHOLE CART
     $("#empty-cart-btn").on('click', function (){
         $.ajax({
             url: 'models/cart/emptyCart.php',
             method: 'POST',
             dataType: 'json',
             success: function (res){
                 location.reload()
             },
             error: function (err){
                 console.log(err)
             }
         })
     })
})