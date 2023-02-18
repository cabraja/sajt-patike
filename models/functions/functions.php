<?php
    function addNewModel($model_name, $id_brand, $id_gender, $price, $image){
        global $conn;

        $free_shipping = 1;

        $query = "INSERT INTO models(model_name, id_brand, id_gender, price, image_url, free_shipping) VALUES(:model_name, :id_brand, :id_gender, :price, :image, :free_shipping)";

        $prepare = $conn->prepare($query);
        $prepare->bindParam(":model_name",$model_name);
        $prepare->bindParam(":id_brand",$id_brand);
        $prepare->bindParam(":id_gender",$id_gender);
        $prepare->bindParam(":price",$price);
        $prepare->bindParam(":image",$image);
        $prepare->bindParam(":free_shipping",$free_shipping);
        $prepare->execute();
        return $conn->lastInsertId();
    }

    function addSizesToModel($id_model, $sizes){
        global $conn;

        foreach ($sizes as $size){
            $query = "INSERT INTO model_size(id_model, id_size) VALUES(:id_model, :id_size)";

            $prepare = $conn->prepare($query);
            $prepare->bindParam(":id_model",$id_model);
            $prepare->bindParam(":id_size",$size);
            $prepare->execute();
        }
        return $conn->lastInsertId();
    }

    function deleteModel($id){
        global $conn;

        $query = 'DELETE FROM models where id = :id';
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id",$id);
        return $prepare->execute();
    }

    function editModel($id,$model_name, $id_brand, $id_gender, $price, $image){
        global $conn;

        $query = "UPDATE models
                  SET model_name = :model_name, id_brand = :id_brand, id_gender = :id_gender, price = :price, image_url = :image
                  WHERE id = :id";

        $prepare = $conn->prepare($query);
        $prepare->bindParam(":model_name",$model_name);
        $prepare->bindParam(":id_brand",$id_brand);
        $prepare->bindParam(":id_gender",$id_gender);
        $prepare->bindParam(":price",$price);
        $prepare->bindParam(":image",$image);
        $prepare->bindParam(":id",$id);
        return $prepare->execute();
    }

    function editModelSizes($id_model, $sizes){
        global $conn;

        $query = "DELETE FROM model_size where id_model = :id";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id",$id_model);

        if($prepare->execute()){
            foreach ($sizes as $size){
                $query = "INSERT INTO model_size(id_model, id_size) VALUES(:id_model, :id_size)";

                $prepare = $conn->prepare($query);
                $prepare->bindParam(":id_model",$id_model);
                $prepare->bindParam(":id_size",$size);
                $prepare->execute();
            }
        }
        return $conn->lastInsertId();
    }
        function getNewModels(){
            global $conn;

            $query = "SELECT * FROM `models` ORDER BY date_added DESC LIMIT 3";
            return $conn->query($query)->fetchAll();

        }

    function getModels($page){
        global $conn;

        $offset = ($page-1)*6;

        $query = "SELECT model_name,price, m.id, image_url, brand_name FROM models m INNER JOIN brands b ON m.id_brand = b.id  LIMIT 6 OFFSET ".$offset;
        return $conn->query($query)->fetchAll();
    }

    function searchModels($keyword){
        global $conn;

        $query = "SELECT model_name, m.id, image_url FROM models m INNER JOIN brands b ON m.id_brand = b.id WHERE model_name LIKE '%".$keyword."%' OR brand_name LIKE '%".$keyword."%'";

        return $conn->query($query)->fetchAll();
    }

    function getAllBrands(){
        global $conn;

        $query = "SELECT * FROM `brands`";
        return $conn->query($query)->fetchAll();
    }

    function getAllGenders(){
        global $conn;

        $query = "SELECT * FROM `genders`";
        return $conn->query($query)->fetchAll();
    }

    function getSingleModel($id){
        global $conn;
        $query = "SELECT * FROM models m INNER JOIN brands b on m.id_brand = b.id INNER JOIN genders g ON m.id_gender = g.id WHERE m.id = :id";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id",$id);
        $prepare->execute();
        return $prepare->fetch();
    }

    function getAllSizes(){
        global $conn;

        $query = "SELECT * FROM `sizes`";
        return $conn->query($query)->fetchAll();
    }

    function getModelSizes($id){
        global $conn;

        $query = "SELECT s.id, s.size FROM model_size ms INNER JOIN sizes s ON ms.id_size = s.id WHERE ms.id_model = :id";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id",$id);
        $prepare->execute();
        return $prepare->fetchAll();
    }

    function getModelCount(){
        global $conn;
        $query = "SELECT COUNT(*) as count FROM models";
        return $conn->query($query)->fetch();
    }

//    ----------------------------------------------------------
//    AUTHORIZATION AND USERS
    function addUser($username, $email,$phone, $password, $roleId ){
        global $conn;

        $query = "INSERT INTO users(username, email, phone, password, id_role) VALUE(:username, :email, :phone, :password, :roleId)";

        $prepare = $conn->prepare($query);
        $prepare->bindParam(":username",$username);
        $prepare->bindParam(":email",$email);
        $prepare->bindParam(":phone",$phone);
        $prepare->bindParam(":password",$password);
        $prepare->bindParam(":roleId",$roleId);
        return $prepare->execute();
    }

    function getUser($id){
        global $conn;

        $query = "SELECT u.id, username, email, phone, email, id_role, role_name FROM users u INNER JOIN roles r ON u.id_role = r.id WHERE u.id = :id";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id",$id);
        $prepare->execute();
        return $prepare->fetch();
    }

    function checkIfEmailExists($email){
        global $conn;

        $query = "SELECT email FROM `users` WHERE email = :email";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":email",$email);
        $prepare->execute();
        return $prepare->fetch();
    }

    function loginAttempt($username, $password){
        global $conn;

        $query = "SELECT u.id, username, email, phone, r.role_name FROM users u INNER JOIN roles r on u.id_role = r.id WHERE username = :username AND password = :password";

        $prepare = $conn->prepare($query);
        $prepare->bindParam(":username",$username);
        $prepare->bindParam(":password",$password);
        $prepare->execute();
        return $prepare->fetch();
    }

    function getAllUsers($page){
        global $conn;

        $offset = ($page-1)*5;

        $query = "SELECT u.id, username, email, phone,date_reg, r.role_name FROM users u INNER JOIN roles r on u.id_role = r.id LIMIT 5 OFFSET ".$offset;
        return $conn->query($query)->fetchAll();
    }
    function getUsersCount(){
        global $conn;
        $query = "SELECT COUNT(*) as count FROM users";
        return $conn->query($query)->fetch();
    }

    function deleteUser($id){
        global $conn;

        $query = "DELETE FROM users WHERE id= :id";

        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id",$id);
        return $prepare->execute();
    }

    function editUser($id, $username, $email, $phone, $id_role){
        global $conn;

        $query = "UPDATE users
                  SET username= :username, email= :email, phone= :phone, id_role= :id_role
                  WHERE id = :id";

        $prepare = $conn->prepare($query);
        $prepare->bindParam(":username",$username);
        $prepare->bindParam(":email",$email);
        $prepare->bindParam(":phone",$phone);
        $prepare->bindParam(":id_role",$id_role);
        $prepare->bindParam(":id",$id);
        return $prepare->execute();
    }

    function getAllRoles(){
        global $conn;

        $query = "SELECT * FROM roles";
        return $conn->query($query)->fetchAll();
    }

    //    ----------------------------------------------------------
    //    CART FUNCTIONS

    function checkIfCartExistsAndReturn($id_user){
        global $conn;

        $query = "SELECT id FROM carts WHERE id_user = :id_user";

        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id_user",$id_user);
        $prepare->execute();
        return $prepare->fetch();
    }

    function createCart($id_user){
        global $conn;

        $query = "INSERT INTO carts(id_user) VALUES(:id_user)";

        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id_user",$id_user);
        return $prepare->execute();
    }

    function addToCart($id_model, $id_size, $id_cart){
        global $conn;

        $query = "INSERT INTO cart_item(id_model, id_size, id_cart) VALUES(:id_model, :id_size, :id_cart)";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id_model",$id_model);
        $prepare->bindParam(":id_size",$id_size);
        $prepare->bindParam(":id_cart",$id_cart);
        return $prepare->execute();
    }

    function getCart($id_cart){
        global $conn;

        $query = "SELECT ci.id, size, image_url, model_name, price FROM cart_item ci INNER JOIN models m ON ci.id_model = m.id INNER JOIN sizes s ON s.id = ci.id_size WHERE ci.id_cart = :id_cart";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id_cart",$id_cart);
        $prepare->execute();
        return $prepare->fetchAll();
    }

    function deleteItemFromCart($id){
        global $conn;

        $query = "DELETE FROM cart_item WHERE id = :id";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id",$id);
        return $prepare->execute();
    }

    function emptyCart($id_cart){
        global $conn;

        $query = "DELETE FROM cart_item WHERE id_cart = :id_cart";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id_cart",$id_cart);
        return $prepare->execute();
    }

//    CONTACT FUNCTIONS
    function addMessage($id_user, $subject, $body){
        global $conn;

        $query = "INSERT INTO messages(id_user,subject,body) VALUES(:id_user, :subject, :body)";

        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id_user",$id_user);
        $prepare->bindParam(":subject",$subject);
        $prepare->bindParam(":body",$body);
        return $prepare->execute();
    }

    function getAllMessages(){
        global $conn;

        $query = "SELECT m.id, body, subject, m.date, username FROM messages m INNER JOIN users u ON m.id_user = u.id";
        return $conn->query($query)->fetchAll();
    }

    function deleteMessage($id){
        global $conn;

        $query = "DELETE FROM messages WHERE id=:id";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id",$id);
        return $prepare->execute();
    }

//    POLL FUNCTIONS
    function addVote($id_user, $id_brand){
        global $conn;

        $query = "INSERT INTO polls(id_user,id_brand) VALUES(:id_user, :id_brand)";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id_user",$id_user);
        $prepare->bindParam(":id_brand",$id_brand);
        return $prepare->execute();
    }

    function checkUserVote($id){
        global $conn;

        $query = "SELECT * FROM polls WHERE id_user = :id";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id",$id);
        $prepare->execute();
        return $prepare->fetch();
    }

    function getPollResults(){
        global $conn;

        $query = "SELECT * FROM polls p INNER JOIN brands b ON p.id_brand = b.id";
        return $conn->query($query)->fetchAll();
    }


?>