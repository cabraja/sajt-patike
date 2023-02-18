$(document).ready(function (){

    // SIZE PICK FUNCTION
    $(".size-div").on('click', function (event){
        let allSizes = document.querySelectorAll('.size-div');
        allSizes.forEach(size => {
            size.classList.remove('active-size')
        })

        event.target.classList.add('active-size')
    });

    // ADD TO CART FUNCTION
    $("#add-to-cart").on('click', function (e){
        const activeSize = document.querySelector('.active-size');
        const alert = document.getElementById("size-alert");
        const modelId = e.target.dataset.id;

        if(activeSize){
            alert.style.display = "none"
        }else{
            alert.style.display = "block"
            return;
        }

        const sizeId = activeSize.dataset.id;

        //CHECK IF CART ALREADY EXISTS, OTHERWISE CREATE ONE FOR LOGGED USER
        $.ajax({
            url: "models/cart/checkCart.php",
            method: "GET",
            dataType: "json",
            success:function (res){
                addModelToCart(modelId, sizeId, res.id)
            },error: function (err){
                console.log(err)
            }
        })



    });

    const addModelToCart = (modelId, sizeId, cartId) => {
        $.ajax({
            url: "models/cart/addToCart.php",
            method: "POST",
            dataType: "json",
            data: {
              modelId: modelId,
              sizeId: sizeId,
              cartId: cartId
            },
            success: function (res){
                let addProductModal = new bootstrap.Modal(document.getElementById('add-product-modal'))
                let message = `<p>${res.response}</p>`;
                $("#modal-text").html(message);
                addProductModal.show();
            },
            error: function (err){
                let addProductModal = new bootstrap.Modal(document.getElementById('add-product-modal'))
                let message = `<p>${err.response}</p>`;
                $("#modal-text").html(message);
                addProductModal.show();
            }
        })
    }


});