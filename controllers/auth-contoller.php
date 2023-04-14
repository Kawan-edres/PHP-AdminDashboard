<?php

require_once "../config/config.php";
header('Content-Type: application/json');
ob_clean(); // This will clear the output buffer


//sign up 
if (isset($_POST['status']) && $_POST['status'] === 'signup') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password_hash = md5($_POST['password']);

    if (empty($fullname) || empty($email) || empty($password_hash)) {
        echo json_encode(array('success' => false, 'message' => 'Please fill in all fields.'));
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array('success' => false, 'message' => 'Please enter a valid email address.'));
        exit();
    }

    // Check if email already exists in the database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $db->query($query);

    if ($result->rowCount() > 0) {
        echo json_encode(array('success' => false, 'message' => 'Email already exists. Please enter a different email address.'));
        exit();
    } else {
        // Insert user data into the database
        $statement = $db->prepare("INSERT INTO users (name,email,password) VALUES(:name,:email,:password)");
        $statement->bindValue(':name', $fullname);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password_hash);
        $statement->execute();
        echo json_encode(array('success' => true, 'message' => 'User registered successfully.'));
        exit();
    }
}


// sign in
if (isset($_POST['status']) && $_POST['status'] === 'signin') {

    $email = $_POST['email'];
    $password_hash = md5($_POST['password']);
    $query = "SELECT id, name, email FROM users WHERE email = :email AND password= :password";
    $statement = $db->prepare($query);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':password', $password_hash);
    $statement->execute();


    if ($statement->rowCount() > 0) {
        $user = $statement->fetch(PDO::FETCH_OBJ);
        session_start();
        $_SESSION['user'] = $user;

        echo json_encode(['success' => true, 'message' => 'success', 'data' => $_POST]);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'wrong credentials']);
        exit();
    }
}



//forget password
if (isset($_POST['status']) && $_POST['status'] === 'forget') {
    require "email.php";
}

//reset password
if (isset($_POST['status']) && $_POST['status'] === 'reset' && $_POST["code"]) {

    $newPassword = $_POST["new_password"];
    $cNewPassword = $_POST["confirm_password"];
    $code = $_POST["code"];
    $email = $_POST["email"];

    if ($newPassword !== $cNewPassword) {
        echo json_encode(['success' => false, 'message' => 'password does not match']);
        exit();
    } else {

        $query = "SELECT email FROM `reset-password` WHERE code = :code";
        $statement = $db->prepare($query);
        $statement->bindValue(':code', $code);
        $statement->execute();
        $result = $statement->fetch();


        $query = "UPDATE users SET password = :password WHERE email = :email";
        $statement = $db->prepare($query);
        $statement->bindValue(':password', md5($newPassword));
        $statement->bindValue(':email', $email);

        // Delete reset password entry from the database
        if ($statement->execute()) {

            $query = "DELETE FROM `reset-password` WHERE code = :code";
            $statement = $db->prepare($query);
            $statement->bindValue(':code', $code);
            $statement->execute();
        }
        echo json_encode(['success' => true, 'message' => 'password updated successfully']);
        exit();
    }
}

//change password
if (isset($_POST['status']) && $_POST['status'] === 'change-password') {
    $currentPassword = $_POST["currentPassword"];
    $newPassword = md5($_POST["newPassword"]);
    $userID=$_POST["userId"];


    $stmt = $db->prepare("SELECT password FROM users WHERE id = :id");
    $stmt->bindParam(':id', $userID);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (md5($currentPassword) !== $user['password']) {
        echo json_encode(['success' => false, 'message' => 'Incorrect current password']);
        exit();
    } else {
        //prepare SQL query to update the password for the current user
        $stmt = $db->prepare("UPDATE users SET password=:password WHERE id=:id");

        //bind parameters
        $stmt->bindParam(':password', $newPassword);
        $stmt->bindParam(':id',$userID);

        //execute the query and update the password
        $stmt->execute();

        //return success message
        echo json_encode(['success' => true, 'message' => 'password changed successfully']);
        exit();
    }
}




//update account settings
if (isset($_POST['status']) && $_POST['status'] === 'update') {
    $userId = $_POST["userId"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    if (empty($name) || empty($email) || empty($phone)) {
        echo json_encode(array('success' => false, 'message' => 'Please fill in all fields.'));
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array('success' => false, 'message' => 'Please enter a valid email address.'));
        exit();
    } else {
        session_start();
        $_SESSION["user"]->name = $name;
        $_SESSION["user"]->email = $email;

        $statement = $db->prepare("UPDATE users SET name = :name, phone = :phone, email = :email WHERE id = :userId");
        $statement->execute(array(":name" => $name, ":email" => $email, ":phone" => $phone, ":userId" => $userId));
        echo json_encode(array('success' => true, 'message' => 'Account Settings updated'));
        exit();
    }
}


//update account image
if (isset($_POST['status']) && $_POST['status'] === 'img') {
    $userId = $_POST["userId"];


    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));


        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) {

                    if (!is_dir("uploads")) {
                        mkdir("uploads");
                    }
                    $fileNameNew = "profile" . $userId . "." . $fileActualExt;
                    $fileDestination = "uploads/" . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    $statement = $db->prepare("UPDATE users SET image = :image WHERE id = :userId");
                    $statement->execute(array(":image" => $fileNameNew, ":userId" => $userId));


                    echo json_encode(array('success' => true, 'message' => 'Profile image updated.'));
                } else {
                    echo json_encode(array('success' => false, 'message' => 'The file is too large.'));
                }
            } else {
                echo json_encode(array('success' => false, 'message' => 'There was an error uploading the file.'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Invalid file type.'));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'No file uploaded.'));
    }

    exit();
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request.', 'debug' => $_POST));
    exit();
}
