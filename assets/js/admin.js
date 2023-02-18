$(document).ready(function (){

    // ADD NEW MODEL
    $("#new-model-btn").on('click', function (){
        const model_name = $("#model_name");
        const brandId = $(".brand-check:checked").val();
        const genderId = $(".gender-check:checked").val();
        const image_url = $("#image_url");
        const price = $("#price");

        // GET CHECKED SIZES
        let sizeArr = [];
        $("input:checkbox[name=size]:checked").each(function(){
            sizeArr.push($(this).val());
        });

        // REGEX
        const nameReg = /^[a-z0-9](.){6,50}$/i;
        const urlReg = /(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/;

        let errors = 0;

    //     CHECK MODEL NAME
        if(!nameReg.test(model_name.val())){
            model_name.next().html('Neispravno ime. Minimum 6 karaktera.');
            errors++;
        }else{
            model_name.next().html('');
        }

    //     CHECK BRAND
        if(!brandId){
            $("#brand-error").html('Izaberite brend.');
            errors++;
        }else{
            $("#brand-error").html('');
        }

    //     CHECK GENDER
        if(!genderId){
            $("#gender-error").html('Izaberite pol.');
            errors++;
        }else{
            $("#gender-error").html('');
        }

    //     CHECK SIZE
        if(sizeArr.length === 0){
            $("#size-error").html('Izaberite bar jednu veličinu.');
            errors++;
        }else{
            $("#size-error").html('');
        }

    //     CHECK IMAGE URL
        if(!urlReg.test(image_url.val())){
            image_url.next().html('Neispravni URL.');
            errors++;
        }else{
            image_url.next().html('');
        }

    //     CHECK PRICE
        if(price.val() <= 1){
            price.next().html('Cena ne sme biti manja od 1.');
            errors++;
        }else{
            price.next().html('');
        }

        if(errors === 0){
            $.ajax({
                url: 'models/products/addNew.php',
                method: 'POST',
                dataType: 'json',
                data: {
                  model_name:model_name.val(),
                  brandId: brandId,
                  genderId: genderId,
                  sizes: sizeArr,
                  image_url: image_url.val(),
                  price: price.val()
                },
                success: function (res){
                    let addProductModal = new bootstrap.Modal(document.getElementById('add-product-modal'))
                    let message = `<p>${res.response}</p>`;
                    $("#add-product-modal-text").html(message);
                    addProductModal.show();
                },
                error: function (err){
                    let addProductModal = new bootstrap.Modal(document.getElementById('add-product-modal'))
                    let message = `<p>${res.response}</p>`;
                    $("#add-product-modal-text").html(message);
                    addProductModal.show();
                }
            })
        }
    })

    // DELETE MODEL

    $(".delete-product-btn").on('click', function (e){
        let btn = e.target;
        if(e.target.tagName === 'I'){
            btn = e.target.parentElement;
        }

        $.ajax({
            url: 'models/products/delete.php',
            method: 'POST',
            dataType: 'json',
            data: {
                id: btn.dataset.id
            },
            success: function (res){
                location.reload();
            },
            error: function (err){
                let addProductModal = new bootstrap.Modal(document.getElementById('add-product-modal'))
                let message = `<p>Greska na serveru. Pokusajte kasnije.</p>`;
                $("#add-product-modal-text").html(message);
                addProductModal.show();
            }

        })
    })

//     EDIT MODEL
    $("#edit-model-btn").on('click' , function (e){
        e.preventDefault();
        const model_name = $("#model_name");
        const brandId = $(".brand-check:checked").val();
        const genderId = $(".gender-check:checked").val();
        const image_url = $("#image_url");
        const price = $("#price");
        const modelId = e.target.dataset.id;

        // GET CHECKED SIZES
        let sizeArr = [];
        $("input:checkbox[name=size]:checked").each(function(){
            sizeArr.push($(this).val());
        });

        // REGEX
        const nameReg = /^[a-z0-9](.){6,50}$/i;
        const urlReg = /(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/;

        let errors = 0;

        //     CHECK MODEL NAME
        if(!nameReg.test(model_name.val())){
            model_name.next().html('Neispravno ime. Minimum 6 karaktera.');
            errors++;
        }else{
            model_name.next().html('');
        }

        //     CHECK BRAND
        if(!brandId){
            $("#brand-error").html('Izaberite brend.');
            errors++;
        }else{
            $("#brand-error").html('');
        }

        //     CHECK GENDER
        if(!genderId){
            $("#gender-error").html('Izaberite pol.');
            errors++;
        }else{
            $("#gender-error").html('');
        }

        //     CHECK SIZE
        if(sizeArr.length === 0){
            $("#size-error").html('Izaberite bar jednu veličinu.');
            errors++;
        }else{
            $("#size-error").html('');
        }

        //     CHECK IMAGE URL
        if(!urlReg.test(image_url.val())){
            image_url.next().html('Neispravni URL.');
            errors++;
        }else{
            image_url.next().html('');
        }

        //     CHECK PRICE
        if(price.val() <= 1){
            price.next().html('Cena ne sme biti manja od 1.');
            errors++;
        }else{
            price.next().html('');
        }

        if(errors === 0){
            $.ajax({
                url: 'models/products/edit.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    id: modelId,
                    model_name:model_name.val(),
                    brandId: brandId,
                    genderId: genderId,
                    sizes: sizeArr,
                    image_url: image_url.val(),
                    price: price.val()
                },
                success: function (res){
                    let addProductModal = new bootstrap.Modal(document.getElementById('add-product-modal'))
                    let message = `<p>${res.response}</p>`;
                    $("#add-product-modal-text").html(message);
                    addProductModal.show();
                },
                error: function (err){
                    let addProductModal = new bootstrap.Modal(document.getElementById('add-product-modal'))
                    let message = `<p>Greska na serveru. Pokusajte kasnije.</p>`;
                    $("#add-product-modal-text").html(message);
                    addProductModal.show();
                }
            })
        }
    })


//     DELETE USER
    $(".delete-user-btn").on('click',function (e){
        let btn = e.target;
        if(e.target.tagName === 'I'){
            btn = e.target.parentElement;
        }

        $.ajax({
            url: 'models/auth/delete.php',
            method: 'POST',
            dataType: 'json',
            data: {
                id: btn.dataset.id
            },
            success: function (res){
                location.reload();
            },
            error: function (err){
                console.log(err)
            }
        })
    })

//     EDIT USER
    $("#edit-user-btn").on('click', function (e){
        e.preventDefault();
        const username = $("#username");
        const email = $("#email");
        const phone = $("#phone");
        const roleId = $(".role-check:checked").val();
        const userId = e.target.dataset.id;

        // REGEX
        const usernameReg = /^[a-z][a-z0-9]{5,16}$/i;
        const emailReg = /^[a-z0-9\.\-]+@[a-z0-9\.\-]+$/i;
        const phoneReg = /^[0][6][0-9]{7,12}$/;

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

        if(errors === 0){
            $.ajax({
                url: 'models/auth/edit.php',
                method: 'POST',
                data: {
                    username: username.val(),
                    email: email.val(),
                    phone: phone.val(),
                    roleId: roleId,
                    userId: userId
                },
                success: function (res){
                    var registerModal = new bootstrap.Modal(document.getElementById('register-modal'))
                    let message = `<p>${res.response}</p>`;
                    $("#register-modal-body").html(message);
                    registerModal.show();
                },
                error: function (err){
                    var registerModal = new bootstrap.Modal(document.getElementById('register-modal'))
                    let message = `<p>${err}</p>`;
                    $("#register-modal-body").html(message);
                    registerModal.show();
                }
            })
        }
    })
})