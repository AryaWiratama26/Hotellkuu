<?php

include 'connect.php';

// Buat Register Account
if(isset($_POST['signUp'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    $checkEmail = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmail);
    if ($result->num_rows>0){
        echo "<script>alert('Email sudah terdaftar!')</script>";
        echo "<script>window.location.href='logSign.php'</script>";
    }else {
        $insertQuery = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if($conn->query($insertQuery) === TRUE){
            echo "<script>alert('Registrasi berhasil!')</script>";
            header('Location: logSign.php');
        }else {
            echo "<script>alert('Registrasi gagal!')</script>";        }
    }
}


// Buat login account
if(isset($_POST['signIn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    $checkUser = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($checkUser);
    if ($result->num_rows>0){
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['name'] = $row['name'];
        header('Location: main.php');
        echo "<script>alert('Login berhasil!')</script>";
        exit();
    }else {
        echo "<script>alert('Login gagal!')</script>";
    }
}

?>